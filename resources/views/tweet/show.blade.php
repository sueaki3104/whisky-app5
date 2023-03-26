<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Tweet Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex flex-col mb-4">
                            <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">投稿された内容</p>
                        <p class="text-left text-grey-dark">所属：{{  $prefecture_select[$tweet->user->prefecture];  }}</p>

                        <p class="text-left text-grey-dark">投稿者：{{  $tweet->user->name  }}</p>

                            <p class="py-2 px-3 text-grey-darkest" id="tweet">{{  $tweet->tweet  }}</p>
                        </div>
                        <!-- <div class="flex flex-col mb-4">
                            <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Description</p>
                            <p class="py-2 px-3 text-grey-darkest" id="description">
                            {{$tweet->description}}
                            </p>
                        </div> -->

                        @if( isset($tweet->innerJoinImages[0]) )
                            <div>
                                @foreach ($tweet->innerJoinImages as $photo)
                                    <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;">
                                    <!-- <span>{{ asset('storage/images/' . $tweet->innerJoinImages[0]->hash_name) }}</span> -->
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ url()->previous() }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                            Back
                        </a>

                        <!-- コメントForm -->
                        <div class="p-6 bg-white border-b border-gray-200">
                            @include('common.errors')
                            <form class="mb-6" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex flex-col mb-4">
                                    <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="tweet">コメントする</label>
                                    <input class="border py-2 px-3 text-grey-darkest" type="text" name="comment" id="comment">
                                    <input type="hidden" name="tweet_id" id="tweet_id" value="{{$tweet->id}}">
                                </div>

                                <x-tweet.form.images></x-tweet.form.images>

                                <!-- <div class="flex flex-col mb-4">
                                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="description">Description</label>
                                <input class="border py-2 px-3 text-grey-darkest" type="text" name="description" id="description">
                                </div> -->
                                <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                    コメントをする
                                </button>
                            </form>
                        </div>

                        <!-- 返信の表示領域 -->
                        <div class="test">
                            @foreach ($commentsList as $commentData)

                                <div>
                                    <p>{{  $commentData->user->name  }}</p>
                                    <p>{{  $commentData->comment  }}</p>
                                    <p>{{  $commentData->created_at  }}</p>

                                @if( isset($tweet->innerJoinImages[0]) )
                                    <div>
                                        @foreach ($tweet->innerJoinImages as $photo)
                                            <img src="{{ asset('storage/images/' . $photo->hash_name) }}" style="display:inline-block; width:150px; height:auto;">
                                            <!-- <span>{{ asset('storage/images/' . $tweet->innerJoinImages[0]->hash_name) }}</span> -->
                                        @endforeach
                                    </div>
                                @endif


                                    <p>写真を掲載</p>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
