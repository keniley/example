<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContentUpdateRequest extends FormRequest
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
            'active' => 'boolean',
            'title' => 'string',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'body' => 'nullable|string',
            'url_slug' => 'nullable|string',
            'url_static' => 'nullable|boolean',
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
        'active.required' => 'Toto pole je požadováno',
        'active.boolean' => 'Zadejte platnou hodnotu 0, 1, true, false',
        'title.required' => 'Toto pole je požadováno',
        'title.string' => 'Toto pole je požadováno',
        'seo_title.required' => 'Toto pole je požadováno',
        'seo_description.required' => 'Toto pole je požadováno',
        'body.required' => 'Toto pole je požadováno',
        'url_slug.string' => 'Toto pole je požadováno',
        'url_static.boolean' => 'Zadejte platnou hodnotu 0, 1, true, false',
    ];
}
}
