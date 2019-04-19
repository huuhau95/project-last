<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToppingRequest extends FormRequest
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
            'name' => 'required|max:200|unique:toppings,name,' . $this->route('topping'),
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is empty',
            'name.max' => 'Name is too long',
            'name.unique' => 'Name has been used',
            'price.required' => 'Price is empty',
            'price.min' => 'Price is too small',
            'price.numeric' => 'Price is number',
            'quantity.required' => 'Quantity is empty',
            'quantity.numeric' => 'Quantity is number',
            'quantity.min' => 'Quantity is too small',
        ];
    }
}
