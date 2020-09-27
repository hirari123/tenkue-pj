{{-- note作成画面 --}}

@extends('app')

@section('title', 'note作成')

@section('content')

<div class="top">

    @include('nav')

    {{-- エラー確認のための表示機能 解決したら破棄 --}}
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 入力内容に不備がある場合のエラーの表示方法について要検討 --}}
    {{-- @include('error_card_list') --}}

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">

    {{-- 新規作成、編集でもform部分は共有使用する --}}
    @include('articles.form')

    {{-- noteの新規登録 --}}
    <p>
        <input type="submit" class="btn new" value="新規作成"/>
    </p>

    {{-- 画像登録 --}}
    <p>
        <input type="file" class="btn image" name="image" value="画像登録" multiple/>
    </p>

    {{-- 一覧ページへの遷移ボタン --}}
        <p>
            <a href="{{route('articles.index')}}">
                <button type="button" class="btn">一覧</button>
            </a>
        </p>


    </form>

</div>
@endsection
