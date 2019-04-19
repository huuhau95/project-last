<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name'        => 'required|max:191',
            'email'       => 'required|email|unique:users,email|max:191',
            'password'    => 'required|min:6|max:50',
            're_password' => 'same:password',
            'address'     => 'required|max:191',
            'phone'       => 'required|min:9|max:11',
            'role'        => 'required',
            'avatar'      => 'mimes:jpg,png,jpeg|nullable',
        ];
    }

    public function messages()
    {
        // update
        return [
            'name.required'        => __('validation.required', ['attribute' => 'name']),
            'name.max'             => 'Name must smaller 191 character !',
            'email.required'       => 'Enter your email !',
            'email.email'          => 'Not is a email !',
            'email.unique'         => 'This email has taken !',
            'email.max'            => 'Email must less than 191 character !',
            'password.required'    => 'Enter user password !',
            'password.max'         => 'Password must smaller 191 character !',
            're_password.required' => 'Enter re_password !',
            're_password.same'     => 'Password not same !',
            'address.required'     => 'Enter user address !',
            'address.max'          => 'Address must smaller 191 character !',
            'phone.required'       => 'Enter user phone number !',
            'phone.max'            => 'Phone must smaller 11 number !',
            'phone.min'            => 'Phone must at least 10 number !',
            'role.required'        => 'Select role !',
            'avatar.mimes'         => 'Not a image !',
        ];
    }
}
