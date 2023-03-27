


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿への返信等はこちらから') }}
        </h2>
    </x-slot>

    <!-- 投稿された内容の表示 -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">

                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <p class="text-gray-700 font-medium" style="font-size: 14px;">{{ $prefecture_select[$tweet->user->prefecture] }}</p>
                                            <a href="{{ route('follow.show', $tweet->user->id) }}">
                                            <p class="text-gray-700 font-medium" style="font-size: 14px;">{{ $tweet->user->name }}</p>
                                        </div>
                                        <p class="text-gray-500 text-sm">{{ $tweet->created_at->locale('ja')->diffForHumans(null, true) }}</p>
                                    </div>
                            <p class="py-4 px-6 border-b border-grey-light" style="overflow-wrap: break-word: font-size: 14px;" id="tweet">{{  $tweet->tweet  }}</p>
                        </div>

                        @if( isset($tweet->innerJoinImages[0]) )
                            <div class="mt-2 text-center">
                                @foreach ($tweet->innerJoinImages as $photo)
                                    <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;" class="mx-auto my-4">
                                @endforeach
                            </div>
                        @endif

                            <a href="{{ url()->previous() }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            Back
                        </a>

                        <!-- コメントをする場所 -->
                        <div class="p-6 bg-white border-b border-gray-200">
                            @include('common.errors')
                            <form class="mb-6" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-col mb-4">
                                    <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="tweet">コメントする（画像は最大４枚）</label>
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
                        <div class="test border border-gray-300 rounded-lg p-4 my-4" style="border-width: 2px;">
                            @foreach ($commentsList as $commentData)
                                <div class="mb-4 border-b border-gray-400 pb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <p class="text-gray-700 font-medium">{{ $prefecture_select[$commentData->user->prefecture] }}</p>
                                            <a href="{{ route('follow.show', $commentData->user->id) }}">
                                            <p class="text-gray-700 font-medium">{{ $commentData->user->name }}</p>
                                        </div>
                                        <p class="text-gray-500 text-sm">{{ $commentData->created_at->locale('ja')->diffForHumans(null, true) }}</p>
                                    </div>
                                    <p class="text-left text-gray-700">{{ $commentData->comment }}</p>
                                    @if( isset($commentData->innerJoinImages[0]) )
                                        <div class="mt-2 text-center">
                                        @foreach ($commentData->innerJoinImages as $photo)
                                            <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;" class="mx-auto my-4">
                                        @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

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
