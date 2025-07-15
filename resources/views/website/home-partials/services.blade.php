
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row  pt-5 g-5">
                @foreach ($albums as $album )
                <div class="col-lg-4 position-relative wow fadeInUp" data-wow-duration="1.5s">
                    <a href="{{$album->link}}" class="custom-services">
                        <img src="{{$album->image }}" class="img-fluid shadow-lg rounded-4 object-fit-cover"
                            alt="">
                        <h2 class="mt-3 fw-medium d-grid px-2">
                            {{$album->name}}
                        </h2>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
