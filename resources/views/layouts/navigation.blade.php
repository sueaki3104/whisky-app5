<!-- resources/views/layouts/navigation.blade.php -->

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
          <a href="{{ route('tweet.index') }}">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
          </a>
        </div>

        <!-- Navigation Links -->
        <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('ホーム') }}
          </x-nav-link>
        </div> -->
        <!-- 🔽 一覧ページへのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('tweet.index')" :active="request()->routeIs('tweet.index')">
            {{ __('投稿一覧') }}
          </x-nav-link>
        </div>
        <!-- 🔽 作成ページへのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
            {{ __('新規投稿') }}
          </x-nav-link>
        </div>
        <!-- 🔽 マイページへのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('tweet.mypage')" :active="request()->routeIs('tweet.mypage')">
            {{ __('自分の投稿') }}
          </x-nav-link>
        </div>
        <!-- 🔽 タイムラインへのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('tweet.timeline')" :active="request()->routeIs('tweet.timeline')">
            {{ __('フォロワー') }}
          </x-nav-link>
        </div>

        <!-- 🔽 検索画面へのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('search.input')" :active="request()->routeIs('search.input')">
            {{ __('検索') }}
          </x-nav-link>
        </div>

      </div>

      <!-- Settings Dropdown -->
      <div class="hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
              <div>{{ Auth::user()->name }}</div>

              <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>





          <x-slot name="content">
            <form method="GET" action="{{ route('profile.edit') }}">
              @csrf

              <x-dropdown-link :href="route('profile.edit')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('プロフィール') }}
              </x-dropdown-link>
            </form>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                {{ __('ログアウト') }}
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <!-- Hamburger -->
      <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>





<!-- ==================================================================================== -->
<!-- ▼スマホ表示 専用ハンバーガーメニュー内の項目リスト ▼ -->
<!-- ==================================================================================== -->
  <!-- Responsive Navigation Menu -->
  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('ホーム') }}
      </x-responsive-nav-link>
    </div> -->
    <!-- 🔽 一覧ページへのリンクを追加 -->
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('tweet.index')" :active="request()->routeIs('tweet.index')">
        {{ __('投稿一覧') }}
      </x-responsive-nav-link>
    </div> -->
    <!-- 🔽 作成ページへのリンクを追加 -->
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('tweet.create')" :active="request()->routeIs('tweet.create')">
        {{ __('新規投稿') }}
      </x-responsive-nav-link>
    </div> -->
    <!-- 🔽 マイページへのリンクを追加 -->
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('tweet.mypage')" :active="request()->routeIs('tweet.mypage')">
        {{ __('自分の投稿') }}
      </x-responsive-nav-link>
    </div> -->
    <!-- 🔽 タイムラインへのリンクを追加 -->
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('tweet.timeline')" :active="request()->routeIs('tweet.timeline')">
        {{ __('フォロワー') }}
      </x-responsive-nav-link>
    </div> -->

    <!-- 🔽 検索画面へのリンクを追加 -->
    <!-- <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('search.input')" :active="request()->routeIs('search.input')">
        {{ __('検索') }}
      </x-responsive-nav-link>
    </div> -->

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
      <div class="px-4">
        <a href="{{ route('profile.edit') }}">
            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </a>
      </div>

      <div class="mt-3 space-y-1">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>

  </div>
</nav>


<!-- ==================================================================================== -->
<!-- ▼スマホ表示 ページ下部固定のグローバルメニュー ▼ -->
<!-- ==================================================================================== -->
<nav>
    <style>
        .sm-globalmenu{
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2px 0;
            margin: 0;
            border-top: 1px solid #aaaaaa;
            background-color: #ffffff;
        }
        .sm-globalmenu > ul{
            display: flex;
            justify-content: space-around;
            flex-wrap: nowrap;
            align-items: center;
        }
        .sm-globalmenu > ul li{
            text-align: center;
        }
        .sm-globalmenu > ul li svg{
            text-align: center;
            margin: 0 auto;
        }

        .sm-tweetButton{
            position: fixed;
            bottom: 70px;
            right: 15px;
        }
    </style>

    <div class="sm-globalmenu sm:hidden" style="">
        <ul>
            <!-- 投稿一覧 -->
            <li>
                <a href="{{ route('tweet.index') }}">
                    <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                    </svg>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <!-- 投稿一覧 -->
            <li>
                <a href="{{ route('tweet.index') }}">
                    <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                    </svg>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <!-- 投稿一覧 -->
            <li>
                <a href="{{ route('tweet.index') }}">
                    <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                    </svg>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <!-- 投稿一覧 -->
            <li>
                <a href="{{ route('tweet.index') }}">
                    <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                    </svg>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>
            <!-- 投稿一覧 -->
            <li>
                <a href="{{ route('tweet.index') }}">
                    <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
                    </svg>
                    <span>{{ __('Home') }}</span>
                </a>
            </li>

        </ul>
    </div>

    <!-- ツイートするボタン -->
    <div class="sm-tweetButton sm:hidden">
        <a href="{{ route('tweet.create') }}">
            <svg class="h-6 w-6 text-red-500" fill="yellow" viewBox="0 0 24 24" stroke="red">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 17.75l-6.172 3.245 1.179-6.873-4.993-4.867 6.9-1.002L12 2l3.086 6.253 6.9 1.002-4.993 4.867 1.179 6.873z" />
            </svg>
        </a>
    </div>

<nav>
