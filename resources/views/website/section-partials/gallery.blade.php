@if ($galleryImages->isNotEmpty())
<!--====================Gallery==============-->
        <section class="portfolio">
            <div class="container">
                <div class="row filter-layout masonary-layout">
                    @foreach ($galleryImages as $image)
                    <!--Portfolio Single Start-->
                    <div class="col-xl-4 col-lg-6 col-md-6 filter-item stra busi">
                        <div class="portfolio__single">
                            <div class="portfolio__img">
                                <img src="{{ $image->img }}" alt="">
                                <div class="portfolio__plus">
                                    <a href="{{ $image->img }}" class="img-popup"><span
                                            class="icon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Portfolio Single End-->
                    @endforeach
                </div>
            </div>
        </section>
<!--====================Gallery==============-->
@endif