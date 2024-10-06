<?php

namespace App\Http\Controllers\Admin;


use App\Models\Cobertura;
use App\Models\Prestador;
use App\Models\Procedimento;
use App\Models\Seguradora;
use App\Models\TipoAtendimento;
use App\Models\TipoProcedimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 15);
        $procedimentos = $query->orderBy('id_prcedimento', 'desc')->paginate($registrosPorPagina);


        return view('admin.procedimento.grid', compact('procedimentos','registrosPorPagina'));
    }

    public function create()
    {

        // Buscar os Tipos de Procedimentos ativos, ordenar por 'secundaria' em ordem ascendente, e criptografar seus IDs
        $tipoprocedimentos = TipoProcedimento::where('ativo', 'S')
            ->orderBy('secundaria', 'asc')  // Ordenar pela coluna 'secundaria' em ordem ascendente
            ->get()
            ->map(function ($tipoprocedimento) {
                $tipoprocedimento->encrypted_id = encrypitar($tipoprocedimento['id_tipoatendimento']);
                return $tipoprocedimento;
            });


        // Buscar as Cobertura ativas e criptografar seus IDs
        $coberturas = Cobertura::where('ativo', 'S')->get()->map(function ($cobertura) {
            $cobertura->encrypted_id = encrypitar($cobertura['id_cobertura']);
            return $cobertura;
        });

        // Buscar as Atendimento ativas e criptografar seus IDs
        $tipoatendimentos = TipoAtendimento::where('ativo', 'S')->get()->map(function ($tipoatendimento) {
            $tipoatendimento->encrypted_id = encrypitar($tipoatendimento['id_tipoprocedimento']);
            return $tipoatendimento;
        });

        // Buscar as Prestador ativas e criptografar seus IDs
        $prestadores = Prestador::where('ativo', 'S')->get()->map(function ($prestador) {
            $prestador->encrypted_id = encrypitar($prestador['id_prestado']);
            return $prestador;
        });

        return view('admin.procedimento.create',compact('tipoprocedimentos','coberturas','tipoatendimentos','prestadores'));
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
