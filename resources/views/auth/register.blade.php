<!-- ユーザー登録画面 -->

@extends('app')

@section('title', 'ユーザー登録')

@section('content')
<!-- Material form register -->
<div class="container">
<div class="row">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">

    <h5 class="card-header primary-color white-text text-center py-4">
        <strong>ユーザー登録</strong>
    </h5>

    <div class="card mt-3">

    <!--Card content-->
    <div class="card-body px-lg-5 pt-0">

        <div class="card-text">

        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="{{route('register')}}" method="POST"">
            @csrf

            <div class="form-row">
                <div class="col">
                    <!-- name -->
                    <div class="md-form">
                        <input type="text" id="Name" class="form-control" name="name" value="{{ old('name')}}">
                        <label for="Name">名前</label>
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class="md-form mt-0">
                <input type="email" id="Email" class="form-control" name="email" value="{{ old('email') }}">
                <label for="Email">メールアドレス</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="Password" name="password" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                <label for="Password">パスワード</label>
                </small>
            </div>

            <!-- Password 確認用 -->
            <div class="md-form">
                <input type="password" id="materialRegisterFormPassword" name="password_confirmation" class="form-control" aria-describedby="materialRegisterFormPasswordHelpBlock">
                <label for="materialRegisterFormPassword">パスワード(確認)</label>
                <small id="materialRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
                    もう一度パスワードの入力をお願いします
                </small>
            </div>


            <!-- 登録button -->
            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">新規ユーザー登録</button>

            <!-- Social register -->
            <p>googleで登録</p>
            <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger">
                <i class="fab fa-google mr-1"></i>登録
            </a>

        </form>
        <!-- Form -->
    </div>

    <div class="mt-0">
        <a href="{{ route('login') }}" class="card-text text-center">ログインはこちら</a>
    </div>
</div>


    </div>

    @include('error_card_list')


    </div>
</div>
</div>
<!-- Material form register -->


@endsection
