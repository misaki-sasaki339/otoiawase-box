<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'category_id'
    ];

    //Categoryモデルの取得
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }

    //性別のラベリング
    public function getGenderLabelAttribute(){
        switch($this->gender){
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
        }
    }

    //ローカルスコープ
    //お問い合わせの種類
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)){
        $query->where('category_id', $category_id);
        }
    }
    //性別
    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender)){
            $query->where('gender', $gender);
        }
    }

    //名前キーワード
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)){
            $query->where(function($q) use($keyword){
                $q->where('first_name', 'like','%' . $keyword . "%")
                  ->orWhere('last_name', 'like','%' . $keyword . "%")
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }
    }
    //日付
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)){
            $query->whereDate('created_at',$date);
        }
    }

}