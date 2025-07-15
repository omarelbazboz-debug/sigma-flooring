@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @section('bredcrmab', $service->{'name_' .$lang})


    @foreach ($servicesTitle as $title)
        @include('website.section-partials.bredcrmab')
    @endforeach
    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-- <==============services==============> -->
    @include('website.section-partials.subService')
        @include('website.home-partials.partners') 

    <!--================------------>
@endsection
