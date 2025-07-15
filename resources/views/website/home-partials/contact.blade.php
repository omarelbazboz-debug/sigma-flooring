
<!-- <============================= StartContactForm ===================> -->
  <section class="contact py-5">
    <div class="container py-5">
      <div class="text-center mb-5 wow fadeInDown" data-wow-duration="0.8s">
        <div class="header-text">
          <h2 class="mb-5 fw-bold fs-1">
            @lang('home.contact_us')
          </h2>
        </div>
      </div>

      <div class="contact-icon row g-3 mb-5">
        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
          <div
            class="d-flex flex-column align-items-center gap-4 shadow-lg border border-1 py-3 px-4 rounded-4 h-100 contact-card">
            <span
              class="contact-icon-circle d-flex justify-content-center align-items-center bg-black text-white rounded-circle p-4">
              <i class="fa-solid fa-location-dot fs-5 text-center"></i>
            </span>
            <a href="{{$firstAddress->map_url}}" class="fw-semibold text-center text-decoration-none"
              target="_blank">
             {{$firstAddress->address }}
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
          <div
            class="d-flex flex-column align-items-center gap-4 border border-1 shadow-lg py-3 px-4 rounded-4 h-100 contact-card">
            <span
              class="contact-icon-circle d-flex justify-content-center align-items-center bg-black text-white rounded-circle p-4">
              <i class="fa-solid fa-phone fs-5 text-center"></i>
            </span>
            <a href="tel:+2{{$setting->mobile}}" class="fw-semibold text-decoration-none">@lang('home.phone') : {{$setting->mobile}}</a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
          <div
            class="d-flex flex-column align-items-center gap-4 border border-1 shadow-lg py-3 px-4 rounded-4 h-100 contact-card">
            <span
              class="contact-icon-circle d-flex justify-content-center align-items-center bg-black text-white rounded-circle p-4">
              <i class="fa-solid fa-envelope fs-5 text-center"></i>
            </span>
            <a href="mailto:infoCairoFinishers@mail.com" class="fw-semibold text-center text-decoration-none">
              @lang('home.email') : {{$setting->email}}
            </a>
          </div>
        </div>
      </div>
      <div class="row gy-5 gx-4 align-items-center"> <!-- تغيير align-items-center إلى align-items-stretch -->
        <div class="col-lg-6 col-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
          <iframe src="https://www.google.com/maps/embed?" style="border: 0; min-height: 465px; height: 100%;"
            class="h-100 w-100 rounded-4" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="col-12 col-md-12 col-lg-6  wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
            <x-contact-form />
        </div>
      </div>
    </div>
  </section>
