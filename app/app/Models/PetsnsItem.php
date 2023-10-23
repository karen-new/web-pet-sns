<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetsnsItem extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','path','comment'];

     /**
     * Relationships
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function like_users()
    {
        return $this->belongsToMany(User::class,'likes','post_id','user_id')->withTimestamps();
    }

    //コメントとのリレーション作成
    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment', 'post_id');
    }
}
