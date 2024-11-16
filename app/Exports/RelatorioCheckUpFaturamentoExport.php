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

class RelatorioCheckUpFaturamentoExport implements FromView, WithDrawings, WithTitle
{

    private ?int $empresa;
    private string $mes_ano;

    public function __construct( int $empresa, string $mes_ano, )
    {
        $this->empresa = $empresa;
        $this->mes_ano = $mes_ano;
    }

    public function view(): View
    {
        try {
            $condicao = '';

            if (!empty($this->empresa)) {
                $condicao .= " AND p.id_emprsa in({$this->empresa})";
            }
            if(!empty($this->mes_ano)){
                $condicao .= " AND c.mesAno = '$this->mes_ano'";
            }

            // Executa a consulta usando DB::select()
            $relatorio_capa_lote = DB::select(utf8_decode(""));

            return view('exports.checkup_faturamento', [
                'relatorio_checkup_faturamento' => $relatorio_capa_lote
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_checkup_faturamento', [
                'relatorio_checkup_faturamento' => [],
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
        return 'Relatório Check-Up Faturamento';
    }



}
