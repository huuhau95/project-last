<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'name' => 'required|min:1|max:5|unique:sizes,name,' . $this->route('size'),
            'percent' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is empty',
            'name.unique' => 'Name has been used',
            'name.max' => 'Name is too long',
            'name.min' => 'Name is too short',
            'percent.required' => 'Percent is empty',
            'percent.numeric' => 'Percent is number',
        ];
    }
}
