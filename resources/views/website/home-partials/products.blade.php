@if ($services->isNotEmpty())
    <!--==========================Services==========================-->
    <section class="py-5 text-center">
        <div class="container mb-5">
            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                <div class="header-text">
                    <h2 class="fw-bold fs-1">
                        <span class="transparent-text">
                            @lang('home.services')
                        </span>
                    </h2>
                </div>
            </div>
            <ul class="nav nav-pills nav-tabs-custom mb-5 d-flex justify-content-center" id="productsTab" role="tablist">
                @foreach ($services as $service)
                    <li class="nav-item {{ !$loop->first ? 'wow fadeInUp' : '' }}" role="presentation">
                        <button class="nav-link {{ !$loop->first ? '' : 'active' }}" id="flooring-tab" data-bs-toggle="tab"
                            data-bs-target="#{{ $service->link_en }}" type="button" role="tab">
                            {{ $service->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="productsTabContent">
                @foreach ($services as $service)
                    <!-- Flooring Tab -->
                    <div class="tab-pane fade {{!$loop->first ?'':'active show'}}" id="{{ $service->link_en }}" role="tabpanel"
                        aria-labelledby="flooring-tab">
                        <h3 class="section-title wow fadeIn">{{ $service->name }}</h3>

                            <div class="row g-4">
                                @foreach ($service->childs->take(6) as $serviceChilde)
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-card">
                                            <a href="{{ $serviceChilde->link }}" class="">
                                                <img src="{{ $serviceChilde->img }}" class="product-img"
                                                    alt="HDF Flooring">
                                                <div class="product-body">
                                                    <span
                                                        class="product-category bg-dark text-white px-3 py-1 rounded-pill mt-3">{{ $service->name }}</span>
                                                    <h3 class="product-title">{{ $serviceChilde->name }}</h3>
                                                    <p> {{ Helper::removeTagsAndCutText($serviceChilde->text, 50) }} </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!--==========================Services==========================-->
@endif
