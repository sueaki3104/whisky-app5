<!-- resources/views/user/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('ユーザー情報') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">名前</p>
              <p class="py-2 px-3 text-grey-darkest" id="name">
                {{$user->name}}
              </p>
            </div>

<!-- 都道府県の日本語化がまだで現在は数字 -->



            <div class="flex flex-col mb-4">
                <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">都道府県</p>
                <p class="py-2 px-3 text-grey-darkest" id="prefecture">
                {{$user->prefecture}}



                </p>
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">アカウント作成時期</p>
              <p class="py-2 px-3 text-grey-darkest" id="created_at">
                {{$user->created_at}}
              </p>
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">{{$followers->count()}} フォロワー</p>
              @foreach($followers as $follower)
              <p class="py-2 px-3 text-grey-darkest" id="followers{{$loop->index}}">
                {{$follower->name}}
              </p>
              @endforeach
            </div>

            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">{{$followings->count()}} フォロー</p>
              @foreach($followings as $following)
              <p class="py-2 px-3 text-grey-darkest" id="followings{{$loop->index}}">
                {{$following->name}}
              </p>
              @endforeach
            </div>

            <a href="{{ url()->previous() }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

