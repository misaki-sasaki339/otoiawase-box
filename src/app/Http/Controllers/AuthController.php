<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest; 
use Illuminate\Support\Facades\Hash;  

use App\Models\Contact;
use App\Models\User;
use App\Models\Category;

use App\Exports\ContactExport;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Facades\Excel;

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
        ->DateSearch($request->created_at)->paginate(7);
        $categories = Category::all();

        //検索結果をセッションに保存
        session([
            'contact_search' => $request->only(['keyword', 'gender', 'category_id', 'created_at'])
        ]);
        
        //検索結果をリンクに引継ぎ
        $contacts->appends($request->all());
        return view('auth.admin', compact('contacts', 'categories'));

    }

    // エクスポート
    public function export(){
        $search = session('contact_search', []); //セッションから検索条件を取得
        $query = Contact::with('category');

        if (!empty($search['keyword'])){
            $query->KeywordSearch($search['keyword']);
        }
        if (!empty($search['category_id'])){
            $query->CategorySearch($search['category_id']);
        }
        if (!empty($search['created_at'])){
            $query->DateSearch($search['created_at']);
        }

        $contacts = $query->get();

        return Excel::download(new ContactExport($contacts), 'output_contact_data.csv', ExcelType::CSV);
    }

}
