@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
    @php echo $schema @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', trans('home.galleryVideos'))


@foreach ($vediosTitle as $title)
    @include('website.section-partials.bredcrmab')
@endforeach
<!-- <================================================================= BreadCrumb =======================================================> -->
@include('website.section-partials.video')
<!--================------------>
@endsection
