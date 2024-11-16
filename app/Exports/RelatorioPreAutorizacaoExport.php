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

class RelatorioPreAutorizacaoExport implements FromView, WithDrawings, WithTitle
{

    private ?int $seguradora;
    private string $dataInicio;
    private string $dataFim;
    private ?int $empresa;
    private ?int $apolice;
    private ?int $tipo_atendimento;
    private string $numero_cartao;

    public function __construct( int $seguradora, string $dataInicio, string $dataFim, int $empresa = null, int $apolice = null, int $tipo_atendimento = null, string $numero_cartao = null )
    {
        $this->seguradora = $seguradora;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->empresa = $empresa;
        $this->apolice = $apolice;
        $this->tipo_atendimento =$tipo_atendimento;
        $this->numero_cartao = $numero_cartao;

    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->seguradora) {
                $condicao .= "AND seg.id_seguradora =  {$this->seguradora}";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao .= " AND DATE(guiaS.dataAtendimento) BETWEEN '{$this->dataInicio}' AND '{$this->dataFim}'";
            }
            if($this->empresa!=""){
                $condicao .= " AND emp.id_empresa = '$this->empresa' ";
            }
            if($this->apolice!=""){
                $condicao .= " AND apo.id_apolice = '$this->apolice' ";
            }
            if($this->idPrestador!=""){
                $condicao .= " AND pre.id_prestador = '($this->idPrestador' ";
            }
            if($this->numero_cartao!=""){
                $condicao .= " AND REPLACE(cli.numerocartao,'-','') = '{$this->numero_cartao}' ";
            }
            if($this->tipo_atendimento!=""){
                $condicao .= " AND guiaS.tipoAtendimento_id = '{$this->tipo_atendimento}' ";
            }

            // Executa a consulta usando DB::select()
            $relatorio_pre_autorizacao = DB::select(utf8_decode("
                                SELECT guia.guia_seguro_id,
                                       guia.id_guia_seguro_gerou,
                                       guia.id_aprovacao,
                                       guia.criado_em,
                                       guia.data_analise,
                                       guia.situacao,
                                       guia.observacao_prestador,
                                       guia.observacao_operacao,
                                       guia.observacao_seguradora,
                                       guia.ativo,
                                       guia.valor_aprovado_internacao,
                                       guia.data_alta_internamento,
                                       guia.status_internamento,
                                       guia.observacao_internamento,
                                       guia.id_seguradora_responsavel,
                                       guia.atualizado_em,
                                       guiaS.tipo_consulta,
                                       guiaS.tipo_internacao,
                                       guiaS.tipo_acomodacao,
                                       guiaS.tipo_prescricao,
                                       guiaS.valor_aproximado,
                                       guiaS.data_internamento,
                                       guiaS.carater,
                                       guiaS.data_atendimento,
                                       guiaS.hipotese_diagnostico,
                                       cli.id_cliente AS cliente,
                                       cli.nome AS beneficiario,
                                       cli.dataNascimento,
                                       cli.genero,
                                       cli.apolice_id,
                                       cli.contato,
                                       cli.numeroCartao,
                                       cli.parentesco,
                                       cli.numeroCartao AS numeroEmpregado,
                                       cli.beneficiarioNecessitaAutorizacao,
                                       apo.apolice,
                                       pre.id_prestador,
                                       pre.nomeFantasia AS prestador,
                                       pre.cotacaoDolar,
                                       emp.nomeFantasia AS empresa,
                                       seg.seguradora,
                                       esp.id_especialidade,
                                       esp.especialidade,
                                       tate.tipoAtendimento,
                                       tate.id_tipoatendimento,
                                       funcionario.nome AS nomeFuncionario,
                                       ser.descricao AS procedimento,
                                       COALESCE(gp.valor_saude_mais - gp.valor_pagar, 0) AS vlrAprovado,
                                       CASE
                                           WHEN guiaS.tipo_atendimento_id = 5 THEN
                                               (SELECT dias_acrescimo
                                                FROM tb_guia_aprovacao_internamento gai
                                                WHERE gai.aprovacao_id = guia.id_aprovacao
                                                LIMIT 1)
                                           END AS diariasSolicitadas,
                                       segRes.seguradora AS seguradoraResponsavel,
                                       usu.nome AS usuarioAlterou,
                                       (SELECT cid
                                        FROM tb_guia_seguro_cid gp1
                                                 JOIN tb_cid c ON gp1.cid_id = c.id_cid
                                        WHERE gp1.guia_seguro_id = guia.id_aprovacao
                                        LIMIT 1) AS descCid
                                FROM tb_guia_aprovacao guia
                                    LEFT JOIN tb_usuarios usu ON guia.atualizado_por = usu.id_usuario
                                         JOIN tb_guia_seguro guiaS ON guiaS.id_guia_seguro = guia.guia_seguro_id
                                         JOIN tb_cliente cli ON cli.id_cliente = guiaS.cliente_id
                                         JOIN tb_apolice apo ON apo.id_apolice = cli.apolice_id
                                         JOIN tb_guia_aprovacao_procedimento gp ON gp.aprovacao_id = guia.id_aprovacao
                                         JOIN tb_servico ser ON gp.procedimento_id = ser.id_servico
                                    LEFT JOIN tb_especialidade esp ON guiaS.especialidade_id = esp.id_especialidade
                                         JOIN tb_prestador pre ON guiaS.prestador_id = pre.id_prestador
                                         JOIN tb_usuarios funcionario ON guiaS.criado_por = funcionario.id_usuario
                                         JOIN tb_empresa emp ON cli.empresa_id = emp.id_empresa
                                         JOIN tb_seguradora seg ON apo.seguradora_id = seg.id_seguradora
                                         JOIN tb_tipoatendimento tate ON guiaS.tipo_atendimento_id = tate.id_tipoAtendimento
                                         LEFT JOIN tb_seguradora AS segRes ON guia.id_seguradora_responsavel = segRes.id_seguradora
                                WHERE guia.ativo <> 'N'
                                $condicao
                                ORDER BY guia.id_aprovacao

            "));

            return view('exports.relatorio_pre_autorizacao', [
                'relatorio_pre_autorizacao' => $relatorio_pre_autorizacao
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_pre_autorizacao', [
                'relatorio_pre_autorizacao' => [],
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
        return 'Relatório Pré-Autorizacao';
    }



}
