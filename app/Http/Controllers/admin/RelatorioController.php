<?php

namespace App\Http\Controllers\admin;


use App\Exports\RelatorioPreAutorizacaoExport;
use App\Exports\RelatorioApolicePadraoExport;
use App\Exports\RelatorioFaturamentoEmpresaExport;
use App\Exports\RelatorioCapadeLoteExport;
use App\Exports\RelatorioFaturamentoResumoExport;
use App\Exports\RelatorioFaturamentoAnaliticoExport;
use App\Exports\RelatorioPrecoPrestadoresExport;
use App\Exports\RelatorioPrecoPrescricaoExport;
use App\Exports\RelatorioReembolsoExport;
use App\Exports\RelatorioFaturamentoPrestadorExport;
use App\Exports\RelatorioFaturamentoColaboradorExport;
use App\Exports\RelatorioCheckUpExport;

use App\Exports\RelatorioCheckUpFaturamentoExport;
use App\Exports\RelatorioCheckUpGuiaExport;

use App\Exports\RelatorioComissionamentoLeveExport;
use App\Exports\RelatorioCesusLevelExport;













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

        // Define o nome do arquivo para Apolice Padrão
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


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioCapaDeLoteExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCapaDeLote(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Verifica se o campo prestadores existe e contém valores
        $prestadoresIds = $request->has('prestadores') ? array_map(function($id) {
            return decrypitar($id);
        }, $request->input('prestadores')) : [];



        // Validação dos campos de data
        $request->validate([
            'mes_ano'    => 'required|date_format:m/Y'
        ]);

        // Converte a data de m/Y para Y-m para ser usada no banco de dados
        $mes_ano = \DateTime::createFromFormat('m/Y', $request->mes_ano);

        // Converte o array de IDs em uma string separada por vírgulas, se não estiver vazio
        $prestadoresIdsString = !empty($prestadoresIds) ? implode(',', $prestadoresIds) : null;

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_capa_lote_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioCapadeLoteExport(
                $prestadoresIdsString?? null,
                $mes_ano
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioFaturamentoResumoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioFaturamentoResumo(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $request->prestador = decrypitar($request->prestador);
        $request->seguradora = decrypitar($request->seguradora);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y',
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);


        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 180) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 180 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_faturamento_resumo_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioFaturamentoResumoExport(
                $dataInicio,
                $dataFim,
                $request->prestador?? null,
                $request->seguradora ?? null
            ),
            $nome_relatorio
        );
    }




    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioFaturamentoAnaliticoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioFaturamentoAnalitico(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $request->prestador = decrypitar($request->prestador);
        $request->seguradora = decrypitar($request->seguradora);

        // Validação dos campos de data e seguradora
        $request->validate([
            'mes_ano'    => 'required|date_format:m/Y',
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $mes_ano = \DateTime::createFromFormat('m/Y', $request->mes_ano);

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_faturamento_analitico_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioFaturamentoAnaliticoExport(
                $mes_ano,
                $request->prestador?? null,
                $request->seguradora ?? null
            ),
            $nome_relatorio
        );
    }




    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioPrecoPrestadoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioPrecoPestadores(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Verifica se o campo prestadores existe e contém valores
        $prestadoresIds = $request->has('prestadores_prestador') ? array_map(function($id) {
            return decrypitar($id);
        }, $request->input('prestadores_prestador')) : [];

        $request->procedimento = decrypitar($request->procedimento);

        // Validação dos campos de data
        $request->validate([
            'prestadores_prestador'    => 'required'

        ]);

        // Converte o array de IDs em uma string separada por vírgulas, se não estiver vazio
        $prestadoresIdsString = !empty($prestadoresIds) ? implode(',', $prestadoresIds) : null;

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_compoarativo_preco_prestador_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioPrecoPrestadoresExport(
                $prestadoresIdsString?? null,
                $request->procedimento            ),
            $nome_relatorio
        );
    }



    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioPrecoPrescricaoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioPrecoPrecricao(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        // Verifica se o campo prestadores existe e contém valores
        $prestadoresIds = $request->has('prestadores_prescricao') ? array_map(function($id) {
            return decrypitar($id);
        }, $request->input('prestadores_prescricao')) : [];

        $request->procedimento = decrypitar($request->procedimento);

        // Validação dos campos de data
        $request->validate([
            'prestadores_prescricao'    => 'required'

        ]);

        // Converte o array de IDs em uma string separada por vírgulas, se não estiver vazio
        $prestadoresIdsString = !empty($prestadoresIds) ? implode(',', $prestadoresIds) : null;

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_compoarativo_preco_prescricao_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioPrecoPrescricaoExport(
                $prestadoresIdsString?? null,
                $request->procedimento
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço relatorioReembolsoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioReembolso(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->empresa = decrypitar($request->empresa);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y'
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
        $nome_relatorio = 'relatorio_reembolso_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioReembolsoExport(
                $dataInicio,
                $dataFim,
                $request->empresa ?? null
            ),
            $nome_relatorio
        );
    }



    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioFaturamentoPrestadorExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioFaturamentoPrestador(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $request->prestador = decrypitar($request->prestador);
        $request->seguradora = decrypitar($request->seguradora);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y',
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);


        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 180) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 180 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_faturamento_pretador_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioFaturamentoPrestadorExport(
                $dataInicio,
                $dataFim,
                $request->prestador?? null,
                $request->seguradora ?? null
            ),
            $nome_relatorio
        );
    }

    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioFaturamentoColaboradorExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioFaturamentoColaborador(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $request->prestador = decrypitar($request->prestador);
        $request->seguradora = decrypitar($request->seguradora);

        // Validação dos campos de data e seguradora
        $request->validate([
            'mes_ano'    => 'required|date_format:m/Y',
            'prestador'=> 'required'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $mes_ano = \DateTime::createFromFormat('m/Y', $request->mes_ano);

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_faturamento_calaborador_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioFaturamentoColaboradorExport(
                $mes_ano,
                $request->prestador,
                $request->seguradora ?? null
            ),
            $nome_relatorio
        );
    }



    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioCheckUpExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCheckUp(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->empresa = decrypitar($request->empresa);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);

        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 90) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 90 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_check_up_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioCheckUpExport(
                $dataInicio,
                $dataFim,
                $request->empresa ?? null
            ),
            $nome_relatorio
        );
    }



    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioCheckUpGuiaExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCheckUpGuia(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->empresa = decrypitar($request->empresa);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);

        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 90) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 90 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_checkup_guia_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioCheckUpGuiaExport(
                $dataInicio,
                $dataFim,
                $request->empresa ?? null
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioCheckUpFaturamentoExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCheckUpFaturamento(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->empresa = decrypitar($request->empresa);

        // Validação dos campos de data e seguradora
        $request->validate([
            'mes_ano'    => 'required|date_format:m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $mes_ano = \DateTime::createFromFormat('m/Y', $request->mes_ano);

        // Define o nome do arquivo
        $nome_relatorio = 'relatorio_checkup_faturamento_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioCheckUpFaturamentoExport(
                $mes_ano,
                $request->empresa ?? null
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioComissionamentoLeveExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioComissionamentoLevel(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->usuario = decrypitar($request->usuario);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);

        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 90) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 90 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'Relatorio_Comissionamento_Level_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioComissionamentoLeveExport(
                $dataInicio,
                $dataFim,
                $request->usuario ?? null
            ),
            $nome_relatorio
        );
    }


    /**
     * Método responsável por exportar o relatório.
     *
     * Este método é chamado quando uma requisição HTTP é feita para exportar um relatório.
     * Ele usa o serviço RelatorioCesusLevelExport para gerar e baixar o arquivo.
     *
     * @param Request $request Objeto contendo os dados da requisição HTTP.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse Resposta contendo o arquivo para download.
     */
    public function relatorioCesusLevel(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {

        $request->usuario = decrypitar($request->usuario);

        // Validação dos campos de data e seguradora
        $request->validate([
            'datainicio'    => 'required|date_format:d/m/Y',
            'datafim'       => 'required|date_format:d/m/Y'
        ]);

        // Converte as datas de d/m/Y para Y-m-d para serem usadas no banco de dados
        $dataInicio = \DateTime::createFromFormat('d/m/Y', $request->datainicio);
        $dataFim = \DateTime::createFromFormat('d/m/Y', $request->datafim);

        // Verifica se a diferença entre as datas
        $interval = $dataInicio->diff($dataFim)->days;
        if ($interval > 90) {
            return back()->withErrors(['datafim' => 'A data final não pode ser superior a 90 dias da data inicial.'])->withInput();
        }

        // Define o nome do arquivo
        $nome_relatorio = 'Relatorio_Census_Level_' . date("Ymd_His") . '.xlsx';

        // Chama o serviço de exportação
        return Excel::download(
            new RelatorioCesusLevelExport(
                $dataInicio,
                $dataFim,
                $request->usuario ?? null
            ),
            $nome_relatorio
        );
    }

}
