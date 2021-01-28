{{-- 作成したnoteの一覧表示をする --}}

@extends('app')

@section('title', '一覧ページ')

@section('content')

    {{-- ナビバー --}}
    @include('nav')

<div class="container">

    {{-- 作成したノートを最新順に行で表示する --}}

    @foreach($articles as $article)

    <div class="card text-left mt-4 mb-4 mx-auto" style="width: 400px">
        {{-- noteのタイトルと作成時間の表示 タイトルをクリックすると詳細画面へと遷移 --}}
        <div class="card-body">
            <h5 class="card-title text-left">
                <a class="text-dark" href="{{ route('articles.edit', ['article' => $article]) }}">
                    {{$article->note_title}}
                </a>
            </h5>

            <p class="card-text text-left ml-3">
                {{$article->content}}
            </p>

            {{-- 編集ボタンと削除ボタン --}}
            @if( Auth::id() === $article->user_id )

            <div class="row mt-4">
            {{-- 編集ボタン --}}
                    <a href="{{ route("articles.edit", ['article' => $article]) }}" class="btn btn-outline-primary btn-sm ml-4">
                        編集
                    </a>
            {{-- 削除ボタン --}}
                    <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">削除</button>
                    </form>
            </div>
            @endif
        </div>
        <div class="card-footer text-muted">{{$article->created_at->format('Y/m/d H:i')}}</div>
    </div>

    @endforeach

</div>
@endsection
