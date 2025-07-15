@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @section('bredcrmab', trans('home.teams'))


        @include('website.section-partials.bredcrmab')

    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-- <==============TeamSection==============> -->
    @include('website.home-partials.team')



@endsection
