<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;



class AccountController extends Controller
{
    public function edit_account()
    {
        //アカウント編集画面
        $user = Auth::user();
        return view('account.edit_account',compact('user'));
    }

    //更新処理
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'name_kanji' => $request->name_kanji,
            'name_kana' => $request->name_kana,
        ]);

        return redirect()
            ->route('account.edit')
            ->with('success','アカウント情報を更新しました');
    }
}
