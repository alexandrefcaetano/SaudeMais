<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheet\FaturamentoPrestadorSheet;
use App\Exports\Sheet\RelatorioFaturamentoSheet;
use App\Exports\Sheet\SaldoPrestadorSheet;


class RelatorioFaturamentoPrestadorExport implements WithMultipleSheets
{
    use Exportable;

    private string $dataInicio;
    private string $dataFim;
    private ?int $prestador;
    private ?int $seguradora;

    public function __construct( string $dataInicio, string $dataFim, int $prestador = null, int $seguradora = null,)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->prestador = $prestador;
        $this->seguradora = $seguradora;

    }

    public function sheets(): array
    {

        $condicao = '';

        if ($this->seguradora) {
            $condicao .= " AND s.id_seguradora =  {$this->seguradora}";
        }
        if (!empty($this->dataInicio) && !empty($this->dataFim)) {
            $condicao .= " AND DATE(f.criado_em) BETWEEN '{$this->dataInicio}' AND '{$this->dataFim}'";
        }
        if($this->prestador!=""){
            $condicao .= " AND p.id_prestador = '$this->prestador' ";
        }

        // Executa a consulta usando DB::select()
        $RelatorioFaturamentoSheet = DB::select(utf8_decode(""));

        // Executa a consulta usando DB::select()
        $FaturamentoPrestadorSheet = DB::select(utf8_decode(""));

        // Executa a consulta usando DB::select()
        $SaldoPrestadorSheet = DB::select(utf8_decode(""));

        return [
            new RelatorioFaturamentoSheet($RelatorioFaturamentoSheet),
            new FaturamentoPrestadorSheet($FaturamentoPrestadorSheet),
            new SaldoPrestadorSheet($SaldoPrestadorSheet),
        ];

    }
}
