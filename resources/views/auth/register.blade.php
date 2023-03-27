<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード 再入力')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('既にアカウントは作っていましたか？') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('新規作成') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
