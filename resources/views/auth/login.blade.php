<!-- ログイン画面 -->

@extends('app')

@section('title', 'ログイン')

@section('content')
  <div class="container">
    <div class="inner">
      <header class="header">
        <h1 class="apptitle">everynote</h1>
      </header>

      @include('error_card_list')

      <div class="form_wrapper">
        <form action="{{route('login')}}" method="POST">

          @csrf

          <p class="inputlabel">メールアドレス</p>
          <p class="input"><input type="email" class="user" id="email" name="email" placeholder="hoge@mail.com" required value="{{old('email')}}"></p>

          <p class="inputlabel pw">パスワード</p>
          <p class="input"><input type="password" class="user" id=“password” name="password" placeholder="******" required value="{{old('email')}}"></p>

          <p class="btn"><input type="submit"  class="btn login" name="regist" value="ログイン"></p>

          <!-- .btnのホバーを削除しました -->
          <p class="pwforgrt"><a href="{{ route('password.request') }}" class="pwforgrt">パスワードをお忘れの場合</a></p>


        </form>
      </div><!--form_wrapper-->
    </div><!--inner-->
  </div><!--container-->
@endsection
