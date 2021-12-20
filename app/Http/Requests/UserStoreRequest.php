<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|numeric',
            'username' => 'required|unique:users,username',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'numeric' => 'El campo :attribute debe ser numerico',
            'unique' => 'El campo :attribute ya ha sido registrado',
            'email' => 'El campo :attribute debe ser un correo',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'phone' => 'telefono',
            'username' => 'usuario',
            'birthday' => 'fecha de nacimiento',
            'email' => 'correo',
        ];
    }
}
