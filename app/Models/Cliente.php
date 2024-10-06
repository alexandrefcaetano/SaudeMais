<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'tb_cliente';

    protected $fillable = [
        'pais_id',
        'provincia_id',
        'municipio_id',
        'plano_id',
        'empresa_id',
        'agente_id',
        'seguradora_id',
        'postocoleta_id',
        'apoliceplano_id',
        'apolice_id',
        'banco_id',
        'numerocartao',
        'nome',
        'genero',
        'contato',
        'datanascimento',
        'ativo',
        'nif',
        'lote',
        'bi',
        'validade',
        'dataativacao',
        'divisao',
        'dtiniciovigencia',
        'dtfimvigencia',
        'estadocivil',
        'parentesco',
        'datacancelamento',
        'motivocancelamento',
        'situacao',
        'diascarencia',
        'numeroempregado',
        'lotacao',
        'cargoempregado',
        'redeinternacional',
        'periodopagamento',
        'seguirregracarencia',
        'dtreferencia',
        'origem',
        'foto',
        'alertasms',
        'contacorrente',
        'iban',
        'fcmtoken',
        'carencia',
        'numeroseguradora',
        'naoperturbeemail',
        'dataprogramadacancelamento',
        'beneficiarioNecessitaAutorizacao'
    ];

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
}
