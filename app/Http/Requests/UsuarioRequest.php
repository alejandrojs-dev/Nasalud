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
        return [
            'nombre'    => 'required',
            'email'     => 'required|email|unique:usuarios,email,'. $this->usuario->id,
            'password'  => 'required',
            'rol_id'    => 'required|integer|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'El nombre de usuario es obligatorio',
            'email.required'    => 'El email es obligatorio',
            'email.unique'      => 'El email ingresado ya está en uso',
            'email.email'       => 'El email tiene un formato inválido',
            'password.required' => 'La contraseña es obligatoria',
            'rol_id.required'   => 'El rol del usuario es obligatorio',
            'rol_id.integer'    => 'El rol del usuario debe ser un valor entero',
            'rol_id.exists'     => 'El rol no se encuentra en existencia'
        ];
    }
}
