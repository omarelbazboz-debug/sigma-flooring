@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================= BreadCrumb ===================> -->
    @section('bredcrmab', trans('home.Our Gallery'))


    @foreach ($galleryTitle as $title)
        @include('website.section-partials.bredcrmab')
    @endforeach
    <!-- <================= BreadCrumb ===================> -->
    @include('website.section-partials.gallery')
    <!--================------------>
@endsection
