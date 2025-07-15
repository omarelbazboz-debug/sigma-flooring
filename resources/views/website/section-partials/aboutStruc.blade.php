<!--==========================Start About Strucs==========================-->

        @foreach ($aboutStrucs as $key => $aboutStruc)
            @if ($loop->iteration % 2 == 1)
                <section class="pt-5 bg-section">
                    <div class="container py-5">
                        <div class="row align-items-center gx-lg-5 py-5">
                            <div class="col-md-5 wow fadeInUp" data-wow-duration="1s">
                                <h2 class="mb-3 fw-bold d-grid">
                                    <span class="text-uppercase mb-2">{{ $aboutStruc->title }} </span>
                                </h2>
                                <p class="text-muted mb-4 lh-lg fs-5">
                                    {!! $aboutStruc->text !!}
                                </p>
                            </div>
                            <div class="col-lg-7 position-relative wow fadeInUp" data-wow-duration="1.5s">
                                <div class="custom-logo-two-about  ">


                                    <!-- الصورة العلوية اليمنى (مثل الحرف f) -->
                                    <img src="{{ $aboutStruc->image }}" class="img-fluid shadow-lg rounded-4"
                                        alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="pt-5 bg-white">
                    <div class="container py-5">
                        <div class="row align-items-center py-5 gx-lg-5">
                            <div class="col-lg-7 position-relative wow fadeInUp" data-wow-duration="1.5s">
                                <div class="custom-logo-about  ">

                                    <img src="{{ $aboutStruc->image }}" class="img-fluid shadow-lg rounded-4"
                                        alt="">
                                </div>

                            </div>
                            <div class="col-md-5 wow fadeInUp" data-wow-duration="1s">
                                <h2 class="mb-3 fw-bold d-grid">
                                    <span class=" mb-2 text-uppercase">{{ $aboutStruc->title }} </span>
                                </h2>
                                <p class="text-muted mb-4 lh-lg fs-5">
                                    {!! $aboutStruc->text !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach

