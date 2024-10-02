<?php

namespace App\Http\Controllers\admin;

use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlanoRequest;

class PlanoController extends Controller
{
    /**
     * Exibe a lista de planos.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

         // Recebe os filtros da requisição
         $plano = $request->input('plano');
         $ativo = $request->input('ativo');


        // Inicia a query base para Especialidade
        $query = Plano::query();

        // Aplica os filtros se os valores não forem vazios
        if (!empty($plano)) {
            $query->where('plano', 'like', '%' . $plano . '%');
        }
        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 6);
        $planos = $query->orderBy('id_plano', 'desc')->paginate($registrosPorPagina);

        return view('admin.plano.grid', compact('planos','registrosPorPagina'));
    }

    /**
     * Mostra o formulário de criação de um assets plano.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view para criar um assets plano
        return view('admin.plano.create');
    }

    /**
     * Armazena um assets plano no banco de dados.
     *
     * @param  \App\Http\Requests\StorePlanoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePlanoRequest $request)
    {
        // Prepara os dados do plano
        $planoData = $request->all();

        // Cria o assets plano no banco de dados
        Plano::create($planoData);

        // Redireciona para a lista de planos com uma mensagem de sucesso
        return redirect()->route('plano.index')->with('success', 'Plano criado com sucesso.');
    }

    /**
     * Exibe um plano específico.
     *
     * @param  \App\Models\Plano  $plano
     * @return \Illuminate\View\View
     */
    public function show($encryptedId)
    {
         // Descriptografa o id_especilidade
         $id_plano = decrypitar($encryptedId);
         // Busca a es no banco de dados com o ID descriptografado
         $plano = Plano::findOrFail($id_plano);

        return view('admin.plano.show', compact('plano'));
    }

    /**
     * Mostra o formulário de edição de um plano.
     *
     * @param  \App\Models\Plano  $plano
     * @return \Illuminate\View\View
     */
    public function edit($encryptedId)
    {

         // Descriptografa o id_especilidade
         $id_plano = decrypitar($encryptedId);

         // Busca a especialidade no banco de dados com o ID descriptografado
         $plano = Plano::findOrFail($id_plano);
         $plano['id_cryto'] = $encryptedId;

        // Retorna a view 'edit' com os dados do plano para edição
        return view('admin.plano.edit', compact('plano'));
    }

    /**
     * Atualiza um plano existente no banco de dados.
     *
     * @param  \App\Http\Requests\StorePlanoRequest  $request
     * @param  \App\Models\Plano  $plano
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePlanoRequest $request, $id_cryto)
    {

        // Descriptografa o ID criptografado antes de buscar a especialidade
        $id_plano = decrypitar($id_cryto);

        // Busca a especialidade usando o ID descriptografado
        $plano = Plano::findOrFail($id_plano);

        // Prepara os dados do plano para atualização
        $especialidadeData = $request->all();

        // Atualiza o plano no banco de dados
        $plano->update($especialidadeData);

        // Redireciona para a lista de planos com uma mensagem de sucesso
        return redirect()->route('plano.index')->with('success', 'Plano atualizado com sucesso.');
    }


}
