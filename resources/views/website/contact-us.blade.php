@extends('layouts.app')
@section('title')
@php echo $metatags @endphp
@php echo $schema @endphp
@endsection
@section('content')
<!-- <======= BreadCrumb ======> -->
@section('bredcrmab', trans('home.contact-us'))


@foreach ($contactTitle->take(1) as $title)
@include('website.section-partials.bredcrmab',['bredImage' => $title->image , 'bredTitle' ,$title->title])
@endforeach
<!-- <======= BreadCrumb ======> -->
<!--Form-->
@include('website.section-partials.contactpage')
<!--<=========ContactPage----------------======>-->
@endsection
