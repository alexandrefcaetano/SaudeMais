<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'tb_usuarios'; // Nome da tabela no banco de dados

    protected $fillable = [
        'nome',
        'usuario',
        'contato',
        'sexo',
        'senha',
        'status',
    ];

    protected $hidden = [
        'senha', // Oculta a senha ao converter o modelo para um array ou JSON
    ];

    // Define a coluna de chave primária
    protected $primaryKey = 'id_usuario';

    // Define que as colunas created_at e updated_at devem ser preenchidas automaticamente
    public $timestamps = true;

    // Define possíveis valores para o campo 'status'
    public const STATUS_ATIVO = 'AT';
    public const STATUS_BLOQUEADO = 'BL';
    public const STATUS_INATIVO = 'IN';

    // Define os valores permitidos para status como constantes
    public static function getStatusOptions()
    {
        return [
            self::STATUS_ATIVO => 'Ativo',
            self::STATUS_BLOQUEADO => 'Bloqueado',
            self::STATUS_INATIVO => 'Inativo',
        ];
    }

    // Retorna o nome completo do status
    public function getStatusLabel()
    {
        $statusOptions = self::getStatusOptions();

        return $statusOptions[$this->status] ?? 'Desconhecido';
    }

    // Retorna o nome completo do sexo
    public function getSexoLabel()
    {
        return $this->sexo === 'M' ? 'Masculino' : ($this->sexo === 'F' ? 'Feminino' : 'Não especificado');
    }

    public function getStatusBadge()
    {
        $statusOptions = [
            self::STATUS_ATIVO => ['label' => 'Ativo', 'class' => 'kt-badge--success'],
            self::STATUS_BLOQUEADO => ['label' => 'Bloqueado', 'class' => 'kt-badge--dark'],
            self::STATUS_INATIVO => ['label' => 'Inativo', 'class' => 'kt-badge--warning'],
        ];

        $status = $statusOptions[$this->status] ?? ['label' => 'Desconhecido', 'class' => 'kt-badge--secondary'];

        return sprintf(
            '<span class="kt-badge kt-badge--inline %s">%s</span>',
            $status['class'],
            $status['label']
        );
    }

}
