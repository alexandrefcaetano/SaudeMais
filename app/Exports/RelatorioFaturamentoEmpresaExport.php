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

class RelatorioFaturamentoEmpresaExport implements FromView, WithDrawings, WithTitle
{

    private ?int $seguradora;
    private string $dataInicio;
    private string $dataFim;
    private ?int $empresa;


    public function __construct( int $seguradora, string $dataInicio, string $dataFim, int $empresa = null)
    {
        $this->seguradora = $seguradora;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->empresa = $empresa;


    }

    public function view(): View
    {
        try {
            $condicao = '';

            if ($this->seguradora) {
                $condicao .= "AND s.id_seguradora =  {$this->seguradora}";
            }
            if (!empty($this->dataInicio) && !empty($this->dataFim)) {
                $condicao .= " AND DATE(c.criado_em) BETWEEN '{$this->dataInicio}' AND '{$this->dataFim}'";
            }
            if($this->empresa!=""){
                $condicao .= " AND e.id_empresa = '$this->empresa' ";
            }

            // Executa a consulta usando DB::select()
            $relatorio_faturamento_empresa = DB::select(utf8_decode("
                               SELECT  a.apolice,
                                       e.nomefantasia AS empresa,
                                       c.id_apolice_conta_corrente,
                                       b.banco,
                                       c.numero_documento,
                                       c.tipo,
                                       c.valor_documento,
                                       c.criado_em,
                                       u.nome AS usuario_incluiu,
                                       s.seguradora
                                FROM tb_apolice_conta_corrente c
                                LEFT JOIN tb_banco b ON b.idBanco = c.idBanco
                                LEFT JOIN tb_faturamentoseguradora fs ON c.idFaturaSeguradora = fs.idFaturaSeguradora
                                INNER JOIN tb_usuario u ON c.idUsuarioInc = u.id_usuario
                                INNER JOIN tb_empresa e ON a.empresa_id = e.id_empresa
                                INNER JOIN tb_apolice a ON a.id_apolice = c.idApolice
                                INNER JOIN tb_seguradora s ON c.idSeguradora = s.id_seguradora
                                WHERE c.excluido is false
                                $condicao
                                ORDER BY e.nomefantasia, c.criado_em;

            "));

            return view('exports.relatorio_faturamento_empresa', [
                'relatorio_faturamento_empresa' => $relatorio_faturamento_empresa
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_faturamento_empresa', [
                'relatorio_faturamento_empresa' => [],
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
        return 'Relatório Faturamento Empresas';
    }



}
