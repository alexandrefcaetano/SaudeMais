<?php

namespace App\Http\Controllers\admin;


use App\Models\GuiaSeguro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RelatorioMonitoramentoAtendimentoExport;
use App\Exports\RelatorioCronicoExport;

class GuiaSeguroController extends Controller
{


    public function relatorioMonitoramentoAtendimento(Request $request)
    {

        // Validação do campo de data
        $request->validate([
            'mesano' => 'required|date_format:m/Y'
        ]);

        [$mes, $ano] = explode("/", $request->mesano);


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
            $resultados = GuiaSeguro::selectRaw('EXTRACT(DAY FROM dataatendimento) as dia, COUNT(id_guiaseguro) as qtd, SUM(valortotalsaudemais) / COUNT(id_guiaseguro) as media')
                ->where('ativo', 'S')
                ->whereYear('dataatendimento', $ano)
                ->whereMonth('dataatendimento', $mes)
                ->when($tipoId, fn($query) => $query->where('tipoatendimento_id', $tipoId))
                ->groupByRaw('EXTRACT(DAY FROM dataatendimento)')
                ->orderByRaw('EXTRACT(DAY FROM dataatendimento)')
                ->get();

            foreach ($resultados as $resultado) {
                $array[$resultado->dia][$tipoNome]['qtd'] = $resultado->qtd;
                $array[$resultado->dia][$tipoNome]['media'] = $resultado->media;
            }
        }


        $nomeRelatorio = 'relatorio_atendimento'.date("Ymd_hms").'.xlsx';

        // Exportar para Excel
        return Excel::download(new RelatorioMonitoramentoAtendimentoExport($array), $nomeRelatorio);
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
     * Ele usa o serviço RelatorioAdministrativoService para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCronico(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Validação dos campos de data
        $request->validate([
            'datainicio' => 'required|date_format:d/m/Y',
            'datafim'    => 'required|date_format:d/m/Y'
        ]);
        $request->seguradora = decrypitar($request->seguradora);
        $request->validate(['seguradora' => 'required']);

        return Excel::download(new RelatorioCronicoExport($request->datainicio,$request->datafim,$request->seguradora ?? null,  $request->empresa ?? null, $request->apolice ?? null), 'relatorio_Cronico.xlsx');


    }

}


