<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'tb_banco';
    protected $primaryKey = 'id_banco';

    protected $fillable = [
        'banco',
        'ativo',
        'provincia_id',
        'municipio_id',
        'pais_id',
        'codigoSwift',
    ];
}
