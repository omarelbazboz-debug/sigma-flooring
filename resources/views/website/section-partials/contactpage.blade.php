<!-- <================================================================= StartContactForm =======================================================> -->
<!--Contact Page Start-->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="contact-page__left">
                    <div class="section-title text-left">
                        <div class="section-sub-title-box">
                            <div class="section-title-shape-1">
                                <img src="{{ asset('assets/front/images/shapes/section-title-shape-1.png') }}"
                                    alt="shape-1">
                            </div>
                            <div class="section-title-shape-2">
                                <img src="{{ asset('assets/front/images/shapes/section-title-shape-2.png') }}"
                                    alt="shape-2">
                            </div>
                        </div>
                        <h2 class="section-title__title">{{ trans('home.contact_us') }}</h2>
                    </div>
                    <div class="contact-page__call-email">
                        <div class="contact-page__call-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-page__call-email-content">
                            <h4>
                                @foreach ($phones as $phone)
                                    <a href="tel:{{ $phone->code }}{{ $phone->phone }}"
                                        class="contact-page__call-number">{{ $phone->phone }}</a>
                                @endforeach
                                <a
                                    href="mailto:{{ $setting->email }}
                                            class="contact-page__email">{{ $setting->email }}</a>
                            </h4>
                        </div>
                    </div>
                    @foreach ($addresses as $address)
                        <p class="contact-page__location-text"><a href="{{ $address->map_url }}"
                                target="_blank">{{ $address->address }}</a></p>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="contact-page__right">
                    <div class="contact-page__form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ Helper::AppUrl('save/contact-us') }}"
                            class="comment-one__form contact-form-validated" novalidate="novalidate" method="POST">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="text" placeholder="{{ trans('home.name') }}" name="name">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="email" placeholder="{{ trans('home.email') }}" name="email">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="comment-form__input-box">
                                        <input type="number" placeholder="{{ trans('home.phone') }}" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="comment-form__input-box text-message-box">
                                        <textarea name="message" placeholder="{{ trans('home.message') }}"></textarea>
                                    </div>
                                    <div class="comment-form__btn-box">
                                        <button type="submit"
                                            class="thm-btn comment-form__btn">{{ trans('home.send') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Contact Page End-->

<!--CTA One Start-->
<section class="cta-one cta-three">
    <div class="container">
        <div class="cta-one__content">
            <div class="cta-one__inner">
                <div class="cta-one__left">
                    <h3 class="cta-one__title">{{ trans('home.call') }}</h3>
                </div>
                <div class="cta-one__right">
                    <div class="cta-one__call">
                        <div class="cta-one__call-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="cta-one__call-number">
                            @foreach ($phones as $index=> $phone)
                            @if($index == 0)
                            <a href="tel:{{$phone->code}}{{$phone->phone}}">{{$phone->phone}}</a>
                            @endif
                            @endforeach
                            <p>{{ trans('home.call') }}</p>
                        </div>
                    </div>
                    {{-- <div class="cta-one__btn-box">
                        <a href="contact.html" class="thm-btn cta-one__btn">Get a Quote</a>
                    </div> --}}
                </div>
                <div class="cta-one__img">
                    <img src="{{asset('assets/front/images/resources/cta-one-img.png')}}" alt="cta">
                </div>
            </div>
        </div>
    </div>
</section>
<!--CTA One End-->

<!--Google Map Start-->
<section class="google-map-two">
    <iframe
        src="{{$setting->map_url}}"
        class="google-map__two" allowfullscreen></iframe>

</section>
<!--Google Map End-->
<!-- <================================================================= EndContactForm =======================================================> -->
