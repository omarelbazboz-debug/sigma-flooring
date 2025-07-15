@extends('layouts.app')
@section('title')
    @php echo $metatags @endphp
@endsection
@section('content')
    <!-- <================================================================= BreadCrumb =======================================================> -->
    @forelse($blogsTitle->take(1) as $title)
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => $title->title,
                'bredImage' => $title->image
            ])
    @empty
        @include('website.section-partials.bredcrmab' ,[
                'bredTitle' => __('home.blogs'),
                'bredImage' => $about->banner
            ])
    @endforelse
    <!-- <================================================================= BreadCrumb =======================================================> -->
    <!-------Blogs----------->
    @include('website.section-partials.blogs')
    <!-------EndBlogs-------->
@endsection
