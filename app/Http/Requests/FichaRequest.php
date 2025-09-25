<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
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
            'nombre_ficha' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'sede_id' => 'required|integer|exists:sedes,sede_id',
            'jornada_id' => 'required|integer|exists:jornadas,jornada_id',
        ];
    }
}