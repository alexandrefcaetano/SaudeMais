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
                                    <div class="col-lg-6">
                                        <button type="button" class="btn btn-outline-success btn-tallest">MODELO DE ARQUIVO</button>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Plano:</label>
                                        <input type="text" class="form-control" name="plano" required value="{{ old('plano') }}" placeholder="Plano">
                                        <span class="form-text text-muted">Entre com o Plnao...</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Arquivo</label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="arquivo">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
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



        let timerInterval;

        // Simulando uma chamada para o servidor
        function enviarArquivo() {
            return new Promise((resolve) => {
                // Simulação de tempo para receber a resposta do servidor (3 segundos)
                setTimeout(() => {
                    // Simula a resposta do servidor: true indica que há erros, false indica que não há erros
                    const temErros = true; // ou false, dependendo da lógica
                    resolve(temErros);
                }, 3000); // 3 segundos de simulação
            });
        }

        // Função para exibir a caixa de diálogo com o temporizador
        function iniciarImportacao() {
            Swal.fire({
                title: "Processando...",
                html: "Irei fechar em <b></b> milissegundos.",
                timer: 5000, // 5 segundos
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        timer.textContent = Swal.getTimerLeft();
                    }, 100);

                    // Envia o arquivo e aguarda a resposta do servidor
                    enviarArquivo().then((temErros) => {
                        // Assim que o servidor responde, fecha o Swal e exibe a próxima caixa de diálogo
                        Swal.close();
                        clearInterval(timerInterval);

                        // Verifica a resposta do servidor e exibe a mensagem de confirmação
                        if (temErros) {
                            Swal.fire({
                                title: "Erros encontrados no arquivo",
                                text: "Deseja salvar os registros válidos?",
                                icon: "warning",
                                showDenyButton: true,
                                confirmButtonText: "Salvar",
                                denyButtonText: `Não Salvar`
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire("Salvo!", "Os registros válidos foram salvos.", "success");
                                    // Chamar função para salvar os registros válidos aqui
                                } else if (result.isDenied) {
                                    Swal.fire("Alterações não salvas", "", "info");
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "Nenhum erro encontrado",
                                text: "Deseja salvar todos os registros?",
                                icon: "success",
                                showDenyButton: true,
                                confirmButtonText: "Salvar",
                                denyButtonText: `Não Salvar`
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.fire("Salvo!", "Todos os registros foram salvos.", "success");
                                    // Chamar função para salvar todos os registros aqui
                                } else if (result.isDenied) {
                                    Swal.fire("Alterações não salvas", "", "info");
                                }
                            });
                        }
                    });
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });
        }

        // Chamando a função para iniciar o processo de importação
        iniciarImportacao();



    </script>


@endsection
