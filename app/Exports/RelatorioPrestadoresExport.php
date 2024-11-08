<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Carbon;
use Exception;

class RelatorioPrestadoresExport implements FromView, WithDrawings, WithTitle
{
    private ?int $idPrestador;
    private string $dataInicio;
    private string $dataFim;

    public function __construct( string $idPrestador = null, string $dataInicio = '', string $dataFim = '')
    {
        $this->idPrestador = $idPrestador;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    public function view(): View
    {
        try {
            $condicao = '';
            $data = '';

            if ($this->idPrestador) {
                $condicao .= " AND p.id_prestador IN ({$this->idPrestador})";
            }

            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $data .= " AND DATE(g.dataatendimento) BETWEEN '{$this->dataInicio}' AND '{$this->dataFim}'";
            }

            // Executa a consulta usando DB::select()
            $resumo_prestadores = DB::select(utf8_decode("
                WITH atendimentos AS (
                    SELECT
                        g.prestador_id,
                        g.prestadorfilial_id,
                        COUNT(g.id_guiaseguro) AS qtdAtendimentos
                    FROM tb_guiaseguro g
                    WHERE g.ativo = 'S'
                      $data
                    GROUP BY g.prestador_id, g.prestadorfilial_id
                )

                SELECT
                    p.id_prestador,
                    p.codigoprestador,
                    p.nif,
                    p.nomefantasia,
                    pf.nomeFilial,
                    p.dtiniciocontrato,
                    pa.pais,
                    CASE
                        WHEN COALESCE(p.seguroplano, '') = '' THEN 'AMBOS'
                        WHEN p.seguroplano = 'S' THEN 'SEGURO'
                        ELSE 'PLANO'
                    END AS seguroplano,
                    p.iban,
                    po.provincia,
                    m.municipio,
                    p.prazopagamento,
                    tp.tipoprestador,
                    e.especialidade,
                    p.aptocheckup,
                    p.descontoprescricao,
                    COALESCE(a.qtdAtendimentos, 0) AS qtdAtendimentos
                FROM tb_prestador p
                JOIN tb_prestadorfilial pf ON p.id_prestador = pf.prestador_id
                JOIN tb_tipoprestador tp ON p.tipoprestador_id = tp.id_tipoprestador
                JOIN tb_especialidade e ON p.especialidade_id = e.id_especialidade
                JOIN tb_provincia po ON pf.pais_id = po.id_pais AND pf.provincia_id = po.provincia_id
                JOIN tb_municipio m ON po.id_provincia = m.provincia_id AND pf.municipio_id = m.id_municipio
                JOIN tb_pais pa ON pf.pais_id = pa.id_pais
                LEFT JOIN tb_atendimentos a ON p.id_prestador = a.prestador_id AND pf.id_prestadorfilial = a.prestadorfilial_id
                WHERE p.ativo = 'S' $condicao
                ORDER BY p.nomefantasia
            "));

            return view('exports.relatorio_prestadores', [
                'resumo_prestadores' => $resumo_prestadores
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_prestadores', [
                'resumo_prestadores' => [],
                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
            ]);
        }
    }

    public function drawings()
    {
        $imagePath = public_path('assets/media/logos/imagem.png');

        if (file_exists($imagePath)) {
            $drawing = new Drawing();
            $drawing->setName('Logo');
            $drawing->setDescription('Logo do relatório');
            $drawing->setPath($imagePath);
            $drawing->setHeight(80);
            $drawing->setCoordinates('A1');

            return [$drawing];
        }

        return [];
    }

    public function title(): string
    {
        return 'Relatório Prestadores';
    }
}
