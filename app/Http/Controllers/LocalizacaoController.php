<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Municipio;
use Illuminate\Http\Request;

class LocalizacaoController extends Controller
{
    // Retorna as províncias de um país específico
    public function getProvincias($pais_id)
    {
        $provincias = Provincia::where('pais_id', $pais_id)->get();

        return response()->json($provincias);
    }

    // Retorna os municípios de uma província específica
    public function getMunicipios($provincia_id)
    {
        $municipios = Municipio::where('provincia_id', $provincia_id)->get();
        return response()->json($municipios);
    }
}
