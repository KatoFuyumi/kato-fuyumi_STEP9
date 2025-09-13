<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'content' => 'required', 
            'price' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名は必須です',
            'name.max' => '商品名は255文字以内で入力してください',
            'content.required' => '商品説明は必須です', 
            'price.required' => '料金は必須です', 
        ];
    }
}
