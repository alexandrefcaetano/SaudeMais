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

class RelatorioPrecoPrescricaoExport implements FromView, WithDrawings, WithTitle
{

    private string $prestador;
    private ?int $procedimento;

    public function __construct( string $prestador, int $procedimento)
    {

        $this->prestador = $prestador;
        $this->procedimento = $procedimento;


    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->procedimento) {
                $condicao .= " AND s.id_seguradora =  {$this->procedimento}";
            }
            if($this->prestador!=""){
                $condicao .= " AND p.id_prestador in ('$this->prestador') ";
            }


            // Executa a consulta usando DB::select()
            $relatorio_preco_prescricao = DB::select(utf8_decode(""));

            return view('exports.relatorio_preco_prescricao', [
                'relatorio_preco_prescricao' => $relatorio_preco_prescricao
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_preco_prescricao', [
                'relatorio_preco_prescricao' => [],
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
        return 'Relatório Preço Prescrição';
    }



}
