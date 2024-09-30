<?php

namespace App\Http\Controllers\admin;

use App\Models\Cid;
use App\Models\Cobertura;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCidRequest;

class CidController extends Controller
{
    /**
     * Exibe a lista de CIDs.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       // Recebe os filtros da requisição
       $cid = $request->input('cid');
       $ativo = $request->input('ativo');


      // Inicia a query base para Especialidade
      $query = Cid::query();

      // Aplica os filtros se os valores não forem vazios
      if (!empty($cid)) {
          $query->where('cid', 'like', '%' . $cid . '%');
      }
      if (!empty($ativo)) {
          $query->where('ativo', $ativo);
      }

      // Paginação de acordo com a quantidade selecionada
      $registrosPorPagina = $request->input('registrosPorPagina', 15);
      $cids = $query->orderBy('id_cid', 'desc')->paginate($registrosPorPagina);

      return view('admin.cid.grid', compact('cids','registrosPorPagina'));
    }

    /**
     * Mostra o formulário de criação de um assets CID.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Busca as coberturas ativas
        $coberturas = Cobertura::where('ativo', 'S')->get();

        // Buscar as Corbeturas ativas e criptografar seus IDs
        $coberturas = Cobertura::where('ativo', 'S')->get()->map(function ($cobertura) {
            $cobertura->encrypted_id = encrypitar($cobertura['id_cobertura']);
            return $cobertura;
        });

        // Retorna a view para criar um assets CID
        return view('admin.cid.create', compact('coberturas'));
    }

    /**
     * Armazena um assets CID no banco de dados.
     *
     * @param  \App\Http\Requests\StoreCidRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCidRequest $request)
    {
        // Obtém os dados validados
        $cidData = $request->validated();

        // Atribui o array diretamente ao campo cobertura_id
        if (isset($cidData['cobertura'])) {
            $cidData['cobertura_id'] = $cidData['cobertura'];
        }

        // Laravel irá salvar o array como JSON automaticamente devido ao cast
        Cid::create($cidData);

        // Redireciona para a lista de CIDs com uma mensagem de sucesso
        return redirect()->route('cid.index')->with('success', 'CID criado com sucesso.');
    }


    /**
     * Exibe um CID específico.
     *
     * @param  \App\Models\Cid  $cid
     * @return \Illuminate\View\View
     */
    public function show($encryptedId)
    {
         // Descriptografa o id_cid
         $id_cid = decrypitar($encryptedId);
         // Busca a es no Cid de dados com o ID descriptografado
         $cid = Cid::findOrFail($id_cid);

        // Busca os nomes das coberturas baseados nos IDs
        $coberturas = Cobertura::whereIn('id_cobertura', $cid->cobertura_id)->pluck('cobertura')->toArray();

        return view('admin.cid.show', compact('cid', 'coberturas'));
    }

    /**
     * Mostra o formulário de edição de um CID.
     *
     * @param  \App\Models\Cid  $cid
     * @return \Illuminate\View\View
     */
    public function edit($encryptedId)
    {
        // Descriptografa o id_cid
        $id_plano = decrypitar($encryptedId);

        // Busca o CID no banco de dados com o ID descriptografado
        $cid = Cid::findOrFail($id_plano);
        $cid['id_cryto'] = $encryptedId;

        // Busca as coberturas ativas
        $coberturas = Cobertura::where('ativo', 'S')->get()->map(function ($cobertura) {
            $cobertura->encrypted_id = encrypitar($cobertura['id_cobertura']);
            return $cobertura;
        });

        // Retorna a view 'edit' com os dados do CID para edição
        return view('admin.cid.edit', compact('cid', 'coberturas'));
    }


    /**
     * Atualiza um CID existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreCidRequest  $request
     * @param  \App\Models\Cid  $cid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreCidRequest $request, $id_cryto)
    {
        // Descriptografa o ID criptografado antes de buscar o Cid
        $id_cid = decrypitar($id_cryto);

        // Busca o Cid usando o ID descriptografado
        $cid = Cid::findOrFail($id_cid);

        // Obtém os dados validados do request
        $cidData = $request->validated();

        // Verifica se há cobertura enviada e ajusta a chave 'cobertura_id' para salvar como array
        if (isset($cidData['cobertura'])) {
            $cidData['cobertura_id'] = $cidData['cobertura'];  // Copia o array de cobertura para 'cobertura_id'
        }

        // Atualiza o CID no banco de dados
        $cid->update($cidData);

        // Redireciona para a lista de CIDs com uma mensagem de sucesso
        return redirect()->route('cid.index')->with('success', 'CID atualizado com sucesso.');
    }
}
