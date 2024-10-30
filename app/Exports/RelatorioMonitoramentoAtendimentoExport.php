<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;

class RelatorioMonitoramentoAtendimentoExport implements  FromView, WithDrawings, WithTitle
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Método que retorna os dados para a view do Excel
    public function view(): View
    {
        $result = [];
        foreach ($this->data as $dia => $dadosDia) {
            $result[] = [
                'Dia'                   => $dia,
                'Geral Qtd'             => $dadosDia['geral']['qtd'] ?? 0,
                'Geral Media'           => $dadosDia['geral']['media'] ?? 0,
                'Consultas Qtd'         => $dadosDia['consultas']['qtd'] ?? 0,
                'Consultas Media'       => $dadosDia['consultas']['media'] ?? 0,
                'Diagnostico Qtd'       => $dadosDia['diagnostico']['qtd'] ?? 0,
                'Diagnostico Media'     => $dadosDia['diagnostico']['media'] ?? 0,
                'Enfermagem Qtd'        => $dadosDia['enfermagem']['qtd'] ?? 0,
                'Enfermagem Media'      => $dadosDia['enfermagem']['media'] ?? 0,
                'Medicamentos Qtd'      => $dadosDia['medicamentos']['qtd'] ?? 0,
                'Medicamentos Media'    => $dadosDia['medicamentos']['media'] ?? 0,
                'Internamento Qtd'      => $dadosDia['internamento']['qtd'] ?? 0,
                'Internamento Media'    => $dadosDia['internamento']['media'] ?? 0,
                'Estomatologia Qtd'     => $dadosDia['estomatologia']['qtd'] ?? 0,
                'Estomatologia Media'   => $dadosDia['estomatologia']['media'] ?? 0,
            ];
        }

        return view('exports.relatorio_monitoramento_atendimento', [
            'clientes' => $result
        ]);
    }

    /**
     * Retorna a imagem que será usada no relatório.
     *
     * @return array
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo do relatório');
        $drawing->setPath(public_path('assets/media/logos/imagem.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1'); // Define a célula onde a imagem será exibida

        return [$drawing];
    }

    /**
     * Define o título da worksheet.
     *
     * @return string O nome da aba da planilha.
     */
    public function title(): string
    {
        return 'Relatório de Maiores Ultilizadores';
    }
}
