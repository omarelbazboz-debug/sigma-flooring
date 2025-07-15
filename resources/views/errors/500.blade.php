@extends('layouts.app')
@section('title')
@endsection
@section('content')
<!-- <================================================================= BreadCrumb =======================================================> -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-2" data-cursor="-opaque"><span>{{ trans('home.page not found') }}</span></h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ LaravelLocalization::LocalizeUrl('/') }}">{{ trans('home.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('home.page not found') }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- <================================================================= BreadCrumb =======================================================> -->
<!-- error section start -->
<div class="error-page">
    <div class="container">
        <div class="row">
            <div class="error-page-image wow fadeInUp" data-wow-delay="0.25s">
                <img src="{{asset('assets/front/images/404-error-img.png')}}" alt="error">
            </div>
            <div class="error-page-content">
                <div class="error-page-content-heading">
                    <h2 class="text-anime-style-2" data-cursor="-opaque"><span> {{ trans('home.page not found') }}!</span></h2>
                </div>
                <div class="error-page-content-body">
                    <a class="btn-default wow fadeInUp" data-wow-delay="0.75s" href="./">{{ trans('home.Back To Home') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- error section end -->
@endsection
