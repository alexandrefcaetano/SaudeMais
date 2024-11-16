<!-- resources/views/exports/relatorio_preco_prescricao.blade.php -->

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
            RELATÓRIO COMPARATIVO PREÇO PRESCRIÇÃO
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
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:390px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "> </th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; "></th>

    </tr>
    </thead>
    <tbody>
    @foreach ($relatorio_preco_prescricao as $result)
        <tr>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result-> }}</td>
            <td>{{ $result->}}</td>
            <td>{{ $result->}}</td>
            <td>{{ $result-> }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
