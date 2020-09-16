{{-- note作成画面 --}}

@extends('app')

@section('title', 'note作成')

@section('content')

<div class="top">

    @include('nav')

    {{-- 入力内容に不備がある場合のエラーの表示方法について要検討 --}}
    {{-- @include('error_card_list') --}}

    <form method="POST" action="{{ route('articles.store') }}">

    {{-- 新規作成、編集でもform部分は共有使用する --}}
    @include('articles.form')

    {{-- noteの新規登録 --}}
    <p>
        <input type="submit" class="btn new" name="post-note" value="新規作成"/>
    </p>

    {{-- 画像登録 --}}
    <p>
        <input type="submit" class="btn image" name="post-img" value="画像登録"/>
    </p>


    </form>

</div>
@endsection
