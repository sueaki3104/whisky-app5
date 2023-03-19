<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = trim($request->keyword);
        $users  = User::where('name', 'like', "%{$keyword}%")->pluck('id')->all();
        $tweets = Tweet::query()
            ->where('tweet', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->orwhereIn('user_id', $users)
            ->get();

        $prefecture_select = array(
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



        return view('tweet.index', compact('tweets','prefecture_select'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('search.input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
