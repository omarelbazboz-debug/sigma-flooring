@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', trans('home.careers'))


@foreach ($careersTitle as $title)
    @include('website.section-partials.bredcrmab')
@endforeach
<!-- <================================================================= BreadCrumb =======================================================> -->
<!--================------------>
@include('website.section-partials.careers')
<!--================------------>
@endsection

