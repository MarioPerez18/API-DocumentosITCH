<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class RegistroRequest extends FormRequest
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
            'paternalSurname' => ['required', 'string'],
            'maternalSurname' => ['required', 'string'],
            'names' => ['required', 'min:4', 'max:30', 'string'],
            'gender' => ['required'],
            'phoneNumber' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRules::min(6)->letters()->numbers()
            ],
            'institution_id' => ['required']
        ];
    }


    public function messages(){
        return [
            'names' => 'El Nombre es obligatorio',
            'email.required' => 'El Email es obligatorio',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El usuario ya esta registrado',
            'password' => 'La contraseña debe contener al menos 6 caracteres y un número'
        ];
    }


}
