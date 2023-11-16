<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'name',
        'image',
        'email',
        'password',
        'introduction'
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
     * Relationships
     */
    public function posts() {
      return $this->hasMany('App\Models\PetsnsItem');
  }


    public function follows()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id');
    }


    public function likes()
    {
        return $this->belongsToMany('App\Models\PetsnsItem','likes','user_id','post_id')->withTimestamps();
    }

    //いいねしているかどうか判別する
    public function is_like($id)
    {
      return $this->likes()->where('post_id',$id)->exists();
    }

    //いいねする
    public function like($id)
    {
      if($this->is_like($id)){
      } else {
        $this->likes()->attach($id);
      }
    }

    //いいねを解除する
    public function unlike($id)
    {
      if($this->is_like($id)){
        $this->likes()->detach($id);
      } else {
      }
    }

    //コメントとのリレーション作成
    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

}
