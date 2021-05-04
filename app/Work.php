<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
       'name', 'photo', 'work_public','title', 'description', 
    ];

    /**
     * この作品を所有するユーザ（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    
    /**
     * この作品をお気に入りしているユーザー（ Userモデルとの関係を定義）
     */
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'work_favorite', 'work_id', 'user_id')->withTimestamps();
    }    
  
  
    
        /**
     * このユーザが公開した作品に絞り込む。
     */
    public function feed_public()
    {
        // このユーザが公開した作品のidを取得して配列にする
        $workIds = $this->favorites()->pluck('works.id')->toArray();    //後で公開仕様に修正する
        // このユーザの作品のidもその配列に追加
        $workIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Work::whereIn('work_public', 1);
    }     

}
