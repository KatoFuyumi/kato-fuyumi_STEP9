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
            'product_name' => 'required|max:255',
            'description' => 'required', 
            'price' => 'required', 
            'stock' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です',
            'product_name.max' => '商品名は255文字以内で入力してください',
            'description.required' => '商品説明は必須です', 
            'price.required' => '料金は必須です', 
            'stock.required' => '在庫は必須です', 
        ];
    }
}
