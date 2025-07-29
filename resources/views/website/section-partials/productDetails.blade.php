<section class="py-5">
    <div class="container py-5">
        <!-- Product Details Section -->
        <div class="row mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-6 position-relative wow fadeInLeft" data-wow-delay="0.2s">
                <!-- الصورة الرئيسية مع زر التكبير -->
                <img id="mainHDFImage" src="{{$service->img}}" alt="HDF Flooring"
                    class="w-100 rounded shadow object-fit-cover" height="500">

                <!-- زر التكبير -->
                <div class="position-absolute top-0 end-0 m-3">
                    <button id="zoomBtn" class="btn btn-light rounded-circle p-2" style="width: 40px; height: 40px;">
                        <i class="fas fa-search-plus"></i>
                    </button>
                </div>

             
            </div>
  
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <h2 class="section-title">{{  $service->name }}</h2>

                {!! $service->text !!}
                <div class="d-grid gap-2 d-md-flex wow fadeInUp" data-wow-delay="1s">
                    <a href="{{$service->file}}" class="btn btn-outline-dark btn-lg">@lang('home.product file')</a>
                </div>
            </div>
        </div>
 <div class="row my-4">
                    <!-- الصور المصغرة -->
                    @foreach ($service->images as  $image)
                        <div class="col-lg-2 col-4 mb-3 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="thumbnail-item" data-fullimg="{{$image->image}}" data-caption="{{$image->alt_image}}">
                                <img src="{{$image->image}}" class="w-100 object-fit-cover rounded-3" height="200"
                                    alt="{{$image->alt_image}}">
                            </div>
                        </div>

                    @endforeach

                </div>
       <!-- Product Gallery Section -->
        <div class="row mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-12">
                <h2 class="section-title fw-bold wow fadeInUp" data-wow-delay="0.2s">@lang('home.More products')</h2>
                {{-- <p class="lead text-muted mb-4 wow fadeInUp" data-wow-delay="0.3s">@lang('product')</p> --}}
            </div>

            <!-- Product Cards with Fancybox -->
            @foreach ($related_services as $service_Related)
                <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="card product-card h-100">
                        <a href="{{ $service_Related->link }}">
                            <img src="{{ $service_Related->img }}" class="product-img" alt="{{ $service_Related->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $service_Related->name }}</h5>
                            <p class="card-text text-muted">{{Helper::removeTagsAndCutText($service->text ,50) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                {{-- <span class="badge bg-dark-subtle text-black">{{ $service->type }}</span> --}}
                                <small class="text-muted">{{ $service->created_at->format('Y-m-d') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
     
</section>
