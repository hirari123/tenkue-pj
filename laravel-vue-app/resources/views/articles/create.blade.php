{{-- note作成画面 html,cssは後ほど差し替え --}}

@extends('app')

@section('title', 'note作成')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('articles.store') }}">

                {{-- 新規作成、編集でもform部分は共有使用する --}}
                @include('articles.form')

                <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
