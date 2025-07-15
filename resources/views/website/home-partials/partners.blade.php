<!--==================Partners Section===============================-->
<div class="pariner-section mt-30 pb-30">
    <div class="container">
        @foreach($brandTitle as $title)
        <div class='text-respect'>
            <span class="tp-section-respect mb-10">{{$title->title}}</span>
            <h4 class="tp-section-title tp_reveal_anim">{{$title->title1}}</h4>
        </div>
        @endforeach
        <div class="tp-brand-area">
            <div class="tp-brand-wrapper">
                <div class="swiper-container tp-brand-active2">
                    <div class="swiper-wrapper slide-transtion">
                        @foreach($partners as $partner)
                        <div class="swiper-slide">
                            <div class="tp-brand-item">
                                <img src="{{$partner->logo}}" alt="logo">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-service-btn-box mt-30">
            <div class="tp-blog-4-btn d-flex justify-content-center">
                <a class="tp-btn-circle tp-hover-btn-wrapper   tp-hover-btn" href="{{Helper::AppUrl('partners')}}">
                    <span class="tp-btn-circle-text"> {{ trans('home.More Partners') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                    <i class="tp-btn-circle-dot"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!--==================Partners Section===============================-->
