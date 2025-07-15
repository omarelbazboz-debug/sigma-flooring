{{-- @extends('layouts.app')
@section('title')
    <title>Search-Result</title>
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @section('bredcrmab', trans('home.No search results'))
    @php
        $aboutTitles = $titles->filter(fn($title) => $title->type === 'pages');
    @endphp

    @foreach ($aboutTitles as $title)
        @include('website.section-partials.bredcrmab')
    @endforeach
    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!---===============--------------->
    @include('website.section-partials.contactpage')
@endsection --}}
