<!-- resources/views/search/input.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('検索してみよう！') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('search.result') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="keyword">文字検索します</label>
              <input class="border py-2 px-3 text-grey-darkest" type="text" name="keyword" id="keyword">
            </div>
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              検索開始
            </button>
          </form>
        </div>

        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('search.prefecture') }}" method="GET">
            @csrf
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="keyword">都道府県別サーチ</label>

                <!-- 都道府県 -->
                <div class="mt-4">
                    <x-input-label for="prefecture" :value="__('都道府県')" />
                    <select name="prefecture" id="prefecture" required="required" autofocus="autofocus">
                        <option value="1">北海道</option>
                        <option value="2">青森</option>
                        <option value="3">岩手</option>
                        <option value="4">宮城</option>
                        <option value="5">秋田</option>
                        <option value="6">山形</option>
                        <option value="7">福島</option>
                        <option value="8">茨城</option>
                        <option value="9">栃木</option>
                        <option value="10">群馬</option>
                        <option value="11">埼玉</option>
                        <option value="12">千葉</option>
                        <option value="13">東京</option>
                        <option value="14">神奈川</option>
                        <option value="15">新潟</option>
                        <option value="16">富山</option>
                        <option value="17">石川</option>
                        <option value="18">福井</option>
                        <option value="19">山梨</option>
                        <option value="20">長野</option>
                        <option value="21">岐阜</option>
                        <option value="22">静岡</option>
                        <option value="23">愛知</option>
                        <option value="24">三重</option>
                        <option value="25">滋賀</option>
                        <option value="26">京都</option>
                        <option value="27">大阪</option>
                        <option value="28">兵庫</option>
                        <option value="29">奈良</option>
                        <option value="30">和歌山</option>
                        <option value="31">鳥取</option>
                        <option value="32">島根</option>
                        <option value="33">岡山</option>
                        <option value="34">広島</option>
                        <option value="35">山口</option>
                        <option value="36">徳島</option>
                        <option value="37">香川</option>
                        <option value="38">愛媛</option>
                        <option value="39">高知</option>
                        <option value="40">福岡</option>
                        <option value="41">佐賀</option>
                        <option value="42">長崎</option>
                        <option value="43">熊本</option>
                        <option value="44">大分</option>
                        <option value="45">宮崎</option>
                        <option value="46">鹿児島</option>
                        <option value="47">沖縄</option>
                        <option value="48">内緒</option>
                    </select>
                    <!-- <x-text-input id="prefecture" class="block mt-1 w-full" type="text" name="prefecture" :value="old('prefecture')" required autofocus autocomplete="prefecture" /> -->
                    <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
                </div>

            </div>
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              サーチ開始
            </button>
          </form>
        </div>


      </div>
    </div>
  </div>
</x-app-layout>





