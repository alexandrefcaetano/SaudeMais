<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    protected $table = 'tb_prestador';
    protected $primaryKey = 'id_prestador';
    protected $fillable = [
        'especialidade_id', 'provincia_id', 'municipio_id', 'pais_id', 'seguradora_id', 'tipoatendimento_id',
        'banco_id', 'tipopessoa', 'razaosocial', 'nomefantasia', 'idTipoprestador', 'observacao', 'nif', 'ativo',
        'cambio', 'iban', 'contato', 'cotacaodolar', 'codigoprestador', 'logoprestador', 'descontoprescricao',
        'seguroplano', 'descontoprescricaoacesso', 'exibirsite', 'aptocheckup', 'contacorrente', 'prazopagamento',
        'utilizadigital', 'lat', 'long', 'geolocalizacao', 'dtiniciovontrato', 'exigirvalorprocedimento',
        'convertervalorMoeda', 'acrescimomoeda', 'liberarguiaGratuita', 'seguirregracoparticipacao', 'responsavelfinanceiro'
    ];
}
