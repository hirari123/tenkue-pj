{{-- note更新画面 --}}

@extends('app')

@section('title', 'note編集')

@section('content')

    @include('nav')

    <div class="container">

    @include('error_card_list')

        <form method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('articles.form')

        <div class="row">
        {{-- noteの更新 --}}
        <div class="col-12 col-md-6 text-center">
            <button type="submit" class="btn btn-primary">更新</button>
        </div>
        {{-- 画像登録 --}}
        <div class="col-12 col-md-6 text-center">
            <button type="file" class="btn btn-info">画像登録</button>
        </div>

        {{-- 一覧ページへの遷移ボタン --}}
        <div class="col-12 text-center mt-2">
            <a href="{{route('articles.index')}}">
                <button type="button" class="btn btn-outline-info">一覧ページへ</button>
            </a>
        </div>

        </div>

    </div>
@endsection
