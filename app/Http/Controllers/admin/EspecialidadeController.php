<?php

// app/Http/Controllers/Admin/EspecialidadeController.php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEspecialidadeRequest;

class EspecialidadeController extends Controller
{
    public function index(Request $request)
    {

        // Recebe os filtros da requisição
        $especialidade = $request->input('especialidade');
        $ativo = $request->input('ativo');

        // Inicia a query base para Especialidade
        $query = Especialidade::query();

        // Aplica os filtros se os valores não forem vazios
        if (!empty($especialidade)) {
            $query->where('especialidade', 'like', '%' . $especialidade . '%');
        }
        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 15);
        $especialidades = $query->orderBy('id_especialidade', 'desc')->paginate($registrosPorPagina);


        return view('admin.especialidade.grid', compact('especialidades','registrosPorPagina'));
    }

    public function create()
    {
        return view('admin.especialidade.create');
    }

    public function store(StoreEspecialidadeRequest $request)
    {
        $especialidadeData = $request->all();

        // Descriptografa o ID criptografado antes de buscar a especialidade
        $especialidadeData['id_especialidade'] = decrypitar($especialidadeData['id_especialidade']);

        Especialidade::create($especialidadeData);

        return redirect()->route('especialidade.index')->with('success', 'Especialidade criada com sucesso.');
    }

    public function show($encryptedId)
    {
        // Descriptografa o id_especilidade
        $id_especialidade = decrypitar($encryptedId);
        // Busca a es no banco de dados com o ID descriptografado
        $especialidade = Especialidade::findOrFail($id_especialidade);

        return view('admin.especialidade.show', compact('especialidade'));
    }

    public function edit($encryptedId)
    {
         // Descriptografa o id_especilidade
         $id_especialidade = decrypitar($encryptedId);

        // Busca a especialidade no banco de dados com o ID descriptografado
        $especialidade = Especialidade::findOrFail($id_especialidade);
        $especialidade['id_cryto'] = $encryptedId;

        return view('admin.especialidade.edit', compact('especialidade'));
    }

    public function update(StoreEspecialidadeRequest $request,  $id_cryto)
    {

        // Descriptografa o ID criptografado antes de buscar a especialidade
        $id_especialidade = decrypitar($id_cryto);

        // Busca a especialidade usando o ID descriptografado
        $especialidade = Especialidade::findOrFail($id_especialidade);

         // Prepara os dados do plano para atualização
        $especialidadeData = $request->all();

        // Atualiza o plano no banco de dados
        $especialidade->update($especialidadeData);

        return redirect()->route('especialidade.index')->with('success', 'Especialidade atualizada com sucesso.');
    }

    public function destroy(Especialidade $especialidade)
    {
        $especialidade->delete();

        return redirect()->route('especialidade.index')->with('success', 'Especialidade removida com sucesso.');
    }


    public function pesquisa(Request $request){

        if($request == null){
            redirect()->route('especialidade.index')->with('success', 'Nenhuma especialidade encontrada.');
        }

        $this->index($request);
    }

}
