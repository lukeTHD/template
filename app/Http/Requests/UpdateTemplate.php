<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemplate extends FormRequest
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
            'name' => 'required|max:255',
            'avatar' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'price' => 'required',
            'section' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'mimes' => 'Chỉ chấp nhận hình với đuôi .jpg .jpeg .png .gif',
            'max' => 'Hình giới hạn dung lượng không quá 2M',
        ];
    }

    public function attributes(){
        return [
            'name'      =>  'Tên Template',
            'avatar'    =>  'Avatar Template',
            'price'     =>  'Giá',
            'section'   =>  'Section',
        ];
    }
}
