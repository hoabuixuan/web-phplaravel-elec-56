<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:product_types,name',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' =>':attribute tối thiểu có 3 ký tự',
            'max' => ':attribute không vượt quá 255 ký tự',
            'unique' => ':attribute không đường trùng nhau',
        ];
    }

    public function attributes(){
        return [
            'name' => 'Tên loại sản phẩm'
        ];
    }
}
