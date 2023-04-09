<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;


class SearchController extends Controller
{

    public const TAKE_NUMBER = 500;


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
            ->where(function ($query) use ($keyword) {
                $query->where('tweet', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            })
            ->orWhereIn('user_id', $users)
            ->orderBy('created_at','desc')
            ->take(self::TAKE_NUMBER)
            ->get();

        $prefecture_select = User::getPrefecture();

        return view('tweet.index', compact('tweets','prefecture_select'));

    }

    public function searchPrefecture(Request $request)
    {
        $tweets = Tweet::query()
            ->whereHas("User", function($query) use($request){
                $query->where('prefecture', "=", $request->prefecture);
            })
            ->orderBy('created_at','desc')
            ->take(self::TAKE_NUMBER)
            ->get();

        return view('tweet.index', compact('tweets'));
    }

    public function searchPrefecture3(Request $request)
    {
        $tweets = Tweet::query()
            ->where('prefecture', $request->prefecture)
            ->orderBy('created_at','desc')
            ->take(self::TAKE_NUMBER)
            ->get();

        return view('tweet.index', compact('tweets'));
    }

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
