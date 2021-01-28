@extends('app')

@section('title', 'トップページ')

{{-- ナビバー --}}
@include('nav')

@section('content')

    <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">

    {{-- note入力画面 --}}

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">

        {{-- form.bladeの読み込み  --}}
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
        </div>

    </form>

    </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
