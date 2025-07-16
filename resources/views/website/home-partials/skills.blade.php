@if ($progresses->isNotEmpty()  )
<section class="experience-section">
    <div class="experience-content">
         @foreach ($skillsTitle->take(1) as $title)
        <h2> {{$title->title}} </h2>
        <p>
           {!! $title->text !!}
        </p>
        @endforeach
    </div>
    <div class="container">
        <div class="stats pt-5">
            <div class=" count first-count   h-100 border-2 ">
                <div class="expertise-highlights mx-auto d-flex flex-column align-items-center px-5 py-3">

                    <i class="fa-solid fa-user fs-4"></i>
                    <span class="counter text-white fs-4 fw-bolder w-auto" data-target="{{ $progresses[0]->number }}"></span>
                </div>
            </div>
            <div class="row gx-lg-5 gy-5 text-center text-white mt-2">
                @foreach ($progresses->slice(2) as $key => $progress)
                    <div class="col-12 col-md-2">
                        <div class=" count d-flex flex-column justify-content-center gap-3 h-100 border-2 p-4">
                            <div class="expertise-highlights">
                                <div class="user-count d-flex flex-column  gap-3">
                                    <i class="fa-solid fa-user fs-4"></i>
                                    <span class="counter text-white fs-4 fw-bolder" data-target="{{ $progress->number }}"></span>
                                </div>

                            </div>
                            <span class=" fw-bold text-white fs-4 ">{{ $progress->title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
  </section>

@endif


