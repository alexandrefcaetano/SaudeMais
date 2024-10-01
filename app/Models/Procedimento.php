<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $table = 'tb_procedimento';
    protected $primaryKey = 'id_procedimento';
    protected $fillable = [
        'prestador_id',
        'tipoprocedimento_id',
        'tipoatendimento_id',
        'cobertura_id',
        'coberturalimite_id',
        'codservico',
        'descricao',
        'ativo',
        'valor',
        'vlrfaturado',
        'vlrsaudeMais',
        'vlrdolar',
        'vlrcotacao',
        'tiporegra',
        'gratuito',
        'quantidadeitens',
        'quantidadedias',
        'ean'
    ];
}
