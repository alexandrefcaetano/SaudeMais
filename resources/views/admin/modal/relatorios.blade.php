
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

$seguradoras = Seguradora::all();
$empresas = Empresa::all();
$apolices = Apolice::all();

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
                            <select class="form-control" id="seguradora" name="seguradora" required>
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




