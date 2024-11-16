<?php

namespace App\Exports\Sheet;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use Exception;

class FaturamentoPrestadorSheet implements FromView, WithDrawings, WithTitle
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        try {

            return view('exports.sheet.faturamento_prestador_sheet', ['faturamento_prestador' =>  $this->data ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.sheet.faturamento_prestador_sheet', [
                'faturamento_prestador_sheet' => [],
                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
            ]);
        }
    }

    public function title(): string
    {
        return 'Relatório Prestador';
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


}
