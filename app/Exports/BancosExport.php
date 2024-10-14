<?php

namespace App\Exports;

use App\Models\Banco;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class BancosExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Banco::query();
    }

    public function headings(): array
    {
        return [
            '#',
            'banco',
            'ativo',
            'codigoswift',
            'Created At'
        ];
    }

    public function map($banco): array
    {
        return [
            $banco->id_banco,
            $banco->banco,
            $banco->ativo,
            $banco->codigoswift,
            $banco->created_at
        ];
    }

    public function fields(): array
    {
        return [
            'id_banco',
            'banco',
            'ativo',
            'codigoswift',
            'created_at'
        ];
    }
}
