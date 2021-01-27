<!-- ログイン画面 -->

@extends('app')

@section('title', 'ログイン')

@section('content')
<div class="container">
<div class="row">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">


    <!-- Material form login -->
<div class="card">

  <h5 class="card-header primary-color white-text text-center py-4">
    <strong>ログイン</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <form class="text-center" style="color: #757575;" action="{{route('login')}}" method="POST">
        @csrf

      <!-- Email -->
      <div class="md-form">
        <input type="email" id="Email" class="form-control" name="email" required>
        <label for="Email" value="{{old('email')}}">メールアドレス</label>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input type="password" id="Password" class="form-control" name="password" required>
        <label for="Password" value="{{old('password')}}">パスワード</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Forgot password -->
          <a href="{{ route('password.request') }}" class="card-text">パスワードをお忘れの場合</a>
        </div>
      </div>

      <input type="hidden" name="remember" id="remember" value="on">

      <!-- Sign in button -->
      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">ログイン</button>

      <!-- Register -->
      <p>
        <a href="{{ route('register') }}" class="card-text">ユーザー登録はこちら</a>
      </p>

      <!-- Social login -->

    </form>
    <!-- Form -->

  </div>

</div>
<!-- Material form login -->


      @include('error_card_list')
</div>
</div>
</div>
@endsection
