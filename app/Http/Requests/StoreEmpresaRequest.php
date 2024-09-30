<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpresaRequest extends FormRequest
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
            'nomeFantasia' => 'nullable|string|max:145',
            'ativo' => 'nullable|string|max:1',
            'nif' => 'nullable|string|max:30',
            'razaoSocial' => 'nullable|string|max:150',
            'ramoAtividade' => 'nullable|string|max:100',
            'morada' => 'nullable|string|max:145',
            'corretor' => 'nullable|string|max:145',
            'contato' => 'nullable|json',
            'observacao' => 'nullable|string',
            'visualizarRelAtendimento' => 'nullable|string|max:1',
            'seguradora' => 'required'
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
            'contato.json' => 'O campo contato deve ser um JSON válido.',
            'seguradora_id.exists' => 'O campo seguradora_id deve existir na tabela tb_seguradora.',
            'id_cryto.required' => 'O campo id_cryto é obrigatório.',
            'id_cryto.size' => 'O campo id_cryto deve ter exatamente :size caracteres.', // Adicionando uma mensagem personalizada
        ];
    }
}
