<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tweet;


class Comments extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
  ];

    public static function getOrderByUpdated_at($id)
    {
        $tmp = Tweet::with('innerJoinImages')->self::select("*")
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


}
