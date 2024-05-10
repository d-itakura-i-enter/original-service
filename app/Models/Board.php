<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Board extends Model
{
    use HasFactory;
    
    protected $table = 'board';
    protected $primaryKey = 'message_id';
    protected $fillable = ['user_number','message','delete_flag'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿をお気に入りしているユーザー
     */
     public function favorite_users()
     {
         return $this->belongsToMany(User::class,'favorites', 'message_id', 'user_number')->withTimestamps();
     }
}
