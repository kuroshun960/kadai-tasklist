<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'content','status',
        ];
    
    
    /**
     * このタスクを所有するユーザ。（ Userモデルとの関係を定義）
     * 
     *  Taskのインスタンスが所属している唯一のUser（投稿者の情報）を
     *  $インスタンス->user()->first()で取得できるようになる
     */
    
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}

