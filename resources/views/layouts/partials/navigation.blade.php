<!-- back to top start -->
<div class="back-to-top-wrapper">
    <button id="back_to_top" type="button" class="back-to-top-btn">
        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button>
</div>
<!-- back to top end -->
<!-- tp-offcanvus-area-end -->
<div class="tp-offcanvas-area">
    <div class="tp-offcanvas-wrapper">
        <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="tp-offcanvas-logo">
                <a href="{{Helper::AppUrl()}}">
                    <img src="{{ Helper::AboutImage() }}" alt="FooterLogo">
                </a>
            </div>
            <div class="tp-offcanvas-close">
                <button class="tp-offcanvas-close-btn">
                    <svg width="37" height="38" viewBox="0 0 37 38" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="tp-offcanvas-main">
            <div class="tp-offcanvas-menu d-xl-block">
                <nav></nav>
            </div>
            <div class="tp-offcanvas-contact">
                <ul>
                    @foreach ($phones as $index => $phone)
                        @if ($index == 0)
                            <li class="contact-items"><a
                                    href="tel:{{ $phone->code }}{{ $phone->phone }}">{{ $phone->phone }}</a></li>
                        @endif
                    @endforeach
                    <li class="contact-item"><a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                    @foreach ($addresses as $$index => $address)
                        @if ($index == 0)
                            <li class="contact-item"><a href="{{ $address->map_url }}"
                                    target="_blank">{{ $address->address }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="tp-offcanvas-social d-flex justify-content-between">
                @if ($altLangLink)
                    <div class="tp-lang-4-btn">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault"
                                onchange="window.location.href='{{ $altLangLink }}'">
                            <div
                                class="ar-en d-flex {{ app()->getLocale() === 'en' ? 'justify-content-end' : 'justify-content-start' }}">
                                <p>
                                    {{ app()->getLocale() === 'ar' ? 'English' : 'عربي' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
                <ul>
                    <x-social-media />
                </ul>

            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<!-- tp-offcanvus-area-end -->
