<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'tb_municipio';
    protected $primaryKey = 'id_municipio';
    public $timestamps = true;

    protected $fillable = [
            'provincia_id',
            'municipio',
            'cod_ibge_completo',
            'latitude',
            'longitude',
            'hemisferio',
            'altitude',
            'area',
            'cep_menor',
            'cep_maior',
            'raio',
            'meridiano',
            'populacao',
            'populacao_homem',
            'populacao_mulher',
            'populacao_urbana',
            'populacao_rural',
            'lat',
            'long'
    ];

}
