<!-- ナビバー -->
<nav class="navbar navbar-expand navbar-dark primary-color">

  <a class="navbar-brand" href="/"><i class="fas fa-book-open mr-1"></i>everynote</a>

  <ul class="navbar-nav ml-auto">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{route('articles.create')}}"><i class="fas fa-pen mr-1"></i>新規作成</a>
    </li>


    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='/list'">
          マイページ
        </button>

        <div class="dropdown-divider"></div>

        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
        </form>

      </div>
    </li>
    <form id="logout-button" method="POST" action="">
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>

</nav>
