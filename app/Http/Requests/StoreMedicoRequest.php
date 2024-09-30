<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;

class StoreMedicoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Certifique-se de que isso é apropriado para o seu caso
    }

    public function rules()
    {
        return [
            'medico' => 'required|string|max:255',
            'crm' => 'required|string|max:20',
            'ativo' => 'nullable|string|max:1',
            'tipo' => 'required|string|max:50',
            'contato' => 'nullable|json',
            'especialidade' => 'required|array',
            'especialidade.*' => 'exists:tb_especialidade,id_especialidade', // Referencie a tabela correta
        ];
    }

    protected function prepareForValidation()
    {


        // Descriptografar os IDs das especialidades
        if ($this->has('especialidade')) {
            $especialidadesDescriptografadas = array_map(function ($id) {
                return decrypitar($id); // Descriptografa o ID da especialidade
            }, $this->especialidade);
            // Sobrescreve o valor das especialidades com os IDs descriptografados
            $this->merge([
                'especialidade' => $especialidadesDescriptografadas,
            ]);
        }
    }
}
