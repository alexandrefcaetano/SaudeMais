<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'tb_medico';
    protected $primaryKey = 'id_medico';
    protected $fillable = ['medico', 'crm', 'ativo', 'tipo', 'contato', 'senha'];
    protected $casts = [
        'contato' => 'array', // JSONB
    ];

    /// Relacionamento muitos-para-muitos com Especialidades
    public function especialidades()
    {
        return $this->belongsToMany(
            Especialidade::class,         // Model relacionado
            'tb_medico_especialidade',    // Nome da tabela pivô
            'medico_id',                  // Chave estrangeira no pivô para médico
            'especialidade_id'            // Chave estrangeira no pivô para especialidade
        );
    }
}
