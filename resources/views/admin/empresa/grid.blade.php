@extends('admin.master')

@section('conteudo')


<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">

            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link">
                    Lista Empresa </a>
                <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title"> Lista de Empresa</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('empresa.export') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Nova Empresa
                            </a>



                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-download"></i> Export
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Choose an option</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link export-btn" data-type="print">
                                                <i class="kt-nav__link-icon la la-print"></i>
                                                <span class="kt-nav__link-text">Print</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link export-btn" data-type="Xlsx">
                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                <span class="kt-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link export-btn" data-type="csv">
                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                <span class="kt-nav__link-text">CSV</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link export-btn" data-type="ods">
                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                <span class="kt-nav__link-text">ODS</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            &nbsp;
                            <a href="{{ route('empresa.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                Nova Empresa
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="kt-portlet__body kt-portlet__body--fit">

                <div class="kt-portlet__body">
                    <!--begin: Search Form -->
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <form action="{{ route('empresa.index') }}" method="POST" novalidate="novalidate" class="kt-form kt-form--label-right form-empresa">
                        @csrf()
                            <div class="row align-items-center">
                                <div class="col-xl-12 order-2 order-xl-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <input type="text" class="form-control" placeholder="Search..." id="generalSearch"  value="{{ old('nomefantasia', request('nomefantasia')) }}" name="nomefantasia">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span><i class="la la-search"></i></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="kt-form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Ativo:</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <select class="form-control" id="ativo" name="ativo" required>
                                                        <option  value="">Selecione...</option>
                                                        <option value="S"  {{ old('ativo', request('ativo')) == 'S' ? 'selected' : '' }}>Sim</option>
                                                        <option value="N"  {{ old('ativo', request('ativo')) == 'N' ? 'selected' : '' }}>Não</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                            <div class="kt-form__group kt-form__group--inline">
                                                <div class="kt-form__label">
                                                    <label>Seguradora:</label>
                                                </div>
                                                <div class="kt-form__control">
                                                    <select class="form-control m-select2 pesquisar_select" id="pesquisar_select" name="seguradora">
                                                        <option value="">Selecione</option>
                                                        @forelse ($seguradoras as $seguradora)
                                                            <option value="{{ $seguradora->encrypted_id }}" {{ old('seguradora_id', request('seguradora_id')) == $seguradora->id_seguradora ? 'selected' : '' }}>
                                                                {{ $seguradora->seguradora }}
                                                            </option>
                                                        @empty
                                                            <option value="">Nenhum Registro Encontrado</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <button type="submit" class="btn btn-success">Pesquisa</button>
                                                <a href="{{ route('empresa.index') }}" class="btn btn-warning">Limpar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                    <a href="#" class="btn btn-default kt-hidden">
                                        <i class="la la-cart-plus"></i> New Order
                                    </a>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!--end: Search Form -->




                    <!--begin::Section-->
                    <div class="kt-section">
                        <div class="kt-section__info"></div>
                        <div class="kt-section__content">
                            <div class="table-responsive">
                                <div class="col-lg-6">
                                    <div class="kt-datatable__pager-info">
                                        <div class="dropdown bootstrap-select kt-datatable__pager-size" >
                                                <form method="GET" action="{{ route('empresa.index') }}">
                                                    <label for="registrosPorPagina">Registros por página:</label>
                                                    <select name="registrosPorPagina" id="registrosPorPagina" data-width="60px" class="selectpicker kt-datatable__pager-size" onchange="this.form.submit()">
                                                        <option value="10" {{ $registrosPorPagina == 10 ? 'selected' : '' }}>10</option>
                                                        <option value="15" {{ $registrosPorPagina == 15 ? 'selected' : '' }}>15</option>
                                                        <option value="20" {{ $registrosPorPagina == 20 ? 'selected' : '' }}>20</option>
                                                        <option value="50" {{ $registrosPorPagina == 50 ? 'selected' : '' }}>50</option>
                                                        <option value="100" {{ $registrosPorPagina == 100 ? 'selected' : '' }}>100</option>
                                                    </select>
                                                </form>
                                        </div>
                                        <span class="kt-datatable__pager-detail" style="margin-left: -35px"> de {{ $empresas->total() }} registros.</span>
                                    </div>
                                </div>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Ações Sistema</th>
                                        <th>Nome Fantasia</th>
                                        <th>Ativo</th>
                                        <th>NIF </th>
                                        <th>Razao Social </th>
                                        <th>Ramo Atividade </th>
                                        <th>Morada </th>
                                        <th>Corretor </th>
                                        <th>Data Criado </th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @php  use App\Helpers\EnvHelper;  @endphp
                                    @forelse ($empresas as $empresa)
                                    <tr>
                                        <th scope="row">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('empresa.show', encrypitar($empresa->id_empresa)) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-success btn-sm btn-icon btn-icon-md m-1" data-original-title="Visualizar">
                                                    <i class="flaticon2-search-1"></i>
                                                </a>
                                                <a href="{{ route('empresa.edit',  encrypitar($empresa->id_empresa)) }}" data-skin="dark" data-toggle="kt-tooltip" class="btn btn-outline-warning btn-sm btn-icon btn-icon-md m-1" data-original-title="Editar">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>

                                        </th>
                                        <td>{{ $empresa->nomefantasia }}</td>
                                        <td>{!! $empresa->getStatusBadge() !!}</td>
                                        <td>{{ $empresa->nif }}</td>
                                        <td>{{ $empresa->razaosocial }}</td>
                                        <td>{{ $empresa->ramoatividade }}</td>
                                        <td>{{ $empresa->morada }}</td>
                                        <td>{{ $empresa->corretor }}</td>
                                        <td>{{ $empresa->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="10">Nenhum registro encontrado</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 <div class="kkt-datatable__pager kt-datatable--paging-loaded">
                    <div class="form-group row">
                        <div class="col-lg-6">
                                 {{ $empresas->links() }}
                        </div>

                    </div>
                    <!--end::Section-->
                </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>




@endsection
@section('scripts')

            <script type="text/javascript">
                $(document).ready(function() {
                    // Captura o clique nos botões de exportação
                    $('.export-btn').on('click', function(e) {
                        e.preventDefault();

                        // Obtém o formato selecionado
                        var fileType = $(this).data('type');
                        if (fileType === 'print') {
                            alert('Função de impressão não implementada');
                            return;
                        }

                        // Dados a serem enviados via POST
                        let formData = {
                            file_type: fileType,
                            _token: '{{ csrf_token() }}'  // Garante que o token CSRF seja enviado com a requisição
                        };

                        // Realiza a requisição AJAX
                        $.ajax({
                            url: "{{ route('empresa.export') }}",  // A rota para exportação
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                // Exibe uma mensagem de sucesso
                                alert(' sucesso  '+response.message);
                            },
                            error: function(xhr) {
                                // Em caso de erro, exibe uma mensagem
                                alert('Erro: ' + xhr.responseText);
                            }
                        });
                    });
                });



            </script>


@endsection
