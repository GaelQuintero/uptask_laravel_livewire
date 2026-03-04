<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:1',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe de tener al menos un caracter',

            'email.required' => 'El e-mail es obligatorio',
            'email.email' => 'E-mail no válido',
            'email.unique' => 'El e-mail ya esta registrado',

            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres',

            'confirm_password' => 'La contraseña no coincide'
        ];
    }
}
