<?php

namespace App\Http\Controllers\admin;

use App\Models\Seguradora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeguradoraRequest;


class SeguradoraController extends Controller
{
    /**
     * Exibe a lista de seguradoras.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        // Recebe os filtros da requisição
        $nomeSeguradora = $request->input('seguradora');
        $ativo = $request->input('ativo');

        // Inicia a query base para Empresa
        $query = Seguradora::query();

          // Aplica os filtros se os valores não forem vazios
        if (!empty($nomeSeguradora)) {
            $query->where('seguradora', 'like', '%' . $nomeSeguradora . '%');
        }

        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }


         // Paginação de acordo com a quantidade selecionada
         $registrosPorPagina = $request->input('registrosPorPagina', 15);
         $seguradoras = $query->orderBy('id_seguradora', 'desc')->paginate($registrosPorPagina);

        return view('admin.seguradora.grid', compact('seguradoras','registrosPorPagina'));
    }

    /**
     * Mostra o formulário de criação de uma nova seguradora.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view para criar uma nova seguradora
        return view('admin.seguradora.create');
    }

    /**
     * Armazena uma nova seguradora no banco de dados.
     *
     * @param  \App\Http\Requests\StoreSeguradoraRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSeguradoraRequest $request)
    {
        // Prepara os dados da seguradora
        $seguradoraData = $request->all();

        // Mapeia os campos de checkbox
        $checkboxFields = [
            'exibirsite',
            'exibirdanoscorporais'
        ];

        // Converte os valores para 'S' ou 'N'
        foreach ($checkboxFields as $field) {
            $seguradoraData[$field] = $request->has($field) ? 'S' : 'N';
        }

        // Cria a nova seguradora no banco de dados
        Seguradora::create($seguradoraData);

        // Redireciona para a lista de seguradoras com uma mensagem de sucesso
        return redirect()->route('seguradora.index')->with('success', 'Seguradora criada com sucesso.');
    }

    /**
     * Exibe uma seguradora específica.
     *
     * @param  \App\Models\Seguradora  $seguradora
     * @return \Illuminate\View\View
     */
    public function show($encryptedId)
    {

        // Descriptografa o id_empresa
        $id_empresa = decrypitar($encryptedId);
        // Busca a empresa no banco de dados com o ID descriptografado
        $seguradora = Seguradora::findOrFail($id_empresa);
        // Converte o JSON para um array
        $seguradoraContato = json_decode($seguradora->contato, true);

        // Retorna a view 'show' com os dados da seguradora
        return view('admin.seguradora.show', compact('seguradora','seguradoraContato'));
    }

    /**
     * Mostra o formulário de edição de uma seguradora.
     *
     * @param  \App\Models\Seguradora  $seguradora
     * @return \Illuminate\View\View
     */
    public function edit($encryptedId)
    {

        // Descriptografa o id_empresa
        $id_seguradora = decrypitar($encryptedId);

        // Busca a empresa no banco de dados com o ID descriptografado
        $seguradora = Seguradora::findOrFail($id_seguradora);
        $seguradora['id_cryto'] = $encryptedId;


        // Retorna a view 'edit' com os dados da seguradora para edição
        return view('admin.seguradora.edit', compact('seguradora'));
    }

    /**
     * Atualiza uma seguradora existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreSeguradoraRequest  $request
     * @param  \App\Models\Seguradora  $seguradora
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreSeguradoraRequest $request, $id_cryto)
    {

        // Descriptografa o ID criptografado antes de buscar a empresa
        $id_seguradora = decrypitar($id_cryto);

        // Busca a empresa usando o ID descriptografado
        $seguradora = Seguradora::findOrFail($id_seguradora);

        // Prepara os dados da seguradora para atualização
        $seguradoraData = $request->all();

         // Mapeia os campos de checkbox
         $checkboxFields = [
            'exibirsite',
            'exibirdanoscorporais'
        ];

        // Converte os valores para 'S' ou 'N'
        foreach ($checkboxFields as $field) {
            $seguradoraData[$field] = $request->has($field) ? 'S' : 'N';
        }

        // Atualiza a seguradora no banco de dados
        $seguradora->update($seguradoraData);

        // Redireciona para a lista de seguradoras com uma mensagem de sucesso
        return redirect()->route('seguradora.index')->with('success', 'Seguradora atualizada com sucesso.');
    }


}
