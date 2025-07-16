@extends('layouts.auth')
<title>{{trans('home.login')}}</title>
@section('content')
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="{{asset('uploads/settings/source/'.$configration->app_logo)}}" alt="" height="28">
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">{{__('home.WelcomeToAdminPanel')}} !</h5>
                                    </div>
                                    <form action="{{route('login')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">{{trans('home.email')}}</label>
                                            <input type="email" class="form-control" name="email" id="username" placeholder="{{trans('home.email')}}">
                                            @error('email')
                                                <span class="text-danger " role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                             <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">{{trans('home.password')}}</label>
                                                </div>
                                               {{-- <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" placeholder="{{trans('home.password')}}" name="password" @error('password') is-invalid @enderror
                                                    aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                @error('password')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>

                                        </div> --}}
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">{{__('home.login')}}</button>
                                        </div>
                                    </form>

                                    {{-- <div class="mt-4 pt-2 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign in with -</h5>
                                        </div>

                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript:void()"
                                                    class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                                    {{-- <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Don't have an account ? <a href="auth-register.html"
                                                class="text-primary fw-semibold"> Signup now </a> </p>
                                    </div> --}}
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> {{$configration->app_name}}   . Crafted with <i class="mdi mdi-heart text-danger"></i>
                                        by
                                        <a href="{{LaravelLocalization::localizeUrl('https://be-group.com/')}}" target="_blank" class="text-decoration-none">
                                            {{trans('home.be-group')}}.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <!-- Carousel Indicators -->
                                        <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            @foreach ($aboutStrucs as $index => $aboutStruc)
                                                <button type="button" data-bs-target="#reviewcarouselIndicators"
                                                data-bs-slide-to="{{$index}}" class="{{$index==0 ? 'active' : ''}}"
                                                aria-current="{{$index==0 ? 'true' : 'false'}}" aria-label="Slide {{$index + 1}}"></button>
                                            @endforeach
                                        </div>
                                        <!-- End Carousel Indicators -->

                                        <!-- Carousel Inner -->
                                        <div class="carousel-inner">
                                            @foreach ($aboutStrucs as $index => $aboutStruc)
                                                <div class="carousel-item {{$index==0 ? 'active' : ''}}">
                                                    <div class="testi-contain text-white">
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h3 class="font-size-25 text-white">{{$aboutStruc->title}}</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                                        <h4 class="mt-4 fw-medium lh-base text-white">
                                                            {!! $about->{'text_'.$lang} !!}
                                                        </h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- End Carousel Inner -->
                                    </div>
                                    <!-- End Review Carousel -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <!-- Page -->
    {{-- <div class="page main-signin-wrapper">

        <!-- Row -->
        <div class="row text-center pl-0 pr-0 ml-0 mr-0">
            <div class="col-lg-3 d-block mx-auto">
                <div class="text-center mb-2">
                    <img src="{{asset('uploads/settings/source/'.$configration->app_logo)}}" class="header-brand-img" alt="logo">
                </div>
                <div class="card custom-card">
                    <div class="card-body">
                        <h4 class="text-center">{{trans('home.Signin to Your Account')}}</h4>
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group text-left">
                                <label>{{trans('home.email')}}</label>
                                <input class="form-control" placeholder="{{trans('home.email')}}" type="email"  name="email" @error('email') is-invalid @enderror />
                                @error('email')
                                    <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-left">
                                <label>{{trans('home.password')}}</label>
                                <input class="form-control" placeholder="{{trans('home.password')}}" type="password" name="password" @error('password') is-invalid @enderror />
                                @error('password')
                                <span class="danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn ripple btn-main-primary btn-block">{{trans('home.login')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div> --}}
    <!-- End Page -->

@endsection
