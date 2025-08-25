<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\Category;

use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //お問い合わせフォームの表示
    public function index(){
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contacts', 'categories'));
    }

    //お問い合わせフォームの確認画面の表示
    public function confirm(ContactRequest $request){
        $contact = new Contact($request->only('last_name','first_name','gender','email','address','building','category_id','detail'));
        $contact['tel']  = $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3;
        $contact['tel1'] = $request->tel1;
        $contact['tel2'] = $request->tel2;
        $contact['tel3'] = $request->tel3;
        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact','category'));
    }

    public function store(Request $request){
        $contact = $request->only('last_name','first_name','gender','email','address','building','category_id','detail');
        $contact['tel'] = $request->tel1 . '-' . $request->tel2 . '-' . $request->tel3;

         //修正ボタン押した場合
        if ($request->input('action') === 'back'){
            return redirect()->route('index')->withInput($request->all());
        }
       
        //送信ボタンを押した場合
        Contact::create($contact);
        return redirect()->route('thanks');
    }

    //サンキューページの表示
    public function showThankYou(){
        return view('thanks');
    }
}