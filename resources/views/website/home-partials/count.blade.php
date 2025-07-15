@if ($progresses->isNotEmpty())
    <!--==========================StartCount==========================-->
    <div class="tp-funfact-area pt-60">
        <div class="container">
            <div class="row">
                @foreach ($skillsTitle as $title)
                    <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 mb-50">
                        <div class="tp-service-left p-relative">
                            <div class="tp-service-title-box mb-40">
                                <span class="tp-section-respect1 mb-10">{{ $title->title }}</span>
                                <h4 class="tp-section-title tp_reveal_anim font-30">{{ $title->title1 }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach ($progresses as $key => $progress)
                    @if ($key < 2)
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 mb-50">
                            <div class="tp-funfact-item">
                                <h4 class="tp-funfact-number"><span data-purecounter-duration="1"
                                        data-purecounter-end="{{ $progress->number }}"
                                        class="purecounter">{{ $progress->number }}</span>+</h4>
                                <span>{{ $progress->title }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!--==========================EndCount==========================-->
@endif