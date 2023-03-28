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
        'name',
        'prefecture',
        'email',
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
    ];

    public function userTweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function tweets()
    {
        return $this->belongsToMany(Tweet::class)->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(self::class, "follows", "user_id", "following_id")->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, "follows", "following_id", "user_id")->withTimestamps();
    }

    public function prefecture_name()
    {
        $prefecture_select = self::getPrefecture();
        return $prefecture_select[$this->prefecture];
    }

    public static function getPrefecture()
    {
        $prefecture_select = array(
            0 => "",
            1 => "北海道",
            2 => "青森",
            3 => "岩手",
            4 => "宮城",
            5 => "秋田",
            6 => "山形",
            7 => "福島",
            8 => "茨城",
            9 => "栃木",
            10 => "群馬",
            11 => "埼玉",
            12 => "千葉",
            13 => "東京",
            14 => "神奈川",
            15 => "新潟",
            16 => "富山",
            17 => "石川",
            18 => "福井",
            19 => "山梨",
            20 => "長野",
            21 => "岐阜",
            22 => "静岡",
            23 => "愛知",
            24 => "三重",
            25 => "滋賀",
            26 => "京都",
            27 => "大阪",
            28 => "兵庫",
            29 => "奈良",
            30 => "和歌山",
            31 => "鳥取",
            32 => "島根",
            33 => "岡山",
            34 => "広島",
            35 => "山口",
            36 => "徳島",
            37 => "香川",
            38 => "愛媛",
            39 => "高知",
            40 => "福岡",
            41 => "佐賀",
            42 => "長崎",
            43 => "熊本",
            44 => "大分",
            45 => "宮崎",
            46 => "鹿児島",
            47 => "沖縄",
            48 => "内緒",
        );
        return $prefecture_select;
    }

}
