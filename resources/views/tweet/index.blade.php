<!-- resources/views/tweet/index.blade.php -->
<style>
  .card {
    border: 1px solid black;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
  }

  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }

  .card-header > div {
    display: flex;
    align-items: center;
  }

  .card-header img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .card-header h4 {
    font-size: 14px;
    font-weight: bold;
    margin: 0;
  }

  .card-header p {
    font-size: 12px;
    margin: 0;
  }

  .card-body {
    margin-bottom: 10px;
  }

  .card-body img {
    max-width: 100%;
    max-height: 300px;
    margin-bottom: 10px;
  }

  .card-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  .card-footer form {
    margin: 0;
  }

  .card-footer button {
    margin-left: 10px;
  }


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
        // aタグをクリックしたら
        $('a[data-lightbox="group1"]').click(function(event){
            // デフォルトの処理をキャンセル
            event.preventDefault();
            // 大きく表示された画像のURLを取得
            const imageUrl = $(this).attr('href');
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


  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('投稿一覧') }}
    </h2>
  </x-slot>

  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="text-center w-full border-collapse sm:table-auto" border="1" style="table-layout: fixed; width:100%;" \>
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light sm:w-1/2 md:w-1/3 lg:w-1/4">新しい投稿を確認</th>
                            </tr>
                        </thead>
                    <tbody>
                      @foreach ($tweets as $tweet)
                            <tr id="tweet{{$tweet->id}}" class="hover:bg-grey-lighter sm:table-row" \>
                            <td class="py-4 px-6 border-b border-grey-light sm:text-sm md:text-base lg:text-lg">
                                    <div class="flex flex-col mb-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="text-left text-white-700 font-medium" style="font-size: 14px;">{{ $tweet->user->prefecture_name() }}</p>
                                                <a href="{{ route('follow.show', $tweet->user->id) }}">
                                                <p class="text-left text-white-700 font-medium" style="font-size: 14px;">{{ $tweet->user->name }}</p>
                                            </div>
                                            <p class="text-white-500 text-sm">{{ $tweet->created_at->locale('ja')->diffForHumans(null, true) }}</p>
                                            <p class="text-white-500 text-sm">{{ $tweet->prefecture_name() }}</p>
                                        </div>
                                    </div>


                    </div>


                <!-- 本文から投稿詳細に飛ばす -->
                <a href="{{ route('tweet.show',$tweet->id) }}">
                    <h3 class="text-left font-bold text-lg text-grey-dark" style="overflow-wrap: break-word; font-size: 14px;">{!!  $tweet->linked_tweet()  !!}</h3>
                </a>



                @if( isset($tweet->innerJoinImages[0]) )
                  <div>
                      @foreach ($tweet->innerJoinImages as $photo)
                          <a href="{{ asset('storage/images/' . $photo->hash_name) }}" data-lightbox="group1" data-title="{{ $tweet->tweet }}">
                              <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;">
                          </a>
                      @endforeach
                  </div>
                @endif

                  <div class="flex">

                    <!-- comment ボタン -->
                    <form action="{{ route('tweet.show',$tweet->id) }}" method="GET" class="text-left">
                    @csrf
                        <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots h-5 w-5" viewBox="0 0 16 16">
                            <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                            </svg>
                            {{ $tweet->commentUsers()->count() }}
                        </button>
                    </form>

                  <!-- favorite 状態で条件分岐 -->
                    @if($tweet->users()->where('user_id', Auth::id())->exists())
                    <!-- unfavorite ボタン -->
                    <form action="{{ route('unfavorites',$tweet) }}" method="POST" class="text-left">
                      @csrf
                        <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                        <svg class="h-6 w-6 text-red-500" fill="red" viewBox="0 0 24 24" stroke="red">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $tweet->users()->count() }}
                      </button>
                    </form>
                    @else
                    <!-- favorite ボタン -->
                    <form action="{{ route('favorites',$tweet) }}" method="POST" class="text-left">
                      @csrf
                        <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ $tweet->users()->count() }}
                      </button>
                    </form>
                    @endif

<!-- フォローボタン フォロー状態のコード -->
                    @if ($tweet->user_id != Auth::user()->id)
                        <!-- フォロー 状態で条件分岐 -->
                        @if(Auth::user()->followings()->where('users.id', $tweet->user->id)->exists())
                            <!-- フォローしていない ボタン -->
                            <form action="{{ route('unfollow', $tweet->user) }}" method="POST" class="text-left">
                            @csrf
                            <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                                <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f00" class="bi bi-person-plus" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    {{ $tweet->user->followers()->count() }}
                                </button>
                            </form>
                        @else
                            <!-- フォロー ボタン -->
                            <form action="{{ route('follow', $tweet->user) }}" method="POST" class="text-left">
                            @csrf
                                <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                                <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                    </svg>
                                    {{ $tweet->user->followers()->count() }}
                                </button>
                            </form>
                        @endif
                    @endif


                    <!-- 更新ボタン -->
                    <!-- <form action="{{ route('tweet.edit',$tweet->id) }}" method="GET" class="text-left">
                      @csrf
                        <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                    </form> -->



                    @if ($tweet->user_id === Auth::user()->id)
                    <!-- 削除ボタン -->
                    <form action="{{ route('tweet.destroy',$tweet->id) }}" method="POST" class="text-left">
                      @method('delete')
                      @csrf
                        <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline;">
                        <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </form>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
