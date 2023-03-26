<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Tweet;
use Auth;
use App\Models\User;
use App\Models\TweetImage;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ここのindexは一覧表示のことです
     public function index()
    {
        //$tweets = Tweet::getAllOrderByUpdated_at();

        $tweets = Tweet::with('innerJoinImages')->orderBy('updated_at', 'desc')->get();
        // echo("<pre>");
        // // var_dump($tweets);

        // var_dump($tweets[0]->tweet);

        // var_dump($tweets[0]->innerJoinImages[0]->hash_name);
        // var_dump($tweets[0]->innerJoinImages[1]->hash_name);
        // var_dump($tweets[0]->innerJoinImages[2]->hash_name);
        // var_dump($tweets[0]->innerJoinImages[3]->hash_name);

        // var_dump($tweets[1]->innerJoinImages[0]->hash_name);
        // var_dump($tweets[1]->innerJoinImages[1]->hash_name);

        // echo("<hr>");
        // var_dump($tweets[0]);
        // echo("</pre>");
        // exit();

        $prefecture_select = User::getPrefecture();
        return view('tweet.index', compact('tweets','prefecture_select'));






    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tweet.create');
    }



    public function images(Request $request): array
    {
        return $request->file('images', []);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191',
            // 'description' => 'required',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.create')
                ->withInput()
                ->withErrors($validator);
        }

        // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id, 'prefecture' => Auth::user()->prefecture,])->all();
        $result = Tweet::create($data);

        $imageList = $this->images($request);
        foreach($imageList as $image){
            Storage::putFile('public/images', $image);// アップロードされたファイルを保存
            $imageModel = new TweetImage();
            $imageModel->tweet_id = $result->id;
            $imageModel->hash_name = $image->hashName();
            $imageModel->save();// DBに保存
        }

        // tweet.index にリクエスト送信（一覧ページに移動）
        return redirect()->route('tweet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::find($id);

        $commentsList = Comments::getOrderByUpdated_at($id);

        // dd($commentsList[0]->id);

        $prefecture_select = User::getPrefecture();


        return view('tweet.show', compact('tweet','commentsList','prefecture_select'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tweet = Tweet::find($id);
        return view('tweet.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //バリデーション
    //     $validator = Validator::make($request->all(), [
    //         'tweet' => 'required | max:191',
    //         // 'description' => 'required',
    //     ]);
    //     //バリデーション:エラー
    //     if ($validator->fails()) {
    //         return redirect()
    //             ->route('tweet.edit', $id)
    //             ->withInput()
    //             ->withErrors($validator);
    //     }
    //     //データ更新処理
    //     $result = Tweet::find($id)->update($request->all());
    //         return redirect()->route('tweet.index');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }

    public function mydata()
    {
        // Userモデルに定義したリレーションを使用してデータを取得する．
        $tweets = User::query()
          ->find(Auth::user()->id)
          ->userTweets()
          ->orderBy('created_at','desc')
          ->get();

        $prefecture_select = User::getPrefecture();
        return view('tweet.index', compact('tweets','prefecture_select'));
    }


    public function timeline()
    {
        // フォローしているユーザを取得する
        $followings = User::find(Auth::id())->followings->pluck('id')->all();
        // フォローしている人が投稿したツイートを取得する
            $tweets = Tweet::query()
                ->whereIn('user_id', $followings)
                ->orderBy('updated_at', 'desc')
                ->with('user')
                ->get();

            $prefecture_select = User::getPrefecture();
            return view('tweet.index', compact('tweets','prefecture_select'));
    }



}
