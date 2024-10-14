<?php
namespace App\Exports;

use App\Models\Servico;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ServicosExport  implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Servico::select('*')->limit(100000); // Retorna o Builder
    }

    public function headings(): array
    {
        return [
            '#',
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

    public function map($servico): array
    {
        return [
            $servico->id_servico,
            $servico->prestador_id,
            $servico->tiposervico_id,
            $servico->cobertura_id,
            $servico->coberturalimite_id,
            $servico->tipoprocedimento_id,
            $servico->codservico,
            $servico->descricao,
            $servico->ativo,
            $servico->valor,
            $servico->vlrfaturado,
            $servico->vlrsaudemais,
            $servico->vlrdolar,
            $servico->vlrcotacao,
            $servico->tiporegra,
            $servico->gratuito,
            $servico->quantidadeitens,
            $servico->quantidadedias,
            $servico->ean,
        ];
    }

}
