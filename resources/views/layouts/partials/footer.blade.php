



  <footer class="site-footer bg-black text-second pt-5">
    <div class="inner first">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-6">
            <div class="widget text-white">
              <div class="widget mt-0 logo-footer">
                <img src="{{Helper::FooterLogo() }}" class=" mb-4" width="220" alt="" />
              </div>
              <p class="w-75">
               {!! $configration->about_app !!}
              </p>
            </div>
            <div class="widget mt-4">
              <ul class="list-unstyled social d-flex gap-3">
                <li>
                    <a href="http://wa.me/01148888024" target="_blank"><i class="fa-brands fa-whatsapp fs-4"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-2 pl-lg-5">
            <div class="widget">
              <h3 class="heading text-white">@lang('home.pages')</h3>
              <ul class="links list-unstyled">
                  @foreach ($menus as $menu)
                    <li>
                        <a href="{{ $menu->link }}">{{ $menu->name }}</a>
                    </li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="widget">
              <h3 class="heading text-white">@lang('home.contact-us')</h3>
              <ul class="list-unstyled quick-info links d-flex flex-column gap-2">
                <li class="email"><a href=""><i class="fa-solid fa-envelope me-2"></i> {{ $setting->email }} </a></li>
                <li class="phone"> <a href="tel:01123456789"><i class="fa-solid fa-phone me-2"></i> {{$setting->mobile}} </a> </li>
                <li class="address"><a href="#"><i class="fa-solid fa-location-dot me-2"></i> {{ $configration->address1 }}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="inner dark mt-5 bg-opacity-25 bg-white ">
      <div class="container">
        <div class="row text-center text-md-left">
          <div class="col-md-6 pt-3">
            <p class="text-white-50">
              All Rights Reserved Cairo Finishers, Developed and Designed by
              <a class="text-white fs-5" href="https://be-group.com/be_en/" target="_blank">BeGroup</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </footer>
<!--====================Footer==============-->
