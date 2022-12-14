<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'logo'   => 'image|dimensions:min_width=100,min_height=100',
            'name'     => 'required|string',
            'email'    => 'email|string|unique:App\Models\Company,email',
            'website' => 'string',
        ];
    }
}
