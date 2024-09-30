<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Empresa extends Model
{
    protected $table = 'tb_empresa';
    protected $primaryKey = 'id_empresa';

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

}
