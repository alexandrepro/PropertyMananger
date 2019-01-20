<?php

namespace PropertyManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequestValidation extends FormRequest
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
			'address_line_1' => 'required|min:3',
			'city_id' => 'required|not_in:all',
			'postcode' => 'required|min:3'
		];
	}

	/**
	 * Custom message for validation
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'address_line_1.required' => 'Fill the Address Line 1 field.',
			'city_id.not_in' => 'Select a city.',
			'postcode.required' => 'Fill the Postcode.'
		];

	}
}