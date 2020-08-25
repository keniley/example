<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'type' => 'required|in:question,course',
            'name' => 'nullable|string',
            'email' => 'required|string|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
            'gdpr' => 'required|accepted',
            'newsletter' => 'nullable|boolean',
            'course' => 'nullable',
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
            'type.required' => 'Zadejte typ zprávy',
            'type.in' => 'Zadejte správný typ zprávy',

            'name.string' => 'Zadejte své jméno',

            'email.required' => 'Musíte zadat svůj email',
            'email.string' => 'Musíte zadat svůj email',
            'email.email' => 'Email nemá platný tvar',

            'phone.string' => 'Zadejte svůj telefon',
            
            'message.required' => 'Musíte zadat text zprávy',
            'message.string' => 'Musíte zadat text zprávy',

            'gdpr.required' => 'Musíte souhlasit se zpracováním osobních údajů',
            'gdpr.accepted' => 'Musíte souhlasit se zpracováním osobních údajů',

            'newsletter.boolean' => 'Zvolte, zda souhlasíte či nesouhlasíte se zasíláním novinek',
        ];
    }
}
