@if($brands->isNotEmpty())
    <!--==================Partners Section===============================-->
    <section class="section-lgb">
        <div class="container">
            <div class="swiper-slider" data-autoplay="true" data-loop="true" data-dots="false" data-arrows="false"
                data-columns="6" data-margin="0" data-effect="slide">
                <div class="swiper-wrapper">
                    <!-- Slide1 -->
                    @foreach($brands as $brand)
                    <article class="pbmit-client-style-1 swiper-slide">
                        <div class="pbmit-border-wrapper">
                            <div class="pbmit-client-wrapper pbmit-client-with-hover-img">

                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{asset('uploads/brands/source/' . $brand->logo) }}" class="img-fluid" alt="logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--==================Partners Section===============================-->
@endif