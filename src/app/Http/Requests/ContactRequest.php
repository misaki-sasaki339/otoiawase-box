<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'first_name'=>['required'],
            'last_name'=>['required'],
            'gender'=>['required'],
            'email'=>['required','email'],
            'address'=>['required'],
            'category_id'=>['required'],
            'detail'=>['required','max:120'],

        ];
    }

    public function messages()
    {
        return [
            'first_name.required'=>'姓を入力してください',
            'last_name.required'=>'名を入力してください',
            'gender.required'=>'性別を選択してください',
            'email.required'=>'メールアドレスを入力してください',
            'email.email'=>'メールアドレスはメール形式で入力してください',
            'address.required'=>'住所を入力してください',
            'category_id.required'=>'お問い合わせの種類を選択してください',
            'detail.required'=>'お問い合わせの内容を入力してください',
            'detail.max'=>'お問合せ内容は120文字以内で入力してください'
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator){
            $tel1 = $this->tel1;
            $tel2 = $this->tel2;
            $tel3 = $this->tel3;

            //未入力の場合
            if(empty($this->tel1) && empty($this->tel2) && empty($this->tel3)){
                $validator->errors()->add('tel', '電話番号を入力してください');
            }

            //5桁以上の場合
            if((!empty($tel1) && strlen($tel1) > 5 ) ||
               (!empty($tel2) && strlen($tel2) > 5 ) ||
               (!empty($tel3) && strlen($tel3) > 5 )){
                $validator->errors()->add('tel', '電話番号は5桁までの数字で入力してください');
            }
        });
    }
}
