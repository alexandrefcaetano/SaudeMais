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

class RelatorioComissionamentoLeveExport implements FromView, WithDrawings, WithTitle
{
    private string $dataInicio;
    private string $dataFim;
    private ?int $usuario;




    public function __construct( string $dataInicio, string $dataFim, int $usuario = null)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->usuario = $usuario;


    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->usuario) {
                $condicao .= " AND u.id_usuario IN ({$this->idEmpresa}) ";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao.=" AND CAST(r.dtInclusao AS DATE) BETWEEN '$this->dataInicio' AND '$this->dataFim' ";
            }

            // Executa a consulta usando DB::select()
            $resumo_comissionamento = DB::select(utf8_decode(""));

            return view('exports.relatorio_comissionamento', [
                'resumo_comissionamento' => $resumo_comissionamento
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_comissionamento', [
                'resumo_comissionamento' => [],
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
        return 'Relatório Comissionamento Leve+';
    }
}
