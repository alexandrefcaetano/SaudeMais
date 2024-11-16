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

class RelatorioFaturamentoResumoExport implements FromView, WithDrawings, WithTitle
{


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
                                    SELECT
                                        f.mes_ano,
                                        f.criado_em,
                                        f.valor_total_fatura,
                                        f.valor_total_coparticipacao,
                                        f.valor_total_aprovado,
                                        f.criado_por,
                                        s.seguradora,
                                        u.nome AS nomeFuncionario,
                                        f.ativo,
                                        COALESCE(notaCredito.total_nota_credito, 0) AS nota_credito,
                                        c.data_vencimento,
                                        p.nomeFantasia AS prestador
                                    FROM   tb_faturamento_seguradora f
                                            JOIN    tb_seguradora s ON f.seguradora_id = s.id_seguradora
                                            JOIN    tb_usuarios u ON f.criado_por = u.id_usuario
                                            JOIN    tb_capa_lote c ON f.id_fatura_seguradora = c.fatura_seguradora_id
                                            JOIN    tb_prestador p ON c.prestador_id = p.id_prestador
                                            LEFT JOIN (        SELECT
                                                f1.fatura_seguradora_id,
                                                SUM(fnc.valor_nota_credito) AS total_nota_credito
                                            FROM    tb_faturamento f1
                                              JOIN  tb_faturamento_notacredito fnc ON fnc.faturamento_id = f1.id_faturamento
                                            WHERE  f1.status = 'APROVADO' AND fnc.excluido is false
                                            GROUP BY f1.fatura_seguradora_id
                                        ) AS notaCredito ON notaCredito.fatura_seguradora_id = f.id_fatura_seguradora

                                    WHERE  f.id_fatura_seguradora IS NOT NULL $condicao
                                    ORDER BY  f.id_fatura_seguradora;

            "));

            return view('exports.relatorio_faturamento_resumo', [
                'relatorio_faturamento_resumo' => $relatorio_pre_autorizacao
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_faturamento_resumo', [
                'relatorio_relatorio_faturamento_resumo' => [],
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
