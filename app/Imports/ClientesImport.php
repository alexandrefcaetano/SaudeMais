<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ClientesImport implements ToCollection
{
    public $errors = [];
    public $validRows = [];

    const COLUNAS_OBRIGATORIAS = [
        '1'  => 'Codigo Transacao',
        '2'  => 'Número',
        '3'  => 'Título',
        '4'  => 'Objeto',
        '5'  => 'Início',
        '6'  => 'Fim',
        '7'  => 'Atualizado',
        '8'  => 'Situacao',
        '9'  => 'Modalidade',
        '10'  => 'Executor',
        '11'  => 'Endereco',
        '12'  => 'Tipo',
        '13'  => 'Percentual Execucao Fisica',
        '14'  => 'Municipio',
        '15'  => 'Valor Investimento',
        '16'  => 'Valor Repasse',
        '17' => 'Valor Empenhado',
        '18' => 'Financeiro Executado'
    ];

    const COLUNAS_COM_DATA = [
        '4'   => 'Data Nascimento',
        '11'  => 'Data inicio',
        '12'  => 'Data inicio cobertura',
        '13'  => 'Data fim cobertura',
        '17'  => 'Data Admissão'
    ];

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

        $linhas_analise = [];

        foreach ($rows as $idLinha => $linha) {

            // Verifica o cabeçalho (primeira linha)
            if ($idLinha == 0) {
                if (1 == 1
//                    strtolower($linha[0])  == 'nome do grupo' &&
//                    strtolower($linha[1])  == 'empresa do segurado' &&
//                    strtolower($linha[2])  == 'n° individual' &&
//                    strtolower($linha[3])  == 'nome completo' &&
//                    strtolower($linha[4])  == 'data nascimento' &&
//                    strtolower($linha[5])  == 'genero' &&
//                    strtolower($linha[6])  == 'relação' &&
//                    strtolower($linha[7])  == 'estado civil' &&
//                    strtolower($linha[8])  == 'status' &&
//                    strtolower($linha[9])  == 'produto' &&
//                    strtolower($linha[10]) == 'apolice' &&
//                    strtolower($linha[11]) == 'data início' &&
//                    strtolower($linha[12]) == 'data inicio cobertura' &&
//                    strtolower($linha[13]) == 'data fim cobertura' &&
//                    strtolower($linha[14]) == 'nacionalidade' &&
//                    strtolower($linha[15]) == 'pais de origem' &&
//                    strtolower($linha[16]) == 'nº do empregado' &&
//                    strtolower($linha[17]) == 'data admissão' &&
//                    strtolower($linha[18]) == 'lotação' &&
//                    strtolower($linha[19]) == 'cargo do empregado' &&
//                    strtolower($linha[20]) == 'email' &&
//                    strtolower($linha[21]) == 'observação' &&
//                    strtolower($linha[22]) == 'bi' &&
//                    strtolower($linha[23]) == 'provincia' &&
//                    strtolower($linha[24]) == 'municipio' &&
//                    strtolower($linha[25]) == 'contacto' &&
//                    strtolower($linha[26]) == 'dias carencia' &&
//                    strtolower($linha[27]) == 'seguir regra carencia' &&
//                    strtolower($linha[28]) == 'data cancelamento' &&
//                    strtolower($linha[29]) == 'motivo cancelamento' &&
//                    strtolower($linha[30]) == 'numero seguradora'
                ) {
                    // Cabeçalho correto, continuar processando as linhas
                    continue;
                } else {


                    // Cabeçalho fora do padrão, adiciona erro
                    $linhas_analise['erros'][$idLinha][] = $this->setErroPara(
                        $linha->toArray(),
                        '',
                        'vazio',
                        1,
                        'Arquivo Inválido. Motivo: Cabeçalho fora do padrão'
                    );
                    $this->errors = $linhas_analise;

                    return $linhas_analise;
                }
            }

            // Verifica se a linha não está completamente vazia
            if (!empty(array_filter($linha->toArray()))) {
                // Validações
                $this->setErroParaColunaObrigatoria($idLinha, $linha->toArray(), $linhas_analise);
                $this->setErroParaColunaComData($idLinha, $linha->toArray(), $linhas_analise);
                $this->setErroParaSituacaoInvalida($idLinha, $linha->toArray(), $linhas_analise);

                // Se não houver erros na linha, adiciona aos sucessos
                if (!isset($linhas_analise['erros'][$idLinha])) {
                    $linhas_analise['sucessos'][] = $linha;
                }
            }
        }

        // Armazena os erros na propriedade da classe
        $this->errors = $linhas_analise;
        return $linhas_analise;
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

    /**
     * Converte uma data no formato Excel para o formato de data legível.
     */
    private function convertExcelDate($excelDate)
    {
        if (is_numeric($excelDate)) {
            return Carbon::create(1900, 1, 1)->addDays($excelDate - 2)->format('Y-m-d');
        }

        return null;
    }

    private function setErroParaColunaObrigatoria(int $idLinha, array $linha, array &$linhas_analise)
    {
        foreach (array_keys(self::COLUNAS_OBRIGATORIAS) as $coluna) {
            if (empty($linha[$coluna]) && $linha[$coluna] != '0.00') {
                $descricaoColuna = self::COLUNAS_OBRIGATORIAS[$coluna];

                $linhas_analise['erros'][$idLinha][] = $this->setErroPara(
                    $linha,
                    $descricaoColuna,
                    'vazio',
                    $idLinha,
                    'Campo ' . $descricaoColuna . ' é obrigatório'
                );
            }
        }
    }

    private function setErroParaColunaComData(int $idLinha, array $linha, array &$linhas_analise)
    {
        // Converte as datas
        $linha[4]  = $this->convertExcelDate($linha[4]); // Data de início
        $linha[11] = $this->convertExcelDate($linha[11]); // Data de início
        $linha[12] = $this->convertExcelDate($linha[12]); // Data de início cobertura
        $linha[13] = $this->convertExcelDate($linha[13]); // Data de fim cobertura
        $linha[17] = $this->convertExcelDate($linha[17]); // Data de admissão

        foreach (array_keys(self::COLUNAS_COM_DATA) as $coluna) {
            if (empty($linha[$coluna])) {
                continue;
            }

            if (!preg_match('/\d{4}-\d{2}-\d{2}/', $linha[$coluna])) {
                $descricaoColuna = self::COLUNAS_COM_DATA[$coluna];
                $linhas_analise['erros'][$idLinha][] = $this->setErroPara(
                    $linha,
                    $descricaoColuna,
                    'data_invalida',
                    $idLinha,
                    'Formato de data inválido na coluna ' . $descricaoColuna
                );
            }
        }
    }

    private function setErroParaSituacaoInvalida(int $idLinha, array $linha, array &$linhas_analise)
    {
        if (!empty($linha[8]) && !in_array($linha[8], ['ATIVA', 'CANCELADA', 'SUSPENSA'])) {
            $linhas_analise['erros'][$idLinha][] = $this->setErroPara(
                $linha,
                'Situação',
                'situacao_invalida',
                $idLinha,
                'Situação inválida: ' . $linha[8]
            );
        }
    }

    private function setErroPara(array $linha, string $item, string $valorItem = '', int $idLinha, string $descricao = ''): array
    {
        $valorItem = $valorItem ?? 'vazio';

        return [
            'codigo_transacao' => $linha[0],
            'item'             => $item,
            'descricao'        => (empty($descricao))? "Valor <b>$valorItem</b> inválido para $item" : $descricao,
            'id_linha'         => $idLinha,
            'valor_item'       => $valorItem
        ];
    }

}
