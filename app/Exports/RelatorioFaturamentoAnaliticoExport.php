<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Carbon;
use Exception;

class RelatorioFaturamentoAnaliticoExport implements FromView, WithDrawings, WithTitle
{


    private string $mes_ano;
    private ?int $prestador;
    private ?int $seguradora;



    public function __construct( string $mes_ano, int $prestador = null, int $seguradora = null,)
    {
        $this->mes_ano = $mes_ano;
        $this->prestador = $prestador;
        $this->seguradora = $seguradora;

    }

    public function view(): View
    {
        try {
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
            $relatorio_pre_autorizacao = DB::select(utf8_decode("


            "));

            return view('exports.relatorio_faturamento_analitico', [
                'relatorio_faturamento_analitico' => $relatorio_pre_autorizacao
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_faturamento_analitico', [
                'relatorio_faturamento_analitico' => [],
                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
            ]);
        }
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

    public function title(): string
    {
        return 'Relatório Faturamento Resumo';
    }



}
