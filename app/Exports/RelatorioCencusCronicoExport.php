<?php

namespace App\Exports;

use App\Models\Cliente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioCencusCronicoExport implements FromCollection, WithHeadings
{
    private int $empresa_id;
    private ?int $seguradora_id; // Agora é nullable
    private ?int $apolice_id;    // Agora é nullable

    /**
     * Construtor da classe RelatorioCencusCronicoExport.
     *
     * @param int $empresa_id ID da empresa (obrigatório).
     * @param int|null $seguradora_id ID da seguradora (opcional).
     * @param int|null $apolice_id ID da apólice (opcional).
     */
    public function __construct(int $empresa_id, ?int $seguradora_id = null, ?int $apolice_id = null)
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
                   emp.nome_fantasia AS empresa,
                   apo.apolice,
                   CASE
                       WHEN apo.data_fim_cobertura < NOW() THEN 'BLOQUEADO'
                       ELSE cli.situacao
                   END AS situacao,
                   CASE
                       WHEN SUBSTRING(cli.numero_cartao FROM 13 FOR 2) <> '00' THEN
                           CONCAT(SUBSTRING(cli.numero_cartao FROM 1 FOR 12), '-00')
                       ELSE cli.numero_cartao
                   END AS cartao_titular,
                   cli.numero_empregado,
                   CASE
                       WHEN apo.rede_internacional = 'S' THEN 'Sim'
                       ELSE 'Não'
                   END AS rede_internacional,
                   cli.numero_cartao,
                   cli.nome AS beneficiario,
                   cli.data_nascimento,
                   EXTRACT(YEAR FROM AGE(cli.data_nascimento)) AS idade,
                   cli.parentesco,
                   cli.genero,
                   cli.contato,
                   cli.data_ativacao,
                   apo.data_inicio_cobertura,
                   apo.data_fim_cobertura,
                   cc.dt_inclusao,
                   usu.nome AS usuario_inc,
                   cli.data_cancelamento,
                   cid.cid
            FROM cliente cli
            JOIN seguradora seg ON cli.id_seguradora = seg.id_seguradora
            JOIN empresa emp ON cli.id_empresa = emp.id_empresa
            JOIN apolice apo ON cli.id_apolice = apo.id_apolice
            LEFT JOIN clientecronico cc ON cli.id_cliente = cc.id_beneficiario
            LEFT JOIN usuario usu ON cc.id_usuario_inc = usu.id_usuario
            LEFT JOIN cid ON cc.id_cid = cid.id_cid
            WHERE cli.empresa_id = ?
            ORDER BY seg.seguradora, emp.nome_fantasia, cli.nome;
        ", [$this->empresa_id]);

        // Adiciona filtros opcionais
        if ($this->seguradora_id) {
            $query->where('cli.seguradora_id', $this->seguradora_id);
        }

        if ($this->apolice_id) {
            $query->where('cli.apolice_id', $this->apolice_id);
        }

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
            'Situação',
            'Cartão Titular',
            'Número Empregado',
            'Rede Internacional',
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
            'Última Inclusão',
            'Nome do Usuário',
            'Data de Cancelamento',
            'CID'
        ];
    }
}
