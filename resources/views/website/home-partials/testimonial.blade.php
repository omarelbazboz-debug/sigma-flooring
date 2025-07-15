@if (count($testimonials) > 0)
    <!-- Testimonials -->
    <section class="content-inner pt-0">
        <div class="container">
            @foreach ($testimonialTitle as $title)
                <div class="section-head style-1 text-center wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.8s">
                    <h2 class="title m-b10">{{ $title->title }}</h2>
                    <p>{{ $title->title1 }}</p>
                </div>
            @endforeach
            <div class="swiper testimonial-swiper3 testimonial-wrapper3 wow fadeInUp" data-wow-delay="0.4s"
                data-wow-duration="0.8s">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-3">
                                <div class="testimonial-media">
                                    <img src="{{ $testimonial->img }}" alt="">
                                    <div class="item1">
                                        {{-- <div class="info-widget">
                                            <ul class="star-list">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="testimonial-pagination-swiper3 swiper-pagination style-1"></div>
            </div>
        </div>
    </section>
@endif
<!-- Testimonials -->
