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
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W538DC3G"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <!-- Header/Navbar -->
    @include('layouts.partials.header')
    @include('layouts.partials.preloader')
    @yield('content')
    @include('layouts.partials.footer')
    @include('layouts.partials.social')
    <!-- JS here -->
    @include('layouts.partials.script')
</body>

</html>
