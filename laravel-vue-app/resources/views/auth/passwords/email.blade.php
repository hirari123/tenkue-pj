<!-- パスワード再設定メール要求画面 -->

@extends('app')

@section('title', 'パスワード再設定')

@section('content')
<div class="container">
  <div class="inner">
    <header class="header">
      <h1 class="apptitle">everynote</h1>
    </header>

    @include('error_card_list')

    <div class="form_wrapper">
      <form method="POST" action="{{ route('password.email') }}">

        @csrf

        <p class="inputlabel">メールアドレス</p>
        <p class="input"><input type="email" class="user" id=“email” name="email" placeholder="hoge@mail.com" required></p>
        <div class="caution">
          登録されているメールアドレス宛にパスワード再設定のご案内メールをお送りします。<br><br>

          メールに記載の手順に従ってパスワードを再設定してください。
        </div>

        <p class="btn"><input type="submit" class="btn" name="mailsent" value="メール送信"></p>

      </form>
    </div>
    <!--form_wrapper-->
  </div>
  <!--inner-->
</div>
<!--container-->
@endsection