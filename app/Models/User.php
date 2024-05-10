<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    /**
     * このユーザーが所有する投稿。（ Boardモデルとの関係を定義）
     */
    public function boards()
    {
        return $this->hasMany(Board::class, 'user_number');
    }
    
     /**
     * このユーザーがお気に入りの投稿
     */
     public function favorites()
     {
         return $this->belongsToMany(Board::class, 'favorites' , 'user_number' , 'message_id')->withTimestamps();
     }
     
     /**
      * 投稿をお気に入り登録する
      */
      public function favorite(int $message_id)
      {
        $exist = $this->is_favorite($message_id);
        if ($exist) {
            return false;
        } else {
            $this->favorites()->attach($message_id);
            return true;
        }
      }
      
      /**
       * 投稿のお気に入り登録を外す
       */
       public function unfavorite(int $message_id)
       {
        $exist = $this->is_favorite($message_id);
        if ($exist) {
            $this->favorites()->detach($message_id);
            return true;
        } else {
            return false;
        }
       }
       
       /**
        * 指定された$micropots_idの投稿をこのユーザーがすでにお気に入り登録しているか返す。しているならtrue
        */
        public function is_favorite(int $message_id)
        {
            return $this->favorites()->where('favorites.message_id',$message_id)->exists();
        }
}
