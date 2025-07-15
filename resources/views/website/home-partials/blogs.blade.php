@if ($blogs->isNotEmpty())
    <section class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="800">
                <div class="header-text">
                    <h2 class="fw-bold fs-1">
                        <span class="transparent-text"> {{ trans('home.blogs') }}
                    </h2>
                </div>
            </div>
            <div class="row g-4">
                <!-- HDF Panel Article -->
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card article-card h-100 border-0 overflow-hidden position-relative">
                            <div class="image-wrapper position-relative overflow-hidden">
                                <img src="{{ $blog->image }}" class="card-img-top zoom-effect"
                                    alt="Premium HDF Panel Applications">
                                <div
                                    class="category-badge position-absolute bg-dark  text-white px-3 py-1 rounded-pill">
                                    {{ $blog->category?->title }}</div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="text-muted small me-3"><i class="far fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($blog->date)->format('M, d') }}</span>
                                    {{-- <span class="text-muted small"><i class="far fa-eye me-1"></i> 2.4K Views</span> --}}
                                </div>
                                <h3 class="card-title fw-bold mb-3 flex-grow-0">
                                    <a href="{{ $blog->link }}"
                                        class="stretched-link text-decoration-none text-dark hover-underline">
                                        {{ $blog->title }}</a>
                                </h3>
                                <p class="card-text text-secondary mb-4 flex-grow-1">
                                    {{ Helper::removeTagsAndCutText($blog->text, 50) }}</p>
                                <button type="button" class="btn btn-outline-dark btn-more align-self-start mt-auto">
                                    @lang('home.read_more')
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
