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

class RelatorioFaturamentoColaboradorExport implements FromView, WithDrawings, WithTitle
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
            if($this->prestador!=""){
                $condicao .= " AND p.id_prestador = '$this->prestador' ";
            }


            // Executa a consulta usando DB::select()
            $relatorio_colaborador = DB::select(utf8_decode("

                                    SELECT
                                        f.id_faturamento,
                                        f.mes_ano,
                                        f.numero_fatura,
                                        f.valor_fatura,
                                        f.valor_coparticipacao,
                                        f.valor_guias,
                                        f.criado_em,
                                        f.atualizado_em,
                                        COALESCE(EXTRACT(HOUR FROM AGE(f.data_aprovacao, f.data_analise)), 0) AS horas,
                                        p.nomeFantasia AS prestador,
                                        u.nome AS usuario_incluiu,
                                        f.status,
                                        c.nome AS nome_beneficiario,
                                        c.numerocartao,
                                        f.data_analise,
                                        f.data_aprovacao,
                                        u1.nome AS usuario_analisou,
                                        u2.nome AS usuario_aprovou,
                                        u3.nome AS usuario_alterou,
                                        c.datanascimento,
                                        c.genero,
                                        c.contato,
                                        c.parentesco,
                                        e.nomeFantasia AS empresa,
                                        s.seguradora,
                                        a.apolice,
                                        a.seguirtiporegra,

                                        (SELECT SUM(valor_nota_credito)
                                         FROM tb_faturamento_notacredito fn
                                         WHERE fn.faturamento_id = f.id_faturamento
                                           AND fn.excluido = 'N') AS valor_nota_credito,

                                        (SELECT nota_credito
                                         FROM tb_faturamento_notacredito fn
                                         WHERE fn.faturamento_id = f.id_faturamento
                                           AND fn.excluido = 'N'
                                         LIMIT 1) AS nota_credito,

                                        (SELECT SUM(valor_procedimento_aprovado)
                                         FROM tb_faturamento_procedimento fp
                                         WHERE fp.faturamento_id = f.id_faturamento) AS valor_aprovado

                                    FROM tb_faturamento f
                                             LEFT JOIN tb_faturamento_anexo fa ON f.id_faturamento = fa.faturamento_id
                                             LEFT JOIN tb_usuarios u1 ON u1.id_usuario = f.usuario_analise_id
                                             LEFT JOIN tb_usuarios u2 ON u2.id_usuario = f.usuario_aprovado_id
                                             LEFT JOIN tb_usuarios u3 ON u3.id_usuario = f.atualizado_por,
                                         tb_prestador p,
                                         tb_usuarios u,
                                         tb_cliente c,
                                         tb_empresa e,
                                         tb_seguradora s,
                                         tb_apolice a,
                                         tb_cliente_apolice_seguradora ca

                                    WHERE
                                            f.prestador_id = p.id_prestador
                                      AND f.criado_por = u.id_usuario
                                      AND f.mes_ano = '{$this->mes_ano}' {$condicao}
                                        AND f.cliente_id = c.id_cliente
                                        AND ca.cliente_id = c.id_cliente
                                        AND f.status IN ('APROVADO', 'PARCIAL', 'PENDENTE', 'CANCELADO')
                                        AND ca.apolice_id = a.id_apolice
                                        AND ca.seguradora_id = s.id_seguradora
                                        AND c.empresa_id = e.id_empresa
                                        AND c.apolice_id = ca.apolice_id
                                        AND c.seguradora_id = ca.seguradora_id

                                    ORDER BY f.id_faturamento;

            "));

            return view('exports.relatorio_faturamento_colaborador', [
                'relatorio_colaborador' => $relatorio_colaborador
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_faturamento_colaborador', [
                'relatorio_faturamento_colaborador' => [],
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
        return 'Relatório Faturamento Colaborador';
    }



}
