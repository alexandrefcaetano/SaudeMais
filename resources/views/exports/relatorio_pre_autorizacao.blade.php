<!-- resources/views/exports/relatorio_pre_autorização.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO DE RESUMO DE APOLICE
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>

    <tr style="background-color: #f2f2f2;">
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Criação</th>
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Análise</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Situação</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">OBS Prestador</th>
        <th style="width:280px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">OBS Operação</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">OBS Seguradora</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Ativo</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Aprovado Internação</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Alta Internamento</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status Internamento</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">OBS Internamento</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Atualizado Em</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo Consulta</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo Internação</th>
        <th style="width:800px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo Acomodação</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo Prescrição</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Aproximado</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Internamento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Caráter</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Atendimento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Hipótese Diagnóstico</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Beneficiário</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Nascimento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Gênero</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apólice ID</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Contato</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Número Cartão</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Parentesco</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Número Empregado</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Autorização Necessária</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apólice</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Prestador</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Cotação Dólar</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Empresa</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Seguradora</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Especialidade</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo Atendimento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">ID Tipo Atendimento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Nome Funcionário</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Procedimento</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Aprovado</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Diárias Solicitadas</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Seguradora Responsável</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuário Alterou</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Descrição CID</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($relatorio_pre_autorizacao as $item)
        <tr>
            <td>{{ $item->criado_em }}</td>
            <td>{{ $item->data_analise }}</td>
            <td>{{ $item->situacao }}</td>
            <td>{{ $item->observacao_prestador }}</td>
            <td>{{ $item->observacao_operacao }}</td>
            <td>{{ $item->observacao_seguradora }}</td>
            <td>{{ $item->ativo == 'S' ? 'SIM' : 'NÃO' }}</td>
            <td>{{ number_format($item->valor_aprovado_internacao, 2, ',', '.') }}</td>
            <td>{{ $item->data_alta_internamento }}</td>
            <td>{{ $item->status_internamento }}</td>
            <td>{{ $item->observacao_internamento }}</td>
            <td>{{ $item->atualizado_em }}</td>
            <td>{{ $item->tipo_consulta }}</td>
            <td>{{ $item->tipo_internacao }}</td>
            <td>{{ $item->tipo_acomodacao }}</td>
            <td>{{ $item->tipo_prescricao }}</td>
            <td>{{ number_format($item->valor_aproximado, 2, ',', '.') }}</td>
            <td>{{ $item->data_internamento }}</td>
            <td>{{ $item->carater }}</td>
            <td>{{ $item->data_atendimento }}</td>
            <td>{{ $item->hipotese_diagnostico }}</td>
            <td>{{ $item->beneficiario }}</td>
            <td>{{ $item->dataNascimento }}</td>
            <td>{{ $item->genero }}</td>
            <td>{{ $item->apolice_id }}</td>
            <td>{{ $item->contato }}</td>
            <td>{{ $item->numeroCartao }}</td>
            <td>{{ $item->parentesco }}</td>
            <td>{{ $item->numeroEmpregado }}</td>
            <td>{{ $item->beneficiarioNecessitaAutorizacao }}</td>
            <td>{{ $item->apolice }}</td>
            <td>{{ $item->prestador }}</td>
            <td>{{ number_format($item->cotacaoDolar, 2, ',', '.') }}</td>
            <td>{{ $item->empresa }}</td>
            <td>{{ $item->seguradora }}</td>
            <td>{{ $item->especialidade }}</td>
            <td>{{ $item->tipoAtendimento }}</td>
            <td>{{ $item->id_tipoatendimento }}</td>
            <td>{{ $item->nomeFuncionario }}</td>
            <td>{{ $item->procedimento }}</td>
            <td>{{ number_format($item->vlrAprovado, 2, ',', '.') }}</td>
            <td>{{ $item->diariasSolicitadas }}</td>
            <td>{{ $item->seguradoraResponsavel }}</td>
            <td>{{ $item->usuarioAlterou }}</td>
            <td>{{ $item->descCid }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
