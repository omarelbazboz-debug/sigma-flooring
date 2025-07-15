@extends('layouts.app')
@section('title')
    {!! $metatags !!}
    {!! $schema !!}
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @forelse($aboutTitle->take(1) as $title)
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => $title->title,
                'bredImage' => $title->image
            ])
    @empty
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => __('home.about_us'),
                'bredImage' => $about->banner
            ])
    @endforelse


    <!-- <================================================================= BreadCrumb =======================================================> -->
    @include('website.section-partials.about')
    @include('website.section-partials.skills')
    @include('website.section-partials.aboutStruc')
    <!--================------------>
@endsection
