<?php

namespace App\Http\Controllers\admin;

use App\Models\Ocorrencia;
use App\Http\Requests\OcorrenciaRequest;
use Illuminate\Http\Request;
use App\Exports\RelatorioOcorrenciaExport;

class OcorrenciaController extends Controller
{
    /**
     * Exibe a lista de Ocorrencias.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        // Recebe os filtros da requisição
        $cliente_id = $request->input('cliente');
        $stuats = $request->input('status');


        // Inicia a query base para Especialidade
        $query = Ocorrencia::query();


        if (!empty($cliente_id)) {
            // Descriptografar o ID da Cliente antes de usar na query
            try {
                $decryptedClienteId = decrypitar($cliente_id);
                $query->where('cliente_id', $decryptedClienteId);
            } catch (\Exception $e) {
                // Trate o erro de descriptografia, se necessário
                return redirect()->back()->withErrors('ID da Cliente inválido.');
            }
        }

        if (!empty($stuats)) {
            $query->where('status', $stuats);
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 20);
        $ocorrencias = $query->orderBy('id_ocorrencia', 'desc')->paginate($registrosPorPagina);

        return view('admin.ocorrencia.grid', compact('ocorrencias','registrosPorPagina'));
    }

    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioOcorrenciaService para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioOcorrencia(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Validação dos campos de data
        $request->validate([
            'datainicio' => 'required|date_format:d/m/Y',
            'datafim'    => 'required|date_format:d/m/Y'
        ]);
        $request->empresa = decrypitar($request->empresa);
        $request->validate(['empresa' => 'required']);

        return Excel::download(new RelatorioOcorrenciaExport($request->empresa ,$request->datainicio ?? null,$request->datafim ?? null), 'relatorio_Ocorrencia.xlsx');

    }


}
