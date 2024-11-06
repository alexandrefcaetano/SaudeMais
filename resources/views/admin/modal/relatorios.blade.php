
<?php
/**
 * Carrega as listas de seguradoras, empresas e apólices do banco de dados.
 *
 * As variáveis $seguradoras, $empresas e $apolices são usadas para popular
 * os campos select nos formulários de cada modal.
 */

use App\Models\Seguradora;
use App\Models\Empresa;
use App\Models\Apolice;

$seguradoras = Seguradora::where('ativo', 'S')->orderBy('seguradora')->get();
$empresas = Empresa::where('ativo', 'S')->orderBy('nomefantasia')->get();
$apolices = Apolice::where('ativo', 'S')->orderBy('apolice')->get();

?>


<!--
Modal para geração do Relatório Census-Seguro.
Permite selecionar seguradora, empresa e outras opções antes de gerar o relatório.
-->

<div class="modal fade"  role="dialog"  id="rlt_sensus_seguro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_sensus_seguro" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('cliente.relatorioCensusSeguro') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório Census-Seguro</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Seguradora:</label>
                            <select class="form-control m-select2" id="seguradora" name="seguradora" required>
                                <option value="">Selecione</option>
                                @foreach ($seguradoras as $seguradora)
                                    <option value="{{ encrypitar($seguradora->id_seguradora) }}">{{ $seguradora->seguradora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Empresa:</label>
                            <select class="form-control" id="empresa_seguro" name="empresa_seguro">
                                <option value="">Selecione</option>
                                @foreach ($empresas as $emp)
                                    <option value="{{ $emp->id_empresa }}">{{ $emp->nomefantasia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Apolice:</label>
                            <select class="form-control" id="apolice" name="apolice">
                                <option value="">Selecione</option>
                                @forelse ($apolices as $apo)
                                    <option value="{{ $apo->id_apolice }}">{{ $apo->apolice }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Necessita Pré Autorização:</label>
                            <div class="input-group">
                                <select class="form-control" id="beneficiarionecessitaautorizacao" name="beneficiarionecessitaautorizacao">
                                    <option value="">Selecione...</option>
                                    <option value="S">Sim</option>
                                    <option value="N">Não</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--
Modal para geração do Relatório CID Crônico.
Permite selecionar seguradora, empresa e outras opções específicas antes de gerar o relatório.
-->
<div class="modal fade"  role="dialog"  id="rlt_cid_cronico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_cid_cronico" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('cliente.relatorioCencusCronico') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório CID Crônico</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Seguradora:</label>
                            <select class="form-control" id="seguradora" name="seguradora" required>
                                <option value="">Selecione</option>
                                @foreach ($seguradoras as $seguradora)
                                    <option value="{{ encrypitar($seguradora->id_seguradora) }}">{{ $seguradora->seguradora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Empresa:</label>
                            <select class="form-control" id="empresa" name="empresa">
                                <option value="">Selecione</option>
                                @forelse ($empresas as $emp)
                                    <option value="{{ encrypitar($emp->id_empresa) }}">{{ $emp->nomefantasia }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Apolice:</label>
                            <select class="form-control" id="apolice" name="apolice">
                                <option value="">Selecione</option>
                                @forelse ($apolices as $apo)
                                    <option value="{{ encrypitar($apo->id_apolice) }}">{{ $apo->apolice }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Cobertura:</label>
                            <div class="input-group">
                                <select class="form-control" id="cobertura" name="cobertura">
                                    <option value="">Selecione...</option>
                                    <option value="3">Gestantes</option>
                                    <option value="7">Cronicos</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--
Modal para geração do Relatório Maiores utilizadores.
Permite selecionar empresa e data inicio e data fim obrigatorios gerar o relatório.
-->
<div class="modal fade"  role="dialog"  id="rlt_maiores_utilizadores" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_maiores_utilizadores" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('cliente.relatorioMaioresUtilizadores') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório Maiores Utilizadores</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Empresa:</label>
                            <select class="form-control" id="empresa" name="empresa">
                                <option value="">Selecione</option>
                                @forelse ($empresas as $emp)
                                    <option value="{{ encrypitar($emp->id_empresa) }}">{{ $emp->nomefantasia }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Inicio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_inicio" name="datainicio"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Fim:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_fim" name="datafim"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--
Modal para geração do Relatório Monitorameto de Atendimento.
Permite selecionar data com mes e adno obrigatorios gerar o relatório.
-->
<div class="modal fade" id="rlt_MonitoramentoAtendimento" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('guiaSeguro.relatorioMonitoramentoAtendimento') }}" class="kt-form kt-form--label-right" method="POST">
            @csrf()
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Relatório Monitorametno de Atendimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-6">
                            <label>Mês/Ano:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_mes_ano" name="mesano"  value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--
Modal para geração do Relatório Maiores utilizadores.
Permite selecionar empresa e data inicio e data fim obrigatorios gerar o relatório.
-->
<div class="modal fade"  role="dialog"  id="rlt_cronico" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_cronico" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('cliente.relatorioCensusSeguro') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório CID Cronico</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Seguradora:</label>
                            <select class="form-control" id="seguradora" name="seguradora">
                                <option value="">Selecione</option>
                                @foreach ($seguradoras as $seguradora)
                                    <option value="{{ encrypitar($seguradora->id_seguradora) }}">{{ $seguradora->seguradora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>Empresa:</label>
                            <select class="form-control" id="empresa_seguro" name="empresa_seguro">
                                <option value="">Selecione</option>
                                @foreach ($empresas as $emp)
                                    <option value="{{ $emp->id_empresa }}">{{ $emp->nomefantasia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Apolice:</label>
                            <select class="form-control" id="apolice" name="apolice">
                                <option value="">Selecione</option>
                                @forelse ($apolices as $apo)
                                    <option value="{{ $apo->id_apolice }}">{{ $apo->apolice }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Inicio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_inicio_cronico" name="datainicio"  value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Fim:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_fim_cronico" name="datafim"  value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--
Modal para geração do Relatório Ocorrencia.
Permite selecionar empresa e data inicio e data fim obrigatorios gerar o relatório.
-->
<div class="modal fade"  role="dialog"  id="rlt_ocorrencia" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_ocorrencia" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('ocorrencia.relatorioOcorrencia') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório de Ocorrência   </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-6">

                            <label class="col-form-label">Empresa</label>

                            <div class=" col-lg-4 col-md-9 col-sm-12">
                                <select class="form-control m-select2" id="kt_select2_1" name="empresa" >
                                <option value="">Selecione</option>
                                @forelse ($empresas as $emp)
                                    <option value="{{ encrypitar($emp->id_empresa) }}">{{ $emp->nomefantasia }}</option>
                                @empty
                                    <option value="">Nenhum Registro Encontrado</option>
                                @endforelse
                            </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Inicio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_inicio" name="datainicio"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label>Data Fim:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_fim" name="datafim"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--
Modal para geração do Resumo Apolice
Permite selecionar empresa e data inicio e data fim obrigatorios gerar o relatório.
-->
<div class="modal fade"  role="dialog"  id="rlt_resulto_apolice" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="rlt_resulto_apolice" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('apolice.relatorioResulmoApolice') }}" class="kt-form kt-form--label-right" method="POST">
                @csrf()
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Relatório Resumo Apolice  </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-lg-5">
                            <label>Seguradora:</label>
                            <select class="form-control" id="seguradora" name="seguradora">
                                <option value="">Selecione</option>
                                @foreach ($seguradoras as $seguradora)
                                    <option value="{{ encrypitar($seguradora->id_seguradora) }}">{{ $seguradora->seguradora }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label>Status Apolice:</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Selecione</option>
                                <option value="S">Sim</option>
                                <option value="N">Não</option>

                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Data Inicio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_inicio" name="datainicio"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <label>Data Fim:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control datepicker_fim" name="datafim"   value="" id="datepicker" placeholder="Selecione Data" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>
        </div>
    </div>
</div>

