<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|max:200',
            'email' => 'required|max:200|email',
            'phone' => 'required|max:200',
            'message' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is empty',
            'name.max' => 'Name is too long',
             'email.required' => 'email is empty',
             'email.email' => 'email không đúng định dạng',
            'email.max' => 'email is too long',
             'phone.required' => 'phone is empty',
            'phone.max' => 'phone is too long',
             'message.required' => 'message is empty',
            'message.max' => 'message is too long',
        ];
    }
}
