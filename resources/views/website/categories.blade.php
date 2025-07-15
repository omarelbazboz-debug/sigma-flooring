@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', $configration->app_name)
@section('bredcrmab1', trans('home.projects'))


    @include('website.section-partials.bredcrmab')
<!-- <================================================================= BreadCrumb =======================================================> -->
@include('website.section-partials.categories')
<!--================------------>
@endsection