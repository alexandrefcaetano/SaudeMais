<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioCencusSeguroExport implements FromCollection, WithHeadings
{
    private int $empresa_id; // Pode ser int ou string dependendo do tipo de dados da empresa_id
    private int $seguradora_id; // O tipo é opcional
    private int $apolice_id; // O tipo é opcional

    /**
     * Construtor da classe RelatorioCencusSeguroExport.
     *
     * @param int|string $empresa_id ID da empresa (obrigatório).
     * @param int|string|null $seguradora_id ID da seguradora (opcional).
     * @param int|string|null $apolice_id ID da apólice (opcional).
     */
    public function __construct(int $empresa_id, int $seguradora_id = null, int $apolice_id = null)
    {
        $this->empresa_id = $empresa_id;
        $this->seguradora_id = $seguradora_id;
        $this->apolice_id = $apolice_id;
    }

    /**
     * Obtém a coleção de dados a serem exportados.
     *
     * @return Collection A coleção com os dados dos clientes.
     */
    public function collection(): Collection
    {
        $query = Cliente::DB("
            SELECT seg.seguradora,
                   emp.nomeFantasia AS empresa,
                   apo.apolice,
                   apo.resseguro,
                   apo.apoliceSeguradora,
                   CASE
                       WHEN apo.dataFimCobertura < NOW() THEN 'BLOQUEADO'
                       ELSE cli.situacao
                   END AS situacao,
                   CASE
                       WHEN substr(cli.numeroCartao, 13, 2) <> '00' THEN substr(cli.numeroCartao, 1, 12) || '-00'
                       ELSE cli.numeroCartao
                   END AS cartaoTitular,
                   cli.numeroEmpregado,
                   CASE
                       WHEN apo.redeInternacional = 'S' THEN 'Sim'
                       ELSE 'Não'
                   END AS redeInternacional,
                   cli.bi,
                   cli.numeroCartao,
                   cli.nome AS beneficiario,
                   cli.dataNascimento,
                   EXTRACT(YEAR FROM AGE(cli.dataNascimento)) AS idade,
                   cli.parentesco,
                   cli.genero,
                   cli.contato,
                   cli.dataAtivacao,
                   apo.dataInicioCobertura,
                   apo.dataFimCobertura,
                   cli.numeroSeguradora,
                   cli.updated_at,
                   cli.dataCancelamento,
                   COALESCE(cli.iban, '') AS iban,
                   COALESCE(cli.contaCorrente, '') AS contaCorrente,
                   cli.beneficiarioNecessitaAutorizacao
            FROM tb_cliente cli
                     LEFT JOIN tb_seguradora seg ON cli.seguradora_id = seg.id_seguradora
                     LEFT JOIN tb_empresa emp ON cli.empresa_id = emp.id_empresa
                     LEFT JOIN tb_apolice apo ON cli.apolice_id = apo.id_apolice
            WHERE cli.empresa_id = ?
        ", [$this->empresa_id]);

        // Adiciona filtros opcionais
        if ($this->seguradora_id) {
            $query->where('cli.seguradora_id', $this->seguradora_id);
        }

        if ($this->apolice_id) {
            $query->where('cli.apolice_id', $this->apolice_id);
        }

        // Retorna a coleção de dados
        return $query->get();
    }

    /**
     * Define os cabeçalhos da planilha Excel.
     *
     * @return array Um array contendo os nomes das colunas.
     */
    public function headings(): array
    {
        return [
            'Seguradora',
            'Empresa',
            'Apólice',
            'Resseguro',
            'Apólice Seguradora',
            'Situação',
            'Cartão Titular',
            'Número Empregado',
            'Rede Internacional',
            'BI',
            'Número do Cartão',
            'Beneficiário',
            'Data de Nascimento',
            'Idade',
            'Parentesco',
            'Gênero',
            'Contato',
            'Data de Ativação',
            'Data Início Cobertura',
            'Data Fim Cobertura',
            'Número Seguradora',
            'Última Atualização',
            'Data de Cancelamento',
            'IBAN',
            'Conta Corrente',
            'Necessita Autorização'
        ];
    }
}
