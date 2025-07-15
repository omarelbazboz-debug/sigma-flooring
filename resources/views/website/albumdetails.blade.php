@extends('layouts.app')
@section('title')
@php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @foreach ($aboutTitle as $title)
    @section('bredcrmab', $title->title)
        @include('website.section-partials.bredcrmab')
    @endforeach
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @include('website.section-partials.albumdetails')
    <!--================------------>
@endsection
