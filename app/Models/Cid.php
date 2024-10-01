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

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'S';
    public const STATUS_INATIVO = 'N';

    protected $fillable = [
        'codigo_cid',
        'cid',
        'tiporegra',
        'ativo',
        'cobertura_id',
        'cobertura_limite_id',
    ];

    public function getStatusBadge()
    {
        $statusOptions = [
            self::STATUS_ATIVO => ['label' => 'Ativo', 'class' => 'kt-badge--success'],
            self::STATUS_INATIVO => ['label' => 'Inativo', 'class' => 'kt-badge--danger'],
        ];

        $status = $statusOptions[$this->ativo] ?? ['label' => 'Desconhecido', 'class' => 'kt-badge--warning'];

        return sprintf(
            '<span class="kt-badge kt-badge--inline %s">%s</span>',
            $status['class'],
            $status['label']
        );
    }
}
