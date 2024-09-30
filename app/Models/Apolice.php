<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apolice extends Model
{
    // Define o nome da tabela
    protected $table = 'tb_apolice';

    // Define o nome da chave primária
    protected $primaryKey = 'id_apolice';

    // Define se a chave primária é auto-incrementada
    public $incrementing = true;

    // Define se o Laravel deve gerenciar created_at e updated_at
    public $timestamps = false;

    // Definir os campos que podem ser preenchidos em massa
    protected $fillable = [
        'seguradora_id',
        'empresa_id',
        'prestadorExcecao_id',
        'codigoApolice',
        'apolice',
        'planoApolice',
        'apoliceSeguradora',
        'ipoMoeda',
        'valorLimiteApolice',
        'dataInicioCobertura',
        'dataFimCobertura',
        'dataCancelamento',
        'dataCadastro',
        'dataAlteracao',
        'excecaoAtendimentoObstetricia',
        'renovacaoLimite',
        'status',
        'permiteReembolso',
        'seguirTipoRegra',
        'redeInternacional',
        'utilizaDigital',
        'regraCronico',
        'regraIdoso',
        'resseguro',
        'liberarGuiaGratuita',
        'motivoCancelamento',
        'observacao'
    ];
}
