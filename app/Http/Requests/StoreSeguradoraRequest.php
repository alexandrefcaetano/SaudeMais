<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeguradoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Ajuste isso conforme necessário para a sua lógica de autorização
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seguradora' => 'required|string|max:100',
            'nif' => 'required|string|max:30',
            'ativo' => 'required|string|max:1',
            'exibirSite' => 'nullable|string|max:1',
            'endereco' => 'nullable|string|max:150',
            'contato' => 'nullable|json',
            'exibirDanosCorporais' => 'nullable|string|max:1',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'seguradora.required' => 'O campo seguradora é obrigatório.',
            'nif.required' => 'O campo NIF é obrigatório.',
            'ativo.required' => 'O campo ativo é obrigatório.',
            'contato.json' => 'O campo contato deve ser um JSON válido.',
        ];
    }
}
