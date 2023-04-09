<style>

</style>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('○○さんのウイスキー') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <img src="{{ asset('storage/images/' . $whisky->innerJoinImages[0]->hash_name) }}" width="80%" height="auto">

                    <div class="mt-4">
                        <span>{{ __("品名") }}</span>
                        <span>{{ $whisky->name }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購入日") }}</span>
                        <span>{{ \Carbon\Carbon::parse($whisky->buy_date)->format('Y/m/d') }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購入場所") }}</span>
                        <span>{{ $whisky->buy_address }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("価格(税込)") }}</span>
                        <span>{{ $whisky->price }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("購入数量") }}</span>
                        <span>{{ $whisky->num }}</span>
                    </div>
                    <div class="mt-4">
                        <span>{{ __("思い出") }}</span>
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
