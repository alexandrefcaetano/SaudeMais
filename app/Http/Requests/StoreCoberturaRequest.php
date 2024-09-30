<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoberturaRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação para a requisição.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cobertura' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:1',
            'alertaSMS' => 'nullable|string|max:1|in:N,S',
        ];
    }
}
