<style>
    .fontBold{
        font-weight: bold;
    }
    /* 上部 */
    .shelves-header {
        width: 100%;
        margin: 12px auto;
        text-align: center;
    }
    .shelves-header > div{
        display: inline-block;
        padding: 6px 0px;
        margin: 0 20px;
        border-radius: 8px;
        color: #fff;
        text-align: center;
    }
    .shelves-header > div._name{
        width: calc(100% - 120px - 100px);
        background-color: #44aaff;
    }
    .shelves-header > div._register{
        width: 120px;
        background-color: #ff66ff;
    }
    .shelves-header > div._register:hover{
        background-color: #ff88ff;
    }
    .shelves-header > div._register:active{
        background-color: #dd44dd;
    }


    /* 本数とか合計金額とか */
    .shelves-status{
        margin: 12px auto;
        text-align: center;
    }
    .shelves-status > div{
        display: inline-block;
        width: calc(50% - 20px);
        padding: 8px 0;
        margin: 0 auto;
        background-color: #cccccc;
        font-size: 85.0%;
        line-height: 200%;
        text-align: center;
    }

    /* 棚本体 */
    ul.shelves-list{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: flex-start;
        justify-content: flex-start;
        align-items: center;
    }
    ul.shelves-list li{
        width: 33.3%;
        padding: 0;
        text-align: center;
        border-bottom: 2px solid #8b4513;
        border-right: 2px solid #8b4513;
    }
    ul.shelves-list li:nth-child(3n){
        border-right: none;
    }
    ul.shelves-list li img{
        display: block;
        margin: 0 auto;
        padding: 5px 0;
        width: auto;
        height: 90px;
        max-height: 90px;
    }
    ul.shelves-list li a{
        display: block;
        padding: 10px 0 2px;
        width: 100%;
        height: 100%;
        font-size: 85.0%;
        background-color: #deb887;
    }
    ul.shelves-list li:nth-child(2n) a{
        background-color: #d2b48c;
    }

</style>


<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="shelves-header">
                        <div class="_name">{{  Auth::user()->name  }}<br>ウィスキー棚</div>

                        <div class="_register"><a href="{{ route('shelves.register') }}">ウィスキー<br>新規登録</a></div>
                    </div>


                    <div class="shelves-status">
                        <div>棚には<br><span class="fontBold">{{ number_format($whiskyNum->total_num) }}本</span>あります</div>
                        <div>コレクションの費用は<br><span class="fontBold">{{ number_format($whiskyPriceTotal->total_price) }}円</span>です</div>
                    </div>


                    <div>
                        <ul class="shelves-list">

                            @foreach($shelvesData as $key=>$val)
                                <li>
                                    <a href="{{ route('shelves.show', $val->id) }}">
                                        @if( isset($val->innerJoinImages[0]) )
                                            <img src="{{ asset('storage/images/' . $val->innerJoinImages[0]->hash_name) }}" width="100px" height="100px">
                                        @else
                                            <img src="{{ asset('./img/whiskylogo.png') }}" width="35px" height="35px">
                                        @endif

                                        <div>
                                            <span>{{ $val->name }}</span><br>
                                            <span>{{ \Carbon\Carbon::parse($val->buy_date)->format('Y/m/d') }}</span><br>
                                        </div>

                                        <span>詳細を見る</span>
                                    </a>
                                </li>
                            @endforeach



                        </ul>
                    </div>









                </div>
            </div>
        </div>
    </div>
</x-app-layout>
