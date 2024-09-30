<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cid extends Model
{
    use HasFactory;

    protected $table = 'tb_cid';

    protected $primaryKey = 'id_cid';

    protected $casts = ['cobertura_id' => 'array'];


    protected $fillable = [
        'codigo_cid',
        'cid',
        'tiporegra',
        'ativo',
        'cobertura_id',
        'cobertura_limite_id',
    ];
}
