@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Especialidade </h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Especialidade</a>

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
                               Cadastra Especialidade
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
                    <form action="{{ route('especialidade.update', $especialidade->id_cryto) }}" class="kt-form kt-form--label-right form-especialidade"  method="POST" novalidate="novalidate">
                        @csrf()
                        @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Especialidade:</label>
                                    <input type="text" class="form-control" name="especialidade" maxlength="145" minlength="2" required value="{{ $especialidade->especialidade }}" placeholder="Especialidade">
                                    <span class="form-text text-muted">Entre com a especialidade...</span>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="ativo">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option value="">Selecione</option>
                                            <option {{ $especialidade->ativo == 'S' ? 'selected' : '' }}  value="S">Sim</option>
                                            <option {{ $especialidade->ativo == 'N' ? 'selected' : '' }}  value="N">Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('especialidade.index') }}"  class="btn btn-outline-danger">Voltar</a>
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
        $(".form-especialidade").validate({
            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                especialidade: { required: true, minlength: 3, maxlength: 145 }
                ativo:{  required: true },
            },
            submitHandler: function (form) {
                // Código a ser executado quando o formulário for válido
                form.submit();
            }
        });
    });

</script>

@endsection