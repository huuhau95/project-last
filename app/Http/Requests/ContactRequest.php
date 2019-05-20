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
            'name.required' => 'Tên là bắt buộc',
            'name.max' => 'Tên không được vượt quá 200 ký tự',
             'email.required' => 'Email là bắt buộc',
             'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được vượt quá 200 ký tự',
             'phone.required' => 'Số điện thoại là bắt buộc',
            'phone.max' => 'Số điện thoại không được vượt quá 200 ký tự',
             'message.required' => 'Nội dung là bắt buộc',
            'message.max' => 'Nội dung không được vượt quá 200 ký tự',
        ];
    }
}
