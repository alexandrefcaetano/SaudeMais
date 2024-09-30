@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Plano </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Lista </a>

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
                               Cadastra Plano
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
                    <form action="{{ route('plano.store', $plano->id_cryto) }}" class="kt-form kt-form--label-right form-plano"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Plano:</label>
                                    <input type="text" class="form-control" name="plano" required value="{{ $plano->plano }}" placeholder="Plano">
                                    <span class="form-text text-muted">Entre com o Plnao...</span>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option value="">Selecione</option>
                                            <option {{ $plano->ativo == 'S' ? 'selected' : '' }} value="S">Sim</option>
                                            <option {{ $plano->ativo == 'N' ? 'selected' : '' }} value="N">Não</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Valor:</label>
                                    <input type="text" class="form-control" name="valor" required value="{{ $plano->valor }}" placeholder="VALOR">
                                    <span class="form-text text-muted">Entre com o Valor...</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Validade:</label>
                                    <input type="text" class="form-control" name="validade" required value="{{ $plano->validade }}" placeholder="Valiade">
                                    <span class="form-text text-muted">Entre com o Validade...</span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('plano.index') }}"  class="btn btn-outline-danger">Voltar</a>
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
        $(".form-plano").validate({

            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                plano:{    required: true },
                ativo:{  required: true },
                valor:{   required: true },
                validade: { required: true }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });


</script>


@endsection