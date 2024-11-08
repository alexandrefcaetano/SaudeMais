<?php

namespace App\Http\Controllers\admin;


use App\Exports\RelatorioPreAutorizacaoExport;
use App\Exports\RelatorioApolicePadraoExport;
use App\Exports\RelatorioFaturamentoEmpresaExport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class RelatorioController extends Controller
{



    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioPreAutorizacaoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioPreAutorizacao(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->seguradora = decrypitar($request->seguradora);
        $request->empresa = decrypitar($request->empresa);
        $request->apolice = decrypitar($request->apolice);
        $request->tipo_atendimento = decrypitar($request->tipo_atendimento);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y',
            'seguradora'    => 'required'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);


        // Verifica se a diferença entre as datas é maior que 92 dias
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 92) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 92 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo para o Pré-Autorização
        $nome_relatorio = 'relatorio_pre_autorizacao_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioPreAutorizacaoExport(
                $request->seguradora,
                $dataInicio,
                $dataFim,
                $request->empresa ?? null,
                $request->apolice ?? null,
                $request->tipo_atendimento ?? null,
                $request->numero_cartao ?? null
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioApolicePadraoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioApolicePadrap(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Define o nome do arquivo para o Pré-Autorização
        $nome_relatorio = 'relatorio_apolice_padrao_' . date("Ymd_His") . '.xlsx';
        // Chama o serviço de exportação
        return Excel::download(new RelatorioApolicePadraoExport(), $nome_relatorio );
    }

    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioFaturamentoEmpresaExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioFaturamentoEmpresa(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->seguradora = decrypitar($request->seguradora);
        $request->empresa = decrypitar($request->empresa);


        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y',
            'seguradora'    => 'required'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);


        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 31) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 31 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_faturamento_empresa_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioFaturamentoEmpresaExport(
                $request->seguradora,
                $dataInicio,
                $dataFim,
                $request->empresa ?? null
            ),
            $nome_relatorio
        );
    }



}
