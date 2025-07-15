            <div id="popup" class="popup-overlay">
                <div class="popup-content">
                    <button id="close-popup" class="close-popup-btn">X</button>
                    @foreach ($sliderTitle as $title)
                        <div class="tp-cta-area black-bg z-index-1">
                            <div class="container">
                                <div class="tp-cta-bg pt-80 pb-95  p-relative">
                                    <div class="tp-cta-bg-img">
                                        <img src="{{ asset('assets/front/img/home-01/cta/cta-bg.png') }}"
                                            alt="cta">
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-xxl-7 col-xl-8 col-lg-10">
                                            <div class="tp-cta-title-box mb-50 text-center">
                                                <span class="tp-section-subtitle mb-10 tp_fade_anim">Newsletter</span>
                                                <h4 class="tp-section-title sm tp_fade_anim">
                                                    {{ $title->title }}
                                                    <span class="p-relative">
                                                        {{ $title->title1 }}
                                                        <span class="tp-cta-line">
                                                            <svg width="204" height="17" viewBox="0 0 204 17"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.52137 4.60245C32.5332 2.24214 115.957 -0.161247 201.56 9.10766M1.84812 14.5959C18.7615 13.505 64.9955 11.6133 100.728 13.0647"
                                                                    stroke="currentcolor" stroke-width="3"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                        </span>
                                                    </span>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-lg-8">
                                            <div class="tp-cta-input-wrapper">
                                                <div
                                                    class="tp-cta-bottom-text d-flex justify-content-center align-items-center tp_fade_anim">
                                                    <span>
                                                        <svg width="21" height="21" viewBox="0 0 21 21"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="0.5" y="0.5" width="19.1871" height="19.1758"
                                                                rx="9.58792" stroke="#A4FF5C" />
                                                            <path d="M13.9951 7.19981L8.69042 12.8884L6.1047 10.4772"
                                                                stroke="#A4FF5C" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <p>Weekly Design Newsletter</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
