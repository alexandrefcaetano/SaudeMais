@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Visualiar Banco </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Visualizar </a>


                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--begin::Portlet-->
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                               Visualiar Banco
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->

                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Banco:</label>
                                        {{ $bancoDetalhes->banco }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Ativo:</label>
                                       {{ $bancoDetalhes->ativo== 'S' ? 'Ativo' : 'Inativo' }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Codigo Swift:</label>
                                       {{ $bancoDetalhes->codigoswift }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Pais:</label>
                                       {{ $bancoDetalhes->pais }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Provincia:</label>
                                        {{ $bancoDetalhes->provincia }}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="visualizar">
                                        <label class="visualizar-titulo">Municipio:</label>
                                        {{ $bancoDetalhes->municipio }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="{{ route('banco.index') }}"  class="btn btn-outline-danger">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>
@endsection
