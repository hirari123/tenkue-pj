{{-- 現状のアプリの機能の関係で不要 --}}

@extends('app')

@section('title', 'note詳細')

@section('content')
<div class="top">
  @include('nav')
    @include('articles.card')
</div>
@endsection
