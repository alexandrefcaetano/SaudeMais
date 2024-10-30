<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    use HasFactory;

    protected $table = 'tb_ocorrencia';

    protected $primaryKey = 'id_ocorrencia';

    public $timestamps = false;

    protected $fillable = [
        'cliente_id',
        'motivo_ocorrencia',
        'status',
        'pergunta',
        'resposta',
        'satisfacao',
        'nota',
        'criado_por',
        'criado_em',
        'atualizado_por',
        'atualizado_em',
        'excluido'
    ];
}
