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
  
  
    

}
