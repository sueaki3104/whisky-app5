<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('自分の棚にウイスキーを登録する') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                @include('common.errors')
                <form class="mb-6" action="{{ route('shelves.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 購入日 -->
                    <div class="mt-4">
                        <x-input-label for="buy_date" :value="__('購入日')" />
                        <x-text-input id="buy_date" class="block mt-1 w-full" type="date" name="buy_date" :value="old('buy_date')" required />
                        <x-input-error :messages="$errors->get('buy_date')" class="mt-2" />
                    </div>

                    <!-- 購入場所 -->
                    <div class="mt-4">
                        <x-input-label for="buy_address" :value="__('購入場所')" />
                        <x-text-input id="buy_address" class="block mt-1 w-full" type="text" name="buy_address" :value="old('buy_address')" required />
                        <x-input-error :messages="$errors->get('buy_address')" class="mt-2" />
                    </div>

                    <!-- ウイスキー名 -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('ウイスキーの名前')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- 単価 -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('単価(税込)')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- 購入数量 -->
                    <div class="mt-4">
                        <x-input-label for="num" :value="__('購入数量')" />
                        <x-text-input id="num" class="block mt-1 w-full" type="number" name="num" :value="old('num')" required />
                        <x-input-error :messages="$errors->get('num')" class="mt-2" />
                    </div>


                    <!-- 思い出 -->
                    <div class="flex flex-col mt-4">
                        <x-input-label for="memory" :value="__('思い出（テキスト191文字）')" />
                        <textarea class="border py-2 px-3 text-grey-darkest resize-none" name="memory" id="memory" rows="4"></textarea>
                    </div>

                    <!-- 写真 -->
                    <x-shelves.form.images></x-shelves.form.images>

                    <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        投稿する
                    </button>
                </form>






                </div>
            </div>
        </div>
    </div>
</x-app-layout>
