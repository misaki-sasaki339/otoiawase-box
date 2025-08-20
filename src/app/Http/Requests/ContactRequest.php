<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name'=>'required',
            'last_name'=>'required',
            'gender'=>'required',
            'email'=>'required',
            'tel'=>'required',
            'address'=>'required',
            'category_id'=>'required',
            'detail'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'=>'姓を入力してください',
            'last_name.required'=>'名を入力してください',
            'gender.required'=>'性別を選択してください',
            'email.required'=>'メールアドレスを入力してください',
            'tel.required'=>'電話番号を入力してください',
            'address.required'=>'住所を入力してください',
            'category_id.required'=>'お問い合わせの種類を選択してください',
            'detail.required'=>'お問い合わせの内容を入力してください',
        ];
    }
}
