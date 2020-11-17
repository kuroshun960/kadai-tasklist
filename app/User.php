<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','content','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    /**
     *  UserのインスタンスからそのUserが持つMicropostsを
     *  $インスタンス->tasks()->get()　で取得できるようになる
     */
    
    //このユーザが所有するタスク。（ Taskモデルとの関係を定義）
    
        public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    
    
    
    // 1.ユーザーモデルのクラス 2.お気に入り中間テーブル名 3.ユーザーモデルのidとつながってる中間id  4.相手先のidとつながってる中間id
    
    public function favoritesNow(){
            return $this->belongsToMany(User::class, 'favorites','user_id','micropost_id')->withTimestamps();
        }
    
    
    //このユーザに関係するお気に入りの件数をカウントする。（'リレーション名'）
    
        public function loadRelationshipCounts()
    {
        $this->loadCount('favoritesNow');
    }  

    
    
    
}

