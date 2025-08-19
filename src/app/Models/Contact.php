<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

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
    ];

    //Categoryモデルの取得
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
}
