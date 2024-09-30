<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobertura extends Model
{
    use HasFactory;

    protected $table = 'tb_cobertura';

    protected $primaryKey = 'id_cobertura';

    protected $fillable = [
        'cobertura',
        'ativo',
        'alertaSMS',
    ];
}
