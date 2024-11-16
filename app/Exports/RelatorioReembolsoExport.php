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

class RelatorioReembolsoExport implements FromView, WithDrawings, WithTitle
{
    private ?int $idEmpresa;
    private string $dataInicio;
    private string $dataFim;

    public function __construct(string $dataInicio = '', string $dataFim = '', string $idEmpresa = null)
    {
        $this->idEmpresa = $idEmpresa;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->idEmpresa) {
                $condicao .= " AND p.id_empresa IN ({$this->idEmpresa}) ";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao.=" AND CAST(r.dtInclusao AS DATE) BETWEEN '$this->dataInicio' AND '$this->dataFim' ";
            }

            // Executa a consulta usando DB::select()
            $resumo_reembolso = DB::select(utf8_decode("
                  SELECT r.idReembolso, r.status_faturamento, b.numeroCartao, b.nome AS beneficiario,
                                    e.nomeFantasia AS empresa, ri.procedimento,
                                    SUM(CASE WHEN r.status = 'C' OR r.status = 'N' THEN 0 ELSE ri.vlrProcedimentoLiquido END) AS vlrProcedimentoLiquido,
                                    SUM(CASE WHEN r.status = 'C' OR r.status = 'N' THEN 0 ELSE ri.vlrProcedimentoKwanza END) AS vlrProcedimentoKwanza,
                                    c.cobertura, cl.coberturaLimite, r.dtInclusao,
                                    CASE
                                        WHEN COALESCE(r.status, '') = '' THEN 'Novo'
                                        WHEN r.status = 'P' THEN 'Pendente'
                                        WHEN r.status = 'A' THEN 'Aprovado'
                                        WHEN r.status = 'C' THEN 'Cancelado'
                                        WHEN r.status = 'N' THEN 'Negado'
                                        WHEN r.status = 'AP' THEN 'Análise de Pendência'
                                    END AS statusDescricao,
                                    mc.motivoCancelamento
                    FROM reembolso r
                        JOIN reembolsoitem ri ON r.idReembolso = ri.idReembolso
                        JOIN cliente b ON r.idBeneficiario = b.idCliente
                        LEFT JOIN empresa e ON b.idEmpresa = e.idEmpresa
                        JOIN cobertura c ON ri.idCobertura = c.idCobertura
                        JOIN coberturalimite cl ON ri.idCobertura = cl.idCobertura AND ri.idCoberturaLimite = cl.idCoberturaLimite
                        LEFT JOIN motivocancelamento mc ON r.idMotivoNegacao = mc.idMotivo
                    WHERE 1=1  $condicao
                        GROUP BY r.idReembolso, b.numeroCartao, b.nome, e.nomeFantasia, r.dtInclusao, c.cobertura, cl.coberturaLimite, mc.motivoCancelamento, ri.procedimento
                    ORDER BY r.dtInclusao
            "));

            return view('exports.relatorio_reembolso', [
                'resumo_reembolso' => $resumo_reembolso
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_reenbolso', [
                'resumo_reembolso' => [],
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
        return 'Relatório Reembolso';
    }
}
