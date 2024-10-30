<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;

class RelatorioOcorrenciaExport implements FromView, WithDrawings, WithTitle
{
    private int $empresa_id;
    private string $dataInicio;
    private string $dataFim;

    /**
     * Construtor da classe RelatorioOcorrenciaExportExport.
     *
     * @param int $empresa_id ID da empresa (obrigatório).
     * @param string $dataInicio Data de início no formato Y-m-d (obrigatório).
     * @param string $dataFim Data de fim no formato Y-m-d (obrigatório).
     */
    public function __construct(int $empresa_id, string $dataInicio, string $dataFim)
    {
        $this->empresa_id = $empresa_id;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    /**
     * Retorna a view que será usada para gerar o arquivo Excel.
     *
     * @return View
     */
    public function view(): View
    {
        $query = DB::table('tb_ocorrencia as o')
            ->leftJoin('tb_usuarios as f', 'o.criado_por', '=', 'f.id_usuario')
            ->join('tb_cliente as c', 'o.cliente_id', '=', 'c.id_cliente')
            ->leftJoin('tb_empresa as e', 'c.empresa_id', '=', 'e.id_empresa')
            ->selectRaw("
                c.numerocartao,
                c.nome AS beneficiario,
                o.motivo_ocorrencia,
                o.criado_em,
                o.pergunta,
                o.resposta,
                o.nota,
                COALESCE(o.satisfacao, 'N') AS satisfacao,
                o.status,
                e.nomefantasia AS empresa,
                f.nome AS nome_funcionario,
                CASE
                    WHEN o.status = 'N' THEN 'Nova Ocorrência'
                    WHEN o.status = 'P' THEN 'Pendente'
                    WHEN o.status = 'A' THEN 'Em Análise'
                    WHEN o.status = 'R' THEN 'Respondido'
                    WHEN o.status = 'C' THEN 'Cancelado'
                END AS status_motivo
            ")
            ->where('c.empresa_id', $this->empresa_id)
            ->orderBy('o.criado_em');


        // Aplica o filtro de datas se estiver definido
        if ($this->dataInicio) {
            $query->whereBetween(DB::raw('DATE(o.criado_em)'), [$this->dataInicio, $this->dataFim]);
        }

        // Retorna a coleção de dados
        $ocorrencia = $query->get();

        return view('exports.relatorio_ocorrencias', [
            'ocorrencias' => $ocorrencia
        ]);
    }

    /**
     * Retorna a imagem que será usada no relatório.
     *
     * @return array
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo do relatório');
        $drawing->setPath(public_path('assets/media/logos/imagem.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');

        return [$drawing];
    }

    /**
     * Define o título da worksheet.
     *
     * @return string
     */
    public function title(): string
    {
        return 'Relatório de Ocorrências';
    }
}
