<?php


function scriptsTabelaContato()
{
    ?>
    <div class="modal fade in" id="modal-infoprofissional" tabindex="-1" role="modal-infoprofissional"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form role="form" name="infoprofissional-form" class="infoprofissional-form" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Contato</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Tipo</label>
                                    <select name="tipo_contato" required="" class="CampoEstilo form-control bs-select" style="" tabindex="-98" aria-required="true"><option value="">Selecione...</option><option value="CL">Celular</option>
                                        <option value="EM">Email</option>
                                        <option value="EP">Email Pessoal</option>
                                        <option value="PS">Email Profissional</option>
                                        <option value="FX">Fax</option>
                                        <option value="TF">Telefone fixo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group" id="campo">
                                    <label class="control-label">Contato</label>
                                    <input type="text" name="contato" id="contato"  maxlength="180" value="" placeholder="Contato" required="" class="normal form-control" aria-required="true">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Ramal (Opcional)</label>
                                    <input type="text" name="ramal" id="ramal" maxlength="6" value="" placeholder="" class="normal form-control">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <div class="form-group">
                                    <label>Principal</label>
                                    <div class="mt-radio-inline" style="padding: 0;">
                                        <label class="mt-radio not-obrigatorio">
                                            <input type="radio" name="flg_principal" value="t" id="radio_opcao_flg_principal_t">Sim<span></span>
                                        </label>
                                        <label class="mt-radio not-obrigatorio">
                                            <input type="radio" name="flg_principal" value="f" id="radio_opcao_flg_principal_f" checked="checked">Não<span></span>
                                        </label>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn blue">
                            <i class="fa fa-plus-circle"></i>
                            Incluir
                        </button>
                        <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
                    </div>
                    <input type="hidden" id="index" name="index"/>
                    <input type="hidden" id="id" name="id"/>
                    <input type="hidden" id="table-contato" name="table-contato"/>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function limparDadosContato() {
            var form = $('[name=infoprofissional-form]');
            form.find('[name=contato]').val('');
            form.find('[name=tipo_contato]').val('').selectpicker('refresh');
            form.find('[name=ramal]').val('');

            var validator = form.validate();
            form.find(".has-error").removeClass("has-error");
            validator.resetForm();
            validator.reset();
        }

        function excluirInformacaoProfissional(index, id) {
            table = $('#contato_id_' + id).closest('table');
            removerItemTabela(index, table);
        }

        function editarInformacaoProfissional(index, id, table) {


            var el = document.getElementById("contato_id_editar_" + id);
            var json = JSON.parse(el.getAttribute("data-json"));

            var table = el.closest('table').getAttribute("tabela");

            var form = $('form[name=infoprofissional-form]')[0];
            $(form).find('#index').val(index)
            $(form).find('input[name=id]').val(id)
            $(form).find('input[name=table-contato]').val(table)
            $(form).find('[name=tipo_contato]').selectpicker('val', json.tipo_contato_sigla).trigger('change');
            $(form).find('[name=contato]').val(json.contato).trigger('change');
            $(form).find('[name=ramal]').val(json.ramal);
            $(form).find('[name=flg_principal]').filter('[value=' + json.flg_principal + ']').prop('checked', true);

            //var infoProfissional = getJsonForm();

            //adicionarItemTabela(infoProfissional, $('.tabela-info-' + table), parseInt($(form).find('#index').val()));
            $('#modal-infoprofissional').modal({
                backdrop: 'static'
            }).modal('show');
        }

        function getJsonForm(){
            var form = $('[name=infoprofissional-form]');
            return {
                contato: form.find('[name=contato]').val(),
                tipo_contato_sigla: form.find('[name=tipo_contato]').val(),
                tipo_contato: form.find('[name=tipo_contato] option:selected').html(),
                ramal: form.find('[name=ramal]').val(),
                flg_principal: form.find('[name=flg_principal]:checked').val(),
            };
        }

        function incluirInformacaoProfissional() {
            var table = $('input[name=table-contato]').val();

            var form = $('[name=infoprofissional-form]');
            var infoProfissional = getJsonForm();

            adicionarItemTabela(infoProfissional, $('.tabela-info-' + table), parseInt(form.find('#index').val()));
            $('#modal-infoprofissional').modal('hide');
        }

        function formatAcaoInfoProfissional(value, row, index) {
            valor = JSON.stringify(row);
            var btnExcluir = '<a id="contato_id_editar_' + row.id + '" class="btn btn-circle btn-icon-only btn-default blue" '
                + 'data-json=\''+valor+'\' href="javascript:editarInformacaoProfissional(' + index + ', ' + row.id + ')" title="Editar" style="margin: 2px;">'
                + '<i class="icon-pencil"></i>'
                + '</a>'
                + '<a id="contato_id_' + row.id + '" class="btn btn-circle btn-icon-only btn-default red" href="javascript:excluirInformacaoProfissional(' + index + ', ' + row.id + ')" title="Excluir" style="margin: 2px;">'
                + '<i class="icon-trash"></i>'
                + '</a>';

            return btnExcluir;
        }

        function formatPrincipal(value, row, index) {
            var principal = "";

            if (value == 'f') {
                principal = 'Não';
            } else if (value == 't') {
                principal = 'Sim';
            }

            return principal;
        }

        $(function () {
            $('select[name=tipo_contato]').change(function () {

                $("form.infoprofissional-form [name=contato]").inputmask("remove");

                $('[name=ramal]').val('');
                $('[name=ramal]').prop('disabled', '');

                switch ($('select[name=tipo_contato]').val()) {
                    case 'TE':
                        $('#campo label').html('Telefone');
                        $("form.infoprofissional-form [name=contato]").inputmask({
                            mask: ["(99) 9999-9999", "(99) 99999-9999"],
                        });
                        break;
                    case 'EP':
                        $('#campo label').html('E-mail Pessoal');
                        $('[name=ramal]').prop('disabled', 'disabled');
                        break;
                    case 'PS':
                        $('#campo label').html('E-mail Profissional');
                        $('[name=ramal]').prop('disabled', 'disabled');
                        break;
                    case 'CL':
                        $('#campo label').html('Celular');
                        $("form.infoprofissional-form [name=contato]").inputmask({
                            mask: ["(99) 9999-9999", "(99) 99999-9999"],
                        });
                        $('[name=ramal]').prop('disabled', 'disabled');
                        break;
                    case 'TF':
                        $('#campo label').html('Telefone Fixo');
                        $("form.infoprofissional-form [name=contato]").inputmask({
                            mask: ["(99) 9999-9999", "(99) 99999-9999"],
                        });
                        break;
                    case 'EM':
                        $('#campo label').html('E-mail');
                        $('[name=ramal]').prop('disabled', 'disabled');
                        break;
                    case 'FX':
                        $('#campo label').html('Fax');
                        $("form.infoprofissional-form [name=contato]").inputmask({
                            mask: ["(99) 9999-9999", "(99) 99999-9999"],
                        });
                        break;
                    default:
                        $('#campo label').html('Contato');
                        break;
                }
                adicionarLabelObrigatorio($(':required'));
                adicionarObrigatorio($('.obrigatorio'));

            });

            $(".infoprofissional-form").validateForm({
                rules: {},
                submitHandler: function (e) {
                    var submit = true;

                    if ($("[name=infoprofissional-form] #campo #contato-error").lengt) {
                        $('[name=infoprofissional-form] #campo #contato-error').html("Este campo é obrigatório.");
                    }

                    var tipo_contato_formulario = $('[name=infoprofissional-form] select[name=tipo_contato]').val();
                    var valor_email_formulario = $('[name=infoprofissional-form] [name=contato]').val();

                    if ((tipo_contato_formulario == "EM" || tipo_contato_formulario == "EP" || tipo_contato_formulario == "PS") && !validaEmail(valor_email_formulario)) {
                        $('[name=infoprofissional-form] #campo').addClass("has-error");
                        if ($("[name=infoprofissional-form] #campo #contato-error").lengt) {
                            $('[name=infoprofissional-form] #campo #contato-error').html("E-mail inválido.");
                        } else {
                            $('[name=infoprofissional-form] #campo #contato').after('<span id="contato-error" class="help-block">E-mail inválido.</span>');
                        }
                        submit = false;
                    }
                    if (submit) {
                        incluirInformacaoProfissional();
                    }

                }
            });

            $('#modal-infoprofissional').on('hidden.bs.modal', function () {
                limparDadosContato();
            });

            $('.btn-infoprofissional').click(function () {
                table = $(this).attr('table');

                $('input[name=id]').val("");
                $('input[name=index]').val("");
                $('input[name=table-contato]').val(table);
                $('#modal-infoprofissional').modal({
                    backdrop: 'static',
                }).modal('show');
            });
        });
    </script>
    <?php
}


function ativadorLinks( array $routes)
{

    if(is_array($routes)){
        foreach ($routes as $ms) {
            if (request()->routeIs($ms)) {
                return "kt-menu__item--open kt-menu__item--here";
            }
        }
    }
}

function ativadorSubLinks( array $routes)
{
    if(is_array($routes)){
        foreach ($routes as $link) {
            if (request()->routeIs($link)) {
                return 'kt-menu__item--active';
            }
        }
    }
}

    /**
     * Método para criptografar.
     */
    function encrypitar($valor)
    {
        return bin2hex(openssl_encrypt($valor, 'AES-256-CBC', '18g%ert4d!SAUDE!fgfFLFM@gd@gfdh!', OPENSSL_RAW_DATA, 'S@ude56fFgh@5SDS'));
    }

    /**
     * Método para descriptografar.
     */
    function decrypitar($valor)
    {


        if(strlen($valor)%2 != 0 || strlen($valor) == 0){
            return false;
        }
        if( $valor == 'pesquisa'){
            return false;
        }

        return openssl_decrypt(hex2bin($valor), 'AES-256-CBC', '18g%ert4d!SAUDE!fgfFLFM@gd@gfdh!', OPENSSL_RAW_DATA, 'S@ude56fFgh@5SDS');
    }
