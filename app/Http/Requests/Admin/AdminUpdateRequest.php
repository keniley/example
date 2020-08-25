<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
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
            'active' => 'required|boolean',
            'name' => 'required|string|min:3',
            'password' => 'nullable|string|min:6',
            'password2' => 'nullable|required_with:password|same:password',
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
            'active.required' => 'Zvolte, zda je administrátor aktivní',
            'active.boolean' => 'Zadejte logickou hodnotu 0 nebo 1',

            'name.required' => 'Musíte vyplnit jméno administrátora',
            'name.string' => 'Jméno administrátora musí být text',
            'name.min' => 'Jméno administrátora musí mít alespoň 3 znaky',

            'password.string' => 'Nové heslo administrátora musí být text',
            'password.min' => 'Nové heslo administrátora musí mít alespoň 6 znaků',

            'password2.required_with' => 'Musíte zadat kontrolu nového hesla',
            'password2.same' => 'Heslo a kontrola nového hesla se neshodují',
        ];
    }
}
