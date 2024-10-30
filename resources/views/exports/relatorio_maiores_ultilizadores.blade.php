<!-- resources/views/exports/relatorio_maiores_ultilizadores.blade.php -->

<table>
    <thead>
    <tr>
        <!-- Célula onde a imagem do logo será gerada pelo método drawings() -->
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação, não precisa do <img> aqui -->
        </th>
    </tr>
    <tr>
        <!-- Título do relatório -->
        <th colspan="2" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO MAIORES UTILIZADORES
        </th>

    </tr>
    <tr>
        <!-- Data e hora da geração do relatório -->
        <th colspan="2"  style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr>
    </tr>

    <!-- Cabeçalhos das colunas de dados -->
    <tr style="background-color: #f2f2f2;">
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Beneficiário</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Número do Cartão</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Apólice</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Empresa</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Tipo de Atendimento</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Parentesco</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Quantidade</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->beneficiario }}</td>
            <td>{{ $cliente->numerocartao }}</td>
            <td>{{ $cliente->apolice }}</td>
            <td>{{ $cliente->empresa }}</td>
            <td>{{ $cliente->tipoatendimento }}</td>
            <td>{{ $cliente->parentesco }}</td>
            <td>{{ $cliente->quantidade }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
