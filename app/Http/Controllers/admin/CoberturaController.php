<?php

namespace App\Http\Controllers\admin;

use App\Models\Cobertura;
use App\Models\CoberturaLimite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoberturaRequest;

class CoberturaController extends Controller
{
    /**
     * Exibe a lista de coberturas.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Paginação de 15 coberturas por página
        $coberturas = Cobertura::paginate(15);
        return view('admin.cobertura.grid', compact('coberturas'));
    }

    /**
     * Mostra o formulário de criação de uma nova cobertura.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retorna a view para criar uma nova cobertura
        return view('admin.cobertura.create');
    }

    /**
     * Armazena uma nova cobertura no banco de dados.
     *
     * @param  \App\Http\Requests\StoreCoberturaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCoberturaRequest $request)
    {
        // Prepara os dados validados da cobertura
        $coberturaData = $request->validated();

        // Cria a nova cobertura no banco de dados
        Cobertura::create($coberturaData);

        // Redireciona para a lista de coberturas com uma mensagem de sucesso
        return redirect()->route('cobertura.index')->with('success', 'Cobertura criada com sucesso.');
    }

    /**
     * Exibe uma cobertura específica.
     *
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\View\View
     */
    public function show(Cobertura $cobertura)
    {
        // Retorna a view 'show' com os dados da cobertura
        return view('admin.cobertura.show', compact('cobertura'));
    }

    /**
     * Mostra o formulário de edição de uma cobertura.
     *
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\View\View
     */
    public function edit(Cobertura $cobertura)
    {
        // Retorna a view 'edit' com os dados da cobertura para edição
        return view('admin.cobertura.edit', compact('cobertura'));
    }

    /**
     * Atualiza uma cobertura existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreCoberturaRequest  $request
     * @param  \App\Models\Cobertura  $cobertura
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCoberturaRequest $request, Cobertura $cobertura)
    {
        // Prepara os dados validados da cobertura para atualização
        $coberturaData = $request->validated();

        // Atualiza a cobertura no banco de dados
        $cobertura->update($coberturaData);

        // Redireciona para a lista de coberturas com uma mensagem de sucesso
        return redirect()->route('cobertura.index')->with('success', 'Cobertura atualizada com sucesso.');
    }


    public function getSubCoberturas($cobertura_id)
    {
         // Buscar as Cobertura ativas e criptografar seus IDs
        $subCoberturas = CoberturaLimite::where('cobertura_id', decrypitar($cobertura_id))->get()->map(function ($subcobertura) {
            $subcobertura->encrypted_id = encrypitar($subcobertura['id_coberturalimite']);
            return $subcobertura;
        });

        // Retornar os dados em JSON
        return response()->json($subCoberturas);
    }

}
