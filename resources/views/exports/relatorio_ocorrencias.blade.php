<!-- resources/views/exports/relatorio_ocorrencias.blade.php -->

<table>
    <thead>
    <tr>
        <th rowspan="3" style="text-align: center; height:50px;">
            <!-- A imagem será inserida automaticamente na exportação -->
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px; font-weight: bold;">
            RELATÓRIO DE OCORRÊNCIAS
        </th>
    </tr>
    <tr>
        <th colspan="3" style="text-align: center; font-size: 12px;">
            {{ date('d/m/Y H:i:s') }}
        </th>
    </tr>
    <tr></tr>
    <tr style="background-color: #f2f2f2;">
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Beneficiário</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Número do Cartão</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Motivo Ocorrência</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Data Inclusão</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Pergunta</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Resposta</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Nota</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Satisfação</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Empresa</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Funcionário</th>
        <th style="width:150px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; height:30px;">Status Motivo</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($ocorrencias as $ocorrencia)
        <tr>
            <td>{{ $ocorrencia->beneficiario }}</td>
            <td>{{ $ocorrencia->numerocartao }}</td>
            <td>{{ $ocorrencia->motivo_ocorrencia }}</td>
            <td>{{ $ocorrencia->criado_em }}</td>
            <td>{{ $ocorrencia->pergunta }}</td>
            <td>{{ $ocorrencia->resposta }}</td>
            <td>{{ $ocorrencia->nota }}</td>
            <td>{{ $ocorrencia->satisfacao }}</td>
            <td>{{ $ocorrencia->status }}</td>
            <td>{{ $ocorrencia->empresa }}</td>
            <td>{{ $ocorrencia->nome_funcionario }}</td>
            <td>{{ $ocorrencia->status_motivo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
