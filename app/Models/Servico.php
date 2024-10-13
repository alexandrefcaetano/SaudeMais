<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $table = 'tb_servico'; // Nome da tabela
    protected $primaryKey = 'id_servico'; // Chave primária

    public $timestamps = true; // Defina como true se você tiver campos created_at e updated_at

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'S';
    public const STATUS_INATIVO = 'N';


    protected $fillable = [
        'prestador_id',
        'tiposervico_id',
        'tipoatendimento_id',
        'cobertura_id',
        'coberturalimite_id',
        'tipoprocedimento_id',
        'codservico',
        'descricao',
        'ativo',
        'valor',
        'vlrfaturado',
        'vlrsaudemais',
        'vlrdolar',
        'vlrcotacao',
        'tiporegra',
        'gratuito',
        'quantidadeitens',
        'quantidadedias',
        'ean',
    ];

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
