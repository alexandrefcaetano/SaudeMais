<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanoRequest extends FormRequest
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
            'plano' => 'required|string|max:100',
            'valor' => 'required|numeric',
            'ativo' => 'required|string|max:1',
            'validade' => 'nullable|integer',
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
            'plano.required' => 'O campo plano é obrigatório.',
            'valor.required' => 'O campo valor é obrigatório.',
            'ativo.required' => 'O campo ativo é obrigatório.',
            'validade.integer' => 'O campo validade deve ser um número inteiro.',
        ];
    }
}
