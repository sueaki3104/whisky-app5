<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"> -->
    <form method="post" action="{{ route('profile.update_prefecture') }}" class="mt-6 space-y-6">

        @csrf
        @method('patch')



        <!-- 都道府県 -->
        <div class="mt-4">
            <x-input-label for="prefecture" :value="__('あなたが登録した都道府県は')" />
            <p class="text-gray-700 font-medium">{{ $prefecture_select[ $user->prefecture ] }}です</p>

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
            <x-input-error :messages="$errors->get('prefecture')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
