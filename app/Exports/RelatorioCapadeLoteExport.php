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

class RelatorioCapadeLoteExport implements FromView, WithDrawings, WithTitle
{

    private ?int $prestadores;
    private string $mes_ano;

    public function __construct( int $prestadores, string $mes_ano, )
    {
        $this->prestadores = $prestadores;
        $this->mes_ano = $mes_ano;
    }

    public function view(): View
    {
        try {
            $condicao = '';

            if (!empty($this->prestadores)) {
                $condicao .= " AND p.id_prestador in({$this->prestadores})";
            }
            if(!empty($this->mes_ano)){
                $condicao .= " AND c.mesAno = '$this->mes_ano'";
            }

            // Executa a consulta usando DB::select()
            $relatorio_capa_lote = DB::select(utf8_decode("
                                        SELECT
                                            c.mes_ano,
                                            c.data_recebimento,
                                            c.data_vencimento,
                                            c.total_faturas,
                                            c.quantidade_faturas,
                                            c.criado_em,
                                            u2.nome AS usuarioAlterou,
                                            c.atualizado_em,
                                            COALESCE(c.valor_devolvido, 0) AS valor_devolvido,
                                            COALESCE(p.prazoPagamento, 0) AS prazo_pagamento,
                                            c.observacao,
                                            c.ativo,
                                            u.nome AS usuarioIncluiu,
                                            p.nomeFantasia AS prestador,
                                            p.prazoPagamento,
                                            c.quantidade_faturas_devolvidas,
                                            fs.id_fatura_seguradora,
                                            fs.ativo AS status_fatura,
                                            fs.atualizado_em AS data_Alteracao_CE
                                        FROM tb_capa_lote c
                                                 LEFT JOIN tb_faturamento_seguradora fs ON c.fatura_seguradora_id = fs.id_fatura_seguradora
                                                 LEFT JOIN tb_usuarios u2 ON c.atualizado_por = u2.id_usuario
                                                 JOIN tb_prestador p ON c.prestador_id = p.id_prestador
                                                 JOIN tb_usuarios u ON c.criado_por = u.id_usuario
                                        WHERE c.id_capa_lote IS NOT NULL AND c.excluido = false $condicao
                                        ORDER BY fs.ativo, c.mes_ano, p.nomeFantasia;

            "));

            return view('exports.capa_lote', [
                'relatorio_capa_lote' => $relatorio_capa_lote
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_capa_lote', [
                'relatorio_capa_lote' => [],
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
        return 'Relatório Capa de Lote';
    }



}
