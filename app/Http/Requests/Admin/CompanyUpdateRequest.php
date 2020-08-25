<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Model\Company;

class CompanyUpdateRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'street' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'zip' => 'required|string|min:5',
            'phone' => 'required|string|min:9',
            'email' => 'required|string|email',
            'number' => 'required|string|min:8',
            'vat' => 'string',
            'is_vat' => 'required|boolean',
            'registration' => 'string',
            'bank_name' => 'required|string',
            'bank_number' => 'required|string',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $is_vat = (bool)request()->get('is_vat');
            $vat = request()->get('vat');

            if($is_vat) {
                if($vat === null || $vat === '') {
                    $validator->errors()->add('vat', 'Pokud jste plátci DPH, musíte vyplnit IČ.');
                }  
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Musíte vyplnit název nadpis adresy.',
            'name.string' => 'Musíte vyplnit název nadpis adresy.',
            'name.min' => 'Název firmy musí mít alespoň 3 znaky',

            'street.required' => 'Musíte vyplnit ulici.',
            'street.string' => 'Musíte vyplnit ulici.',
            'street.min' => 'Ulice firmy musí mít alespoň 3 znaky',

            'city.required' => 'Musíte vyplnit město.',
            'city.string' => 'Musíte vyplnit město.',
            'city.min' => 'Město firmy musí mít alespoň 3 znaky',

            'zip.required' => 'Musíte vyplnit PSČ.',
            'zip.string' => 'Musíte vyplnit PSČ.',
            'zip.min' => 'PSČ firmy musí mít alespoň 5 znaků',

            'phone.required' => 'Musíte vyplnit kontaktní telefon.',
            'phone.string' => 'Musíte vyplnit kontaktní telefon.',
            'phone.min' => 'Kontaktní telefon firmy musí mít alespoň 9 znaků',

            'email.required' => 'Musíte vyplnit kontaktní email.',
            'email.string' => 'Musíte vyplnit kontaktní email.',
            'email.min' => 'Zadejte platný email',

            'number.required' => 'Musite vyplnit Ič firmy',
            'number.string' => 'Musíte vyplnit IČ firmy',

            'is_vat.required' => 'Zvolte, zda je firma plátcem DPH',
            'is_vat.boolean' => 'Zadejte logickou hodnotu (0,1, true, false)',

            'registration.string' => 'Musíte vyplnit zápis v obchodním rejstříku (nebo ponechat prázdné)',

            'bank_name.required' => 'Název banky u bankovního spojení musí být vyplněn',
            'bank_name.string' => 'Název banky u bankovního spojení musí být vyplněn',

            'bank_number.required' => 'Číslo účtu u bankovního spojení musí být vyplněno',
            'bank_number.string' => 'Číslo účtu u bankovního spojení musí být vyplněno',
        ];
    }
}
