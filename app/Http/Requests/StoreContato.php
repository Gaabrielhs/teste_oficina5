<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreContato extends FormRequest
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
            'name.required' => 'O nome é obrigatório',
            'name.unique' => 'Já existe contato com esse nome cadastrado.',
            'phone_number.unique' => 'Já existe contato com esse nº de telefone.',
            'email.required' => 'O email é obrigatório',
            'phone_number.required' => 'O telefone é obrigatório',
            'phone_number.min' => 'Telefone inválido',
            'birthdate.required' => 'A data de nascimento é obrigatória',
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
            'email' => 'required|max:255',
            'name' => 'required|unique:contatos,name,'.Request::user()->id.'id_user',
            'phone_number' => 'required|min:14|unique:contatos,phone_number,'.Request::user()->id.'id_user',
            'birthdate' => 'required|min:10',
            'phone_number_mask' => '',
            'id_user'=>'required'
        ];
    }
}
