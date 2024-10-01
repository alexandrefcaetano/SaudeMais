@extends('admin.master')

@section('conteudo')


<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">

            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Lista Empresa </a>
                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-users"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Lista de Empresa
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ route('procedimento.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Nova Empresa
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <form action="{{ route('procedimento.index') }}" method="POST" novalidate="novalidate" class="kt-form kt-form--label-right form-empresa">
                            @csrf()
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label for="status">Pesquisar:</label>
                                            <input type="text" name="nomefantasia" value="{{ old('nomefantasia', request('nomefantasia')) }}" class="form-control" placeholder="Search..." id="generalSearch">
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label for="status">Ativo:</label>
                                            <select class="form-control" id="ativo" name="ativo" required>
                                                <option  value="">Selecione...</option>
                                                <option value="S"  {{ old('ativo', request('ativo')) == 'S' ? 'selected' : '' }}>Sim</option>
                                                <option value="N"  {{ old('ativo', request('ativo')) == 'N' ? 'selected' : '' }}>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <label for="status">Seguradora:</label>
                                            <select class="form-control m-select2 pesquisar_select" id="pesquisar_select" name="seguradora">
                                                <option value="">Selecione</option>
                                                @forelse ($seguradoras as $seguradora)
                                                    <option value="{{ $seguradora->encrypted_id }}" {{ old('seguradora_id', request('seguradora_id')) == $seguradora->id_seguradora ? 'selected' : '' }}>
                                                        {{ $seguradora->seguradora }}
                                                    </option>
                                                @empty
                                                    <option value="">Nenhum Registro Encontrado</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-success">Pesquisa</button>
                                                    <a href="{{ route('procedimento.index') }}" class="btn btn-warning">Limpar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                <!--end: Search Form -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <div class="kt-portlet__body">

                    <!--begin::Section-->
                    <div class="kt-section">
                        <div class="kt-section__info"></div>
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <div class="col-lg-6">
                                    <div class="kt-datatable__pager-info">
                                        <div class="dropdown bootstrap-select kt-datatable__pager-size" >
                                                <form method="GET" action="{{ route('procedimento.index') }}">
                                                    <label for="registrosPorPagina">Registros por página:</label>
                                                    <select name="registrosPorPagina" id="registrosPorPagina" data-width="60px" class="selectpicker kt-datatable__pager-size" onchange="this.form.submit()">
                                                        <option value="10" {{ $registrosPorPagina == 10 ? 'selected' : '' }}>10</option>
                                                        <option value="15" {{ $registrosPorPagina == 15 ? 'selected' : '' }}>15</option>
                                                        <option value="20" {{ $registrosPorPagina == 20 ? 'selected' : '' }}>20</option>
                                                        <option value="50" {{ $registrosPorPagina == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ $registrosPorPagina == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                </form>
                                        </div>
                                        <span class="kt-datatable__pager-detail" style="margin-left: -35px"> de {{ $procedimentos->total() }} registros.</span>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ações Sistema</th>
                                        <th>Nome Fantasia</th>
                                        <th>Ativo</th>
                                        <th>NIF </th>
                                        <th>Razao Social </th>
                                        <th>Ramo Atividade </th>
                                        <th>Morada </th>
                                        <th>Corretor </th>
                                        <th>Data Criado </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                    @forelse ($procedimentos as $procedimento)
                                    <tr>
                                        <th scope="row">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('procedimento.show', encrypitar(procedimento->id_procedimento)) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-success btn-sm btn-icon btn-icon-md m-1" data-original-title="Visualizar">
                                                    <i class="flaticon2-search-1"></i>
                                                </a>
                                                <a href="{{ route('procedimento.edit',  encrypitar(procedimento->id_procedimento)) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-warning btn-sm btn-icon btn-icon-md m-1" data-original-title="Editar">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>

                                        </th>
                                        <td>{{ procedimento->nomefantasia }}</td>
                                        <td>{!! procedimento->getStatusBadge() !!}</td>
                                        <td>{{ procedimento->nif }}</td>
                                        <td>{{ procedimento->razaosocial }}</td>
                                        <td>{{ procedimento->ramoatividade }}</td>
                                        <td>{{ procedimento->morada }}</td>
                                        <td>{{ procedimento->corretor }}</td>
                                        <td>{{ procedimento->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="10">Nenhum registro encontrado</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 <div class="kkt-datatable__pager kt-datatable--paging-loaded">
                    <div class="form-group row">
                        <div class="col-lg-6">
                                 {{ procedimentos->links() }}
                        </div>

                    </div>
                    <!--end::Section-->
                </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>




@endsection
