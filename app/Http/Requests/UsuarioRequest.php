<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->usuario->usuario_id ?? null;

        return [
            'numero_documento' => 'required|string|unique:usuarios,numero_documento,' . $userId . ',usuario_id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $userId . ',usuario_id',
            'password' => $userId ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'foto_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'activo' => 'boolean',
            'rol_id' => 'required|exists:roles,rol_id',
            'sede_id' => 'required|exists:sedes,sede_id',
            'jornada_id' => 'required|exists:jornadas,jornada_id',
            'ficha_id' => 'required|exists:fichas,ficha_id',
        ];
    }
}
