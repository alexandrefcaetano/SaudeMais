<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Jobs\ExportServicoJob;

class ServicoController extends Controller
{
    /**
     * Exibe a lista de Servicos.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        // Recebe os filtros da requisição
        $plano = $request->input('plano');
        $ativo = $request->input('ativo');


        // Inicia a query base para Servicos
        $query = Servico::query();

        // Aplica os filtros se os valores não forem vazios
        if (!empty($plano)) {
            $query->where('descricao', 'like', '%' . $plano . '%');
        }
        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 6);
        $servicos = $query->orderBy('id_servico', 'desc')->paginate($registrosPorPagina);

        return view('admin.servico.grid', compact('servicos','registrosPorPagina'));
    }

    /**
     * Mostra o formulário de criação de um assets Servico.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view para criar um assets plano
        return view('admin.servico.create');
    }

    /**
     * gera arquivo de empresa/.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\RedirectResponse
     */

    public function export()
    {
        $fileName = 'service_export.xlsx';
        return Excel::download(new ExportServicoJob,$fileName);
    }

}
