<!-- ユーザー登録画面 -->

@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<div class="container">
  <div class="inner">
    <header class="header">
      <h1 class="apptitle">everynote</h1>
    </header>

    @include('error_card_list')

    <div class="form_wrapper">
      <form action="{{route('register')}}" method="POST">

        @csrf

        <p class="inputlabel">名前</p>
        <p class="input"><input type="text" id="name" class="user" name="name" placeholder="太郎" required value="{{old('name')}}"></p>
        <p class="inputlabel">メールアドレス</p>
        <p class="input"><input type="email" class="user" id=“email” name="email" placeholder="hoge@mail.com" required value="{{old('email')}}"></p>
        <p class="inputlabel">パスワード</p>
        <p class="input"><input type="password" class="user" id=“password” name="password" placeholder="******" required></p>
        <p class="btn"><input type="submit"  class="btn" name="register" value="新規会員登録"></p>
        <p class="btn"><input type="button" class="btn" name="google" value="googleアカウントで登録"></p>
      </form>
    </div><!--form_wrapper-->
  </div><!--inner-->
</div><!--container-->
@endsection
