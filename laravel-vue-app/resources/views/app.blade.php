<!DOCTYPE html>
<html lang="ja">

  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=375,
            height=812,
            initial-scale=1.0,
            minimum-scale=1.0,
            maximum-scale=2.0,
            user-scalable=yes" />

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>
      @yield('title')
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    {{-- public/assets/cssに配置しているCSSの読み込み --}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/base.css')}}">

  </head>

  <body>

    @yield('content')

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>

  </body>

</html>
