
<!--============================== BlogDetails End ==============================-->
<section class="article-section py-5 bg-light">
        <div class="container py-5">
            <div class="row g-4">
                <!-- المحتوى الرئيسي -->
                <div class="col-lg-8">
                    <div class="mb-4 wow fadeInUp" data-wow-delay="0.1s">
                        <img src="{{ $blog->image }}" alt="HDF System Architecture" class="img-fluid rounded shadow">
                    </div>

                    <div class="text-dark lh-lg fw-medium wow fadeInUp" data-wow-delay="0.2s">
                       {!! $blog->text !!}
                    </div>
                </div>

                <!-- القائمة الجانبية -->
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm wow fadeInRight" data-wow-delay="0.3s">
                        <h3 class="mb-4 fw-bold border-bottom pb-2 wow fadeInRight" data-wow-delay="0.4s">Related Articles</h3>

                        <div class="related-articles">
                             @foreach ($blogs as $relatedBlog)
                            <!-- Article Item 1 -->
                            <div class="d-flex mb-4 pb-2 border-bottom wow fadeInRight" data-wow-delay="0.5s">
                                <div class="flex-shrink-0">
                                    <img src="{{ $relatedBlog->image }}" alt="HDF Architecture"
                                        class="rounded me-3" width="80" height="80">
                                </div>
                                <div class="flex-grow-1 d-grid justify-content-between">
                                    <h5 class="mb-2">
                                        <a href="{{ $relatedBlog->link }}"
                                            class="text-dark text-decoration-none fw-semibold fs-6">
                                            {{ $relatedBlog->title }}
                                        </a>
                                    </h5>
                                    <div class="text-muted small">
                                        <i class="far fa-calendar me-1"></i>{{ Carbon\Carbon::parse($blog->date)->format('Y M D') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>