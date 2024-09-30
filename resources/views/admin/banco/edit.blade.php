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
                    Edição </a>

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
                    <form action="{{ route('banco.update', $banco->id_banco) }}" class="kt-form kt-form--label-right form-banco"  method="POST" novalidate="novalidate">
                       @csrf()
                       @method('PUT')
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Plano:</label>
                                    <input type="text" class="form-control" name="banco" required value="{{ $banco->banco }}" placeholder="Banco">
                                    <span class="form-text text-muted">Entre com o Banco...</span>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="status">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option value="">Selecione</option>
                                            <option {{ $banco->ativo == 'S' ? 'selected' : '' }} value="S">Sim</option>
                                            <option {{ $banco->ativo == 'N' ? 'selected' : '' }} value="N">Não</option>
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
                                            <option value="{{ $pais->id_pais }}" @selected($banco->pais_id == $pais->id_pais)>{{ $pais->pais }}</option>

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
        var selectedPaisId = "{{ old('pais_id', $banco->pais_id) }}";
        var selectedProvinciaId = "{{ old('provincia_id', $banco->provincia_id) }}";
        var selectedMunicipioId = "{{ old('municipio_id', $banco->municipio_id) }}";

        // Se um país já estiver selecionado, carrega as províncias e municípios correspondentes
        if (selectedPaisId) {
            carregarProvincias(selectedPaisId, selectedProvinciaId);
        }

        // Quando o país for alterado
        $('#pais').on('change', function() {
            var pais_id = $(this).val();
            $('#provincia').html('<option value="">Selecione uma Província</option>').prop('disabled', true);
            $('#municipio').html('<option value="">Selecione um Município</option>').prop('disabled', true);

            if (pais_id) {
                carregarProvincias(pais_id);
            }
        });

        // Quando a província for alterada
        $('#provincia').on('change', function() {
            var provincia_id = $(this).val();
            $('#municipio').html('<option value="">Selecione um Município</option>').prop('disabled', true);

            if (provincia_id) {
                carregarMunicipios(provincia_id);
            }
        });

        function carregarProvincias(pais_id, provinciaSelecionada = null) {
            $.ajax({
                url: '/provincias/' + pais_id,
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        $('#provincia').prop('disabled', false);
                        $.each(response, function(key, provincia) {
                            var selected = provinciaSelecionada == provincia.id_provincia ? 'selected' : '';
                            $('#provincia').append('<option value="' + provincia.id_provincia + '" ' + selected + '>' + provincia.provincia + '</option>');
                        });

                        // Se houver uma província selecionada, carregar os municípios
                        if (provinciaSelecionada) {
                            carregarMunicipios(provinciaSelecionada, selectedMunicipioId);
                        }
                    }
                }
            });
        }

        function carregarMunicipios(provincia_id, municipioSelecionado = null) {
            $.ajax({
                url: '/municipios/' + provincia_id,
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        $('#municipio').prop('disabled', false);
                        $.each(response, function(key, municipio) {
                            var selected = municipioSelecionado == municipio.id_municipio ? 'selected' : '';
                            $('#municipio').append('<option value="' + municipio.id_municipio + '" ' + selected + '>' + municipio.municipio + '</option>');
                        });
                    }
                }
            });
        }
    });


</script>


@endsection