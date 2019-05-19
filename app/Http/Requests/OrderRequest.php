<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|min:6|max:191',
            'order_place' => 'required|min:6|max:191',
            'order_phone' => 'required|digits_between:9,11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc',
            'name.max' => 'Tên không được vượt quá 191 ký tự',
            'order_place.required' => 'Địa chỉ là bắt buộc',
            'order_place.max' => 'Địa chỉ không được vượt quá 191 ký tự',
            'order_phone.required' => 'Số điện thoại là bắt buộc',
            'order_phone.digits_between' => 'Số điện thoại chỉ được từ 9 đến 11 ký tự',
        ];
    }
}
