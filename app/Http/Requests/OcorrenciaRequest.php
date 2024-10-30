<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OcorrenciaRequest extends FormRequest
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
            'cliente_id' => 'nullable|integer',
            'motivo_ocorrencia' => 'nullable|string|max:45',
            'status' => 'nullable|string|max:1',
            'pergunta' => 'nullable|string',
            'resposta' => 'nullable|string',
            'satisfacao' => 'nullable|string|max:1',
            'nota' => 'nullable|string|max:2',
            'criado_por' => 'required|integer',
            'criado_em' => 'required|date',
            'atualizado_por' => 'nullable|integer',
            'atualizado_em' => 'nullable|date',
            'excluido' => 'boolean'
        ];
    }
}
