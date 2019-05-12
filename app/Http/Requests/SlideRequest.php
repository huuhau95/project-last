<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            'name' => 'max:200|unique:slides,name,' . $this->route('slide'),
            'image' => 'mimes:jpeg,jpg,png|image',
        ];
    }

    public function messages()
    {
        return [
            'name.max' => 'Name is too long',
            'name.unique' => 'Name is taken',
            'image.mimes' => 'Image is jpg, jpeg or png',
            'image.image' => 'Not image',
        ];
    }
}
