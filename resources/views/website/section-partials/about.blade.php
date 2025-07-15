


  <section class="py-5 bg-white">
    <div class="container py-5">
      <div class="row align-items-center pt-5 gx-lg-5">
       <div class="col-lg-7 position-relative wow fadeInUp" data-wow-duration="1.5s">
          <div class="custom-logo-about  ">
            <img src="{{$about->image}}" class="img-fluid shadow-lg rounded-4" alt="">
          </div>
        </div>
        <div class="col-md-5 wow fadeInUp" data-wow-duration="1s">
          <h2 class="mb-3 fw-bold d-grid text-uppercase">
           {{$about->title  }}
          </h2>
          <p class="text-muted mb-4 lh-lg fs-5">
           {!! $about->text !!}
          </p>
        </div>
      </div>
    </div>
  </section>
