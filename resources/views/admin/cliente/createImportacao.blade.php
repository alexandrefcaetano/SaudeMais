@extends('admin.master')

@section('conteudo')

    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Importação Cliente </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        Cliente </a>

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
                                    Importação Cliente
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
                        <div class="alert alert-light alert-elevate" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                The Metronic Datatable component supports local or remote data source. For the local data you can pass javascript array as data source. In this example the grid fetches its
                                paging performed in user browser(frontend).
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form action="{{ route('cliente.importarClientes') }}" class="kt-form kt-form--label-right form-importacao-cliente" enctype="multipart/form-data"   method="POST" novalidate="novalidate">
                            @csrf()
                            <div class="kt-portlet__body">

                                <div class="form-group row">
                                    <div class="col-lg-2">
                                    </div>
                                    <div class="col-lg-8">
                                        <a href="{{ route('cliente.download', ['filename' => 'PlanilhaClientePadrao.xlsx']) }}" class="btn btn-success btn-lg btn-block">MODELO DE ARQUIVO PARA IMPORTAÇÃO</a>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Tipo importaço:</label>
                                        <select class="form-control" id="tipo" name="tipo" required>
                                            <option  value="">Selecione...</option>
                                            <option value="S"  {{ old('tipo') == 'B' ? 'selected' : '' }}>Beneficiarios</option>
                                            <option value="N"  {{ old('ativo') == 'O' ? 'selected' : '' }}>Outros</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; border: 1px solid #081aa8  !important;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /></div>
                                            <div>
                                                <div class="" id="abaixo-thumbnail" style="text-align: center; margin-top: -4px"></div>
                                                                <span class=" btn-file">
                                                                    <span class="fileinput-new btn btn-success btn-elevate btn-elevate-air"> SELECIONE ARQUIVO </span>
                                                                    <span class="fileinput-exists btn btn-outline-warning"> ALTERAR </span>
                                                                    <input type="file" name="arquivo">
                                                                </span>
                                                    <a href="javascript:;" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput"> REMOVER </a>
                                                </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                    </div>

                                </div>


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
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="modal-importar" tabindex="-1" role="dialog" aria-labelledby="modal-importar" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 900px !important;">
            <div class="modal-content">
                <form action="{{ route('cliente.confirmarImportacao') }}" class="kt-form kt-form--label-right form-importacao-cliente" enctype="multipart/form-data" method="POST" novalidate="novalidate">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-importar">Análise do Arquivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="kt-scroll" data-scroll="true" data-height="400">
                            @if (!empty($linhas_analise))
                                @if (!empty($linhas_analise['erros']) && count($linhas_analise['erros']))
                                    <div class="alert alert-danger">
                                        <span>Arquivo contém as seguintes inconsistências:</span>
                                    </div>
                                    <div class="panel">
                                        <table class="table table-striped table-hover table-condensed">
                                            <thead>
                                            <tr>
                                                <th>Linha</th>
                                                <th>Código Transação</th>
                                                <th>Coluna (em negrito) - Descrição</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($linhas_analise['erros'] as $idLinha => $linha)
                                                <tr>
                                                    <td>{{ $idLinha }}</td>
                                                    <td>
                                                        @if(is_array($linhas_analise['erros']) && count($linhas_analise['erros']) > 0)
                                                            -
                                                        @else
                                                            {{ $linhas_analise['erros'][$idLinha][0]['codigo_transacao'] }}
                                                        @endif
                                                    </td>
                                                    <td>

                                                        @foreach ($linha as $key => $item)
                                                            <b>{{ $item['item'] }}</b> - {{ $item['descricao'] }}
                                                            @if(count($linha) != ($key + 1)), @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        <span>Arquivo não contém erros</span>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if (!empty($linhas_analise))
                            @if (is_array($linhas_analise['erros']) && count($linhas_analise['erros']) < 1 )
                                <input type="hidden" name="nome_arquivo" value="{{ $linhas_analise['nome_arquivo']}}">
                                <button type="submit" class="btn btn-success" name="btn-importar">Importar</button>
                            @endif
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>





    @if(!empty(session('registrosValidos')))
        <form method="POST" action="{{ route('importar.confirmar') }}">
            @csrf
            <button type="submit">Confirmar Importação dos Registros Válidos</button>
        </form>
    @endif

@endsection

@section('scripts')

    <script>

        $(function () {
            $(".form-importacao-cliente").validate({
                focusInvalid: true,
                ignore: ":not(:visible),[readonly]",
                rules: {
                    arquivo:{    required: true },
                    ativo:{  required: true }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });


        var controleTelaUpload = (function() {
            return {
                modalImportar: $('#modal-importar'),
                formImportar: $('form[name="form-importar"]'),
                btnImportar: $('button[name="btn-importar"]'),
                inputAct: $('input[name="act"]'),
                mensagemConfirm: '',

                abrirModalImportar: function() {
                    this.modalImportar.modal('show');
                },

                init: function() {
                    this.events();
                },

                events: function() {
                    this.btnImportar.click(this.handleBtnImportarClick.bind(this));
                },

                handleBtnImportarClick: function(e) {
                    e.preventDefault();
                    if (confirm(this.mensagemConfirm)) {
                        this.inputAct.val('importarArquivo');
                        this.formImportar.submit();
                    }
                }
            }
        })();

        $(function() {
            controleTelaUpload.init();

            <?php if (!empty($linhas_analise) && count($linhas_analise)) : ?>
            controleTelaUpload.abrirModalImportar();
            <?php if (!empty($linhas_analise['erros'])) : ?>
                controleTelaUpload.mensagemConfirm = 'Importar arquivo apesar das inconsistências?';
            <?php else : ?>
                controleTelaUpload.mensagemConfirm = 'Importar arquivo?';
            <?php endif; ?>
            <?php endif; ?>
        });







        // let timerInterval;
        //
        // // Simulando uma chamada para o servidor
        // function enviarArquivo() {
        //     return new Promise((resolve) => {
        //         // Simulação de tempo para receber a resposta do servidor (3 segundos)
        //         setTimeout(() => {
        //             // Simula a resposta do servidor: true indica que há erros, false indica que não há erros
        //             const temErros = true; // ou false, dependendo da lógica
        //             resolve(temErros);
        //         }, 3000); // 3 segundos de simulação
        //     });
        // }
        //
        // // Função para exibir a caixa de diálogo com o temporizador
        // function iniciarImportacao() {
        //     Swal.fire({
        //         title: "Processando...",
        //         html: "Irei fechar em <b></b> milissegundos.",
        //         timer: 5000, // 5 segundos
        //         timerProgressBar: true,
        //         didOpen: () => {
        //             Swal.showLoading();
        //             const timer = Swal.getHtmlContainer().querySelector("b");
        //             timerInterval = setInterval(() => {
        //                 timer.textContent = Swal.getTimerLeft();
        //             }, 100);
        //
        //             // Envia o arquivo e aguarda a resposta do servidor
        //             enviarArquivo().then((temErros) => {
        //                 // Assim que o servidor responde, fecha o Swal e exibe a próxima caixa de diálogo
        //                 Swal.close();
        //                 clearInterval(timerInterval);
        //
        //                 // Verifica a resposta do servidor e exibe a mensagem de confirmação
        //                 if (temErros) {
        //                     Swal.fire({
        //                         title: "Erros encontrados no arquivo",
        //                         text: "Deseja salvar os registros válidos?",
        //                         icon: "warning",
        //                         showDenyButton: true,
        //                         confirmButtonText: "Salvar",
        //                         denyButtonText: `Não Salvar`
        //                     }).then((result) => {
        //                         if (result.isConfirmed) {
        //                             Swal.fire("Salvo!", "Os registros válidos foram salvos.", "success");
        //                             // Chamar função para salvar os registros válidos aqui
        //                         } else if (result.isDenied) {
        //                             Swal.fire("Alterações não salvas", "", "info");
        //                         }
        //                     });
        //                 } else {
        //                     Swal.fire({
        //                         title: "Nenhum erro encontrado",
        //                         text: "Deseja salvar todos os registros?",
        //                         icon: "success",
        //                         showDenyButton: true,
        //                         confirmButtonText: "Salvar",
        //                         denyButtonText: `Não Salvar`
        //                     }).then((result) => {
        //                         if (result.isConfirmed) {
        //                             Swal.fire("Salvo!", "Todos os registros foram salvos.", "success");
        //                             // Chamar função para salvar todos os registros aqui
        //                         } else if (result.isDenied) {
        //                             Swal.fire("Alterações não salvas", "", "info");
        //                         }
        //                     });
        //                 }
        //             });
        //         },
        //         willClose: () => {
        //             clearInterval(timerInterval);
        //         }
        //     });
        // }
        //
        // // Chamando a função para iniciar o processo de importação
        // iniciarImportacao();



    </script>


@endsection
