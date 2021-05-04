<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function works()
    {
        return $this->hasMany(Work::class);
    }
    
    
    

    /**
     * このユーザがお気に入りしている作品。（ Userモデルとの関係を定義）
     */
    public function favorites()
    {
        return $this->belongsToMany(Work::class, 'work_favorite', 'user_id', 'work_id')->withTimestamps();
    }       
    

    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['works', 'favorites']);
    } 
    
    

    
    /**
     * $userIdで指定された作品をお気に入りする。
     *
     * @param  int  $workID
     * @return bool
     */
    public function favorite($workId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($workId);
        // 作品が自分自身のものかどうかの確認
        $its_mine= $this->id == $workId;

        if ($exist || $its_mine) {
            // すでにお気に入りしていれば何もしない
            return false;
        } else {
            // まだお気に入りしていなければお気に入りする
            $this->favorites()->attach($workId);
            return true;
        }
    }

    /**
     * $workIdで指定された作品をお気に入り解除する。
     *
     * @param  int  $workId
     * @return bool
     */
    public function unfavorite($workId)
    {
        // すでにお気に入りしているかの確認
        $exist = $this->is_favorite($workId);
        // 投稿が自分自身のものかどうかの確認
        $its_mine = $this->id == $workId;

        if ($exist && !$its_mine) {
            // すでにお気に入りしていればお気に入りを外す
            $this->favorites()->detach($workId);
            return true;
        } else {
            // まだお気に入りしていなければ何もしない
            return false;
        }
    }
    
    
    /**
     * 指定された $userIdの作品をこのユーザがお気に入りしているか調べる。お気に入りしているならtrueを返す。
     *
     * @param  int  $workId
     * @return bool
     */
    public function is_favorite($workId)
    {
        // お気に入りしている作品の中に $workIdのものが存在するか
        return $this->favorites()->where('work_id', $workId)->exists();
    }  
    
    

    
    /**
     * このユーザがお気に入りした作品に絞り込む。
     */
    public function feed_favorites()
    {
        // このユーザがお気に入りした投稿のidを取得して配列にする
        $workIds = $this->favorites()->pluck('works.id')->toArray();
        // このユーザの作品のidもその配列に追加
        $workIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Work::whereIn('work_id', $workIds);
    }  
    

    
}
