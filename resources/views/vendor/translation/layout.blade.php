<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/back/img/b-group.webp')}}" type="image/x-icon"/>
    <title>{{trans('home.translation')}}</title>
    <link rel="stylesheet" href="{{ asset('assets/back/translation/css/main.css') }}">
</head>
<body>

    <div id="app">

        @include('translation::nav')
        @include('translation::notifications')

        @yield('body')

    </div>

    <script src="{{ asset('assets/back/translation/js/app.js') }}"></script>
</body>
</html>
