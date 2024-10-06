<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProcedimento extends Model
{
    protected $table = 'tb_tipoprocedimento';
    protected $primaryKey = 'id_tipoprocedimento';
    protected $fillable = ['principal', 'secundaria', 'ativo'];
}
