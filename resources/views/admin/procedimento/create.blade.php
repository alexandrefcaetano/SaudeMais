@extends('admin.master')

@section('conteudo')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Form Usuário </h3>
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
                               Cadastra Usuário
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
                    <form action="{{ route('empresa.store') }}" class="kt-form kt-form--label-right form-empresa"  method="POST" novalidate="novalidate">
                        @csrf()
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Razão Social:</label>
                                    <input type="text" class="form-control" name="razaosocial" minlength="2" maxlength="150" required value="{{ old('razaosocial') }}" placeholder="Razão Social">
                                    <span class="form-text text-muted">Entre com o nome Razão Social...</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Nome Fantasia:</label>
                                    <input type="text" class="form-control" name="nomefantasia" minlength="2" maxlength="150" required value="{{ old('nomefantasia') }}" placeholder="Nome Fantasia">
                                    <span class="form-text text-muted">Entre com o nome Nome Fantasia...</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>NIF:</label>
                                    <input type="text" class="form-control" name="nif" minlength="2" maxlength="50" required value="{{ old('nif') }}" placeholder="NIF">
                                    <span class="form-text text-muted">Entre com o NIF...</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Ramo de Atividade:</label>
                                    <input type="text" class="form-control" name="ramoatividade" minlength="2" maxlength="150" required value="{{ old('ramoatividade') }}" placeholder="Ramo Atividade">
                                    <span class="form-text text-muted">Entre com o Ramo de Atividade...</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Ativo:</label>
                                        <select class="form-control" id="ativo" name="ativo" required>
                                            <option  value="">Selecione...</option>
                                            <option value="S"  {{ old('ativo') == 'S' ? 'selected' : '' }}>Sim</option>
                                            <option value="N"  {{ old('ativo') == 'N' ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Visualizar Relatorio de Atendimento:</label>
                                        <select class="form-control" id="visualizarrelatendimento" name="visualizarrelatendimento" required>
                                            <option selected value="AT">Ativo</option>
                                            <option value="S"  {{ old('visualizarrelatendimento') == 'S' ? 'selected' : '' }}>Sim</option>
                                            <option value="N"  {{ old('visualizarrelatendimento') == 'N' ? 'selected' : '' }}>Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Seguradora:</label>
                                        <select class="form-control"  id="seguradora_id" name="seguradora_id" required>
                                            <option value="">Selecione</option>
                                            @forelse ($seguradoras as $seguradora)
                                                <option value="{{ $seguradora->encrypted_id }}  {{ old('seguradora_id') == $seguradora->id_seguradora ? 'selected' : '' }}">{{ $seguradora->seguradora }}</option>
                                            @empty
                                                <option value="">Nem um Registro Encontrado</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Morada:</label>
                                    <input type="text" class="form-control" name="morada" minlength="2" maxlength="200" required value="{{ old('morada') }}" placeholder="Morada">
                                    <span class="form-text text-muted">Entre com a Morada...</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Corretor:</label>
                                    <input type="text" class="form-control" name="corretor" minlength="2" maxlength="50" required value="{{ old('corretor') }}" placeholder="Ramo Atividade">
                                    <span class="form-text text-muted">Entre com o Corretor...</span>
                                </div>
                            </div>
                            <div class="form-group form-group-last">
                                <label for="exampleTextarea">Observação:</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ old('observacao') }}</textarea>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <h3>Contatos</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                 <div class="col-md-6">
                                    <a href="javascript:abrirModalItem()" class="btn btn-info"><i class="fa fa-plus-square-o"></i> Incluir Contato</a>
                                </div>
                                <div class="col-md-12">
                                    <table data-toggle="table" class="table table-bordered table-hover table-contato" data-unique-id="id">
                                        <thead class="thead-light">
                                        <tr>
                                            <th data-field="tipo" data-align="center">Tipo</th>
                                            <th data-field="descricao">Contato</th>
                                            <th data-field="flg_principal" data-align="center" data-formatter="formatPrincipal">Principal</th>
                                            <th data-formatter="formatAcao" data-align="center">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <input type="hidden" name="contato" class="contato" value=""/>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <a href="{{ route('empresa.index') }}"  class="btn btn-outline-danger">Voltar</a>
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

<div class="modal fade" id="modal-atributo-valor" tabindex="-1" role="modal-atributo-valor" aria-labelledby="modal-atributo-valor" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" name="form-atributo-valor" class="kt-form kt-form--label-right form-atributo-valor" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="cod_atributo_valor" id="cod_atributo_valor" value="">
                  <input type="hidden" name="index" id="index" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label>Tipo:</label>
                            <select name="tipo_contato" required class="form-control" tabindex="-98" aria-required="true">
                                <option value="">Selecione...</option>
                                <option value="CL">Celular</option>
                                <option value="EM">Email</option>
                                <option value="TF">Telefone fixo</option>
                            </select>
                            <span class="form-text text-muted">Tipo de Contato</span>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-control-label">Contato:</label>
                            <input type="text" class="form-control" name="descricao_contato"  aria-required="true">
                            <span class="form-text text-muted">Entre com seu contato</span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">Principal:</label>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="flg_principal"  value="T">Sim
                                    <span></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="flg_principal" checked="checked" value="F">Não
                                    <span></span>
                                </label>
                            </div>
                            <span class="form-text text-muted">Contato Principal?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Incluir</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>





<div class="modal fade show" id="modal-excluir" tabindex="-1" role="modal-excluir" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;" >
    <input type="hidden" name="index"/>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir o Contato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Não</button>
                <button type="button" onclick="excluirRegistro();" class="btn btn-primary">Sim</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade show" id="modal-obrigatorio" tabindex="-1" role="modal-obrigatorio" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: none;" >
    <input type="hidden" name="index"/>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                OBRIGATORIO! ter um contato, e no minico um do tipo Email?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-elevate btn-pill btn-elevate-air btn-sm" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<?$itensAtributo = "{}";?>
@endsection

@section('scripts')

<script>

    $(function () {
        $('.pesquisar_select').select2();
    });

    $(function () {
        $(".form-empresa").validate({
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
                var dadosItens = $('.table-contato').bootstrapTable("getData");

                if (dadosItens.length > 0) {
                    $('input[type=hidden][name=contato]').val(JSON.stringify(dadosItens));
                }else{
                    exibirModalObrigatorio();
                    return false;
                }
                email = false;
                $.each(dadosItens, function (index, row) {
                    if (row.tipo_contato === 'EM') {
                        email = true;
                    }
                });
                if(email == false){
                    exibirModalObrigatorio();
                    return false;
                }
                return true;
            }
        });

        $(".form-atributo-valor").validate({

            focusInvalid: true,
            ignore: ":not(:visible),[readonly]",
            rules: {
                descricao_contato: {    required: true, minlength: 2, maxlength: 150 },
                flg_principal: {        required: true },
                tipo_contato: {         required: true },
                flg_principal: {        required: true },
            },
            submitHandler: function (form) {
                // Prevenir o comportamento padrão de submissão
                event.preventDefault();

                let repetido = false;
                let principalExiste = false;
                let row2 = {
                    tipo: $(form).find('[name=tipo_contato] option:selected').html(),
                    tipo_contato: $(form).find('[name=tipo_contato] option:selected').val(),
                    descricao: $(form).find('[name=descricao_contato]').val(),
                    flg_principal: $(form).find('[name=flg_principal]:checked').val()
                };
                let table = $('.table-contato');

                if ($(form).find('[name=index]').val() !== '') {
                    table.bootstrapTable('updateRow', { index: $(form).find('[name=index]').val(), row: row2 });
                } else {
                    var dadosItens = table.bootstrapTable("getData");
                    $.each(dadosItens, function (index, row) {
                        if (row.flg_principal === "T") {
                            principalExiste = true;
                        }
                        if (row.descricao === row2.descricao) {
                            repetido = true;
                        }
                    });

                    // Lógica para evitar múltiplos contatos principais
                    if (row2.flg_principal === "T" && principalExiste) {
                        alert('Já existe um contato principal. Apenas um contato pode ser marcado como principal.');
                        return false;
                    }

                    if (!repetido) {
                        table.bootstrapTable("insertRow", { index: dadosItens.length, row: row2 });
                        fecharModalItem(); // Certifique-se de que essa função está definida
                        return true;
                    } else {
                        alert('O Contato "' + row2.descricao + '" já existe');
                    }
                }
            }
        });

        $('.tabela-itens-atributo').bootstrapTable('load', {{$itensAtributo}});
    });

    function abrirModalItem(index) {
        limparCamposModal();
        let modal = $('#modal-atributo-valor');
        modal.find('#tipo-operacao').html('Incluir');
        modal.modal('show');
    }

    function fecharModalItem(index) {
        limparCamposModal();
        $('#modal-atributo-valor').modal('hide');
    }

    function limparCamposModal() {
        let form = $('[name=form-atributo-valor]');
        let validator = form.validate();

        form.find(".has-error").removeClass("has-error");
        validator.resetForm();
        validator.reset();

        form.find('[name=index]').val('');
        form.find('[name=cod_atributo_valor]').val('');
        form.find('[name=num_ordem]').val('');
        form.find('[name=qci_grupo_id]').val('');
        form.find('[name=nome_grupo]').val('');
    }

    function formatAcao(value, row, index) {

        let btnExcluir = '<a class="btn btn-sm btn-danger btn-icon btn-icon-md" href="javascript:exibirModalExclusao(' + index + ')" title="Excluir" style="margin: 2px;">'
            + '<i class="la la-trash"></i>'
            + '</a>';

        return btnExcluir;
    }

    function formatPrincipal(value, row, index) {
            var principal = "";

            if (value == 'F') {
                principal = 'Não';
            } else if (value == 'T') {
                principal = 'Sim';
            }

            return principal;
        }



    function exibirModalExclusao(index) {
        let valor = index;
        $('#modal-excluir').find('[name=index]').val(valor);
        var modal = $('#modal-excluir');
        modal.modal('show');
    }

    function excluirRegistro() {
        var modal = $('#modal-excluir');
        valor = modal.find('[name=index]').val();

        modal.modal('hide');
        let table = $('.table-contato');
        var dados = table.bootstrapTable("getData");
        dados.splice(valor, 1);
        table.bootstrapTable("load", dados);

        $(table).closest('form').data("changed", true);
    }

    function exibirModalObrigatorio(index) {
        var modal = $('#modal-obrigatorio');
        modal.modal('show');
    }


</script>


@endsection