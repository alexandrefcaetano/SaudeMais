<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApoliceExport implements FromCollection, WithHeadings
{
    protected $dataInicio;
    protected $dataFim;

    public function __construct($dataInicio, $dataFim)
    {
        // Convertendo para o formato YYYY-MM-DD
        $dataInicio = \Carbon\Carbon::createFromFormat('d/m/Y', $dataInicio)->format('Y-m-d');
        $dataFim = \Carbon\Carbon::createFromFormat('d/m/Y', $dataFim)->format('Y-m-d');

        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    public function collection()
    {
        $results = DB::select("
            SELECT e.nomefantasia AS empresa,
                   seg.seguradora,
                   a.apolice,
                   a.resseguro,
                   c.cobertura,
                   al.valorlimite,
                   al.participacaorede,
                   a.datainiciocobertura,
                   a.datafimcobertura,
                   a.apoliceseguradora,
                   CASE
                       WHEN al.participacaobeneficiariorede = 1 THEN 'SEM CO-PARTICIPAÇÃO'
                       WHEN al.participacaobeneficiariorede = 2 THEN 'NA AUTORIZAÇÃO'
                       WHEN al.participacaobeneficiariorede = 3 THEN 'FRANQUIA'
                       ELSE 'FOLHA DE PAGAMENTO'
                   END AS participacaobeneficiariorede,
                   al.ativo,
                   al.maximosessoes,
                   CASE
                       WHEN a.fraccionamento = 'AN' THEN 'Anual'
                       WHEN a.fraccionamento = 'SE' THEN 'Semestral'
                       WHEN a.fraccionamento = 'TR' THEN 'Trimestral'
                       ELSE ''
                   END AS fraccionamento,
                   (SELECT STRING_AGG(cl.coberturalimite::TEXT, ', ' ORDER BY cl.coberturalimite)
                    FROM tb_coberturalimite cl
                    WHERE cl.cobertura_id = c.id_cobertura AND cl.status = 'S') AS coberturaslimites
            FROM tb_apolice a
                     INNER JOIN tb_empresa e ON (a.empresa_id = e.id_empresa AND a.ativo = 'S')
                     INNER JOIN tb_seguradora seg ON (seg.id_seguradora = a.seguradora_id)
                     INNER JOIN tb_apolicelimite al ON (al.apolice_id = a.id_apolice)
                     INNER JOIN tb_cobertura c ON (c.id_cobertura = al.cobertura_id)
            WHERE a.ativo = 'S' AND a.datainiciocobertura BETWEEN ? AND ?
            GROUP BY
                e.nomefantasia,
                seg.seguradora,
                a.apolice,
                a.resseguro,
                c.cobertura,
                al.valorlimite,
                al.participacaorede,
                a.datainiciocobertura,
                a.datafimcobertura,
                a.apoliceseguradora,
                al.ativo,
                al.maximosessoes,
                al.participacaobeneficiariorede,
                a.fraccionamento,
                c.id_cobertura
        ", [$this->dataInicio, $this->dataFim]);

        // Converta o resultado para uma coleção
        return collect($results);
    }

    public function headings(): array
    {
        return [
            'Empresa',
            'Seguradora',
            'Apólice',
            'Resseguro',
            'Cobertura',
            'Valor Limite',
            'Participação Rede',
            'Data Início Cobertura',
            'Data Fim Cobertura',
            'Apólice Seguradora',
            'Participação Beneficiário Rede',
            'Ativo',
            'Máximo Sessões',
            'Fracionamento',
            'Coberturas Limites',
        ];
    }
}
