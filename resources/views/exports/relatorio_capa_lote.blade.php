<!-- resources/views/exports/relatorio_capa_de_lote.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO CAPA DE LOTE
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>
    <tr style="background-color: #f2f2f2;">
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Mes/Ano</th>
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Recebimento</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Vencimento</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Total Faturas</th>
        <th style="width:280px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Qtd. Faturas</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Criação</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Crio</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Atualização</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Alterou</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Devolvido</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Pagamento</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Observação</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Prestador</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Prazo Pagametno</th>
        <th style="width:800px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Qtd Faturas Devolvidas</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status Fatura</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Altração CE</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($relatorio_capa_lote as $resumo)
        <tr>
            <td>{{ $resumo->mes_ano }}</td>
            <td>{{ $resumo->data_recebimento }}</td>
            <td>{{ $resumo->data_vencimento }}</td>
            <td>{{ $resumo->total_faturas }}</td>
            <td>{{ $resumo->quantidade_faturas }}</td>
            <td>{{ $resumo->criado_em}}</td>
            <td>{{ $resumo->usuarioIncluiu }}</td>
            <td>{{ $resumo->atualizado_em }}</td>
            <td>{{ $resumo->usuarioAlterou }}</td>
            <td>{{ $resumo->valor_devolvido }}</td>
            <td>{{ $resumo->prazo_pagamento }}</td>
            <td>{{ $resumo->observacao }}</td>
            <td>{{ $resumo->ativo == 'S'? 'SIM': 'NÃO' }}</td>
            <td>{{ $resumo->prestador }}</td>
            <td>{{ $resumo->prazoPagamento }}</td>
            <td>{{ $resumo->quantidade_faturas_devolvidas }}</td>
            <td>{{ $resumo->status_fatura }}</td>
            <td>{{ $resumo->data_Alteracao_CE }}</td>
        </tr>

    @endforeach
    </tbody>
</table>
