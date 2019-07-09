<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
            'cnpj' => 'bail|required|numeric|digits:14|unique:offices,cnpj',
            'fantasy_name' => 'required|max:50',
            'social_name' => 'required|max:50',
            'zip_code' => 'bail|required|numeric|digits:8'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cnpj.required' => 'O CNPJ é obrigatório',
            'cnpj.digits' => 'O CNPJ deve ter 14 caractéres',
            'cnpj.numeric' => 'O CNPJ só pode ter números',
            'cnpj.unique' => 'Este CNPJ já está cadastrado',

            'zip_code.required' => 'Zip Code é obrigatório',
            'zip_code.digits' => 'Zip Code deve ter 8 caractéres',
            'zip_code.numeric' => 'Zip Code só pode ter números',

            'fantasy_name.required' => 'Fantasy Name é obrigatório',
            'fantasy_name.max' => 'Fantasy Name deve ter no máximo 50 caractéres',

            'social_name.required' => 'Social Name é obrigatório',
            'social_name.max' => 'Social Name deve ter no máximo 50 caractéres',
        ];
    }
}
