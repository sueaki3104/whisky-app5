<!-- resources/views/tweet/create.blade.php -->



<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('新しい投稿を作成する') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="tweet">MAX（テキスト1024文字 画像２枚）</label>
              <textarea class="border py-2 px-3 text-grey-darkest resize-none" name="tweet" id="tweet" rows="4"></textarea>
            </div>

            <x-tweet.form.images></x-tweet.form.images>

            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              投稿する
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
