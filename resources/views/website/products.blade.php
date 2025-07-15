@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->


    @forelse($productsTitle->take(1) as $title)
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => $title->title,
                'bredImage' => $title->image
            ])
    @empty
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => __('home.products'),
                'bredImage' => $about->banner
            ])
    @endforelse
    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-- <==============services==============> -->
    @include('website.section-partials.products')

    <!--================------------>

@endsection
