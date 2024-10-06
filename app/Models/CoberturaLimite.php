<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoberturaLimite extends Model
{
    protected $table = 'tb_coberturalimite';
    protected $primaryKey = 'id_coberturaLimite';
    protected $fillable = [
        'cobertura_id', 'coberturalimite', 'status', 'statuspadrao', 'alertasms'
    ];
}
