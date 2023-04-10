<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Shelves;
use App\Models\ShelvesImage;


class ShelvesController extends Controller
{

    public function images(Request $request): array
    {
        return $request->file('images', []);
    }


    //-------------------------------------------------------------
    //  棚一覧ページ
    //-------------------------------------------------------------
    public function index()
    {

        // 自分のウイスキー取得
        $shelvesData = Shelves::select("*")
            ->where([
                ["user_id", "=", Auth::user()->id],
                ["is_delete", "=", 0],
            ])
            ->orderBy("buy_date", "DESC")
            ->get();

        // 自身のウイスキーの総本数
        $whiskyNum = Shelves::select(DB::raw("sum(num) as total_num"))->where([
                ["user_id", "=", Auth::user()->id],
                ["is_delete", "=", 0],
            ])->get()->first();

        // 自身のウイスキーの合計金額
        $whiskyPriceTotal = Shelves::select(DB::raw("sum(price*num) as total_price"))->where([
                ["user_id", "=", Auth::user()->id],
                ["is_delete", "=", 0],
            ])->get()->first();


        return view('shelves.shelves', compact('shelvesData', 'whiskyNum', 'whiskyPriceTotal'));
    }

    //-------------------------------------------------------------
    //  ウイスキー登録ページ
    //-------------------------------------------------------------
    public function register()
    {

        return view('shelves.new-bottle');
    }

    //-------------------------------------------------------------
    //  ウイスキー登録処理
    //-------------------------------------------------------------
    public function store(Request $request)
    {

        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'memory' => ['required', 'string', 'max:255'],
            // 'num' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000', // 10MB以下に変更
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('shelves.register')
                ->withInput()
                ->withErrors($validator);
        }

        // ウイスキーを登録
        $result = Shelves::create([
            'user_id'     => Auth::user()->id,
            'buy_date'    => $request->buy_date,
            'buy_address' => $request->buy_address,
            'name'        => $request->name,
            'price'       => $request->price,
            'num'         => $request->num,
            'memory'      => $request->memory,
        ]);

        // 画像をいい感じに圧縮して保存する
        $imageList = $this->images($request);
        foreach ($imageList as $image) {
            $path = $image->store('public/images'); // アップロードされたファイルを保存
            $compressedImage = Image::make(storage_path('app/' . $path))->orientate(); // 画像を圧縮

            // 投稿された画像が２MBを超えるなら２MB以下になるようにする　２MB未満ならリサイズしない
            if ($compressedImage->filesize() > 2048000) { // もし2MBを超える場合
                $compressedImage = $compressedImage->resize(1920, null, function ($constraint) { // 幅を1920pxに縮小する
                    $constraint->aspectRatio(); // 縦横比はそのまま
                })->limitColors(255)->encode(); // 255色に減色してエンコード
            } else {
                $compressedImage = $compressedImage->encode();
            }

            // 画像を保存する前にファイルのサイズを確認する
            if ($compressedImage->filesize() > 0) {
                Storage::put($path, $compressedImage); // 圧縮した画像を保存
            } else {
                // エラー処理
            }

            $imageModel = new ShelvesImage();
            $imageModel->shelves_id = $result->id;
            $imageModel->hash_name = $image->hashName();
            $imageModel->save();// DBに保存
        }

        return redirect()->route('shelves.index');
    }


    //-------------------------------------------------------------
    //  ウイスキー削除処理
    //-------------------------------------------------------------
    public function delete($id)
    {
        $shelvesData = Shelves::select("*")
            ->where([
                ["id", "=", $id],
                ["user_id", "=", Auth::user()->id],
            ])
            ->orderBy("buy_date", "DESC")
            ->get()
            ->first();

        $shelvesData->is_delete = 1;
        $shelvesData->save();

        return redirect()->route('shelves.index');
    }

    //-------------------------------------------------------------
    //  登録ウィスキー詳細ページ
    //-------------------------------------------------------------
    public function show($id)
    {
        $whisky = Shelves::select("*")
            ->where([
                ["id", "=", $id],
                ["user_id", "=", Auth::user()->id],
                ["is_delete", "=", 0],
            ])
            ->orderBy("buy_date", "DESC")
            ->get()
            ->first();

        if($whisky == NULL){
            return redirect()->route('shelves.index');
        }

        return view('shelves.show', compact('whisky'));
    }












}
