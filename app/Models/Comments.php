<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tweet;


class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
  ];

    public static function getOrderByUpdated_at($id)
    {
        $tmp = self::with('innerJoinImages')
                        ->select("*")
                        ->where("tweet_id", $id)
                        ->orderBy('updated_at', 'desc')
                        ->get();



        return $tmp;
        // return self::orderBy('updated_at', 'desc')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function innerJoinImages()
    {
        return $this->hasMany(CommentImage::class, "comment_id");
    }

    public function linked_comment(){
        $urlRegex = '/https?:\/\/[^\s]+/';
        $linkedText = preg_replace($urlRegex, '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $this->comment);
        return $linkedText;
    }




}
