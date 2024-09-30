<?php

namespace App\Http\Controllers\admin;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Models\Especialidade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicoRequest;


class MedicoController extends Controller
{
    public function index(Request $request)
    {

        // Recebe os filtros da requisição
        $medico = $request->input('medico');
        $especialidade_id = $request->input('especialidade');

        // Inicia a query base para Empresa
        $query = Medico::query();

        // Aplica os filtros se os valores não forem vazios
        if (!empty($medico)) {
            $query->where('medico', 'like', '%' . $medico . '%');
        }

        if (!empty($especialidade_id)) {
            // Descriptografar o ID da especialidade antes de usar na query
            try {
                $decryptedSeguradoraId = decrypitar($especialidade_id);
                $query->where('especialiadade_id', $decryptedSeguradoraId);
            } catch (\Exception $e) {
                // Trate o erro de descriptografia, se necessário
                return redirect()->back()->withErrors('ID da seguradora inválido.');
            }
        }

        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 15);
        $medicos = $query->paginate($registrosPorPagina);

        // Buscar as especialidade ativas e criptografar seus IDs
        $especialidades = Especialidade::where('ativo', 'S')->get()->map(function ($especialidade) {
            $especialidade->encrypted_id = encrypitar($especialidade['id_seguradora']);
            return $especialidade;
        });

        // Retorna para a view
        return view('admin.medico.grid', compact('medicos', 'especialidades', 'registrosPorPagina'));

    }

    public function create()
    {

        // Buscar as especialidade ativas e criptografar seus IDs
        $especialidades = Especialidade::where('ativo', 'S')->get()->map(function ($especialidade) {
            $especialidade->id_crypt = encrypitar($especialidade['id_especialidade']);
            return $especialidade;
        });

        return view('admin.medico.create', compact('especialidades'));
    }

    public function store(StoreMedicoRequest $request)
    {
        // Obtém os dados validados
        $data = $request->validated();

        // Cria o médico com os dados validados
        $medico = Medico::create([
            'medico' => $data['medico'],
            'crm' => $data['crm'],
            'ativo' => $data['ativo'],
            'tipo' => $data['tipo'],
            'contato' => $data['contato']
        ]);

        $medico->especialidades()->sync($data['especialidade']);
        // Redireciona com mensagem de sucesso
        return redirect()->route('medico.index')->with('success', 'Médico criado com sucesso.');
    }


    public function show(Medico $medico)
    {
        return view('admin.medico.show', compact('medico'));
    }

    public function edit($encryptedId)
    {

        // Descriptografa o id_medico
        $id_medico = decrypitar($encryptedId);

        if (!$id_medico) {
            // Caso o ID descriptografado seja inválido, redirecionar com erro
            return redirect()->route('medico.index')->with('error', 'ID inválido.');
        }

        // Busca a medico no banco de dados com o ID descriptografado
        $medico = Medico::findOrFail($id_medico);
        $medico['id_cryto'] = $encryptedId;


        // Buscar as especialidade ativas e criptografar seus IDs
        $especialidades = Especialidade::where('ativo', 'S')->get()->map(function ($especialidade) {
        $especialidade->id_crypt = encrypitar($especialidade['id_especialidade']);
        return $especialidade;
    });

        return view('admin.medico.edit', compact('medico','especialidades'));
    }

    public function update(StoreMedicoRequest $request, Medico $medico)
    {
        $data = $request->validated();
        if ($request->filled('senha')) {
            $data['senha'] = bcrypt($data['senha']);
        }
        $medico->update($data);
        return redirect()->route('admin.medico.index')->with('success', 'Médico atualizado com sucesso.');
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();
        return redirect()->route('admin.medico.index')->with('success', 'Médico removido com sucesso.');
    }


    public function pesquisa(Request $request){

        redirect()->route('admin.medico.index');
    }
}
