<?php

namespace App\Exports;

use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EmpresaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Empresa::select('nomefantasia', 'ativo', 'nif', 'razaosocial', 'ramoatividade', 'morada', 'corretor', 'contato', 'observacao')
            ->limit(100)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nome Fantasia',
            'Ativo',
            'NIF',
            'Razao Social',
            'Ramo Atividade',
            'Morada',
            'Corretor',
            'Contato',
            'Observacao'
        ];
    }
}
