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



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name.__('さんのウィスキー詳細') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if( isset($whisky->innerJoinImages[0]) )
                        <a href="{{ asset('storage/images/' . $whisky->innerJoinImages[0]->hash_name) }}" data-lightbox="group1" data-title="{{ $whisky->name }}">
                            <img src="{{ asset('storage/images/' . $whisky->innerJoinImages[0]->hash_name) }}" style="display: block; margin: 0 auto;" width="80%" height="auto">
                        </a>
                    @else
                        <a href="{{ asset('./img/whiskylogo.png') }}" data-lightbox="group1" data-title="{{ $whisky->name }}">
                            <img src="{{ asset('./img/whiskylogo.png') }}" style="display: block; margin: 0 auto;" width="80%" height="auto">
                        </a>
                    @endif

                    <div class="mt-4">
                        <span>{{ __("ウィスキー名:") }}</span>
                        <span>{{ $whisky->name }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購 入 日:") }}</span>
                        <span>{{ \Carbon\Carbon::parse($whisky->buy_date)->format('Y/m/d') }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購入場所:") }}</span>
                        <span>{{ $whisky->buy_address }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("価格(税込):") }}</span>
                        <span>{{ $whisky->price }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購入数量:") }}</span>
                        <span>{{ $whisky->num }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("想 い 出:") }}</span>
                        <span>{{ $whisky->memory }}</span>
                    </div>



                    <a href="{{ route('shelves.delete', $whisky->id) }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none" style="background-color:#f55;">
                        {{ __("このウイスキーを削除する"); }}
                    </a>

                    <a href="{{ route('shelves.index') }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        {{ __("棚へ戻る"); }}
                    </a>







                </div>
            </div>
        </div>
    </div>
</x-app-layout>
