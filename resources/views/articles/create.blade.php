{{-- note作成画面 --}}

@extends('app')

@section('title', 'note作成')

@section('content')

@include('nav')
<div class="container">


    @include('error_card_list')

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">

    {{-- 新規作成専用のformを使用する --}}
    @include('articles.form-new')


    <div class="row">
        {{-- noteの新規登録 --}}
        <div class="col-12 col-md-6 text-center">
            <button type="submit" class="btn btn-primary">新規作成</button>
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


    </form>

</div>
@endsection
