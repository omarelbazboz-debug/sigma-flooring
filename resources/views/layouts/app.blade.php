<!doctype html>
<html lang="{{LaravelLocalization::getCurrentLocale() }}"
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'ltr') dir="ltr" @else dir="rtl" @endif>




<head>
    <!-- Meta -->
    @include('layouts.partials.meta')
    <!-- CSS here -->
    @include('layouts.partials.head')
</head>

<body>

    <!-- Header/Navbar -->
    @include('layouts.partials.header')
    @include('layouts.partials.preloader')
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.social')
    <!-- JS here -->
    @include('layouts.partials.script')
</body>

</html>
