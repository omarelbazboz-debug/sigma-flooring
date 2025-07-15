@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->


        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => $po,
                'bredImage' => $about->banner
            ])
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @include('website.section-partials.projectdetalis')
@endsection
