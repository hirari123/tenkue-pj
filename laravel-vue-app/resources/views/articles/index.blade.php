{{-- 作成したnoteの一覧表示をする --}}

@extends('app')

@section('title', '一覧ページ')

@section('content')

  <div class="top">

    {{-- ナビバー --}}
    @include('nav')

    {{-- 作成したノートを最新順に行で表示する --}}
    @foreach($articles as $article)

      <div class="chart">

        <div class="chart-list">

          {{-- noteのタイトルと作成時間の表示 タイトルをクリックすると詳細画面へと遷移 --}}
          <span>
              <a class="text-dark" href="{{ route('articles.edit', ['article' => $article]) }}">
            {{$article->note_title}}
              </a>
            {{$article->created_at->format('Y/m/d H:i')}}
          </span>

          {{-- 編集ボタンと削除ボタン --}}
          {{-- noteの作成ユーザーのみに編集、削除ボタンを表示する？ --}}
          @if( Auth::id() === $article->user_id )

          <span>

              {{-- 編集ボタン --}}
              <a href="{{ route("articles.edit", ['article' => $article]) }}">
                  <button type="button" class="btn edit" href>編集</button>
              </a>

              {{-- 削除ボタン モーダルの実装をどうするか 現状確認なしでワンボタン削除 --}}
              <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn edit">削除</button>
              </form>

            </span>

          @endif
        </div>

          {{-- noteの内容表示 保留 --}}
          {{-- <div class="card-text">
            {!! nl2br(e($article->content)) !!}
          </div> --}}
     </div>
    @endforeach

     {{-- 作成ボタンとログアウトボタン --}}
     <div class="top__btn">

        <div class="top__btn-login">

        {{-- create.bladeへのリンクボタン --}}
        <p>
            <a href="{{route('articles.create')}}">
                <button type="button" class="btn">新規作成</button>
            </a>
        </p>

        {{-- ログアウト処理 --}}
        <button form="logout-button" type="submit" class="btn">ログアウト</button>
        <form id="logout-button" method="POST" action="{{ route('logout') }}">
        @csrf
        </form>

        </div>

    </div>

  </div>
@endsection
