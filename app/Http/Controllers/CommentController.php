<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Tweet;
use Auth;
use App\Models\User;
use App\Models\TweetImage;
use App\Models\Comments;
use App\Models\CommentImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CommentController extends Controller
{


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
            'comment' => 'required | max:191',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000'// 10MB以下に変更
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.show',$request->tweet_id)
                ->withInput()
                ->withErrors($validator);
        }

        // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge([
            'user_id' => Auth::user()->id,
            'tweet_id' => $request->tweet_id,
            ])->all();
        $result = Comments::create($data);

        $imageList = $this->images($request);
        foreach($imageList as $image){

            $path = $image->store('public/images'); // アップロードされたファイルを保存
            $compressedImage = Image::make(storage_path('app/' . $path))->orientate(); // 画像を圧縮

            if ($compressedImage->filesize() > 2048000) { // もし2MBを超える場合
                $compressedImage = $compressedImage->resize(1920, null, function ($constraint) { // 幅を1920pxに縮小する
                    $constraint->aspectRatio(); // 縦横比はそのまま
                })->limitColors(255)->encode(); // 255色に減色してエンコード
            } else {
                $compressedImage = $compressedImage->encode();
            }


            // if ($compressedImage->filesize() > 2048000) { // もし2MBを超える場合
            //     $compressedImage->resize(1920, null, function ($constraint) { // 幅を1920pxに縮小する
            //         $constraint->aspectRatio(); // 縦横比はそのまま
            //     })->limitColors(255)->encode(); // 255色に減色してエンコード
            // }


            Storage::put($path, $compressedImage); // 圧縮した画像を保存

            // Storage::putFile('public/images', $image);// アップロードされたファイルを保存
            $imageModel = new CommentImage();
            $imageModel->comment_id = $result->id;
            $imageModel->hash_name = $image->hashName();
            $imageModel->save();// DBに保存
        }

        // tweet.index にリクエスト送信（一覧ページに移動）
        return redirect()->route('tweet.show',$request->tweet_id);
    }

}
