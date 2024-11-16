<?php

namespace App\Exports\Sheet;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use Exception;

class SaldoPrestadorSheet implements FromView, WithDrawings, WithTitle
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        try {

            return view('exports.sheet.saldo_prestador_sheet.balde', ['faturamento_saldo' =>  $this->data ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.sheet.saldo_prestador_sheet', [
                'saldo_prestador_sheet' => [],
                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
            ]);
        }
    }

    public function title(): string
    {
        return 'Saldo Prestador';
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
