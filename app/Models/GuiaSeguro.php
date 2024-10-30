<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaSeguro extends Model
{
    use HasFactory;

    protected $table = 'tb_guiaseguro';
    protected $primaryKey = 'id_guiaseguro';

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'S';
    public const STATUS_INATIVO = 'N';


    public function getStatusBadge()
    {
        $statusOptions = [
            self::STATUS_ATIVO => ['label' => 'Ativo', 'class' => 'kt-badge--success'],
            self::STATUS_INATIVO => ['label' => 'Inativo', 'class' => 'kt-badge--danger'],
        ];

        $status = $statusOptions[$this->ativo] ?? ['label' => 'Desconhecido', 'class' => 'kt-badge-warning'];

        return sprintf(
            '<span class="kt-badge kt-badge--inline %s">%s</span>',
            $status['class'],
            $status['label']
        );

    }

    protected $fillable = [
        'prestador_id',
        'cliente_id',
        'tipoatendimento_id',
        'especialidade_id',
        'prestadorfilial_id',
        'seguradora_id',
        'motivocancelamento_id',
        'danos_id',
        'dataatendimento',
        'carater',
        'hipotesediagnostico',
        'valortotalpagar',
        'valortotalsaudemais',
        'valortotaldeducaofolha',
        'valoraproximado',
        'valoraprovadointernacao',
        'cotacaodolar',
        'tipoconsulta',
        'datainternamento',
        'diariassolicitadas',
        'tipointernacao',
        'tipoacomodacao',
        'tipoprescricao',
        'ativo',
        'observacaoprestador',
        'alertasms',
        'convertervalormoeda',
        'utilizoutoken'
    ];
}

