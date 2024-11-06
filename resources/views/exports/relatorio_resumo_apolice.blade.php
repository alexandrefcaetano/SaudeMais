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
        <th style="width:500px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Empresa
        <th style="width:380px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Seguradora</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Resseguro</th>
        <th style="width:280px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Corbertura</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Valor Limitte</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">ParticipaçÃo Rede</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Inicio Corbetura</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Fim Corbetura</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Apolice Seguradora</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">ParticipaçãoBen. Rede   </th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Maximo Sessoes</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Fraccionamento</th>
        <th style="width:800px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Corbetura Limite</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($resumo_apolice as $resumo)
        <tr>
            <td>{{ $resumo->empresa }}</td>
            <td>{{ $resumo->seguradora }}</td>
            <td>{{ $resumo->apolice }}</td>
            <td>{{ $resumo->resseguro }}</td>
            <td>{{ $resumo->cobertura }}</td>
            <td>{{ number_format( $resumo->valorlimite , 2, ',', '.') }}</td>
            <td>{{ $resumo->participacaorede }}</td>
            <td>{{ $resumo->datainiciocobertura }}</td>
            <td>{{ $resumo->datafimcobertura }}</td>
            <td>{{ $resumo->apoliceseguradora }}</td>
            <td>{{ $resumo->participacaobeneficiariorede }}</td>
            <td>{{ $resumo->ativo == 'S'? 'SIM': 'NÃO' }}</td>
            <td>{{ $resumo->maximosessoes }}</td>
            <td>{{ $resumo->fraccionamento }}</td>
            <td>{{ $resumo->coberturalimite }}</td>
        </tr>

    @endforeach
    </tbody>
</table>
