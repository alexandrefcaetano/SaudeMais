<!-- resources/views/exports/relatorio_prestadores.blade.php -->

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
            RELATÓRIO DE PRESTADORES
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
        <th style="width:350px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Prestador(Nome Fantasia)</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Codigo Prestador</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">NIF</th>
        <th style="width:390px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Nome Filial</th>
        <th style="width:250px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Data Inicio Contrato</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Pais</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Provincia</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Municipio</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Seguro Plano</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Iban</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Prazo Pagamento</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Tipo Prestador</th>
        <th style="width:200px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Especialidade</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Apto Checkup</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Desconto Prescrição</th>
        <th style="width:100px; text-align: center; color:#fffffa; font-weight:bold; background-color: #0D3349; vertical-align:center; height:30px; ">Qnt Atendiemnto</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($resumo_prestadores as $pretador)
        <tr>
            <td>{{ $pretador->nomefantasia }}</td>
            <td>{{ $pretador->codigoprestador }}</td>
            <td>{{ $pretador->nif }}</td>
            <td>{{ $pretador->nomeFilial }}</td>
            <td>{{ $pretador->dtiniciocontrato }}</td>
            <td>{{ $pretador->pais }}</td>
            <td>{{ $pretador->provincia }}</td>
            <td>{{ $pretador->municipio }}</td>
            <td>{{ $pretador->seguroplano }}</td>
            <td>{{ $pretador->iban }}</td>
            <td>{{ $pretador->prazopagamento }}</td>
            <td>{{ $pretador->tipoprestador }}</td>
            <td>{{ $pretador->especialidade }}</td>
            <td>{{ $pretador->aptocheckup }}</td>
            <td>{{ $pretador->descontoprescricao }}</td>
            <td>{{ $pretador->qtdAtendimentos }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
