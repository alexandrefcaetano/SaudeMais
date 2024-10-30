<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class RelatorioCronicoExport implements FromCollection, WithHeadings
{
    private ?int $empresa_id;
    private ?int $seguradora_id;
    private ?string $apolice;
    private string $datainicio;
    private string $datafim;

    /**
     * Construtor da classe RelatorioCencusSeguroExport.
     *
     * @param string $datainicio Data de início do relatório.
     * @param string $datafim Data de fim do relatório.
     * @param int|null $seguradora_id ID da seguradora (opcional).
     * @param int|null $empresa_id ID da empresa (opcional).
     * @param string|null $apolice ID da apólice (opcional).
     */
    public function __construct(string $datainicio, string $datafim, ?int $seguradora_id = null, ?int $empresa_id = null, ?string $apolice = null)
    {
        if (empty($datainicio) || empty($datafim)) {
            throw new \InvalidArgumentException('Os campos de data de início e fim são obrigatórios.');
        }

        $this->empresa_id = $empresa_id;
        $this->seguradora_id = $seguradora_id;
        $this->apolice = $apolice;
        // Converte as datas do formato dd/mm/yyyy para yyyy-mm-dd
        $this->datainicio = \DateTime::createFromFormat('d/m/Y', $datainicio)->format('Y-m-d');
        $this->datafim = \DateTime::createFromFormat('d/m/Y', $datafim)->format('Y-m-d');

    }

    /**
     * Obtém a coleção de dados a serem exportados.
     *
     * @return Collection A coleção com os dados dos clientes.
     */
    public function collection(): Collection
    {
        // Construir a consulta usando Query Builder do Laravel
        $query = DB::table('tb_guiaseguro AS g')
            ->join('tb_cliente AS c', 'g.idBeneficiario', '=', 'c.id_cliente')
            ->join('tb_apolice AS a', 'c.apolice_id', '=', 'a.id_apolice')
            ->join('tb_empresa AS e', 'c.empresa_id', '=', 'e.id_empresa')
            ->join('tb_prestador AS p', 'g.prestador_id', '=', 'p.id_prestador')
            ->leftJoin('tb_clientecronico AS cc', 'c.id_cliente', '=', 'cc.idBeneficiario')
            ->leftJoin('cid AS cid', 'cc.cid_id', '=', 'cid.id_cid')
            ->select([
                'g.id_guiaseguro',
                DB::raw('TO_CHAR(g.dataatendimento, \'DD/MM/YYYY\') AS dataatendimento'),  // Formato de data Y-m-d
                'c.numerocartao',
                'c.nome AS beneficiario',
                'a.apolice',
                'e.nomefantasia AS empresa',
                'p.nomefantasia AS prestador',
                DB::raw('(SELECT cid FROM tb_clientecronico cc, cid WHERE cc.cid_id = cid.id_cid AND cc.idBeneficiario = c.id_cliente LIMIT 1) AS cidcronico')
            ])
            ->where('g.ativo', '=', 'S')
            ->whereBetween(DB::raw('DATE(g.dataatendimento)'), [$this->datainicio, $this->datafim]);

        // Adicionar filtros opcionais
        if ($this->seguradora_id) {
            $query->where('c.idSeguradora', $this->seguradora_id);
        }

        if ($this->empresa_id) {
            $query->where('e.idEmpresa', $this->empresa_id);
        }

        if ($this->apolice) {
            $query->where('a.idApolice', $this->apolice);
        }

        // Retorna a coleção de dados
        return collect($query->get());
    }

    /**
     * Define os cabeçalhos da planilha Excel.
     *
     * @return array Um array contendo os nomes das colunas.
     */
    public function headings(): array
    {
        return [
            'ID Guia Seguro',
            'Data Atendimento',
            'Número Cartão',
            'Beneficiário',
            'Apólice',
            'Empresa',
            'Prestador',
            'CID Crônico'
        ];
    }
}
