<section class="about py-5">
    <div class="container py-5">
        <div class="row align-items-center pt-5 gx-5 gy-0">
            <div class="col-lg-7 position-relative wow fadeInUp" data-wow-duration="1.5s">
                <div class="custom-logo  ">
                    <!-- الصورة السفلية (مثل الحرف d) -->
                    <img src="{{ $about->banner }}" class="img-square shadow-lg rounded-4" alt="">

                    <!-- الصورة العلوية اليمنى (مثل الحرف f) -->
                    <img src="{{ $about->image }}" class="img-rect shadow-lg rounded-4" alt="">
                </div>

            </div>
            <div class="col-lg-5 wow fadeInUp" data-wow-duration="1.5s">
                <h2 class="mb-3 fw-bold  text-uppercase">
                    {{ $about->title }}
                </h2>
                <p class="text-muted mb-4 lh-lg">
                    {{Helper::removeTagsAndCutText($about->text , 500)}}
                  
                </p>


                <a href="{{Helper::AppUrl('about-us')}}" class="btn btn-send px-4 py-2">
                    @lang('home.View About Us')
                </a>
            </div>
        </div>
    </div>
</section>
