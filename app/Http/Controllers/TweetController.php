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

use Intervention\Image\Facades\Image;





class TweetController extends Controller
{
// 投稿を１５０件だけ表示するやつ
    public const TAKE_NUMBER = 150;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ここのindexは一覧表示のことです
     public function index()
    {
        $tweets = Tweet::with('innerJoinImages')->orderBy('updated_at', 'desc')->take(self::TAKE_NUMBER)->get();

        return view('tweet.index', compact('tweets'));
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



// // 投稿する際に画像を自動で圧縮する処理を検討したが、データ容量がそもそも多いものは

//      public function store(Request $request)
//     {
//         // バリデーション
//         $validator = Validator::make($request->all(), [
//             'tweet' => 'required | max:191',
//             'images' => 'array|max:4',
//             'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // 2MB以下に変更
//         ]);
//         // バリデーション:エラー
//         if ($validator->fails()) {
//             return redirect()
//                 ->route('tweet.create')
//                 ->withInput()
//                 ->withErrors($validator);
//         }

//         // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
//         $data = $request->merge([
//             'user_id' => Auth::user()->id,
//             'prefecture' => Auth::user()->prefecture,
//         ])->all();
//         $result = Tweet::create($data);

//         $imageList = $this->images($request);
//         foreach ($imageList as $image) {
//             $path = $image->store('public/images'); // アップロードされたファイルを保存
//             $compressedImage = Image::make(storage_path('app/' . $path)); // 画像を圧縮
//             if ($compressedImage->filesize() > 2048000) { // もし2MBを超える場合
//                 $compressedImage->resize(1920, null, function ($constraint) { // 幅を1920pxに縮小する
//                     $constraint->aspectRatio(); // 縦横比はそのまま
//                 })->limitColors(255)->encode(); // 255色に減色してエンコード
//             }
//             Storage::put($path, $compressedImage); // 圧縮した画像を保存

//             $imageModel = new TweetImage();
//             $imageModel->tweet_id = $result->id;
//             $imageModel->hash_name = $image->hashName();
//             $imageModel->save();// DBに保存
//         }

//         // tweet.index にリクエスト送信（一覧ページに移動）
//         return redirect()->route('tweet.index');
//     }


// これもうまくいかない

// public function store(Request $request)
// {
//     // バリデーション
//     $validator = Validator::make($request->all(), [
//         'tweet' => 'required|max:191',
//         'images' => 'array|max:4',
//         'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
//     ]);

//     // バリデーション:エラー
//     if ($validator->fails()) {
//         return redirect()
//             ->route('tweet.create')
//             ->withInput()
//             ->withErrors($validator);
//     }

//     // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
//     $data = $request->merge([
//         'user_id' => Auth::user()->id,
//         'prefecture' => Auth::user()->prefecture,
//     ])->all();

//     $result = Tweet::create($data);

//     $imageList = $this->images($request);

//     foreach($imageList as $image){
//         $path = $image->store('public/images'); // アップロードされたファイルを保存
//         $compressedImage = Image::make(storage_path('app/' . $path))->encode(null, 60)->orientate(); // 画像を圧縮し、向きを調整
//         Storage::put($path, $compressedImage); // 圧縮した画像を保存

//         $imageModel = new TweetImage();
//         $imageModel->tweet_id = $result->id;
//         $imageModel->hash_name = $image->hashName();
//         $imageModel->save();// DBに保存
//     }

//     // tweet.index にリクエスト送信（一覧ページに移動）
//     return redirect()->route('tweet.index');
// }







// 最悪これを使う

     public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191',
            // 'description' => 'required',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000'

        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.create')
                ->withInput()
                ->withErrors($validator);
        }

        // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge([
            'user_id' => Auth::user()->id,
            'prefecture' => Auth::user()->prefecture,
            ])->all();
        $result = Tweet::create($data);

        $imageList = $this->images($request);
        foreach($imageList as $image){
            Storage::putFile('public/images', $image);// アップロードされたファイルを保存
            $path = $image->store('public/images'); // アップロードされたファイルを保存
            // $compressedImage = Image::make(storage_path('app/' . $path))->fit(800)->encode(); // 画像を圧縮
            // Storage::put($path, $compressedImage); // 圧縮した画像を保存



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

        return view('tweet.show', compact('tweet','commentsList'));
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
          ->take(self::TAKE_NUMBER)
          ->get();

        return view('tweet.index', compact('tweets'));
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
                ->take(self::TAKE_NUMBER)
                ->get();

            return view('tweet.index', compact('tweets'));
    }



}
