<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:200|unique:products,name,' . $this->route('product'),
            'price' => 'required|numeric|min:0',
            'discount' => 'numeric|min:0|max:50',
            'category_id' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|image',
            'brief' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc',
            'name.max' => 'Tên không được vượt quá 200 ký tự',
            'name.unique' => 'Tên đã tồn tại',
            'price.required' => 'Giá là bắt buộc',
            'price.numeric' => 'Giá phải là kiểu số',
            'price.min' => 'Giá quá nhỏ',
            'discount.numeric' => 'Khuyến mại phải là kiểu số',
            'discount.min' => 'Khuyến mại quá nhỏ',
            'discount.max' => 'Khuyến mại vượt quá 50%',
            'category_id.required' => 'Bạn cần chọn danh mục sản phẩm',
            'image.required' => 'Bạn cần chọn ảnh sản phẩm',
            'image.mimes' => 'Ảnh phải có đuôi là jpg, jpeg hoặc png',
            'image.image' => 'Đây không phải là ảnh',
            'brief.required' => 'Tóm tắt là bắt buộc',
            'brief.max' => 'Tóm tắt không được vượt quá 200 ký tự',
        ];
    }
}
