<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'message'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'名前は必須です。',
            'name.max'=>'名前は255文字以内で入力してください。',
            'email.required'=>'Eメールは必須です。',
            'email.max'=>'Eメールは255文字以内で入力してください。',
            'maessage.required'=>'内容は必須です。',
        ];
    }
}
