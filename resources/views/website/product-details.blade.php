@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->

    @include('website.section-partials.bredcrmab' ,[
        'bredImage' => $service->image,
        'bredTitle' => $service->name
    ])

<!-- <================================================================= BreadCrumb =======================================================> -->
@include('website.section-partials.productDetails')

@endsection
