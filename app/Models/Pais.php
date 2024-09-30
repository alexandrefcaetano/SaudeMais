<?php

namespace App\Models;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pais extends Model
{
    use HasFactory;
    protected $table = 'tb_pais';
    protected $primaryKey = 'id_pais';
    public $timestamps = true;

    protected $fillable = [
        'pais'
    ];

    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }

}
