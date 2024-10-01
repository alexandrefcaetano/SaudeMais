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

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'S';
    public const STATUS_INATIVO = 'N';


    protected $fillable = [
        'especialidade',
        'ativo'
    ];

    // Relacionamento muitos-para-muitos com Médicos
    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'tb_medico_especialidade', 'especialidade_id', 'medico_id');
    }
    public function getStatusBadge()
    {
        $statusOptions = [
            self::STATUS_ATIVO => ['label' => 'Ativo', 'class' => 'kt-badge--success'],
            self::STATUS_INATIVO => ['label' => 'Inativo', 'class' => 'kt-badge--danger'],
        ];

        $status = $statusOptions[$this->ativo] ?? ['label' => 'Desconhecido', 'class' => 'kt-badge--secondary'];

        return sprintf(
            '<span class="kt-badge kt-badge--inline %s">%s</span>',
            $status['class'],
            $status['label']
        );
    }
}
