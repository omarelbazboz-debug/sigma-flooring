<!--==========================ServiceDetails==========================-->



        <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row  pt-5 g-5 align-items-center">
                <div class="col-lg-12 position-relative wow fadeInUp" data-wow-duration="1.5s">
                    <div class="custom-services">
                        <img src="{{$album->image }}" class="img-fluid shadow-lg rounded-4 object-fit-cover"
                            alt="">

                    </div>
                </div>
                <div class="col-lg-12 position-relative wow fadeInUp" data-wow-duration="1.5s">
                    <div class="custom-services">

                        <h2 class="mt-3 fw-medium d-grid px-2 lh-lg">
                                {{$album->name}}<br/>

                            {!! $album->text !!}
                        </h2>
                    </div>
                </div>



            </div>
        </div>
    </section>
<!--==========================ServiceDetails==========================-->
