@extends('admin.master')

@section('conteudo')

    <style>

        .kt-switch input:empty ~ span:after{
            color: #f8f9fb;
            background-color:#dd2525;
        }
    </style>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Form Apolice Relatorio </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Relatorio </a>

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
                                    Apolice Relatorio
                                </h3>
                            </div>
                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $e)
                                    {{ $e }}<br>
                                @endforeach
                            </div>
                        @endif

                        <!--begin::Form-->
                        <form action="{{ route('apolice.exportar') }}" class="kt-form kt-form--label-right form-apolice-relatorio"  method="POST" novalidate="novalidate">
                            @csrf()
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="status">Seguradora:</label>
                                            <select class="form-control" id="seguradora" name="seguradora">
                                                <option value="">Selecione</option>
                                                @forelse ($seguradoras as $seguradora)
                                                    <option value="{{ $seguradora->id_seguradora }}">{{ $seguradora->seguradora }}</option>
                                                @empty
                                                    <option value="">Nem um Registro Encontrado</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="empresa">Empresa:</label>
                                            <select class="form-control" id="empresa" name="empresa">
                                                <option value="">Selecione</option>
                                                @forelse ($empresas as $emp)
                                                    <option value="{{ $emp->id_empresa }}">{{ $emp->nomefantasia }}</option>
                                                @empty
                                                    <option value="">Nem um Registro Encontrado</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Data Inicio Cobertura:</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control" name="dataInicioCobertura" placeholder="Selecione Data" id="kt_datepicker_2">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Data Fim Cobertura:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                            </div>
                                            <input type="text" class="form-control" name="dataFimCobertura"   value="{{ old('dataFimCobertura') }}" placeholder="Selecione Data">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="mt-1"></label>
                                        <div class="input-group">
                                            <div class="col-lg-6 mt-1">
                                                <button type="submit" class="btn btn-primary">Pesquisa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>

                    <!--end::Portlet-->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>

@endsection

@section('scripts')

    <script>
        $(function () {
            $(".form-apolice-relatorio").validate({
                focusInvalid: true,
                ignore: ":not(:visible),[readonly]",
                rules: {
                    dataInicioCobertura:{    required: true },
                    dataFimCobertura:{       required: true }
                },
                submitHandler: function (form) {

                    KTApp.blockPage();

                    setTimeout(function() {
                        KTApp.unblockPage();
                        form.submit();
                    }, 3000);
                }
            });
        });

    </script>


@endsection
