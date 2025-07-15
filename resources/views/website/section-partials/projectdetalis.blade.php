{{-- <section class="projects popular__featured--section section--padding">
    <div class="container">
        @foreach ($categories as $index => $categorie)
            @php
                // التحقق إذا كانت الفئة تحتوي على مشاريع
                $categoryProjects = $projects->filter(function ($project) use ($categorie) {
                    return $project->category_id == $categorie->id;
                });
            @endphp

            @if ($categoryProjects->isNotEmpty())
                <div class="section__heading text-center mb-50 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                    <h3 class="section__heading--subtitle color__white h5">
                        <span>رعاية عقاية</span> موثوقة
                    </h3>
                    <h2 class="section__heading--title color__white">{{ $categorie->{'name_' .$lang} }}</h2>
                </div>

                <div class="row mx-0 popular__featured--inner aos-init aos-animate">
                    @foreach ($categoryProjects as $index => $all_product)
                        <div class="col-md-4 col-sm-6 mb-3">
                            <article class="popular__featured--card">
                                <div class="popular__featured--thumbnail position-relative">
                                    <!-- رابط الصورة -->
                                    <a class="popular__featured--link" data-fancybox="gallery-{{ $index }}" href="{{ $all_product->image }}">
                                        <img class="popular__featured--img" src="{{ $all_product->image }}" alt="{{ $all_product->name }}">
                                    </a>
                                    <div class="popular__featured--content">
                                        <h3 class="popular__featured--title">{{ $all_product->name }}</h3>
                                    </div>
                                </div>

                                <!-- الصور المخفية -->
                                <div style="display:none">
                                    @foreach ($all_product->images as $image)
                                        <a data-fancybox="gallery-{{ $index }}" href="{{ asset('uploads/projects/source/' . $image->image) }}">
                                            <img src="{{ asset('uploads/projects/source/' . $image->image) }}" alt="Image">
                                        </a>
                                    @endforeach
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</section> --}}
   <div class="tp-border-line-wrap">
      <div class="tp-border-line"></div>
      <div class="tp-border-line line-2"></div>
      <div class="tp-border-line line-3"></div>
      <div class="tp-border-line line-4"></div>
   </div>
<!-- tp-service-sidebar-start -->
<div class="sv-details-area pt-135 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="project-details-right-wrap">
                    <div class="project-details-thumb">
                        <img src="{{ $project->image }}" alt="image">
                        <div class="project-hero-content-wrapper wow fadeIn" data-wow-delay="0.2s">
                            <div class="row">
                                <div class="col-lg-4 col-12 col-md-6">
                                    <div class="project-hero-data">
                                        <div class="project-hero-icon-wrapper wow fadeInDown">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="project-hero-data-text">
                                            <span>{{ trans('home.location') }}</span>
                                            <p>{{$project->location}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 col-md-6">
                                    <div class="project-hero-data">
                                        <div class="project-hero-icon-wrapper wow fadeInDown">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="project-hero-data-text">
                                            <span>{{ trans('home.type') }}</span>
                                            <p>{{$project->type}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 col-md-6">
                                    <div class="project-hero-data">
                                        <div class="project-hero-icon-wrapper wow fadeInDown">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="project-hero-data-text">
                                            <span>{{ trans('home.project') }}</span>
                                            <p>{{$project->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-50">
                <div class="col-12">
                    <div class="sv-details-content border-bottom-2">
                        <h4 class="tp-section-title fs-44 mb-20 tp-split-text tp-split-right">{{ $project->name }}</h4>
                        {!! $project->text !!}
                    </div>
                    <div class="sv-details-content mb-50">
                        <h4 class="tp-section-title fs-44 mb-20 tp-split-text tp-split-right">
                            {{ trans('home.Project Gallery') }}</h4>
                        <div class="row">
                            @foreach ($project->images as $image)
                                <div class="col-lg-4 col-md-6">
                                    <div class="condo-item hotel-intro"
                                        style="background-image: url({{ asset('uploads/projects/source/' . $image->image) }});">
                                        <div class="title">
                                            <div class="display-on-hover">
                                                <a href="{{ $image->image_url }}" data-fancybox="album1"><i
                                                        class="fa-solid fa-eye "></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="contact-right-wrap">
                        <div class="team-details-contactform">
                            <!-- Contact Form -->
                            <x-contact-form />
                            <!-- Contact Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tp-service-sidebar-end -->
