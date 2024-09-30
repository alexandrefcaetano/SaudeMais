<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'      => 'required|string|max:255',
            'status'    => 'required|string|in:AT,BL,IN',
            'sexo'      => 'required|string|in:M,F',
            'usuario'   => 'required|string|min:6|max:30',
            'contato'   => 'required'
        ];
    }
}
