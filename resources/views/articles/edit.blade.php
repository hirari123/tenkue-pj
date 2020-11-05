{{-- note更新画面 --}}

@extends('app')

@section('title', 'note編集')

@section('content')

<div class="top">

    @include('nav')

    {{-- 入力内容に不備がある場合のエラーの表示方法について要検討 --}}
    {{-- @include('error_card_list') --}}

        <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('articles.form')

        {{-- noteの更新 --}}
            <p>
              <input type="submit" class="btn new" name="post-note" value="更新"/>
            </p>

            {{-- 画像登録 --}}
            <p>
              <input type="file" class="btn image" name="image" value="画像登録"/>
            </p>
        </form>

        {{-- 削除ボタン --}}
        <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn edit">削除</button>
        </form>

        {{-- 一覧ページへの遷移ボタン --}}
        <p>
            <a href="{{route('articles.index')}}">
                <button type="button" class="btn">一覧</button>
            </a>
        </p>

</div>

@endsection
