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
            'name' => 'required|min:2|max:255|unique:products,name',
            'description' => 'required|min:2',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'promotional' => 'required|numeric',
            'image' => 'required|image',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute tốt thiểu 2 ký tự',
            'max' => ':attribute không được vượt quá 255 ký tự',
            'image' => ':attrbute phải là định dạnh ảnh',
            'numeric' => ':attrbute phải là kiểu số'
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên sản phẩm',
            'description' => 'Mô tả sản phẩm',
            'quantity' => 'Số lượng sản phẩm',
            'price' => 'Giá sản phẩm',
            'promotional' => 'Giá khuyến mại',
            'image' => 'Hình ảnh'
        ];
    }
}
