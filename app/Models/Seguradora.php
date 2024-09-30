<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Seguradora extends Model
{
    protected $table = 'tb_seguradora';
    protected $primaryKey = 'id_seguradora';

    public $timestamps = true;

    protected $fillable = [
        'seguradora',
        'nif',
        'ativo',
        'exibirsite',
        'endereco',
        'contato',
        'exibirdanoscorporais',
    ];

    // Função que retorna um array de segurados para uma seguradora específica
    public static function getSeguradora($id_seguradora)
    {
        // Busca a seguradora pelo id_seguradora
        $seguradora = self::where('id_seguradora', $id_seguradora)->first();

        // Verifica se a seguradora foi encontrada
        if ($seguradora) {
            // Retorna os segurados relacionados como array
            return $seguradora;
        }

        // Retorna um array vazio se a seguradora não for encontrada
        return [];
    }


}
