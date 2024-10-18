<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioMonitoramentoAtendimentoExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    // Método que retorna os dados para o Excel
    public function array(): array
    {
        $result = [];
        foreach ($this->data as $dia => $dadosDia) {
            $result[] = [
                'Dia'                   => $dia,
                'Geral Qtd'             => $dadosDia['geral']['qtd'],
                'Geral Media'           => $dadosDia['geral']['media'],
                'Consultas Qtd'         => $dadosDia['consultas']['qtd'],
                'Consultas Media'       => $dadosDia['consultas']['media'],
                'Diagnostico Qtd'       => $dadosDia['diagnostico']['qtd'],
                'Diagnostico Media'     => $dadosDia['diagnostico']['media'],
                'Enfermagem Qtd'        => $dadosDia['enfermagem']['qtd'],
                'Enfermagem Media'      => $dadosDia['enfermagem']['media'],
                'Medicamentos Qtd'      => $dadosDia['medicamentos']['qtd'],
                'Medicamentos Media'    => $dadosDia['medicamentos']['media'],
                'Internamento Qtd'      => $dadosDia['internamento']['qtd'],
                'Internamento Media'    => $dadosDia['internamento']['media'],
                'Estomatologia Qtd'     => $dadosDia['estomatologia']['qtd'],
                'Estomatologia Media'   => $dadosDia['estomatologia']['media']
            ];
        }
        return $result;
    }

    // Definir cabeçalhos para o arquivo Excel
    public function headings(): array
    {
        return [
            'Dia',
            'Geral Qtd', 'Geral Media',
            'Consultas Qtd', 'Consultas Media',
            'Diagnostico Qtd', 'Diagnostico Media',
            'Enfermagem Qtd', 'Enfermagem Media',
            'Medicamentos Qtd', 'Medicamentos Media',
            'Internamento Qtd', 'Internamento Media',
            'Estomatologia Qtd', 'Estomatologia Media'
        ];
    }
}
