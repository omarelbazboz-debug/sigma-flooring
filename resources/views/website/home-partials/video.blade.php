@if($videos->isNotEmpty())
<!--===============Vedioection==============-->
@foreach ($vediosTitle as $title)
    <div class="tp-partners-area tp-testimonial-space black-bg-2 pt-25 pb-160 p-relative">
        <div class="tp-testimonial-thumb">
            <img src="{{ $title->image }}" alt="image">
            <a class="popup-video tp-testimonial-playbtn" href="{{ $title->link }}">
                <span>
                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 12L0.5 23.2583V0.74167L20 12Z" fill="currentcolor" />
                    </svg>
                </span>
            </a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8 col-md-9">
                    <div class="tp-testimonial-title-box mb-45">
                        <span class="tp-section-subtitle mb-10">{{ $title->title }}</span>
                        <h4 class="tp-section-title tp_reveal_anim font-40">{{ $title->title1 }}</h4>
                    </div>
                    {!! $title->text !!}

                </div>
            </div>
        </div>
    </div>
@endforeach
<!--===============Vedioection==============-->
<div class="gallery-section pt-135 pb-135">
    <div class="container">
        <div class='text-respect'>
            <span class="tp-section-respect mb-10">{{ trans('home.Exhibitions') }}</span>
        </div>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="condo-item hotel-intro">
                        <iframe width="100%" height="300" src="{{ $video->youtube_link }}" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="text-iframe">
                        <span class="head">{{ $video->title }}</span>
                        <p>{{ $video->text }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="tp-service-btn-box mt-30">
            <div class="tp-blog-4-btn d-flex justify-content-center">
                <a class="tp-btn-circle tp-hover-btn-wrapper   tp-hover-btn" href="{{Helper::AppUrl('galleryVideos')}}">
                    <span class="tp-btn-circle-text">{{ trans('home.read_more') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                    <i class="tp-btn-circle-dot"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
<!--===============Vedioection==============-->
