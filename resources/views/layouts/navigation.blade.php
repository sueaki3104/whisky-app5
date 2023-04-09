<!-- resources/views/layouts/navigation.blade.php -->

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
  <!-- Primary Navigation Menu -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <!-- Logo -->
        <div class="shrink-0 flex items-center">
            <a href="{{ route('tweet.index') }}">
                <img src="{{ asset('./img/whiskylogo.png') }}" width="35px" height="35px">
            </a>
        </div>


        <!-- Navigation Links -->

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
            {{ __('フォロー') }}
          </x-nav-link>
        </div>

        <!-- 🔽 検索画面へのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('search.input')" :active="request()->routeIs('search.input')">
            {{ __('検索') }}
          </x-nav-link>
        </div>

        <!-- 🔽 棚へのリンクを追加 -->
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
          <x-nav-link :href="route('shelves.index')" :active="request()->routeIs('shelves.index')">
            {{ __('棚へ') }}
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
        {{ __('フォロー') }}
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg>
                    <span>{{ __('投稿一覧') }}</span>
                </a>
            </li>
            <!-- 自分の投稿 -->
            <li>
                <a href="{{ route('tweet.mypage') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <span>{{ __('自分の投稿') }}</span>
                </a>
            </li>
            <!-- フォロワー -->
            <li>
                <a href="{{ route('tweet.timeline') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-heart" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276Z"/>
                    </svg>
                    <span>{{ __('フォロー') }}</span>
                </a>
            </li>
            <!-- 検索 -->
            <li>
                <a href="{{ route('search.input') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    <span>{{ __('検索') }}</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ツイートするボタン新規投稿 -->
    <div class="sm-tweetButton sm:hidden">
        <a href="{{ route('tweet.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#f00" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </a>
    </div>

<nav>
