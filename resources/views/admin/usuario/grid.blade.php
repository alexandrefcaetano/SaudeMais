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
                    Lista Usuários </a>
                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="alert alert-light alert-elevate" role="alert">
            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
            <div class="alert-text">
                The Metronic Datatable component supports local or remote data source. For the local data you can pass javascript array as data source. In this example the grid fetches its
                paging performed in user browser(frontend).
            </div>
        </div>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon-users"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Lista de Usuários
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="{{ route('usuario.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Novo Usuário
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                
                                

                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Status:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <div class="dropdown bootstrap-select form-control">
                                            <select class="form-control bootstrap-select" id="kt_form_status" tabindex="-98">
                                                <option value="">Selecione</option>
                                                <option value="1">Atico</option>
                                                <option value="2">Inativo</option>
                                                <option value="3">Bloqueado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                            <a href="#" class="btn btn-default kt-hidden">
                                <i class="la la-cart-plus"></i> New Order
                            </a>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                        </div>
                    </div>
                </div>

                <!--end: Search Form -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <div class="kt-portlet__body">

                    <!--begin::Section-->
                    <div class="kt-section">
                        <div class="kt-section__info">
                            Create responsive tables by wrapping any table with <code>.table-responsive</code> <code>DIV</code> to make them scroll horizontally on small devices (under 768px)
                        </div>
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ações</th>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Usuário </th>
                                        <th>Status </th>
                                        <th>Data Criado </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                    @forelse ($usuarios as $user)
                                    <tr>
                                        <th scope="row">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('usuario.show', $user->id_usuario) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-success btn-sm btn-icon btn-icon-md" data-original-title="Visualizar">
                                                    <i class="flaticon2-search-1"></i>
                                                </a>
                                                <a href="{{ route('usuario.edit', $user->id_usuario) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-warning btn-sm btn-icon btn-icon-md" data-original-title="Editar">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>

                                        </th>
                                        <td>{{ $user->nome }}</td>
                                        <td>{{ $user->getSexoLabel() }}</td>
                                        <td>{{ $user->usuario }}</td>
                                        <td>{!! $user->getStatusBadge() !!}</td>
                                        <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="10">Nenhum registro encontrado</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ $usuarios->links() }}
                    <!--end::Section-->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>




@endsection
