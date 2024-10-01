<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedimentoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Define se o usuário pode enviar a request
    }

    public function rules()
    {
        return [
            'prestador_id' => 'required|integer',
            'tipoprocedimento_id' => 'nullable|integer',
            'tipoatendimento_id' => 'nullable|integer',
            'cobertura_id' => 'nullable|integer',
            'coberturalimite_id' => 'nullable|integer',
            'codservico' => 'required|string|max:20',
            'descricao' => 'nullable|string|max:500',
            'ativo' => 'nullable|string|max:1',
            'valor' => 'nullable|numeric',
            'vlrfaturado' => 'nullable|numeric',
            'vlrsaudeMais' => 'nullable|numeric',
            'vlrdolar' => 'nullable|numeric',
            'vlrcotacao' => 'nullable|numeric',
            'tiporegra' => 'nullable|string|max:30',
            'gratuito' => 'nullable|string|max:1',
            'quantidadeitens' => 'nullable|integer',
            'quantidadedias' => 'nullable|integer',
            'ean' => 'nullable|string|max:255',
        ];
    }
}
