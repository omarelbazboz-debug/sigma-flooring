 <!---==========================================Bredcrmab=========================================--->



    <div class=" hero-slider-pages position-relative " style="height: 60vh; background-image:url({{url('uploads/bg/cover-sigma.jpg')}});  background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <div class="text-slider mt-5">
        <h1 class="wow fadeInRight " data-wow-duration="1s">{{ $bredTitle }}</h1>
        <nav aria-label=" ">
          <ol class="breadcrumb d-flex justify-content-center gap-2 align-items-center text-white mt-4">
            <li class="breadcrumb-item fs-4">
              <a href="{{ Helper::AppUrl('/') }}" class="text-white-50 text-decoration-none">@lang('home.home')</a>
            </li>
            <li class="fs-3">/</li>
            <li class="breadcrumb-item fw-bold active fs-4 text-white" aria-current="page">
              {{ $bredTitle }}
            </li>
          </ol>
        </nav>
    </div>


      <div class="overlay"></div>


    </div>

 <!---==========================================Bredcrmab=========================================--->
