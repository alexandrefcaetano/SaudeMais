<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Imports\ClientesImport;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel; // Se você estiver usando Laravel Excel
use App\Imports\BeneficiariosImport; // Defina sua classe de importação se estiver usando Laravel Excel

class ClienteController extends Controller
{


    public function index(Request $request)
    {

        // Inicia a query base para Especialidade
        $query = Cliente::query();
        // Paginação de acordo com a quantidade selecionada
        $registrosPorPagina = $request->input('registrosPorPagina', 15);
        $clientes = $query->orderBy('id_cliente', 'desc')->paginate($registrosPorPagina);
        return view('admin.cliente.grid', compact('clientes','registrosPorPagina'));

    }

    public function createImportacao()
    {
        $linhas_analise = array();
        return view('admin.cliente.createImportacao',compact('linhas_analise')); // View da tela de importação cliente
    }


    public function importarClientes(Request $request)
    {
        $file = $request->file('arquivo');

        // Verifica se o arquivo é válido e do tipo permitido
        if (!$file->isValid() || !in_array($file->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            return redirect()->back()->withErrors(['arquivo' => 'Arquivo inválido. Certifique-se de que é um arquivo Excel ou CSV.']);
        }

        // Cria a instância do importador de clientes
        $import = new ClientesImport();

        try {
            // Importa o arquivo
            Excel::import($import, $file);

            // Obtém os erros usando o método getErrors()
            $linhas_arquivo = [
                'arquivo_id' => null,
                'nome_arquivo' => $file->getClientOriginalName(),
            ];

            $linhas_erros =  $import->getErrors();
            $linhas_analise = array_merge($linhas_arquivo, $linhas_erros);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Retorna a visualização de erros
            return view('importacao.erros', ['erros' => $e->failures()]);
        }

        // Retorna a análise completa para a visualização
        return view('admin.cliente.createImportacao', compact('linhas_analise'));
    }


    public function confirmarImportacao(Request $request)
    {

        if (empty($registrosValidos)) {
            return redirect()->back()->with('error', 'Não há registros válidos para importar.');
        }

        // Salva cada registro válido no banco de dados
        foreach ($registrosValidos as $registro) {
            $registro->save();
        }

        return redirect()->back()->with('success', 'Registros válidos importados com sucesso.');
    }

    public function download($filename)
    {

        $filePath = storage_path('app/public/modelos/' . $filename); // Se o arquivo estiver na pasta "storage/app/public"

        // Verifique se o arquivo existe
        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }
        // Retorna o arquivo para download
        return response()->download($filePath);
    }

}
