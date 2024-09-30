<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCidRequest extends FormRequest
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
            'codigo_cid' => 'nullable|string|max:45',
            'cid' => 'nullable|string|max:500',
            'tiporegra' => 'nullable|string|max:45',
            'ativo' => 'nullable|string|max:1',
            'cobertura' => 'nullable|max:200'
        ];
    }

    protected function prepareForValidation()
    {
        // Descriptografar os IDs das coberturas
        if ($this->has('cobertura')) {
            $coberturasDescriptografadas = array_map(function ($id) {
                return decrypitar($id); // Descriptografa o ID da cobertura
            }, $this->cobertura);
            // Sobrescreve o valor das coberturas com os IDs descriptografados
            $this->merge([
                'cobertura' => $coberturasDescriptografadas,
            ]);
        }
    }
}
