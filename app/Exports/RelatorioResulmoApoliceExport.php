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

class RelatorioResulmoApoliceExport implements FromView, WithDrawings, WithTitle
{
    private ?int $seguradora_id;
    private string $dataInicio;
    private string $dataFim;

    /**
     * Construtor da classe RelatorioResulmoApoliceExport.
     *
     * @param int|null $seguradora_id ID da seguradora (opcional).
     * @param string $dataInicio Data de início no formato Y-m-d (obrigatório).
     * @param string $dataFim Data de fim no formato Y-m-d (obrigatório).
     * @throws Exception Se as datas estiverem em formato inválido.
     */
    public function __construct(?int $seguradora_id = null, string $dataInicio, string $dataFim)
    {
        // Validação de datas
        if (!Carbon::hasFormat($dataInicio, 'Y-m-d') || !Carbon::hasFormat($dataFim, 'Y-m-d')) {
            throw new Exception('Formato de data inválido. Use o formato Y-m-d.');
        }

        $this->seguradora_id = $seguradora_id;
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
//        try {
            // Monta a query base com os parâmetros de data
            $query = DB::table('tb_apolice as a')
                ->join('tb_empresa as e', 'a.empresa_id', '=', 'e.id_empresa')
                ->join('tb_seguradora as seg', 'seg.id_seguradora', '=', 'a.seguradora_id')
                ->join('tb_apolicelimite as al', 'al.apolice_id', '=', 'a.id_apolice')
                ->join('tb_cobertura as c', 'c.id_cobertura', '=', 'al.cobertura_id')
                ->selectRaw("
                    e.nomeFantasia AS empresa,
                    seg.seguradora,
                    a.apolice,
                    a.resseguro,
                    c.cobertura,
                    al.valorlimite,
                    al.participacaorede,
                    TO_CHAR(a.datainiciocobertura, 'DD/MM/YYYY') AS datainiciocobertura,
                    TO_CHAR(a.datafimcobertura, 'DD/MM/YYYY') AS datafimcobertura,
                    a.apoliceseguradora,
                    CASE
                        WHEN al.participacaobeneficiariorede = 1 THEN 'SEM CO-PARTICIPAÇÃO'
                        WHEN al.participacaobeneficiariorede = 2 THEN 'NA AUTORIZAÇÃO'
                        WHEN al.participacaobeneficiariorede = 3 THEN 'FRANQUIA'
                        ELSE 'FOLHA DE PAGAMENTO'
                    END AS participacaobeneficiariorede,
                    al.ativo,
                    al.maximosessoes,
                    CASE
                        WHEN a.fraccionamento = 'AN' THEN 'Anual'
                        WHEN a.fraccionamento = 'SE' THEN 'Semestral'
                        WHEN a.fraccionamento = 'TR' THEN 'Trimestral'
                        ELSE ''
                    END AS fraccionamento,
                    (
                        SELECT STRING_AGG(cl.coberturalimite, ', ' ORDER BY cl.coberturalimite)
                        FROM tb_coberturalimite cl
                        WHERE cl.cobertura_id = c.id_cobertura AND cl.status = 'S'
                    ) AS coberturalimite
                ")
                ->where('a.ativo', 'S')
                ->whereBetween(DB::raw('DATE(a.datainiciocobertura)'), [$this->dataInicio, $this->dataFim])
                ->groupBy(
                    'e.nomefantasia',
                    'seg.seguradora',
                    'a.apolice',
                    'a.resseguro',
                    'c.cobertura',
                    'al.valorlimite',
                    'al.participacaorede',
                    'a.datainiciocobertura',
                    'a.datafimcobertura',
                    'a.apoliceseguradora',
                    'al.ativo',
                    'al.maximosessoes',
                    'al.participacaobeneficiariorede',
                    'a.fraccionamento',
                    'c.id_cobertura'
                );

            // Aplica o filtro de seguradora se estiver definido
            if ($this->seguradora_id) {
                $query->where('a.seguradora_id', $this->seguradora_id);
            }

            // Retorna a coleção de dados
            $resumo_apolice = $query->get();

            // Retorna a view com os dados
            return view('exports.relatorio_resumo_apolice', [
                'resumo_apolice' => $resumo_apolice
            ]);



//        } catch (Exception $e) {
//            // Lida com falhas na consulta e exibe uma mensagem de erro
//            report($e);
//            return view('exports.relatorio_resumo_apolice', [
//                'resumo_apolice' => [],
//                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
//            ]);
//        }
    }

    /**
     * Retorna a imagem que será usada no relatório.
     *
     * @return array
     */
    public function drawings()
    {
        $imagePath = public_path('assets/media/logos/imagem.png');

        if (file_exists($imagePath)) {
            $drawing = new Drawing();
            $drawing->setName('Logo');
            $drawing->setDescription('Logo do relatório');
            $drawing->setPath($imagePath);
            $drawing->setHeight(80);
            $drawing->setCoordinates('A1'); // Define a célula onde a imagem será exibida

            return [$drawing];
        }

        return [];
    }

    /**
     * Define o título da worksheet.
     *
     * @return string O nome da aba da planilha.
     */
    public function title(): string
    {
        return 'Relatório Resumo de Apólice';
    }
}
