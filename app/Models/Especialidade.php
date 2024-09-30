<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{

    use HasFactory;

    protected $table = 'tb_especialidade';
    protected $primaryKey = 'id_especialidade';
    public $timestamps = true;

    protected $fillable = [
        'especialidade',
        'ativo'
    ];

    // Relacionamento muitos-para-muitos com Médicos
    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'tb_medico_especialidade', 'especialidade_id', 'medico_id');
    }
}
