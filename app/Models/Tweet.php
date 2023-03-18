<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
  ];

    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }

    // 🔽 追加
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function innerJoinImages()
    {
        //return $this->belongsToMany(TweetImage::class, 'tweet_images', 'tweet_id')->using(TweetImage::class);
        // return $this->hasOne(TweetImage::class, "tweet_id");
        return $this->hasMany(TweetImage::class, "tweet_id");
    }

}
