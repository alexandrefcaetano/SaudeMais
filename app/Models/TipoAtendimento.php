<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAtendimento extends Model
{
    protected $table = 'tb_tipoatendimento';
    protected $primaryKey = 'id_tipoatendimento';
    protected $fillable = [
        'tipoatendimento', 'status', 'obrigatoriocid', 'acessos_id', 'coberturas_id'
    ];
}
