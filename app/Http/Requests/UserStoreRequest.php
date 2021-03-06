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
            'name.required'        => 'Tên là bắt buộc'
            'name.max'             => 'Tên không được vượt quá 191 ký tự',
            'email.required'       => 'Email là bắt buộc',
            'email.email'          => 'Email không đúng định dạng',
            'email.unique'         => 'Email đã tồn tại',
            'email.max'            => 'Email không được vượt quá 191 ký tự',
            'password.required'    => 'Mật khẩu là bắt buộc',
            'password.max'         => 'Mật khẩu phải từ 6 đến 50 ký tự',
            're_password.required' => 'Nhập lại mật khẩu là bắt buộc',
            're_password.same'     => 'Mật khẩu không khớp',
            'address.required'     => 'Địa chỉ là bắt buộc',
            'address.max'          => 'Địa chỉ không được vượt quá 191 ký tự',
            'phone.required'       => 'Số điện thoại là bắt buộc',
            'phone.max'            => 'Số điện thoại không được vượt quá 11 ký tự',
            'phone.min'            => 'Số điện thoại phải từ 9 ký tự trở lên',
            'role.required'        => 'Bạn cần chọn vai trò',
            'avatar.mimes'         => 'Đây không phải là ảnh',
        ];
    }
}
