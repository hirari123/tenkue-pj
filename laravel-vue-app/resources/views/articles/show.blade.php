@extends('app')

@section('title', 'note詳細')

@section('content')
  @include('nav')
  <div class="container">
    @include('articles.card')
  </div>
@endsection
