<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
</head>
<body>
    <div id="app">
        @include('common.nav')
        <div class="container-fluid margin-top-15">
            @include('common.message')
            @yield('content')
        </div>
    </div>
    <style>
        .margin-top-15 {
            margin-top: 15px;
        }
        .font-weight-700 {
            font-weight: 700;
        }

        .moeny-outcome{
        color: red;
      }
      .money-net{
        border-bottom: none;
        font-weight: 700;
        color: green;
        background-color: #eee;
      }

      .card-header {
        border-bottom:0px;
      }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>