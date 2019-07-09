<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecifierRequest extends FormRequest
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
            'cpf' => 'bail|required|numeric|digits:11|unique:specifiers,cpf',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'profession' => 'required|max:50',
            'date_birth' => 'required|date',
            'phone' => 'bail|required|numeric|digits_between:8,13|',
            'zip_code' => 'bail|required|numeric|digits:8',
            'state' => 'required|size:2',
            'city' => 'required|max:50'            
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
            'cpf.required' => 'O CPF é obrigatório',
            'cpf.digits' => 'O CPF deve ter 11 caractéres',
            'cpf.numeric' => 'O CPF só pode ter números',
            'cpf.unique' => 'Este CPF já está cadastrado',

            'first_name.required' => 'First Name é obrigatório',
            'first_name.max' => 'First Name deve ter no máximo 50 caractéres',

            'last_name.required' => 'Last Name é obrigatório',
            'last_name.max' => 'Last Name deve ter no máximo 50 caractéres',

            'profession.required' => 'Profession é obrigatório',
            'profession.max' => 'Profession deve ter no máximo 50 caractéres',

            'date_birth.required' => 'Date Birth é obrigatório',
            'date_birth.date' => 'Date Birth não é uma data válida (yyyy-mm-dd)',

            'phone.required' => 'Phone é obrigatório',
            'phone.digits_between' => 'Phone deve ter no mínino 8 caractéres e no máximo 13',
            'phone.numeric' => 'Phone só pode ter números',

            'zip_code.required' => 'Zip Code é obrigatório',
            'zip_code.digits' => 'Zip Code deve ter 8 caractéres',
            'zip_code.numeric' => 'Zip Code só pode ter números',

            'state.required' => 'State é obrigatório',
            'profession.size' => 'State deve ter no máximo 2 caractéres',

            'city.required' => 'City é obrigatório',
            'city.max' => 'City deve ter no máximo 50 caractéres'
        ];
    }
}
