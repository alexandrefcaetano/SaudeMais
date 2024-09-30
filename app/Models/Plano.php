<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    protected $table = 'tb_plano';
    protected $primaryKey = 'id_plano';

    protected $fillable = [
        'plano',
        'valor',
        'ativo',
        'validade',
        'excluido',
    ];

    public $timestamps = true;
}
