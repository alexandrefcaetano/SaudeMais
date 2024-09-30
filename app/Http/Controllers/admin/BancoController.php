<?php

namespace App\Http\Controllers\admin;

use App\Models\Banco;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBancoRequest;
use Illuminate\Support\Facades\DB;

class BancoController extends Controller
{
    /**
     * Exibe a lista de bancos.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $bancos = DB::table('tb_banco')
            ->leftJoin('tb_pais', 'tb_banco.pais_id', '=', 'tb_pais.id_pais')
            ->leftJoin('tb_provincia', 'tb_banco.provincia_id', '=', 'tb_provincia.id_provincia')
            ->leftJoin('tb_municipio', 'tb_banco.municipio_id', '=', 'tb_municipio.id_municipio')
            ->select(
                'tb_banco.*', // Todos os campos da tabela banco
                'tb_pais.pais as pais', // Nome do país
                'tb_provincia.provincia as provincia', // Nome da província
                'tb_municipio.municipio as municipio' // Nome do município
            )
            ->paginate(15); // Paginação de 15 itens por página

        return view('admin.banco.grid', compact('bancos'));
    }

    /**
     * Mostra o formulário de criação de um assets banco.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $paises = \App\Models\Pais::all();
        // Retorna a view para criar um assets banco
        return view('admin.banco.create', compact('paises'));
    }

    /**
     * Armazena um assets banco no banco de dados.
     *
     * @param  \App\Http\Requests\StoreBancoRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBancoRequest $request)
    {
        // Prepara os dados validados do banco
        $bancoData = $request->validated();

         // Substitui os campos 'pais', 'provincia' e 'municipio' pelos respectivos IDs
        $bancoData['pais_id'] = $bancoData['pais'];
        $bancoData['provincia_id'] = $bancoData['provincia'];
        $bancoData['municipio_id'] = $bancoData['municipio'];

        // Remove os campos antigos que não são necessários no banco de dados
        unset($bancoData['pais'], $bancoData['provincia'], $bancoData['municipio']);

        // Cria o assets banco no banco de dados
        Banco::create($bancoData);

        // Redireciona para a lista de bancos com uma mensagem de sucesso
        return redirect()->route('banco.index')->with('success', 'Banco criado com sucesso.');
    }

    /**
     * Exibe um banco específico.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\View\View
     */
    public function show(Banco $banco)
    {
        // Consulta para buscar o banco específico com país, província e município
        $bancoDetalhes = DB::table('tb_banco')
            ->leftJoin('tb_pais', 'tb_banco.pais_id', '=', 'tb_pais.id_pais')
            ->leftJoin('tb_provincia', 'tb_banco.provincia_id', '=', 'tb_provincia.id_provincia')
            ->leftJoin('tb_municipio', 'tb_banco.municipio_id', '=', 'tb_municipio.id_municipio')
            ->select(
                'tb_banco.*', // Todos os campos da tabela banco
                'tb_pais.pais as pais', // Nome do país
                'tb_provincia.provincia as provincia', // Nome da província
                'tb_municipio.municipio as municipio' // Nome do município
            )
            ->where('tb_banco.id_banco', $banco->id_banco) // Usa o ID do banco passado como parâmetro
            ->first();

        // Verifique se o banco foi encontrado
        if (!$bancoDetalhes) {
            return redirect()->back()->withErrors('Banco não encontrado.');
        }

        // Retorna a view 'show' com os detalhes do banco
        return view('admin.banco.show', compact('bancoDetalhes'));
    }


    /**
     * Mostra o formulário de edição de um banco.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\View\View
     */
    public function edit(Banco $banco)
    {
        // Busca os dados do banco para edição
        $paises = \App\Models\Pais::all();
        // Retorna a view 'edit' com os dados do banco para edição
        return view('admin.banco.edit', compact('paises', 'banco'));
    }

    /**
     * Atualiza um banco existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreBancoRequest  $request
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreBancoRequest $request, Banco $banco)
    {
        // Prepara os dados validados do banco para atualização
        $bancoData = $request->validated();

        // Substitui os campos 'pais', 'provincia' e 'municipio' pelos respectivos IDs
        $bancoData['pais_id'] = $bancoData['pais'];
        $bancoData['provincia_id'] = $bancoData['provincia'];
        $bancoData['municipio_id'] = $bancoData['municipio'];
        // Remove os campos antigos que não são necessários no banco de dados
        unset($bancoData['pais'], $bancoData['provincia'], $bancoData['municipio']);

        // Atualiza o banco no banco de dados
        $banco->update($bancoData);

        // Redireciona para a lista de bancos com uma mensagem de sucesso
        return redirect()->route('banco.index')->with('success', 'Banco atualizado com sucesso.');
    }

    /**
     * Remove um banco do banco de dados.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Banco $banco)
    {
        // Exclui o banco
        $banco->delete();

        // Redireciona para a lista de bancos com uma mensagem de sucesso
        return redirect()->route('banco.index')->with('success', 'Banco excluído com sucesso.');
    }
}
