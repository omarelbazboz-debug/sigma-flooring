@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('schema')
    {!! $schema ?? '' !!}
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->

        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => $blog->title,
                'bredImage' => $blog->image
            ])

<!-- <================================================================= BreadCrumb =======================================================> -->
<!-- Blog Details Area Start -->
@include('website.section-partials.blogdetails')
<!-- Blog Details Area End -->

@endsection
