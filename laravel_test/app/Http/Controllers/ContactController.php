<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    //お問い合わせフォーム
    public function showForm()
    {
        return view('contact');
    }
    
    //お問い合わせフォームの内容を送信
    public function submitForm(ContactRequest $request)
    {
        $data = $request->validated();
        try {
            //メール送信
            Mail::to(env('ADMIN_EMAIL'))->send(new ContactMail($data));
        } catch (\Exception $e) {
            Log::error('メール送信エラー: '. $e->getMessage());
            return back()->with('error','メール送信に失敗しました。後でもう一度お試しください。');
        }

        return redirect()->route('index')
            ->with('success','お問い合わせが送信されました！');
    }
}
