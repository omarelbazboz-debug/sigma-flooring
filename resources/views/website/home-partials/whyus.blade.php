@foreach($careersTitle as $careersTitle)
<div class="why-choose mb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="tp-service-title-box mb-40 wow animate__bounceInRight" data-wow-duration="1.5s"
                    data-wow-delay="0s">
                    <span class="tp-section-respect1 mb-10">{{ trans('home.Why HGAD') }}</span>
                    <h4 class="tp-section-title tp_reveal_anim">{{$careersTitle->title}}</h4>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex align-items-center">
                        <ul class="why-choose-list wow animate__bounceInLeft" data-wow-duration="1.5s"
                            data-wow-delay="1s">
                            @foreach ($careers as $career)
                                <li><i class="{{ $career->icon }}"></i> {{ $career->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="why-choose-img wow animate__bounceInLeft" data-wow-duration="1.5s"
                            data-wow-delay="1.3s">
                            <img src="{{$careersTitle->image}}" alt="image">
                            <div class="count-choose">
                                <div class="tp-funfact-item">
                                    <h4 class="tp-funfact-number"><span data-purecounter-duration="1"
                                            data-purecounter-end="20" class="purecounter">{{$careersTitle->number}}</span>+</h4>
                                    <span>{{$careersTitle->title1}}</span>
                                </div>
                            </div>
                            <div class="count-img-r wow fadeIn" data-wow-duration="1.5s" data-wow-delay="2s">
                                <img src="{{ asset('assets/front/img/home-01/project/project-2.jpg') }}"
                                    alt="project">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach