@if ($services->isNotEmpty())
    <!--==========================Services==========================-->
    <section class="services-one">
        <div class="services-one__bottom">
            <div class="services-one__container">
                <div class="row">
                    @foreach ($services as $service)
                        <!--Services One Single Start-->
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="services-one__single">
                                <div class="service-one__img">
                                    <img src="{{ $service->img }}" alt="service->img">
                                </div>
                                <div class="service-one__content">
                                    <h2 class="service-one__title"><a
                                            href="{{ $service->link }}">{{ $service->name }}</a></h2>
                                    <p class="service-one__text">{!! $service->text1 !!}</p>
                                </div>
                            </div>
                        </div>
                        <!--Services One Single End-->
                    @endforeach
                </div>
            </div>
        </div>
        <div class="about-one__btn-call">
            <div class="about-one__btn-box text-center">
                <a href="{{ Helper::AppUrl('services') }}"
                    class="thm-btn about-one__btn">{{ trans('home.read_more') }}</a>
            </div>
        </div>
    </section>
    <!--==========================Services==========================-->
@endif
