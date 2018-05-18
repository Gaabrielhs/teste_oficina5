<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
            'name.unique' => 'Contato :input já adicionado',
            'email.required' => 'O email é obrigatório',
            'phone_number.required' => 'O telefone é obrigatório',
            'phone_number.min' => 'Telefone inválido',
            'phone_number.unique' => 'Telefone já adicionado',
            'birthdate.required' => 'A data de nascimento é obrigatória',
        ];
    }

   
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData() {
        //Formata o telefone antes de comparar o unique da rule abaixo
        return array_merge(
            $this->all(),
            [
                'phone_number' => str_replace(['(', ')', '-', ' '], '',$this->phone_number)
            ]
        );
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
            'name' => ['required', Rule::unique('contatos')->where(function ($query) {
                return $query->where('id_user', Auth::user()->id);
            })],
            'phone_number' => ['required','min:10',Rule::unique('contatos')->where(function ($query) {
                return $query->where('id_user', Auth::user()->id);
            })],
            'birthdate' => 'required|min:10'
        ];

    }
}
