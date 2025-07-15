@extends('layouts.app')

@section('title')
    @php echo $metatags @endphp
    @php echo $schema @endphp
@endsection
@section('content')
    @include('website.home-partials.slider')
    @include('website.home-partials.about')
    @include('website.home-partials.skills')
    @include('website.home-partials.products')
    @include('website.home-partials.blogs')
    @include('website.home-partials.contact')
@endsection
