<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBancoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Coloque a lógica de autorização aqui, se necessário.
    }

    /**
     * Regras de validação para a requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'banco' => 'nullable|string|max:100',
            'ativo' => 'nullable|string|max:1',
            'provincia' => 'nullable|integer',
            'municipio' => 'nullable|integer',
            'pais' => 'nullable|integer',
            'codigoSwift' => 'nullable|string|max:100',
        ];
    }
}
