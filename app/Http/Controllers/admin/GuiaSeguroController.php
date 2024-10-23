<?php

namespace App\Http\Controllers\admin;

use App\Models\GuiaSeguro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatorioMaioresUtilizadoresExport;
use App\Exports\RelatorioMonitoramentoAtendimentoExport;

class GuiaSeguroController extends Controller
{


    public function RelatorioMonitoramentoAtendimento($mesAno)
    {
        [$mes, $ano] = explode("/", $mesAno);

        // Inicializar array com dias do mês
        $array = $this->inicializarArray();

        // Tipos de atendimentos com suas chaves no array
        $tipos = [
            'geral' => null, // Geral sem filtro
            'consultas' => 1,
            'diagnostico' => 2,
            'enfermagem' => 3,
            'medicamentos' => 4,
            'internamento' => 5,
            'estomatologia' => 6
        ];

        // Itera por todos os tipos (geral e específicos) em uma única consulta para cada tipo
        foreach ($tipos as $tipoNome => $tipoId) {
            $resultados = GuiaSeguro::selectRaw('DAY(dataatendimento) as dia, COUNT(id_guiaSeguro) as qtd, SUM(valortotalsaudemais) / COUNT(id_guiaSeguro) as media')
                ->where('status', 'S')
                ->whereYear('dataatendimento', $ano)
                ->whereMonth('dataatendimento', $mes)
                ->when($tipoId, fn($query) => $query->where('tipoatendimento_id', $tipoId))
                ->groupByRaw('DAY(dataatendimento)')
                ->orderByRaw('DAY(dataatendimento)')
                ->get();

            foreach ($resultados as $resultado) {
                $array[$resultado->dia][$tipoNome]['qtd'] = $resultado->qtd;
                $array[$resultado->dia][$tipoNome]['media'] = $resultado->media;
            }
        }

        // Exportar para Excel
        return Excel::download(new RelatorioMonitoramentoAtendimentoExport($array), 'relatorio_atendimento.xlsx');
    }

    private function inicializarArray()
    {
        return array_fill(1, 31, [
            'geral' => ['qtd' => 0, 'media' => 0],
            'consultas' => ['qtd' => 0, 'media' => 0],
            'diagnostico' => ['qtd' => 0, 'media' => 0],
            'enfermagem' => ['qtd' => 0, 'media' => 0],
            'medicamentos' => ['qtd' => 0, 'media' => 0],
            'internamento' => ['qtd' => 0, 'media' => 0],
            'estomatologia' => ['qtd' => 0, 'media' => 0],
        ]);
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioMaioresUtilizadores para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function RelatorioMaioresUtilizadores(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        // Validação dos campos de data
        $request->validate([
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date'
        ]);

        // Exporta o relatório usando o Excel e retorna o arquivo para download
        return Excel::download(
            new RelatorioMaioresUtilizadoresExport(
                $request->empresa_id ?? null,
                $request->dataInicio,
                $request->dataFim
            ),
            'RelatorioMaioresUtilizadores.xlsx'
        );
    }


}
