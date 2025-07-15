  <section class="py-5 text-center">
      <div class="container py-5 ">
          <div class="row g-5">
              @foreach ($services as $service)
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.1s">
                      <div class="product-card">
                          <a href="{{$service->link}}" class="">
                              <img src="{{$service->img}}" class="product-img" alt="HDF Flooring">
                              <div class="product-body">
                                  <span class="product-category  bg-dark  text-white px-3 py-1 rounded-pill mt-3">{{$service->parent?->name ?? ''}}</span>
                                  <h3 class="product-title"> {{ $service->name }} </h3>
                                  <p>
                                        {{Helper::removeTagsAndCutText($service->text ,50) }}
                                  </p>
                              </div>
                          </a>
                      </div>
                  </div>
              @endforeach

          </div>
      </div>
  </section>
