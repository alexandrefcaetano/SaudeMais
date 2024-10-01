<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProcedimentoRequest;

class ProcedimentoController extends Controller
{
    public function index(Request $request)
    {
        $prestador_id = $request->input('prestador_id');
        $codservico = $request->input('codservico');
        $ativo = $request->input('ativo');

        $query = Procedimento::query();

        if (!empty($prestador_id)) {
            $decryptedPrestadorId = decrypitar($prestador_id);
            $query->where('prestador_id', $decryptedPrestadorId);
        }

        if (!empty($codservico)) {
            $query->where('codservico', 'like', '%' . $codservico . '%');
        }

        if (!empty($ativo)) {
            $query->where('ativo', $ativo);
        }

        $procedimentos = $query->paginate(15);

        return view('procedimento.index', compact('procedimentos'));
    }

    public function create()
    {
        return view('procedimento.create');
    }

    public function store(StoreProcedimentoRequest $request)
    {
        $procedimentoData = $request->all();
        Procedimento::create($procedimentoData);

        return redirect()->route('procedimento.index')->with('success', 'Procedimento criado com sucesso.');
    }

    public function show($encryptedId)
    {
        $id_procedimento = decrypitar($encryptedId);
        $procedimento = Procedimento::findOrFail($id_procedimento);

        return view('procedimento.show', compact('procedimento'));
    }

    public function edit($encryptedId)
    {
        $id_procedimento = decrypitar($encryptedId);
        $procedimento = Procedimento::findOrFail($id_procedimento);

        return view('procedimento.edit', compact('procedimento'));
    }

    public function update(StoreProcedimentoRequest $request, $encryptedId)
    {
        $id_procedimento = decrypitar($encryptedId);
        $procedimento = Procedimento::findOrFail($id_procedimento);

        $procedimentoData = $request->all();
        $procedimento->update($procedimentoData);

        return redirect()->route('procedimento.index')->with('success', 'Procedimento atualizado com sucesso.');
    }


}
