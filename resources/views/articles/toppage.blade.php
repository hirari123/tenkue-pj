@extends('app')

@section('title', 'トップページ')

@section('content')

  <div class="top">

    {{-- ナビバー --}}
    @include('nav')

    {{-- note入力画面 --}}

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">

        {{-- form.bladeの読み込み  --}}
        @include('articles.form-new')

        {{-- ログイン時のみデータベースに登録する処理を行う --}}
        @auth
        <div class="top__btn">

          <div class="top__btn-new">

            {{-- noteの新規登録 --}}
            <p>
              <input type="submit" class="btn new" name="post-note" value="新規作成"/>
            </p>

            {{-- 画像登録 --}}
            <p>
              <input type="file" class="btn image" name="image" value="画像登録"/>
            </p>

          </div>


          {{-- ログインしている時は一覧ボタンを表示する --}}
          <div class="top__btn-login">

              {{-- 一覧ページへの遷移ボタン --}}
              <p>
                  <a href="{{route('list')}}">
                    <button type="button" class="btn">一覧</button>
                </a>
            </p>

            </div>
        </div>
        @endauth

        {{-- 未ログイン時は下部にログインと会員登録のボタンを表示 --}}
        {{-- ログインしていない時のノートの処理方法の検討 --}}
        @guest
        <div class="top__btn">

          <div class="top__btn-new">

            {{-- noteの新規登録 --}}
            <p>
              <input type="submit" class="btn new" name="post-note" value="新規作成"/>
            </p>

            {{-- 画像登録 未ログインユーザーでの実装方法を要検討 --}}
            <p>
              <input type="submit" class="btn image" name="post-img" value="画像登録"/>
            </p>

          </div>


          {{-- 未ログインの時はログインと会員登録ボタンを表示する --}}
          <div class="top__btn-login">

              {{-- ログイン --}}
              <p>
                  <a href="{{route('login')}}">
                    <button type="button" class="btn">ログイン</button>
                </a>
            </p>

            {{-- 会員登録 --}}
            <p>
                <a href="{{route('register')}}">
                    <button type="button" class="btn">新規会員登録</button>
                </a>
            </p>

            </div>
        </div>
        @endguest

    </form>

    </div>

@endsection
