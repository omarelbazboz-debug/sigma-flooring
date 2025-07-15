@if ($projects->isNotEmpty())

    <section class="py-5 text-center">
        <div class="container py-5">
            <div class="row g-5">
                @foreach ($projects as $project)
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.6s">
                    <div class="product-card">
                        <a href="{{$project->link}}" data-fancybox
                            data-caption="Wood Alternative Panels">
                            <img src="{{$project->image}}" class="product-img"
                                alt="Wood Alternative Panels">
                        </a>
                        <div class="product-body">
                            {{-- <span class="product-category bg-dark text-white px-3 py-1 rounded-pill mt-3"> Panel</span> --}}
                            <h3 class="product-title mb-3">{{ $project->name }}</h3>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
