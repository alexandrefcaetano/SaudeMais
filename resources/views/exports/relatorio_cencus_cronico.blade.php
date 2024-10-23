<!-- resources/views/exports/relatorio_cencus_cronico.blade.php -->

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
            RELATÓRIO CENCUS CRÔNICO
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
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Seguradora</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Empresa</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Apólice</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Situação</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Cartão Titular</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Número Empregado</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Rede Internacional</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Número do Cartão</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Beneficiário</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data de Nascimento</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Idade</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Parentesco</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Gênero</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Contato</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data de Ativação</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data Início Cobertura</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data Fim Cobertura</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data de Cancelamento</th>
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">CID</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->seguradora }}</td>
            <td>{{ $cliente->empresa }}</td>
            <td>{{ $cliente->apolice }}</td>
            <td>{{ $cliente->situacao }}</td>
            <td>{{ $cliente->cartaotitular }}</td>
            <td>{{ $cliente->numeroempregado }}</td>
            <td>{{ $cliente->redeinternacional }}</td>
            <td>{{ $cliente->numerocartao }}</td>
            <td>{{ $cliente->beneficiario }}</td>
            <td>{{ $cliente->datanascimento }}</td>
            <td>{{ $cliente->idade }}</td>
            <td>{{ $cliente->parentesco }}</td>
            <td>{{ $cliente->genero }}</td>
            <td>{{ $cliente->contato }}</td>
            <td>{{ $cliente->dataativacao }}</td>
            <td>{{ $cliente->datainiciocobertura }}</td>
            <td>{{ $cliente->datafimcobertura }}</td>
            <td>{{ $cliente->datacancelamento }}</td>
            <td>{{ $cliente->cid }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
