<?php
namespace App\Exports;

use App\Models\Servico;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicosExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Servico::select('*')->limit(10000); // Retorna o Builder
    }

    public function headings(): array
    {
        return [
            'id_servico',
            'prestador_id',
            'tiposervico_id',
            'tipoatendimento_id',
            'cobertura_id',
            'coberturalimite_id',
            'tipoprocedimento_id',
            'codservico',
            'descricao',
            'ativo',
            'valor',
            'vlrfaturado',
            'vlrsaudemais',
            'vlrdolar',
            'vlrcotacao',
            'tiporegra',
            'gratuito',
            'quantidadeitens',
            'quantidadedias',
            'ean'
        ];
    }
}
