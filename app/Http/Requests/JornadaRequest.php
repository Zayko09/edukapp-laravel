<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JornadaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $jornadaId = $this->route('jornada')?->jornada_id;

        return [
            'nombre_jornada' => [
                'required',
                'string',
                'max:50',
                'min:2',
                Rule::unique('jornadas', 'nombre_jornada')->ignore($jornadaId, 'jornada_id'),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_jornada.required' => 'El nombre de la jornada es obligatorio.',
            'nombre_jornada.string' => 'El nombre debe ser una cadena de texto.',
            'nombre_jornada.max' => 'El nombre no puede tener más de 50 caracteres.',
            'nombre_jornada.min' => 'El nombre debe tener al menos 2 caracteres.',
            'nombre_jornada.unique' => 'Ya existe una jornada con este nombre.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre_jornada' => trim($this->nombre_jornada),
        ]);
    }
}