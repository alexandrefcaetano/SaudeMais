<?php

use App\Models\Apolice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;




use App\Http\Controllers\admin\UsuarioController;
Route::put('/usuario/{usuario}', [UsuarioController::class, 'update'])->name(   'usuario.update')->where('usuario', '[0-9]+');
Route::get('/usuario/{usuario}', [UsuarioController::class, 'show'])->name(   'usuario.show')->where('usuario', '[0-9]+');
Route::get('/usuario/{usuario}/edit', [UsuarioController::class, 'edit'])->name(   'usuario.edit')->where('usuario', '[0-9]+');
Route::get('/usuario', [UsuarioController::class, 'index'])->name(   'usuario.index');
Route::post('/usuario', [UsuarioController::class, 'store'])->name(   'usuario.store');
//Route::get('/usuario/create', [UsuarioController::class, 'create'])->name(   'usuario.create');
Route::match(['get', 'post'], 'usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');

// Rotas para o gerenciamento de empresas
use App\Http\Controllers\admin\EmpresaController;

Route::match(['get', 'post'], '/empresa/create', [EmpresaController::class, 'create'])->name('empresa.create');
Route::put('/empresa/{hash}', [EmpresaController::class, 'update'])->name('empresa.update');
Route::get('/empresa/show/{hash}', [EmpresaController::class, 'show'])->name('empresa.show');
Route::get('/empresa/edit/{hash}', [EmpresaController::class, 'edit'])->name('empresa.edit');
Route::match(['get', 'post'],'/empresa', [EmpresaController::class, 'index'])->name('empresa.index');
Route::post('/empresa/store', [EmpresaController::class, 'store'])->name('empresa.store');

Route::get('empresa/export/', [EmpresaController::class, 'export'])->name('empresa.export');



use App\Http\Controllers\admin\ServicoController;
Route::match(['get', 'post'], '/servico/create', [EmpresaController::class, 'create'])->name('servico.create');
Route::get('servico', [ServicoController::class, 'index'])->name('servico.index');
Route::get('servico/exportServico/', [ServicoController::class, 'exportServico'])->name('servico.exportServico');



// Rotas para o gerenciamento de seguradoras
use App\Http\Controllers\admin\SeguradoraController;
Route::match(['get', 'post'], '/seguradora/create', [SeguradoraController::class, 'create'])->name('seguradora.create');
Route::put('/seguradora/{hash}', [SeguradoraController::class, 'update'])->name('seguradora.update');
Route::get('/seguradora/{hash}', [SeguradoraController::class, 'show'])->name('seguradora.show');
Route::get('/seguradora/edit/{hash}', [SeguradoraController::class, 'edit'])->name('seguradora.edit');
Route::match(['get', 'post'], '/seguradora', [SeguradoraController::class, 'index'])->name('seguradora.index');
Route::post('/seguradora/store', [SeguradoraController::class, 'store'])->name('seguradora.store');


use App\Http\Controllers\admin\CidController;
Route::match(['get', 'post'], '/cid/create', [CidController::class, 'create'])->name('cid.create');
Route::put('/cid/{hash}', [CidController::class, 'update'])->name('cid.update')->where('cid', '[0-9]+');
Route::get('/cid/{hash}', [CidController::class, 'show'])->name('cid.show')->where('cid', '[0-9]+');
Route::get('/cid/edit/{hash}', [CidController::class, 'edit'])->name('cid.edit')->where('cid', '[0-9]+');
Route::match(['get', 'post'], '/cid', [CidController::class, 'index'])->name('cid.index');
Route::post('/cid/store', [CidController::class, 'store'])->name('cid.store');



// Rotas para o gerenciamento de especialidades
use App\Http\Controllers\admin\EspecialidadeController;
Route::match(['get', 'post'], '/especialidade/create', [EspecialidadeController::class, 'create'])->name('especialidade.create');
Route::put('/especialidade/{hash}', [EspecialidadeController::class, 'update'])->name('especialidade.update')->where('especialidade', '[0-9]+');
Route::get('/especialidade/{hash}', [EspecialidadeController::class, 'show'])->name('especialidade.show')->where('especialidade', '[0-9]+');
Route::get('/especialidade/edit/{hash}', [EspecialidadeController::class, 'edit'])->name('especialidade.edit')->where('especialidade', '[0-9]+');
Route::match(['get', 'post'], '/especialidade', [EspecialidadeController::class, 'index'])->name('especialidade.index');
Route::post('/especialidade/store', [EspecialidadeController::class, 'store'])->name('especialidade.store');


// Rotas para o gerenciamento de procedimento
use App\Http\Controllers\admin\PlanoController;
Route::match(['get', 'post'], '/plano/create', [PlanoController::class, 'create'])->name('plano.create');
Route::put('/plano/{hash}', [PlanoController::class, 'update'])->name('plano.update')->where('plano', '[0-9]+');
Route::get('/plano/{hash}', [PlanoController::class, 'show'])->name('plano.show')->where('plano', '[0-9]+');
Route::get('/plano/edit/{hash}', [PlanoController::class, 'edit'])->name('plano.edit')->where('plano', '[0-9]+');
Route::match(['get', 'post'],'/plano', [PlanoController::class, 'index'])->name('plano.index');
Route::post('/plano/store', [PlanoController::class, 'store'])->name('plano.store');



// Rotas para o gerenciamento de planos
use App\Http\Controllers\admin\ProcedimentoController;
Route::match(['get', 'post'], '/procedimento/create', [ProcedimentoController::class, 'create'])->name('procedimento.create');
Route::put('/procedimento/{hash}', [ProcedimentoController::class, 'update'])->name('procedimento.update')->where('procedimento', '[0-9]+');
Route::get('/procedimento/{hash}', [ProcedimentoController::class, 'show'])->name('procedimento.show')->where('procedimento', '[0-9]+');
Route::get('/procedimento/edit/{hash}', [ProcedimentoController::class, 'edit'])->name('procedimento.edit')->where('procedimento', '[0-9]+');
Route::match(['get', 'post'],'/procedimento', [ProcedimentoController::class, 'index'])->name('procedimento.index');
Route::post('/procedimento/store', [ProcedimentoController::class, 'store'])->name('procedimento.store');




// Rotas para o gerenciamento de Medicos
use App\Http\Controllers\admin\MedicoController;
Route::match(['get', 'post'], '/medico/create', [MedicoController::class, 'create'])->name('medico.create');
Route::put('/medico/{hash}', [MedicoController::class, 'update'])->name('medico.update');
Route::get('/medico/{hash}', [MedicoController::class, 'show'])->name('medico.show');
Route::get('/medico/edit/{hash}', [MedicoController::class, 'edit'])->name('medico.edit');
Route::get('/medico', [MedicoController::class, 'index'])->name('medico.index');
Route::post('/medico', [MedicoController::class, 'store'])->name('medico.store');
Route::post('/medico/pesquisa', [MedicoController::class, 'index'])->name('medico.pesquisa');


// Rotas para o gerenciamento de Apolices
use App\Http\Controllers\admin\ApoliceController;
Route::match(['get', 'post'], '/apolice/create', [ApoliceController::class, 'create'])->name('apolice.create');
Route::put('/apolice/{apolice}', [ApoliceController::class, 'update'])->name('apolice.update')->where('apolice', '[0-9]+');
Route::get('/apolice/{apolice}', [ApoliceController::class, 'show'])->name('apolice.show')->where('apolice', '[0-9]+');
Route::get('/apolice/{apolice}/edit', [ApoliceController::class, 'edit'])->name('apolice.edit')->where('apolice', '[0-9]+');
Route::get('/apolice', [ApoliceController::class, 'index'])->name('apolice.index');
Route::post('/apolice', [ApoliceController::class, 'store'])->name('apolice.store');
Route::get('/apolice/relatorio', [ApoliceController::class, 'relatorio'])->name('apolice.relatorio');
Route::post('/apolice/export', [ApoliceController::class, 'export'])->name('apolice.export');

Route::post('/apolice/relatorioResulmoApolice', [ApoliceController::class, 'relatorioResulmoApolice'])->name('apolice.relatorioResulmoApolice');



// Rotas para o gerenciamento de Banco
use App\Http\Controllers\admin\BancoController;
Route::match(['get', 'post'], '/banco/create', [BancoController::class, 'create'])->name('banco.create');
Route::put('/banco/{banco}', [BancoController::class, 'update'])->name('banco.update')->where('banco', '[0-9]+');
Route::get('/banco/{banco}', [BancoController::class, 'show'])->name('banco.show')->where('banco', '[0-9]+');
Route::get('/banco/{banco}/edit', [BancoController::class, 'edit'])->name('banco.edit')->where('banco', '[0-9]+');
Route::match(['get', 'post'],'/banco', [BancoController::class, 'index'])->name('banco.index');
Route::post('/banco/store', [BancoController::class, 'store'])->name('banco.store');

Route::get('/banco/export', [BancoController::class, 'export'])->name('banco.export');

use App\Http\Controllers\admin\CoberturaController;
// Rotas para o gerenciamento de Cobertura
Route::put('/cobertura/{cobertura}', [CoberturaController::class, 'update'])->name('cobertura.update')->where('cobertura', '[0-9]+');
Route::get('/cobertura/{cobertura}', [CoberturaController::class, 'show'])->name('cobertura.show')->where('cobertura', '[0-9]+');
Route::get('/cobertura/{cobertura}/edit', [CoberturaController::class, 'edit'])->name('cobertura.edit')->where('cobertura', '[0-9]+');
Route::get('/cobertura', [CoberturaController::class, 'index'])->name('cobertura.index');
Route::post('/cobertura', [CoberturaController::class, 'store'])->name('cobertura.store');
Route::match(['get', 'post'], '/cobertura/create', [CoberturaController::class, 'create'])->name('cobertura.create');
Route::get('/cobertura/getSubCoberturas/{cobertura}', [CoberturaController::class, 'getSubCoberturas'])->name('cobertura.getSubCoberturas');




// Rotas para o gerenciamento de Localizacoes
use App\Http\Controllers\LocalizacaoController;
Route::get('/provincias/{pais_id}', [LocalizacaoController::class, 'getProvincias'])->name('get.provincias');
Route::get('/municipios/{provincia_id}', [LocalizacaoController::class, 'getMunicipios'])->name('get.municipios');


// Rotas para o gerenciamento de Localizacoes
use App\Http\Controllers\admin\ClienteController;
Route::match(['get', 'post'],'/cliente', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/createImportacao', [ClienteController::class, 'createImportacao'])->name('cliente.createImportacao');
Route::post('/cliente/importarClientes', [ClienteController::class, 'importarClientes'])->name('cliente.importarClientes');
Route::post('/cliente/confirmarImportacao', [ClienteController::class, 'confirmarImportacao'])->name('cliente.confirmarImportacao');
Route::get('/cliente/download/{filename}', [ClienteController::class, 'download'])->name('cliente.download');

Route::post('/cliente/relatorioCensusSeguro', [ClienteController::class, 'relatorioCensusSeguro'])->name('cliente.relatorioCensusSeguro');
Route::post('/cliente/relatorioMaioresUtilizadores', [ClienteController::class, 'relatorioMaioresUtilizadores'])->name('cliente.relatorioMaioresUtilizadores');
Route::post('/cliente/relatorioCencusCronico', [ClienteController::class, 'relatorioCencusCronico'])->name('cliente.relatorioCencusCronico');



use App\Http\Controllers\admin\GuiaSeguroController;
Route::post('/guiaSeguro/RelatorioMonitoramentoAtendimento', [GuiaSeguroController::class, 'relatorioMonitoramentoAtendimento'])->name('guiaSeguro.relatorioMonitoramentoAtendimento');


use App\Http\Controllers\admin\OcorrenciaController;
Route::post('/ocorrencia/relatorioOcorrencia', [OcorrenciaController::class, 'relatorioOcorrencia'])->name('ocorrencia.relatorioOcorrencia');

use App\Http\Controllers\admin\PrestadoresCotroller;
Route::post('/prestadores/relatorioPrestador', [PrestadoresCotroller::class, 'relatorioPrestador'])->name('prestadores.relatorioPrestador');


use App\Http\Controllers\admin\RelatorioController;
Route::post('/relatorio/relatorioPreAutorizacao', [RelatorioController::class, 'relatorioPreAutorizacao'])->name('relatorio.relatorioPreAutorizacao');
Route::post('/relatorio/relatorioApolicePadrap', [RelatorioController::class, 'relatorioApolicePadrap'])->name('relatorio.relatorioApolicePadrap');
Route::post('/relatorio/relatorioFaturamentoEmpresa', [RelatorioController::class, 'relatorioFaturamentoEmpresa'])->name('relatorio.relatorioFaturamentoEmpresa');
Route::post('/relatorio/relatorioCapaDeLote', [RelatorioController::class, 'relatorioCapaDeLote'])->name('relatorio.relatorioCapaDeLote');
Route::post('/relatorio/relatorioFaturamentoResumo', [RelatorioController::class, 'relatorioFaturamentoResumo'])->name('relatorio.relatorioFaturamentoResumo');
Route::post('/relatorio/relatorioFaturamentoAnalitico', [RelatorioController::class, 'relatorioFaturamentoAnalitico'])->name('relatorio.relatorioFaturamentoAnalitico');
Route::post('/relatorio/relatorioPrecoPestadores', [RelatorioController::class, 'relatorioPrecoPestadores'])->name('relatorio.relatorioPrecoPestadores');
Route::post('/relatorio/relatorioPrecoPrecricao', [RelatorioController::class, 'relatorioPrecoPrecricao'])->name('relatorio.relatorioPrecoPrecricao');
Route::post('/relatorio/relatorioReembolso', [RelatorioController::class, 'relatorioReembolso'])->name('relatorio.relatorioReembolso');
Route::post('/relatorio/relatorioFaturamentoPrestador', [RelatorioController::class, 'relatorioFaturamentoPrestador'])->name('relatorio.relatorioFaturamentoPrestador');
Route::post('/relatorio/relatorioFaturamentoColaborador', [RelatorioController::class, 'relatorioFaturamentoColaborador'])->name('relatorio.relatorioFaturamentoColaborador');
Route::post('/relatorio/relatorioCheckUp', [RelatorioController::class, 'relatorioCheckUp'])->name('relatorio.relatorioCheckUp');
Route::post('/relatorio/relatorioCheckUpFaturamento', [RelatorioController::class, 'relatorioCheckUpFaturamento'])->name('relatorio.relatorioCheckUpFaturamento');
Route::post('/relatorio/relatorioCheckUpGuia', [RelatorioController::class, 'relatorioCheckUpGuia'])->name('relatorio.relatorioCheckUpGuia');

Route::post('/relatorio/relatorioCesusLevel', [RelatorioController::class, 'relatorioCesusLevel'])->name('relatorio.relatorioCesusLevel');
Route::post('/relatorio/relatorioComissionamentoLevel', [RelatorioController::class, 'relatorioComissionamentoLevel'])->name('relatorio.relatorioComissionamentoLevel');









Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\admin\DashboardController;
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'destroy')->name('login.destroy');
});
