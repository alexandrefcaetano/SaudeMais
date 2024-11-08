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


class RelatorioApolicePadraoExport implements FromView, WithDrawings, WithTitle
{

    /**
     * Retorna a view que será usada para gerar o arquivo Excel.
     *
     * @return View
     */
    public function view(): View
    {
        try {

            // Executa a consulta usando DB::select()
            $relatorio_apolce_padrao = DB::select(utf8_decode("
                               SELECT a.apolice,
                                       c.cobertura,
                                       cl.coberturaLimite,
                                       al.valor_limite,
                                       al.participacao_rede,
                                       a.data_inicio_cobertura,
                                       a.data_fim_cobertura,
                                       al.ativo,
                                       CASE
                                           WHEN al.participacao_beneficiario_rede = 1 THEN 'SEM CO-PARTICIPAÇÃO'
                                           WHEN al.participacao_beneficiario_rede = 2 THEN 'NA AUTORIZAÇÃO'
                                           WHEN al.participacao_beneficiario_rede = 3 THEN 'FRANQUIA'
                                           ELSE 'FOLHA DE PAGAMENTO'
                                           END AS participacao_beneficiario_rede
                                FROM tb_apolice_padrao a
                                         INNER JOIN tb_apolice_padrao_limite al ON a.id_apolice_padrao = al.apolice_padrao_id
                                         INNER JOIN tb_cobertura c ON al.cobertura_id = c.id_cobertura
                                         INNER JOIN tb_coberturalimite cl ON al.cobertura_limite_id = cl.id_coberturalimite  AND c.id_cobertura = cl.cobertura_id
                                WHERE a.ativo = 'S'
                                ORDER BY a.apolice,c.cobertura

            "));

            return view('exports.relatorio_apolice_padrao', [
                'relatorio_apolice_padrao' => $relatorio_apolce_padrao
            ]);
        } catch (Exception $e) {
            report($e);
            return view('exports.relatorio_apolice_padrao', [
                'relatorio_apolice_padrao' => [],
                'error' => 'Erro ao gerar o relatório: ' . $e->getMessage()
            ]);
        }
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
        return 'Relatório Apólice Padrão';
    }


}


