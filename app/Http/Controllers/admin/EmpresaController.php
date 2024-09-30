<?php

namespace App\Http\Controllers\admin;

use App\Classes;
use App\Models\Empresa;
use App\Models\Seguradora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpresaRequest;
use App\Helpers\EnvHelper;


    class EmpresaController extends Controller
    {

     /**
     * Exibe a lista de empresas.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Recebe os filtros da requisição
        $nomefantasia = $request->input('nomefantasia');
        $ativo = $request->input('ativo');
        $seguradora_id = $request->input('seguradora');

        // Inicia a query base para Empresa
        $query = Empresa::query();

        // Aplica os filtros se os valores não forem vazios
        if (!empty($nomefantasia)) {
            $query->where('nomefantasia', 'like', '%' . $nomefantasia . '%');
        }

        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }

        if (!empty($seguradora_id)) {
            // Descriptografar o ID da seguradora antes de usar na query
            try {
                $decryptedSeguradoraId = decrypitar($seguradora_id);
                $query->where('seguradora_id', $decryptedSeguradoraId);
            } catch (\Exception $e) {
                // Trate o erro de descriptografia, se necessário
                return redirect()->back()->withErrors('ID da seguradora inválido.');
            }
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 15);
        $empresas = $query->paginate($registrosPorPagina);

        // Buscar as seguradoras ativas e criptografar seus IDs
        $seguradoras = Seguradora::where('ativo', 'S')->get()->map(function ($seguradora) {
            $seguradora->encrypted_id = encrypitar($seguradora['id_seguradora']);
            return $seguradora;
        });

        // Retorna para a view
        return view('admin.empresa.grid', compact('empresas', 'seguradoras', 'registrosPorPagina'));
    }



    /**
     * Mostra o formulário de criação de uma nova empresa.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Buscar as seguradoras ativas e criptografar seus IDs
        $seguradoras = Seguradora::where('ativo', 'S')->get()->map(function ($seguradora) {
            $seguradora->encrypted_id = encrypitar($seguradora['id_seguradora']);
            return $seguradora;
        });
        // Retorna a view para criar uma nova empresa
        return view('admin.empresa.create', compact('seguradoras'));
    }

    /**
     * Armazena uma nova empresa no banco de dados.
     *
     * @param  \App\Http\Requests\StoreEmpresaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmpresaRequest $request)
    {
        // Prepara os dados da empresa
        $empresaData = $request->all();

        // Cria a nova empresa no banco de dados
        Empresa::create($empresaData);

        // Redireciona para a lista de empresas com uma mensagem de sucesso
        return redirect()->route('empresa.index')->with('success', 'Empresa criada com sucesso.');
    }

    /**
     * Exibe uma empresa específica.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\View\View
     */
    public function show($encryptedId)
    {

        // Descriptografa o id_empresa
        $id_empresa = decrypitar($encryptedId);
        // Busca a empresa no banco de dados com o ID descriptografado
        $empresa = Empresa::findOrFail($id_empresa);

        $seguradora =  Seguradora::getSeguradora($empresa->seguradora_id);

          // Converte o JSON para um array
        $contatoArray = json_decode($empresa->contato, true);
        // Retorna a view 'show' com os dados da empresa
        return view('admin.empresa.show', compact('empresa', 'contatoArray','seguradora'));
    }

    /**
     * Mostra o formulário de edição de uma empresa.
     *
     * @param  string  $encryptedId
     * @return \Illuminate\View\View
     */
    public function edit($encryptedId)
    {
        // Descriptografa o id_empresa
        $id_empresa = decrypitar($encryptedId);

        if (!$id_empresa) {
            // Caso o ID descriptografado seja inválido, redirecionar com erro
            return redirect()->route('empresa.index')->with('error', 'ID inválido.');
        }

        // Busca a empresa no banco de dados com o ID descriptografado
        $empresa = Empresa::findOrFail($id_empresa);
        $empresa['id_cryto'] = $encryptedId;


        // Buscar as seguradoras ativas e criptografar seus IDs
        $seguradoras = Seguradora::where('ativo', 'S')->get()->map(function ($seguradora) {
            $seguradora->encrypted_id = encrypitar($seguradora['id_seguradora']);
            return $seguradora;
        });

        // Retorna a view 'edit' com os dados da empresa para edição
        return view('admin.empresa.edit', compact('empresa', 'seguradoras'));
    }


    /**
     * Atualiza uma empresa existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreEmpresaRequest  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreEmpresaRequest $request, $id_cryto)
    {
        // Descriptografa o ID criptografado antes de buscar a empresa
        $id_empresa = decrypitar($id_cryto);

        // Busca a empresa usando o ID descriptografado
        $empresa = Empresa::findOrFail($id_empresa);

        // Prepara os dados da empresa para atualização
        $empresaData = $request->all();

        // Atualiza o segurdora_id após descriptografar, se necessário
        $empresaData['seguradora_id'] = decrypitar($empresaData['seguradora']);

        // Atualiza a empresa no banco de dados
        $empresa->update($empresaData);

        // Redireciona para a lista de empresas com uma mensagem de sucesso
        return redirect()->route('empresa.index')->with('success', 'Empresa atualizada com sucesso.');
    }



    /**
     * Remove uma empresa do banco de dados.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Empresa $empresa)
    {
        // Marca a empresa como excluída (soft delete)
        $empresa->update(['excluido' => 'S']);

        // Redireciona para a lista de empresas com uma mensagem de sucesso
        return redirect()->route('empresa.index')->with('success', 'Empresa excluída com sucesso.');
    }

    public function pesquisa(Request $request){

        $this->index($request);
    }
}
