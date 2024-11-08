<!-- resources/views/exports/relatorio_resumo_apolice.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO FATURAMENTO EMPRESA
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>


    <tr style="background-color: #f2f2f2;">
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice</th>
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Empresa</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice C/C</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Banco</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Numero Documento</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Tipo</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Documento</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Criado</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Usuario Crio</th>
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Seguradora</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($relatorio_faturamento_empresa as $resumo)
        <tr>
            <td>{{ $resumo->apolice }}</td>
            <td>{{ $resumo->empresa }}</td>
            <td>{{ $resumo->id_apolice_conta_corrente }}</td>
            <td>{{ $resumo->banco }}</td>
            <td>{{ $resumo->numero_documento }}</td>
            <td>{{ $resumo->tipo }}</td>
            <td>{{ number_format( $resumo->valor_documento , 2, ',', '.') }}</td>
            <td>{{ $resumo->criado_em }}</td>
            <td>{{ $resumo->usuario_incluiu }}</td>
            <td>{{ $resumo->seguradora }}</td>
        </tr>

    @endforeach
    </tbody>
</table>
