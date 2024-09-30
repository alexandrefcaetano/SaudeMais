@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Banco </h3>
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
                    <form action="{{ route('banco.store') }}" class="kt-form kt-form--label-right form-banco"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Plano:</label>
                                    <input type="text" class="form-control" name="banco" required value="{{ old('banco') }}" placeholder="Banco">
                                    <span class="form-text text-muted">Entre com o Banco...</span>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option value="">Selecione</option>
                                            <option value="S">Sim</option>
                                            <option value="N">Não</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="pais">País</label>
                                        <select id="pais" name="pais" class="form-control">
                                            <option value="">Selecione um País</option>
                                            @foreach($paises as $pais)
                                                <option value="{{ $pais->id_pais }}">{{ $pais->pais }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="provincia">Província</label>
                                        <select id="provincia" name="provincia" class="form-control" disabled>
                                            <option value="">Selecione uma Província</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="municipio">Município</label>
                                        <select id="municipio" name="municipio" class="form-control" disabled>
                                            <option value="">Selecione um Município</option>
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
                                        <a href="{{ route('banco.index') }}"  class="btn btn-outline-danger">Voltar</a>
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
        $(".form-banco").validate({

            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                banco:{         required: true },
                ativo:{         required: true },
                pais:{          required: true },
                provincia:{     required: true },
                municipio: {    required: true }
            },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });


    $(document).ready(function() {
        // Quando o país for selecionado
        $('#pais').on('change', function() {
            var pais_id = $(this).val();

            // Limpa e desabilita as listas de províncias e municípios se não tiver país
            $('#provincia').html('<option value="">Selecione uma Província</option>').prop('disabled', true);
            $('#municipio').html('<option value="">Selecione um Município</option>').prop('disabled', true);

            // Se o país estiver selecionado, busca as províncias
            if (pais_id) {
                $.ajax({
                    url: '/provincias/' + pais_id,  // Corrige a URL com pais_id
                    type: 'GET',
                    success: function(response) {
                        if (response.length > 0) {
                            $('#provincia').prop('disabled', false);
                            $.each(response, function(key, provincia) {
                                $('#provincia').append('<option value="' + provincia.id_provincia + '">' + provincia.provincia + '</option>');
                            });
                        }
                    }
                });
            }
        });

        // Quando a província for selecionada
        $('#provincia').on('change', function() {
            var provincia_id = $(this).val();

            // Limpa e desabilita a lista de municípios se não tiver província
            $('#municipio').html('<option value="">Selecione um Município</option>').prop('disabled', true);

            // Se a província estiver selecionada, busca os municípios
            if (provincia_id) {
                $.ajax({
                    url: '/municipios/'+ provincia_id,  // Corrige a URL com provincia_id
                    type: 'GET',
                    success: function(response) {
                        if (response.length > 0) {
                            $('#municipio').prop('disabled', false);
                            $.each(response, function(key, municipio) {
                                $('#municipio').append('<option value="' + municipio.id + '">' + municipio.municipio + '</option>');
                            });
                        }
                    }
                });
            }
        });
    });


</script>


@endsection