<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    protected $table = 'tb_provincia';
    protected $primaryKey = 'id_provincia';
    public $timestamps = true;

    protected $fillable = [
        'regiao_id',
        'pais_id',
        'sigla',
        'provincia',
        'codigo_ibge'
    ];


    public function provincias()
    {
        return $this->hasMany(Municipio::class);
    }
    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

}
