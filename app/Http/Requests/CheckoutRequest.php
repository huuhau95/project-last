<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'receiver' => 'required|max:100',
            'email' => 'required|email',
            'place' => 'required|max:300',
            'phone' => 'required|digits_between:9,11',
            'note' => 'max:300',
        ];
    }

    public function messages()
    {
        return [
            'receiver.required' => 'Name is empty',
            'receiver.max' => 'Name must smaller 100 character',
            'email.required' => 'Email is empty',
            'email.email' => 'Email is wrong',
            'place.required' => 'Place is empty!',
            'place.max' => 'Address must smaller 300 character',
            'phone.digits_between' => 'Your phone is wrong !',
            'phone.required' => 'Phone is empty',
            'note.max' => 'Note must smaller 300 character',
        ];
    }
}
