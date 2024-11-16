<!-- resources/views/exports/relatorio_reembolso.blade.php -->

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
            RELATÓRIO DE REEMBOLSO
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
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Nº Reembolso</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Nº Cartão</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Beneficiario</th>
        <th style="width:390px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data/Hora</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Cobertura</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Cobertura Limite</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Vlr Procedimento Liquido</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Vlr Procedimento Kwanza</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Status </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($resumo_reembolso as $reenbolso)
        <tr>
            <td>{{ $reenbolso->id_reembolso }}</td>
            <td>{{ $reenbolso->numero_cartao }}</td>
            <td>{{ $reenbolso->beneficiario }}</td>
            <td>{{ $reenbolso->empresa }}</td>
            <td>{{ $reenbolso->criado_em }}</td>
            <td>{{ $reenbolso->cobertura }}</td>
            <td>{{ $reenbolso->coberturaLimite }}</td>
            <td>{{ $reenbolso->vlrProcedimentoLiquido }}</td>
            <td>{{ $reenbolso->vlrProcedimentoKwanza }}</td>
            <td>{{ $reenbolso->statusDescricao }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
