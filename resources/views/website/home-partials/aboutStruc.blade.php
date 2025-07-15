<div class="tp-goal-area pt-85 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="tp-goal-right">
                    <div class="quality-section">
                        @foreach ($aboutStrucTitle as $title)
                            <div class="count-quality">
                                <img src="{{ $title->image }}" alt="title->image">
                                <div class="quality-text wow animate__bounceInRight" data-wow-duration="2s"
                                    data-wow-delay="1s">
                                    <span class="tp-section-2-subtitle mb-10">{{ $title->title }}</span>
                                    <p>{!! $title->text !!}</p>
                                    </p>
                                </div>
                                <div class="quality-img-1 wow animate__bounceInLeft" data-wow-duration="1.5s"
                                    data-wow-delay="0s">
                                    <img src="{{ asset('assets/front/img/home-01/project/project-1.jpg') }}"
                                        alt="project">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="tp-goal-left p-relative mt-80">
                    <div class='text-respect'>
                        <span class="tp-section-respect mb-10">Respect</span>
                    </div>
                    <div class="respect">
                        @foreach ($aboutStrucs as $aboutStruc)
                            @if (empty($aboutStruc->text))
                                <div class="tp-service-item mb-70">
                                    <img class="quality-img" src="{{ $aboutStruc->image }}" alt="img">
                                    <h4 class="tp-service-title">
                                        <p class="tp-line-white">{{ $aboutStruc->title }}</p>
                                    </h4>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
