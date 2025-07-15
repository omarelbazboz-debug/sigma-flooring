@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', $configration->app_name)
@section('bredcrmab1', $category->{'name_' . $lang})

    @include('website.section-partials.bredcrmab')

<!-- <================================================================= BreadCrumb =======================================================> -->
@include('website.section-partials.subcategories')
<!--================------------>
@endsection