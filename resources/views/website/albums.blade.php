@extends('layouts.app')
@section('title')
@php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @foreach ($services->take(1) as $title)
    @section('bredcrmab', $title->title)
        @include('website.section-partials.bredcrmab',[
            'title' => $title->title,
            'image' => $title->image,
        ])
    @endforeach

    <!-- <================================================================= BreadCrumb =======================================================> -->
    @include('website.home-partials.products')
    <!--================------------>
@endsection
