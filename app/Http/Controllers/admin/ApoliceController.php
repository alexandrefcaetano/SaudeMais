<?php

namespace App\Http\Controllers\admin;

use App\Models\Plano;
use App\Models\Apolice;
use App\Models\Empresa;
use App\Models\Seguradora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApoliceRequest;
use App\Services\ExportacaoService;
use App\Services\ExportacaoSercice;

use Illuminate\Support\Facades\DB;


class ApoliceController extends Controller
{
    /**
     * Exibe a lista de apólices.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        // Paginação de 15 apólices por página
        $apolices = Apolice::paginate(15);
        return view('admin.apolice.grid', compact('apolices'));
    }

    /**
     * Mostra o formulário de criação de uma nova apólice.
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
        // Buscar as seguradoras ativas e criptografar seus IDs
        $empresas = Empresa::where('ativo', 'S')->get()->map(function ($empresa) {
            $empresa->encrypted_id = encrypitar($empresa['id_seguradora']);
            return $empresa;
        });
        $planos = Plano::all();
        // Retorna a view para criar uma nova apólice
        return view('admin.apolice.create', compact('seguradoras', 'empresas', 'planos'));
    }

    /**
     * Armazena uma nova apólice no banco de dados.
     *
     * @param  \App\Http\Requests\StoreApoliceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreApoliceRequest $request)
    {
        // Prepara os dados da apólice
        $apolicesData = $request->all();


        // Mapeia os campos de checkbox
        $checkboxFields = [
            'excecaoAtendimentoObstetricia',
            'renovacaoLimite',
            'status',
            'permiteReembolso',
            'seguirTipoRegra',
            'redeInternacional',
            'utilizaDigital',
            'regraCronico',
            're-graIdoso',
            'resseguro',
            'liberarGuiaGratuita',
        ];

        // Converte os valores para 'S' ou 'N'
        foreach ($checkboxFields as $field) {
            $apolicesData[$field] = $request->has($field) ? 'S' : 'N';
        }

        // Cria a nova apólice no banco de dados
        $apolice = Apolice::create($apolicesData);

        // Redireciona para a lista de apólices com uma mensagem de sucesso
        return redirect()->route('apolice.index')->with('success', 'Apólice criada com sucesso.');
    }

    /**
     * Exibe uma apólice específica.
     *
     * @param  \App\Models\Apolice  $apolice
     * @return \Illuminate\View\View
     */
    public function show(Apolice $apolice)
    {
        // Converte o JSON do contato (se aplicável) para um array
        $contatoArray = json_decode($apolice->contato, true);

        // Retorna a view 'show' com os dados da apólice
        return view('admin.apolice.show', compact('apolice', 'contatoArray'));
    }

    /**
     * Mostra o formulário de edição de uma apólice.
     *
     * @param  \App\Models\Apolice  $apolice
     * @return \Illuminate\View\View
     */
    public function edit(Apolice $apolice)
    {
        // Retorna a view 'edit' com os dados da apólice para edição
        return view('admin.apolice.edit', compact('apolice'));
    }

    /**
     * Atualiza uma apólice existente no banco de dados.
     *
     * @param  \App\Http\Requests\StoreApoliceRequest  $request
     * @param  \App\Models\Apolice  $apolice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreApoliceRequest $request, Apolice $apolice)
    {
        // Prepara os dados da apólice para atualização
        $apoliceData = $request->all();

          // Mapeia os campos de checkbox
          $checkboxFields = [
            'excecaoAtendimentoObstetricia',
            'renovacaoLimite',
            'status',
            'permiteReembolso',
            'seguirTipoRegra',
            'redeInternacional',
            'utilizaDigital',
            'regraCronico',
            're-graIdoso',
            'resseguro',
            'liberarGuiaGratuita',
        ];

        // Converte os valores para 'S' ou 'N'
        foreach ($checkboxFields as $field) {
            $apolicesData[$field] = $request->has($field) ? 'S' : 'N';
        }


        // Atualiza a apólice no banco de dados
        $apolice->update($apoliceData);

        // Redireciona para a lista de apólices com uma mensagem de sucesso
        return redirect()->route('apolice.index')->with('success', 'Apólice atualizada com sucesso.');
    }

    /**
     * Remove uma apólice do banco de dados.
     *
     * @param  \App\Models\Apolice  $apolice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Apolice $apolice)
    {
        // Deleta a apólice do banco de dados
        $apolice->delete();

        // Redireciona para a lista de apólices com uma mensagem de sucesso
        return redirect()->route('apolice.index')->with('success', 'Apólice removida com sucesso.');
    }


    public function relatorio(){

        // Buscar as seguradoras ativas e criptografar seus IDs
        $seguradoras = Seguradora::where('ativo', 'S')->get()->map(function ($seguradora) {
            $seguradora->encrypted_id = encrypitar($seguradora['id_seguradora']);
            return $seguradora;
        });
        // Buscar as seguradoras ativas e criptografar seus IDs
        $empresas = Empresa::where('ativo', 'S')->get()->map(function ($empresa) {
            $empresa->encrypted_id = encrypitar($empresa['id_seguradora']);
            return $empresa;
        });
        return view('admin.apolice.relatorio', compact('seguradoras','empresas'));
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioAdministrativoService para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function exportar(Request $request)
    {
        // Recebe os filtros da requisição
        $empresa        = $request->input('nomefantasia');
        $seguradora     = $request->input('ativo');
        $data_inicio    = $request->input('dataInicioCobertura');
        $data_fim       = $request->input('dataFimCobertura');

        // Inicializa a variável de filtro
        $where = [];

        // Verifica se os filtros estão preenchidos e descriptografa os valores, se necessário
        if (!empty($seguradora)) {
            $where['seguradora'] = decrypitar($seguradora);
        }

        if (!empty($empresa)) {
            $where['empresa'] = decrypitar($empresa);
        }

        if (!empty($data_inicio)) {
            $where['dataInicioCobertura'] = $data_inicio;
        }

        if (!empty($data_fim)) {
            $where['dataFimCobertura'] = $data_fim;
        }

        // Obtém os dados do relatório com base nos filtros
        $dados = ['Relatorio_apolice' => $this->consultarDados($where)];

        // Instancia o serviço de exportação de relatórios
        $service = new ExportacaoSercice('Relatorio_Apolice',$dados);

        // Limpa o buffer de saída para evitar problemas ao gerar o arquivo
        if (ob_get_length()) {
            ob_end_clean();
        }

        // Retorna o arquivo gerado como resposta
        return $service->export('xls', 'A8');
    }

    /**
     * Consulta os dados no banco de dados com base nos filtros fornecidos.
     *
     * @param array $where Filtros da consulta.
     * @return array Dados retornados do banco de dados.
     */
    public function consultarDados($where)
    {
        $result = DB::select("
        SELECT
            e.nomeFantasia AS empresa,
            seg.seguradora,
            a.apolice,
            CASE
                WHEN a.resseguro = 'S' THEN 'SIM'
                WHEN a.resseguro = 'N' THEN 'NÃO'
                ELSE ''
            END AS resseguro,
            c.cobertura,
            al.valorLimite,
            al.participacaoRede,
            to_char(a.dataInicioCobertura, 'DD/MM/YYYY HH24:MI:SS') AS dataInicioCobertura,
            to_char(a.dataFimCobertura, 'DD/MM/YYYY HH24:MI:SS') AS dataFimCobertura,
            a.apoliceSeguradora,
            CASE
                WHEN al.participacaoBeneficiarioRede = 1 THEN 'SEM CO-PARTICIPAÇÃO'
                WHEN al.participacaoBeneficiarioRede = 2 THEN 'NA AUTORIZAÇÃO'
                WHEN al.participacaoBeneficiarioRede = 3 THEN 'FRANQUIA'
                ELSE 'FOLHA DE PAGAMENTO'
            END AS participacaoBeneficiarioRede,
            CASE
                WHEN al.status = 'S' THEN 'SIM'
                WHEN al.status = 'N' THEN 'NÃO'
                ELSE ''
            END AS status,
            al.maximoSessoes,
            CASE
                WHEN a.fraccionamento = 'AN' THEN 'Anual'
                WHEN a.fraccionamento = 'SE' THEN 'Semestral'
                WHEN a.fraccionamento = 'TR' THEN 'Trimestral'
                ELSE ''
            END AS fraccionamento,
            (
                SELECT STRING_AGG(cl.coberturaLimite, ', ' ORDER BY cl.coberturaLimite)
                FROM coberturalimite cl
                WHERE cl.idCobertura = c.idCobertura AND cl.status = 'S'
            ) AS coberturasLimites
        FROM empresa e
        INNER JOIN apolice a ON a.idEmpresa = e.idEmpresa AND a.status = 'S'
        INNER JOIN apolicelimite al ON al.idApolice = a.idApolice
        INNER JOIN seguradora seg ON seg.idSeguradora = e.idSeguradora
        INNER JOIN cobertura c ON c.idCobertura = al.idCobertura
        WHERE a.status = 'S'
        GROUP BY
            e.nomeFantasia, seg.seguradora, a.apolice, a.resseguro, c.cobertura,
            al.valorLimite, al.participacaoRede, a.dataInicioCobertura,
            a.dataFimCobertura, a.apoliceSeguradora, al.status,
            al.maximoSessoes, al.participacaoBeneficiarioRede, a.fraccionamento, c.idCobertura
        LIMIT 100000
    ");

        // Converte o resultado para array associativo
        return array_map(function ($item) {
            return (array) $item;
        }, $result);
    }


}
