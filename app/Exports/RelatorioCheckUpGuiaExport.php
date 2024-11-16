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

class RelatorioCheckUpGuiaExport implements FromView, WithDrawings, WithTitle
{
    private ?int $idEmpresa;
    private string $dataInicio;
    private string $dataFim;

    public function __construct(string $dataInicio = '', string $dataFim = '', string $idEmpresa = null)
    {
        $this->idEmpresa = $idEmpresa;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->idEmpresa) {
                $condicao .= " AND p.id_empresa IN ({$this->idEmpresa}) ";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao.=" AND CAST(r.creado_em AS DATE) BETWEEN '$this->dataInicio' AND '$this->dataFim' ";
            }

            // Executa a consulta usando DB::select()
            $resumo_checkup_guia = DB::select(utf8_decode(""));

            return view('exports.relatorio_checkup_guia', [
                'resumo_checkup' => $resumo_checkup_guia
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_checkup_guia', [
                'resumo__checkup_guia' => [],
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
        return 'Relatório Check-Up Guia';
    }
}
