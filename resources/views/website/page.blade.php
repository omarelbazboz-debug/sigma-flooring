{{-- @extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
@section('bredcrmab', $page->{'title_' .$lang})
@php
    $aboutTitles = $titles->filter(fn($title) => $title->type === 'pages');
@endphp

@foreach ($aboutTitles as $title)
    @include('website.section-partials.bredcrmab')
@endforeach
    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-- Main -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <img src="img/blog/22.jpg" class="mb-30" alt="">
                    <p>{!! $page->text_en !!} </p>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    </section>
@endsection --}}
