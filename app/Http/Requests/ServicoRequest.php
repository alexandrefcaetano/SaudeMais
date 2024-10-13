<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permite que qualquer usuário faça esta requisição
    }

    public function rules()
    {
        return [
            'prestador_id' => 'required|integer',
            'tiposervico_id' => 'nullable|integer',
            'tipoatendimento_id' => 'nullable|integer',
            'cobertura_id' => 'nullable|integer',
            'coberturalimite_id' => 'nullable|integer',
            'tipoprocedimento_id' => 'nullable|integer',
            'codservico' => 'required|string|max:20',
            'descricao' => 'nullable|string|max:500',
            'ativo' => 'nullable|string|max:1',
            'valor' => 'nullable|numeric',
            'vlrfaturado' => 'nullable|numeric',
            'vlrsaudemais' => 'nullable|numeric',
            'vlrdolar' => 'nullable|numeric',
            'vlrcotacao' => 'nullable|numeric',
            'tiporegra' => 'nullable|string|max:30',
            'gratuito' => 'nullable|string|max:1',
            'quantidadeitens' => 'nullable|integer',
            'quantidadedias' => 'nullable|integer',
            'ean' => 'nullable|string|max:255',
        ];
    }

    // Opcional: Mensagens personalizadas
    public function messages()
    {
        return [
            'idprestador.required' => 'O campo prestador é obrigatório.',
            'codservico.required' => 'O campo código do serviço é obrigatório.',
            // Adicione mais mensagens personalizadas conforme necessário
        ];
    }
}
