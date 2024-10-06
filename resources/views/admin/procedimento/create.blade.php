@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Procedimento </h3>
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
                               Cadastra Procedimento
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
                    <form action="{{ route('procedimento.store') }}" class="kt-form kt-form--label-right form-procedimento"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Codigo Procedimento:</label>
                                    <input type="text" class="form-control" name="razaosocial" minlength="2" maxlength="150" required value="{{ old('razaosocial') }}" placeholder="Codigo Procedimento">
                                    <span class="form-text text-muted">Codigo procedimento gerado automatico..</span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="exampleTextarea">Descrição:</label>
                                    <textarea class="form-control" id="descricao" name="Descrição" rows="3">{{ old('Descrição') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Tipo Regra:</label>
                                        <select class="form-control" id="tiporegra" name="tiporegra" required>
                                            <option  value="">Selecione...</option>
                                            <option value="pré-autorização"  {{ old('pré-autorização') == 'S' ? 'selected' : '' }}>PRÉ-AUTORIZAÇÃO</option>
                                            <option value="autorização"  {{ old('autorização') == 'N' ? 'selected' : '' }}>AUTORIZAÇÃO</option>
                                            <option value="exclusão"  {{ old('exclusão') == 'N' ? 'selected' : '' }}>EXCLUSÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Tipo Atendimento:</label>
                                        <select class="form-control"  id="tipoatendimento" name="tipoatendimento" required>
                                            <option value="">Selecione</option>
                                            @forelse ($tipoatendimentos as $tipoatendimento)
                                                <option value="{{ $tipoatendimento->encrypted_id }}  {{ old('id_tipoatendimento') == $tipoatendimento->id_tipoatendimento ? 'selected' : '' }}">{{ $tipoatendimento->tipoatendimento }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Prestador:</label>
                                        <select class="form-control"  id="prestador" name="prestador" required>
                                            <option value="">Selecione</option>
                                            @forelse ($prestadores as $prestador)
                                                <option value="{{ $prestador->encrypted_id }}  {{ old('id_prestador') == $prestador->id_prestador ? 'selected' : '' }}">{{ $prestador->nomefantasia }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Cobertura:</label>
                                        <select class="form-control" id="cobertura" name="cobertura" required>
                                            <option value="">Selecione</option>
                                            @forelse ($coberturas as $cobertura)
                                                <option value="{{ $cobertura->encrypted_id }} {{ old('id_cobertura') == $cobertura->id_cobertura ? 'selected' : '' }}">{{ $cobertura->cobertura }}</option>
                                            @empty
                                                <option value="">Nenhum registro encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Sub-Cobertura:</label>
                                        <select class="form-control" id="sub_cobertura" name="sub_cobertura" required>
                                            <option value="">Selecione</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Tipo de Procedimento:</label>
                                        <select class="form-control"  id="tipoprocedimento" name="tipoprocedimento" required>
                                            <option value="">Selecione</option>
                                            @forelse ($tipoprocedimentos as $tipoprocedimento)
                                                <option value="{{ $tipoprocedimento->encrypted_id }}  {{ old('id_tipoprocedimento') == $tipoprocedimento->id_tipoprocedimento ? 'selected' : '' }}">{{ $tipoprocedimento->secundaria }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label>Quantidade de Dias:</label>
                                    <input type="text" class="form-control" name="quantidadedias" minlength="2" maxlength="20" required value="{{ old('quantidadedias') }}" placeholder="Quantidade de Dias">
                                </div>
                                <div class="col-lg-3">
                                    <label>Quantidade de Itens:</label>
                                    <input type="text" class="form-control" name="quantidadeItens" minlength="2" maxlength="50" required value="{{ old('quantidadeitens') }}" placeholder="Quantidade de Itens">
                                </div>
                                <label class="col-2 col-form-label">Ativo</label>
                                <div class="col-1">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" {{ old('ativo')  ? 'checked' : '' }} name="ativo">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Gratutito</label>
                                <div class="col-1">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" {{ old('gratuito') ? 'checked' : '' }}  name="gratuito">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>


                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h3>Contatos</h3>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Informar o Valor em:</label>
                                        <select class="form-control" id="informaValor" name="informaValor" required>
                                            <option  value="">Selecione...</option>
                                            <option value="D"  {{ old('ativo') == 'S' ? 'selected' : '' }}>Sim</option>
                                            <option value="N"  {{ old('ativo') == 'N' ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Valor Faturado:</label>
                                    <input type="text" class="form-control" name="vlrfaturado" minlength="2" maxlength="200" required value="{{ old('vlrFaturado') }}" placeholder="Morada">
                                    <span class="form-text text-muted">Entre com a Morada...</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Valor Saude +:</label>
                                    <input type="text" class="form-control" name="vlrdaudemais" minlength="2" maxlength="50" required value="{{ old('vlrSaudeMais') }}" placeholder="Ramo Atividade">
                                    <span class="form-text text-muted">Entre com o Corretor...</span>
                                </div>
                            </div>


                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('procedimento.index') }}"  class="btn btn-outline-danger">Voltar</a>
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
        $(".form-procedimento").validate({
            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                razaosocial:{               required: true, minlength: 2, maxlength: 150 },
                nomefantasia:{              required: true, minlength: 2, maxlength: 150},
                nif:{                       required: true, minlength: 2, maxlength: 50},
                ativo:{                     required: true },
                ramoatividade:{             required: true, minlength: 2, maxlength: 150},
                morada:{                    required: true, minlength: 2, maxlength: 200},
                corretor:{                  required: true, minlength: 2, maxlength: 50},
                contato:{                   required: true },
                visualizarrelatendimento:{  required: true },
                seguradora_id:{             required: true }
            },
            submitHandler: function (e) {

            }
        });
    });


    $(document).ready(function() {
        // Quando o cobertura for selecionado
        $('#cobertura').on('change', function() {
            var cobertura_id = $(this).val();

            // Limpa e desabilita as listas de sub cobertura se não tiver cobertura
            $('#sub_cobertura').html('<option value="">Selecione uma Sub Cobertura</option>').prop('disabled', true);

            // Se o cobertura estiver selecionado, busca as províncias
            if (cobertura_id) {
                $.ajax({
                    url: '/cobertura/getSubCoberturas/' + cobertura_id,  // Corrige a URL com cobertura_id
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.length > 0) {
                            $('#sub_cobertura').prop('disabled', false);
                            $.each(response, function(key, sub_cobertura) {
                                $('#sub_cobertura').append('<option value="' + sub_cobertura.encrypted_id + '">' + sub_cobertura.coberturalimite + '</option>');
                            });
                        }
                    }
                });
            }
        });
    });

</script>



@endsection
