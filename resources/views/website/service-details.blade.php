@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->

    @include('website.section-partials.bredcrmab' ,[
        'bredImage' => $album->image ,
        'bredTitle' => $album->name
    ])

<!-- <================================================================= BreadCrumb =======================================================> -->
@include('website.section-partials.servicedetails')

@endsection
