<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class ContactExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $contacts;

    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }

    public function collection()
    {
        return $this->contacts->map(function ($contact){
            $genders = [
                1 => '男性',
                2 => '女性',
                3 => 'その他'
            ];
            //性別を文字列に変換
            $contact['gender'] = $genders[$contact['gender']];
            //カテゴリ名の表示
            $contact['category_id'] = $contact->category->content;

            return [
                $contact->id,
                $contact->last_name,
                $contact->first_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category_id,
                $contact->detail,
                $contact->created_at->format('Y/m/d'),
            ];
        });
    }

    //ヘッダーの設定
    public function headings(): array
    {
        return[
            'ID',
            '名字',
            '名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物',
            'お問い合わせの種類',
            'お問い合わせの内容',
            'お問い合わせ日'
        ];
    }
}