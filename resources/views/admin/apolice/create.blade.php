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
                Form Apolice </h3>
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
                               Cadastra Apolice
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
                    <form action="{{ route('apolice.store') }}" class="kt-form kt-form--label-right"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Seguradora:</label>
                                        <select class="form-control" id="seguradora" name="seguradora" required>
                                            <option value="">Selecione</option>
                                            @forelse ($seguradoras as $seguradora)
                                                <option value="{{ $seguradora->id_seguradora }}">{{ $seguradora->seguradora }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="empresa">Empresa:</label>
                                        <select class="form-control" id="empresa" name="empresa" required>
                                            <option value="">Selecione</option>
                                            @forelse ($empresas as $emp)
                                                <option value="{{ $emp->id_empresa }}">{{ $emp->nomefantasia }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="empresa">Plano Apolice:</label>
                                        <select class="form-control" id="plano" name="plano" required>
                                            <option value="">Selecione</option>
                                            @forelse ($planos as $plano)
                                                <option value="{{ $plano->id_plano }}">{{ $plano->plano }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Tipo de Moeda:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="tipoMoeda" name="tipoMoeda">
                                            <option value="">Selecine...</option>
                                            <option value="Kwanza">Kwanza</option>
                                            <option value="Dolar">Dolar</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Selecione uma Moeda</span>
                                </div>

                                <div class="col-lg-4">
                                    <label>Valor Limite Apolice:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">0.00</span>
                                        </div>
                                        <input type="text" class="form-control" name="valorLimiteApolice"  >
                                    </div>
                                    <span class="form-text text-muted">Valor Limite da Apolice</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Renovação dos Limites:</label>
                                    <div class="input-group">
                                        <select name="renovacaoLimite" id="renovacaoLimite" class="form-control" aria-invalid="false">
                                            <option value="1">POR ANO DE CONTRATO</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Renovação dos Limites?</span>
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
                                        <input type="text" class="form-control" name="dataFimCobertura"  required value="{{ old('dataFimCobertura') }}" placeholder="Selecione Data">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Data Cancelamento:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"  name="dataCancelamento" required value="{{ old('dataCancelamento') }}" placeholder="Nome Usuário">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Motivo Cancelamento:</label>
                                    <div class="input-group">
                                        <select name="motivoCancelamento" id="motivoCancelamento" class="form-control">
                                            <option value="">Selecione...</option>
                                            <option value="1">POR VENCIMENTO CONTRATUAL</option>
                                            <option value="2">POR SOLICITAÇÃO DA EMPRESA</option>
                                            <option value="3">POR INADIMPLENCIA</option>
                                            <option value="4">CANCELADO PELO PROCESSO DE CARGA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Apolice Seguradora:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control"  name="apoliceSeguradora" required value="{{ old('apoliceSeguradora') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Status da Apólice</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Exceção Atend. Obstetrícia</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="excecaoAtendimentoObstetricia">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Utiliza Leitor de Digital</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="utilizaDigital">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Permite Reembolso</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="permiteReembolso">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Seguir Tipos de Regra</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="seguirTipoRegra">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Rede Internacional</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="redeInternacional">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">ResSeguro</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="resseguro">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Seguir Regras Para Cronicos</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="regraCronico">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="col-2 col-form-label">Seguir Regras Para Idosos(Acima 64 Anos)</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="regraIdoso">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-2 col-form-label">Liberar Guia Gratuita</label>
                                <div class="col-2">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="liberarGuiaGratuita">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                            <div class="form-group row">
                                <div class="col-10">
                                    <label for="exampleTextarea">Observação:</label>
                                    <textarea class="form-control" name="observacao" id="observacao"  rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('apolice.index') }}"  class="btn btn-outline-danger">Voltar</a>
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
        $(".form-medico").validate({

            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                // nome:{    required: true },
                // tipo:{  required: true },
                // crm:{   required: true },
                // especialidade: { required: true }
            },
            submitHandler: function (e) {
                var dadosItens = $('.table-contato').bootstrapTable("getData");

                if (dadosItens.length > 0) {
                    $('input[type=hidden][name=contato]').val(JSON.stringify(dadosItens));
                }else{
                    alert("Obrigatorio contato");
                    return false;
                }
                email = false;
                $.each(dadosItens, function (index, row) {
                    if (row.tipo_contato === 'EM') {
                        email = true;
                    }
                });
                if(email == false){
                    alert("E-mail obrigatório");
                    return false;
                }
                return true;
            }
        });
    });

</script>


@endsection