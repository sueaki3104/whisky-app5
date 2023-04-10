<style>
  .modal {
      position: fixed;
      z-index: 999;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.7);
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .modal img {
      max-width: 100%;
      max-height: 100%;
      cursor: pointer;
      position: relative;
  }
  .modal .close {
      position: absolute;
      top: 10px;
      left: 10px;
      color: white;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
  }
</style>


<x-app-layout>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // 画像をクリックしたら
            $('img').click(function(event){
                // デフォルトの処理をキャンセル
                event.preventDefault();
                // 大きく表示された画像のURLを取得
                const imageUrl = $(this).attr('src');
                // 大きく表示された画像のimg要素を生成
                const $largeImage = $('<img>',{src: imageUrl, class: 'enlarged-image'});
                // ×印を追加
                const $closeButton = $('<div>',{class: 'close'}).html('×').appendTo($largeImage);
                // モーダルダイアログを表示
                const $dialog = $('<div>',{class: 'modal'}).append($largeImage).appendTo('body');
                // ×印をクリックしてモーダルダイアログを閉じる
                $closeButton.click(function(){
                    $dialog.remove();
                });
                // モーダルダイアログ以外をクリックしても閉じる
                $dialog.click(function(e){
                    if (e.target === this) {
                        $dialog.remove();
                    }
                });
            });
        });
    </script>

    <?php
        $urlRegex = '/https?:\/\/[^\s]+/';
        $linkedText = preg_replace($urlRegex, '<a href="$0" target="_blank" rel="noopener noreferrer">$0</a>', $tweet->tweet);
    ?>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿への返信等はこちらから') }}
        </h2>
    </x-slot>

    <!-- 投稿された内容の表示 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border border-gray-300 border-solid rounded-lg">
                    <div class="mb-6">
                    <div class="p-6 bg-white border border-gray-300 border-solid rounded-lg">
                        <div class="flex flex-col mb-4">

                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <p class="text-gray-700 font-medium" style="font-size: 14px;">{{ $tweet->user->prefecture_name() }}</p>
                                            <a href="{{ route('follow.show', $tweet->user->id) }}">
                                            <p class="text-gray-700 font-medium" style="font-size: 14px;">{{ $tweet->user->name }}</p>
                                        </div>
                                        <p class="text-gray-500 text-sm">{{ $tweet->created_at->locale('ja')->diffForHumans(null, true) }}</p>
                                    </div>
                            <p class="py-4 px-6 border-grey-light" style="overflow-wrap: break-word: font-size: 14px;" id="tweet">{!!  $linkedText  !!}</p>
                        </div>

                        @if( isset($tweet->innerJoinImages[0]) )
                            <div class="mt-2 text-center">
                                @foreach ($tweet->innerJoinImages as $photo)
                                    <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;" class="mx-auto my-4">
                                @endforeach
                            </div>
                        @endif

                        <a href="{{  route('tweet.index')  }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            投稿一覧へ戻る
                        </a>
                    </div>
                    <!-- コメントをする場所 -->
                    <div class="p-6 bg-blue-100 border-b border-gray-200">
                        @include('common.errors')
                        <form class="mb-6" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col mb-4">
                                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="tweet">MAX（テキスト1024文字 画像２枚）</label>
                                <textarea class="border py-2 px-3 text-grey-darkest resize-none" name="comment" id="comment" rows="4"></textarea>
                                <input type="hidden" name="tweet_id" id="tweet_id" value="{{$tweet->id}}">
                            </div>

                            <x-tweet.form.images></x-tweet.form.images>

                            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                コメントをする
                            </button>
                        </form>
                    </div>

                    <!-- 返信の表示領域 -->
                    @foreach ($commentsList as $commentData)
                        <div class="border border-gray-300 rounded-lg p-4 my-4">
                            <div class="mb-4 pb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="text-left">
                                        <p class="text-gray-700 font-medium">{{ $commentData->user->prefecture_name() }}</p>
                                        <a href="{{ route('follow.show', $commentData->user->id) }}">
                                            <p class="text-gray-700 font-medium">{{ $commentData->user->name }}</p>
                                        </a>
                                    </div>
                                    <p class="text-gray-500 text-sm">{{ $commentData->created_at->locale('ja')->diffForHumans(null, true) }}</p>
                                </div>
                                <p class="text-left text-gray-700">{{ $commentData->comment }}</p>

                                <div class="mt-2 text-center">
                                    @if( isset($commentData->innerJoinImages[0]) )
                                        @foreach ($commentData->innerJoinImages as $photo)
                                            <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;" class="mx-auto my-4">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <style>
                            .test img {
                                margin: 5px 0;
                            }
                        </style>




                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
