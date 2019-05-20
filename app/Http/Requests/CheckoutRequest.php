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
            'receiver.required' => 'Tên là bắt buộc',
            'receiver.max' => 'Tên không được vượt quá 100 ký tự',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'place.required' => 'Địa chỉ là bắt buộc',
            'place.max' => 'Địa chỉ không được vượt quá 300 ký tự',
            'phone.digits_between' => 'Số điện thoại không đúng định dạng',
            'phone.required' => 'Số điện thoại là bắt buộc',
            'note.max' => 'Chú thích không được vượt quá 300 ký tự',
        ];
    }
}
