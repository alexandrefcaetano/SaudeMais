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
        return view('admin.cliente.createImportacao'); // View da tela de importação cliente
    }


    public function importarClientes(Request $request)
    {
        // Verifica se o arquivo foi enviado e se é do tipo Excel
        $file = $request->file('arquivo');
        if (!$file->isValid() || !in_array($file->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            return redirect()->back()->withErrors(['arquivo' => 'Arquivo inválido. Certifique-se de que é um arquivo Excel ou CSV.']);
        }

        $import = new ClientesImport();

        try {
            // Especifica o tipo de arquivo explicitamente ou garante que o tipo seja inferido pela extensão
            Excel::import($import, $file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Retorna os erros encontrados para a view
            return view('importacao.erros', ['erros' => $e->failures()]);
        }

        // Se o usuário decidir prosseguir com a importação dos registros válidos
        foreach ($import->getValidRows() as $beneficiario) {
            $beneficiario->save();
        }

        return redirect()->back()->with('success', 'Importação realizada com sucesso.');
    }


    public function confirmarImportacao(Request $request)
    {
        // Aqui você vai precisar recuperar os registros válidos que foram processados na etapa anterior.
        // Para simplificação, você pode utilizar a sessão para armazená-los temporariamente.

        $registrosValidos = session('registrosValidos');

        if (empty($registrosValidos)) {
            return redirect()->back()->with('error', 'Não há registros válidos para importar.');
        }

        // Salva cada registro válido no banco de dados
        foreach ($registrosValidos as $registro) {
            $registro->save();
        }

        // Limpa a sessão após a importação
        session()->forget('registrosValidos');

        return redirect()->back()->with('success', 'Registros válidos importados com sucesso.');
    }

}
