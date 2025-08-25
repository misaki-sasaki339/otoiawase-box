<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest; 
use Illuminate\Support\Facades\Hash;  

use App\Models\Contact;
use App\Models\User;
use App\Models\Category;

class AuthController extends Controller
{
    //管理画面の表示
    public function admin(){
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('auth.admin', compact('contacts', 'categories'));
    }

    //新規登録画面の表示
    public function showRegister(){
        return view('auth.register');
    }

    //新規ユーザーの登録
    public function register(UserRequest $request){
        $user = $request->except('_token');
        $user['password'] = Hash::make($user['password']); 
        User::create($user);
        return redirect()->route('login')->with('success', '登録が完了しました！ログインしてください');
    }

    //お問い合わせの削除
    public function destroy(Request $request){
        Contact::find($request->id)->delete();
        return redirect('admin')->with('delete', 'お問い合わせを削除しました');
    }

    //お問い合わせの検索
    public function search(Request $request){
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)
        ->GenderSearch($request->gender)->CategorySearch($request->category_id)
        ->DateSearch($request->date)->paginate(7);
        $categories = Category::all();
        
        //検索結果をリンクに引継ぎ
        $contacts->appends($request->all());
        return view('auth.admin', compact('contacts', 'categories'));
    }

}
