@if (count($testimonials) > 0)
    <!-- Testimonials -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Our Testimonial Content Start -->
                    <div class="our-testimonial-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">{{ trans('home.testimonials') }}</h3>
                        </div>
                        <!-- Testimonial Slider Start -->
                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <!-- Testimonial Slide Start -->
                                    @foreach ($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="testimonial-item">

                                                <div class="testimonial-body">
                                                    <div class="testimonial-content">
                                                        <p>{!! $testimonial->text !!}</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-body">
                                                    <div class="author-image">
                                                        <figure class="image-anime">
                                                            <img src="{{ asset('uploads/testimonials/source/', $testimonial->img) }}"
                                                                alt="img">
                                                        </figure>
                                                    </div>
                                                    <div class="author-content">
                                                        <h3>{{ $testimonial->name }}</h3>
                                                        <p>{{ $testimonial->postion }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Testimonial Slide End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
