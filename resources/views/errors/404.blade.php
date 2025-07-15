@extends('layouts.app')
@section('title')
@endsection
@section('content')
<!-- <================================================================= BreadCrumb =======================================================> -->

<!-- <================================================================= BreadCrumb =======================================================> -->
<!-- error section start -->
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- error Page Image Start -->
                    <div class="error-page-image wow fadeInUp">
                        <img src="images/error.jpg" alt="">
                    </div>
                    <!-- error Page Image End -->

                    <!-- error Page Content Start -->
                    <div class="error-page-content">
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Oops! page not found</h2>
                        </div>
                        <div class="error-page-content-body">
                            <p class="wow fadeInUp" data-wow-delay="0.2s">The page you are looking for does not exist.</p>
                            <a class="btn-default wow fadeInUp" data-wow-delay="0.4s" href="{{LaravelLocalization::localizeUrl('/')}}">back to home</a>
                        </div>
                    </div>
                    <!-- error Page Content End -->
                </div>
            </div>
        </div>
    </div>
<!-- error section end -->
@endsection
