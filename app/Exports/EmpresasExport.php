<?php

namespace App\Exports;

use App\Models\Empresa;
use Maatwebsite\Excel\Concerns\FromQuery;

class EmpresasExport implements FromQuery
{
    public function query()
    {
        return Empresa::query();
    }
}
