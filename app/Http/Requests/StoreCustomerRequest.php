<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
			'first_name' => 'required|max:100',
			'last_name' => 'required|max:150',
			'shop_id' => 'required|numeric',
			'email' => 'nullable|unique:customers,email|max:100',
			'phone' => 'nullable|max:100'
		];
	}
}
