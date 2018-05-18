<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditPassword extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required' => 'Campo de nova senha não pode ser vazio.',
            'password.min' => 'Campo de nova senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'Campo de confirmação incorreto.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldPassword' => function($attribute, $value, $fail){
                if(!Hash::check($value, Auth::user()->password)){
                    return $fail('Senha incorreta');
                }
            },
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
