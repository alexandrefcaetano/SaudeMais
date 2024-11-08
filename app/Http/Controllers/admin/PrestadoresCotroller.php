<?php

namespace App\Http\Controllers\admin;

use App\Models\Prestador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrestadoresRequest;
use App\Exports\RelatorioPrestadoresExport;

class PrestadoresCotroller extends Controller
{


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioPrestadoresExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioPrestador(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        // Verifica se o campo prestadores existe e contém valores
        $prestadoresIds = $request->has('prestadores') ? array_map(function($id) {
            return decrypitar($id);
        }, $request->input('prestadores')) : [];

        // Validação dos campos de data
        $request->validate([
            'datainicio' => 'required|date_format:d/m/Y',
            'datafim' => 'required|date_format:d/m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);


        // Converte o array de IDs em uma string separada por vírgulas, se não estiver vazio
        $prestadoresIdsString = !empty($prestadoresIds) ? implode(',', $prestadoresIds) : null;

        // Define o nome do arquivo para o relatório
        $nome_relatorio = 'relatorio_prestador_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação, passando a string de IDs dos prestadores (ou null) e outros parâmetros
        return Excel::download(
            new RelatorioPrestadoresExport(
                $prestadoresIdsString?? null,
                $dataInicio,
                $dataFim,
            ),
            $nome_relatorio
        );
    }




}
