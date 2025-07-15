@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @section('bredcrmab', $configration->app_name)
    @section('bredcrmab1', trans('home.Our Portfolio'))


  
        @include('website.section-partials.bredcrmab')

    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-- <==============services==============> -->
    @include('website.section-partials.profile')
    <!--================------------>

@endsection




