@extends('layouts.app')
@section('title')
@php echo $metatags @endphp
@php echo $schema @endphp
@endsection
@section('content')
<!-- <======= BreadCrumb ======> -->
@section('bredcrmab', trans('home.contact-us'))


@foreach ($contactTitle as $title)
@section('bredcrmab', $title->title)
@include('website.section-partials.bredcrmab')
@endforeach
<!-- <======= BreadCrumb ======> -->
<!--Form-->
@include('website.section-partials.contactpage')
<!--<=========ContactPage----------------======>-->
@endsection