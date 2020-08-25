<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OfficeUpdateRequest extends FormRequest
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
            // main
            'active' => 'required|boolean',
            'default' => 'required|boolean',
            'title' => 'required|string|min:3',
            'street' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'zip' => 'required|string|min:5',
            'phone' => 'required|string|min:9',
            'email' => 'required|string|email',
            'map' => 'required|string|url',
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
            'active.required' => 'Zvolte, zda je adresa aktivní.',
            'active.boolean' => 'Zvolte, zda je adresa aktivní.',

            'default.required' => 'Zvolte, zda je adresa nastavene jako výchozí (pro web).',
            'default.boolean' => 'Zvolte, zda je adresa nastavene jako výchozí (pro web).',

            'title.required' => 'Musíte vyplnit název adresy.',
            'title.string' => 'Musíte vyplnit název adresy.',
            'title.min' => 'Název adresy musí mít alespoň 3 znaky',

            'street.required' => 'Musíte vyplnit ulici.',
            'street.string' => 'Musíte vyplnit ulici.',
            'street.min' => 'Ulice adresy musí mít alespoň 3 znaky',

            'city.required' => 'Musíte vyplnit město.',
            'city.string' => 'Musíte vyplnit město.',
            'city.min' => 'Město adresy musí mít alespoň 3 znaky',

            'zip.required' => 'Musíte vyplnit PSČ.',
            'zip.string' => 'Musíte vyplnit PSČ.',
            'zip.min' => 'PSČ adresy musí mít alespoň 5 znaků',

            'phone.required' => 'Musíte vyplnit kontaktní telefon.',
            'phone.string' => 'Musíte vyplnit kontaktní telefon.',
            'phone.min' => 'Telefon adresy musí mít alespoň 9 znaků',

            'email.required' => 'Musíte vyplnit kontaktní email.',
            'email.string' => 'Musíte vyplnit kontaktní email.',
            'email.email' => 'Zadejte platný tvar emailu',

            'map.required' => 'Musíte vyplnit URL google mapy',
            'map.string' => 'Musíte vyplnit URL google mapy',
            'map.url' => 'Zadejte platnou URL adresu',
        ];
    }
}
