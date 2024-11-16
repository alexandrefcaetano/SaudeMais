<!-- resources/views/exports/relatorio_checkup.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO CHECK  - UP
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>
    <tr style="background-color: #f2f2f2;">
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Fatura</th>
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Numero Fatura</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Prestador </th>
        <th style="width:280px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Seguradora </th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Beneficiario </th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Numero Cartao </th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Vlr Fatura </th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Vlr Co-Participacao </th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Vlr Aprovado </th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Vlr Nota Credito </th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Nota Credito</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Mes/Ano</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Dt Inclusao</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Dt Alteracao</th>
        <th style="width:800px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Dt Analise </th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Dt Aprovado</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tempo Aprovacao</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Incluiu</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Alterou</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Analisou</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Aprovou</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($resumo_checkup as $checkup)
        <tr>
            <td>{{ $checkup->mes_ano }}</td>
        </tr>

    @endforeach
    </tbody>
</table>
