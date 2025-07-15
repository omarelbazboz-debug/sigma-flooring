@extends('layouts.app')
@section('meta')
    <title>Search-Result</title>
@endsection
@section('content')

    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', $search_input)


@foreach ($aboutTitle as $title)
    @include('website.section-partials.bredcrmab')
@endforeach
<!-- <================================================================= BreadCrumb =======================================================> -->
<!--====================== Service =========================--->
<section class="destination1 section-padding">
    <div class="container">
        <div class="row">
            @if ($services->isNotEmpty())
                @foreach ($services as $index => $service)
                    <div class="col-md-4">
                        <div class="item">
                            <a href="{{ LaravelLocalization::LocalizeUrl('service/' . $service->{'link_' . $lang}) }}">
                                <div class="position-re o-hidden">
                                    <img src="{{ asset('uploads/services/source/' . $service->img) }}" alt="img">
                                </div>
                            </a>
                            <div class="con">
                                <h5>
                                    <a
                                        href="{{ LaravelLocalization::LocalizeUrl('service/' . $service->{'link_' . $lang}) }}">
                                        <i class="ti-location-pin"></i>
                                        {{ $service->{'name_' . $lang} }}
                                    </a>
                                </h5>
                                <div class="line"></div>
                                <div class="row facilities">
                                    <div class="col col-md-8">
                                        <p>{{ $service->{'shorttext_' . $lang} }}</p>
                                    </div>
                                    <div class="col col-md-4 text-right">
                                        <div class="permalink">
                                            <a
                                                href="{{ LaravelLocalization::LocalizeUrl('service/' . $service->{'link_' . $lang}) }}">{{ trans('home.more') }}
                                                <i class="ti-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center col-12">Not Found</p>
            @endif
        </div>
    </div>
</section>
<!--====================== Service =========================--->
@endsection
