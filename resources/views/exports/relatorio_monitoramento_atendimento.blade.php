<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente pelo método drawings() -->
        </th>
    </tr>
    <tr>
        <th colspan="2" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO MONITORAMENTO ATENDIMENTO
        </th>
    </tr>
    <tr>
        <th colspan="2"  style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr><tr>
    </tr>

    <tr style="background-color: #f2f2f2;">
        <th style="width:270px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Dia</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Geral Qtd</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Geral Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Consultas Qtd</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Consultas Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Diagnostico Qtd</th>
        <th style="width:120px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Diagnostico Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Enfermagem Qtd</th>
        <th style="width:300px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Enfermagem Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Medicamentos Qtd</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Medicamentos Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Internamento Qtd</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Internamento Media</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Estomatologia Qtd</th>
        <th style="width:180px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349;">Estomatologia Media</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente['Dia'] }}</td>
            <td>{{ $cliente['Geral Qtd'] }}</td>
            <td>{{ number_format($cliente['Geral Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Consultas Qtd'] }}</td>
            <td>{{ number_format($cliente['Consultas Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Diagnostico Qtd'] }}</td>
            <td>{{ number_format($cliente['Diagnostico Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Enfermagem Qtd'] }}</td>
            <td>{{ number_format($cliente['Enfermagem Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Medicamentos Qtd'] }}</td>
            <td>{{ number_format($cliente['Medicamentos Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Internamento Qtd'] }}</td>
            <td>{{ number_format($cliente['Internamento Media'], 2, ',', '.') }}</td>
            <td>{{ $cliente['Estomatologia Qtd'] }}</td>
            <td>{{ number_format($cliente['Estomatologia Media'], 2, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
