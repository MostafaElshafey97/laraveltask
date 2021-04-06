<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // todo add authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'email' => 'nullable|unique:shops|string|max:100',
            'logo' => 'image|mimes:jpeg,bmp,png|max:2000',
            'website' => 'nullable|string|max:300',
        ];
    }

  
}
