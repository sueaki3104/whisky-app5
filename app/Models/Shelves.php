<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelves extends Model
{
    use HasFactory;


    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function innerJoinImages()
    {
        return $this->hasMany(ShelvesImage::class, "shelves_id");
    }



}
