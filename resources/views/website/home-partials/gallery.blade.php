@if ($galleryImages->isNotEmpty())
    <!--===============Gallery==============-->
    <div class="test-gallery-serv mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="g-serv-img">
                        <div class="tp-testimonial-3-slider-wrap">
                            <div class="swiper-container tp-testimonial-3-active">
                                <div class="swiper-wrapper">
                                    @foreach ($galleryImages as $gallery)
                                        <div class="swiper-slide">
                                            <img src="{{ $gallery->img }}" alt="img">
                                        </div>
                                    @endforeach
                                </div>
                                <!--<div class="swiper-button-next"></div>-->
                                <!--<div class="swiper-button-prev"></div>-->
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($galleryTitle as $title)
                    <div class="col-lg-6 col-12">
                        <div class="tp-testimonial-title-box mb-45">
                            <span class="tp-section-subtitle mb-10">{{ $title->title }}</span>
                            <h4 class="tp-section-title tp_reveal_anim font-40">{{ $title->title1 }}</h4>
                            {!! $title->text !!}
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
    <!--===============Gallery==============-->
@endif
