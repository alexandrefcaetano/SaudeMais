<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Empresa extends Model
{
    protected $table = 'tb_empresa';
    protected $primaryKey = 'id_empresa';

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'S';
    public const STATUS_INATIVO = 'N';

    protected $fillable = [
        'nomefantasia',
        'ativo',
        'nif',
        'razaosocial',
        'ramoatividade',
        'morada',
        'corretor',
        'contato',
        'observacao',
        'visualizarrelatendimento',
        'seguradora_id',
    ];


    public $timestamps = true;

    // Definindo o relacionamento com a tabela tb_seguradora
    public function seguradora()
    {
        return $this->belongsTo(Seguradora::class, 'seguradora_id');
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
