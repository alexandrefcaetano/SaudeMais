<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClientesImport implements ToCollection
{
    public $errors = [];
    public $validRows = [];

    /**
     * Função para completar número com zeros à esquerda.
     */
    protected function completarNum($num, $length)
    {
        return str_pad($num, $length, '0', STR_PAD_LEFT);
    }

    /**
     * Gera o número de cartão, verifica se já existe e faz a lógica de incremento.
     */
    protected function gerarNumeroCartao($idApolice, $lote)
    {
        $numeroCliente = session()->get('numeroCliente', 1);
        $numeroCartao = date("y") . $this->completarNum($idApolice, 4) . $this->completarNum($lote, 2) . $this->completarNum($numeroCliente, 4) . "-00";

        // Verifica se o número de cartão já existe no banco
        $cartaoExistente = DB::table('tb_cliente')->where('numerocartao', $numeroCartao)->exists();

        if ($cartaoExistente) {
            $x = 1;
            while ($lote <= 99) {
                $lote++;
                $numeroCartao = date("y") . $this->completarNum($idApolice, 4) . $this->completarNum($lote, 2) . $this->completarNum(1, 4) . "-00";

                $cartaoExistente = DB::table('tb_cliente')->where('numerocartao', $numeroCartao)->exists();
                if (!$cartaoExistente) {
                    break;
                }

                if ($lote == 99) {
                    $lote = 1;
                }
                $x++;
                if ($x > 99) {
                    throw new \Exception('Não foi possível gerar um número de cartão único.');
                }
            }
        }

        session()->put('numeroCliente', $numeroCliente + 1);
        return $numeroCartao;
    }

    /**
     * Recebe a coleção de dados para validar e preparar os registros.
     */
    public function collection(Collection $rows)
    {

        //dd($rows);
        foreach ($rows as $index => $row) {
            $tipoCartao = $row[14];
            $numeroCartao = $row[11];
            $idApolice = $row[9];
            $lote = $row[7];

            // Geração do número do cartão, se necessário
            if ($tipoCartao === "S" && empty($numeroCartao)) {
                try {
                    $numeroCartao = $this->gerarNumeroCartao($idApolice, $lote);
                } catch (\Exception $e) {
                    $this->errors[] = [
                        'linha' => $index + 1,  // Exibe a linha do arquivo
                        'erro' => $e->getMessage(),
                        'dados' => $row
                    ];
                    continue;
                }
            }

            // Valida os dados
            $validator = Validator::make($row->toArray(), [
                '0' => 'required|string|max:145', // Nome
                '1' => 'nullable|string|max:30',  // CPF
                '2' => 'nullable|date',           // Data de nascimento
                '3' => 'nullable|email|max:255',  // Email
                '11' => 'nullable|string|unique:tb_cliente,numerocartao', // Número do cartão
                // Adicione as outras validações necessárias
            ]);

            if ($validator->fails()) {
                $this->errors[] = [
                    'linha' => $index + 1,
                    'erro' => $validator->errors()->first(),
                    'dados' => $row
                ];
                continue;
            }

            // Se passar pela validação, armazena para importação posterior
            $this->validRows[] = new Cliente([
                'nome' => $row[1],
                'cpf' => $row[2],
                'datanascimento' => $row[3],
                'email' => $row[4],
                'bi' => $row[5],
                'numerocartao' => $numeroCartao,
                'lote' => $lote,
                'id_apolice' => $idApolice,
                'genero' => $row[7],
                'contato' => json_encode($row[8]),
                // Adicione outros campos aqui
            ]);
        }
    }

    /**
     * Retorna os erros para serem exibidos ao usuário.
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Retorna os registros válidos prontos para inserção no banco.
     */
    public function getValidRows()
    {
        return $this->validRows;
    }
}
