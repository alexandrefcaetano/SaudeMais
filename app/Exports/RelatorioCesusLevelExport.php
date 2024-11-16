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

class RelatorioCesusLevelExport implements FromView, WithDrawings, WithTitle
{
    private ?int $usuario;
    private string $dataInicio;
    private string $dataFim;

    public function __construct(string $dataInicio = '', string $dataFim = '', string $usuario = null)
    {
        $this->usuario = $usuario;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->usuario) {
                $condicao .= " AND p.id_usuario IN ({$this->usuario}) ";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao.=" AND CAST(r.dtInclusao AS DATE) BETWEEN '$this->dataInicio' AND '$this->dataFim' ";
            }

            // Executa a consulta usando DB::select()
            $resumo_checkup = DB::select(utf8_decode(""));

            return view('exports.relatorio_census', [
                'resumo_checkup' => $resumo_checkup
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_census', [
                'relatorio_census' => [],
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
        return 'Relatório Census Level+';
    }
}
