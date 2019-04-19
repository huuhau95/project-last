<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:191',
            'password' => 'nullable|min:6|max:191',
            're_password' => 'same:password',
            'address' => 'required|max:191',
            'phone' => 'required|digits_between:9,11',
            'avatar' => 'mimes:jpeg,png,jpg|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Enter user name !',
            'name.max' => 'Name must smaller 191 character !',
            'password.max' => 'Password must smaller 191 character !',
            'password.min' => 'Password must at least 6 character !',
            're_password.same' => 'Password not same !',
            'address.required' => 'Enter user address !',
            'address.max' => 'Address must smaller 191 character !',
            'phone.required' => 'Enter user phone number !',
            'phone.digits_between' => 'Phone must smaller 11 and at least 9 number !',
            'avatar.mimes' => 'Extension is not true !',
        ];
    }
}
