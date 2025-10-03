<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'name_kanji' => ['required', 'string', 'max:255'],
            'name_kana' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です',
            'name.max' => '名前は255文字以内で入力してください',
            'name_kanji.required' => '名前(漢字)は必須です',
            'name_kanji.max' => '名前(漢字)は255文字以内で入力してください',
            'name_kana.max' => '名前(漢字)は255文字以内で入力してください',
            'email.required' => 'Eメールは必須です', 
            'email.max' => 'Eメールは255文字以内で入力してください',
            'email.unique' => 'すでに使われているEメールです',
            'password.required' => 'パスワードは必須です', 
            'password.min' => 'パスワードは8文字以上で入力してください', 
            'password.confirmed' => 'パスワードが一致しません', 
        ];
    }
}
