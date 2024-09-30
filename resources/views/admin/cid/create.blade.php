@extends('admin.master')

@section('conteudo')
<style>

.select2-selection__choice {
    color: #242a4e !important;
    background: #c8d1e3 !important;
    border: 1px solid #9ca1af !important;
}

</style>
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Cadastro </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Cadastro </a>

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
                               Cadastra CID
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
                    <form action="{{ route('cid.store') }}" class="kt-form kt-form--label-right form-plano"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Codigo CID:</label>
                                    <input type="text" class="form-control" name="codigo_cid" required value="{{ old('codigo_cid') }}" placeholder="Codigo Cid">
                                    <span class="form-text text-muted">Entre com o Plnao...</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>CID:</label>
                                    <input type="text" class="form-control" name="cid" required value="{{ old('cid') }}" placeholder="CID">
                                    <span class="form-text text-muted">Entre com o Valor...</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="status">Tipo Regra:</label>
                                        <select class="form-control" id="tiporegra" name="tiporegra" required>
                                            <option value="">Selecione</option>
                                            <option value="PRÉ-AUTORIZAÇÃO"  {{ old('tiporegra') == 'PRÉ-AUTORIZAÇÃO' ? 'selected' : '' }}>Pré-Autorização</option>
                                            <option value="AUTORIZAÇÃO" {{ old('tiporegra') == 'AUTORIZAÇÃO' ? 'selected' : '' }}>Autorização</option>
                                            <option value="EXCLUSÃO" {{ old('tiporegra') == 'EXCLUSÃO' ? 'selected' : '' }}>Exclusão</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="status">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option value="">Selecione</option>
                                            <option value="S" {{ old('ativo') == 'S' ? 'selected' : '' }} >Sim</option>
                                            <option value="N" {{ old('ativo') == 'N' ? 'selected' : '' }} >Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12">Coberturas Aceitas:</label>
                                <div class=" col-lg-10">
                                    <select class="form-control m-select2" id="select2" name="cobertura[]" multiple>
                                        <option></option>
                                        @forelse($coberturas as $cobertura)
                                            <option value="{{ $cobertura->encrypted_id }}" {{ old('cobertura_id') == $cobertura->id_cobertura ? 'selected' : '' }}>
                                                {{ $cobertura->cobertura }}
                                            </option>
                                        @empty
                                            <option>Nenhum Registro...</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('cid.index') }}"  class="btn btn-outline-danger">Voltar</a>
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

         // multi select
         $('#select2').select2({ });
    });


</script>


@endsection