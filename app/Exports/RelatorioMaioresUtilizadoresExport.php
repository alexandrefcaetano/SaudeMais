<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithTitle;

class RelatorioMaioresUtilizadoresExport implements FromView, WithDrawings, WithTitle
{
    private ?int $empresa_id;
    private string $dataInicio;
    private string $dataFim;

    /**
     * Construtor da classe RelatorioMaioresUtilizadoresExport.
     *
     * @param int|null $empresa_id ID da empresa (opcional).
     * @param string $dataInicio Data de início no formato Y-m-d (obrigatório).
     * @param string $dataFim Data de fim no formato Y-m-d (obrigatório).
     */
    public function __construct(?int $empresa_id = null, string $dataInicio, string $dataFim)
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
        // Monta a query base com os parâmetros de data
        $query = DB::table('tb_guiaseguro as g')
            ->join('tb_tipoatendimento as t', 't.id_tipoatendimento', '=', 'g.tipoatendimento_id')
            ->join('tb_cliente as c', 'g.cliente_id', '=', 'c.id_cliente')
            ->join('tb_empresa as e', 'c.empresa_id', '=', 'e.id_empresa')
            ->join('tb_apolice as a', 'c.apolice_id', '=', 'a.id_apolice')
            ->selectRaw('c.numerocartao, c.nome AS beneficiario, c.parentesco, a.apolice, e.nomefantasia AS empresa, t.tipoatendimento, COUNT(g.id_guiaSeguro) AS quantidade')
            ->where('g.ativo', 'S')
            ->whereBetween(DB::raw('DATE(g.dataatendimento)'), [$this->dataInicio, $this->dataFim])
            ->groupBy('c.numerocartao', 'c.nome', 'c.parentesco', 'a.apolice', 'e.nomefantasia', 't.tipoatendimento')
            ->orderByDesc('quantidade')
            ->orderBy('c.nome')
            ->orderBy('t.tipoatendimento');

        // Aplica o filtro de empresa se estiver definido
        if ($this->empresa_id) {
            $query->where('c.empresa_id', $this->empresa_id);
        }

        // Retorna a coleção de dados
        $clientes = $query->get();

        // Retorna a view com os dados
        return view('exports.relatorio_maiores_ultilizadores', [
            'clientes' => $clientes
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
        $drawing->setCoordinates('A1'); // Define a célula onde a imagem será exibida

        return [$drawing];
    }

    /**
     * Define o título da worksheet.
     *
     * @return string O nome da aba da planilha.
     */
    public function title(): string
    {
        return 'Relatório de Maiores Ultilizadores';
    }
}
