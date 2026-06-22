<section class="py-5">
    <div class="container py-5">
        <!-- Product Details Section -->
        <div class="row mb-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="col-lg-6 position-relative wow fadeInLeft" data-wow-delay="0.2s">
                <img id="mainHDFImage" src="{{$service->img}}" alt="HDF Flooring"
                    class="w-100 rounded shadow object-fit-cover" height="500">

              
                <!--<div class="position-absolute top-0 end-0 m-3">-->
                <!--    <button id="zoomBtn" class="btn btn-light rounded-circle p-2" style="width: 40px; height: 40px;">-->
                <!--        <i class="fas fa-search-plus"></i>-->
                <!--    </button>-->
                <!--</div>-->

             
            </div>
  
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <h2 class="section-title">{{  $service->name }}</h2>

                {!! $service->text !!}
                <!--<div class="d-grid gap-2 d-md-flex wow fadeInUp" data-wow-delay="1s">-->
                <!--    <a href="{{$service->file}}" class="btn btn-outline-dark btn-lg">@lang('home.product file')</a>-->
                <!--</div>-->
            </div>
        </div>
 <div class="row my-4">
     <h3 class="my-3">Albums</h3>
                    <!-- الصور المصغرة -->
                   
                    @foreach ($service->albums as $albumIndex => $album)
                         @if($album->img)
                            <div class="col-lg-4  mb-3 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="thumbnail-item" data-fancybox="gallery{{$albumIndex}}" data-src="{{$album->img}}" data-caption="{{$album->name}}">
                                    <img src="{{$album->img}}" class="w-100 object-fit-cover rounded-3" height="400"
                                        alt="{{$album->name}}">
                                </div>
                                <h2 class="fs-4 pt-2 ">{{ $album->name}} </h2>
                            </div>
                        @endif
                        @foreach ($album->images as $image)
                           {{-- <div class="col-lg-2 col-4 mb-3 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="thumbnail-item" data-fancybox="gallery{{$albumIndex}}" data-src="{{$image->image}}" data-caption="{{$image->alt_image}}">
                                    <img src="{{$image->image}}" class="w-100 object-fit-cover rounded-3" height="200"
                                        alt="{{$image->alt_image}}">
                                </div>
                            </div>--}}
                            <div style="display:none">
                              <a data-fancybox="gallery{{$albumIndex}}" href="{{$image->image}}">
                                <img src="{{$image->image}}" />
                              </a>
                            
                            </div>
                        @endforeach
                    @endforeach

                </div>
       <!-- Product Gallery Section -->
        <!--<div class="row mb-5 wow fadeInUp" data-wow-delay="0.1s">-->
        <!--    <div class="col-12">-->
        <!--        <h2 class="section-title fw-bold wow fadeInUp" data-wow-delay="0.2s">@lang('home.More products')</h2>-->
        <!--        {{-- <p class="lead text-muted mb-4 wow fadeInUp" data-wow-delay="0.3s">@lang('product')</p> --}}-->
        <!--    </div>-->

            <!-- Product Cards with Fancybox -->
        <!--    @foreach ($related_services as $service_Related)-->
        <!--        <div class="col-md-4 mb-4 wow fadeInUp" data-wow-delay="0.2s">-->
        <!--            <div class="card product-card h-100">-->
        <!--                <a href="{{ $service_Related->link }}" data-fancybox="gallery" data-caption="{{ $service_Related->name }}"> -->
        <!--                    <img src="{{ $service_Related->img }}"  class="product-img" alt="{{ $service_Related->name }}">-->
        <!--                </a>-->
        <!--                <div class="card-body">-->
        <!--                    <h5 class="card-title">{{ $service_Related->name }}</h5>-->
        <!--                    <p class="card-text text-muted">{{Helper::removeTagsAndCutText($service->text ,50) }}</p>-->
        <!--                    <div class="d-flex justify-content-between align-items-center">-->
        <!--                        {{-- <span class="badge bg-dark-subtle text-black">{{ $service->type }}</span> --}}-->
        <!--                        <small class="text-muted">{{ $service->created_at->format('Y-m-d') }}</small>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--    @endforeach-->

        <!--</div>-->
    </div>
     
</section>
