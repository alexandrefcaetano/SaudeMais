<!-- resources/views/exports/relatorio_padrao.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO APOLICE PADRÃç
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>


    <tr style="background-color: #f2f2f2;">
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice</th>
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Corbertura</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Corbertura Limite</th>
        <th style="width:280px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Limite</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Participção Rede </th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Inicio Corbetura</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Fim Corbetura</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Participação Ben. Rede   </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($relatorio_apolice_padrao as $resumo)
        <tr>
            <td>{{ $resumo->apolice }}</td>
            <td>{{ $resumo->cobertura }}</td>
            <td>{{ $resumo->coberturaLimite }}</td>
            <td>{{ number_format( $resumo->valor_limite , 2, ',', '.') }}</td>
            <td>{{ $resumo->participacao_rede }}</td>
            <td>{{ $resumo->data_inicio_cobertura }}</td>
            <td>{{ $resumo->data_fim_cobertura }}</td>
            <td>{{ $resumo->ativo == 'S'? 'SIM': 'NÃO' }}</td>
            <td>{{ $resumo->participacaobeneficiariorede }}</td>

    @endforeach
    </tbody>
</table>
