<!--============================== BlogDetails Start ==============================-->
<section class="news-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="news-details__left">
                    <div class="news-details__img">
                        <img src="{{ $blog->image }}" alt="blog->image">
                    </div>
                    <div class="news-details__content">
                        <ul class="list-unstyled news-details__meta">
                            <li><i class="far fa-calendar"></i> {{ $blog->date }}
                            </li>
                        </ul>
                        <h1 class="news-details__title">{{ $blog->title }}</h1>
                        <p class="news-details__text-1">{!! $blog->text !!}</p>
                        @foreach ($faqs as $i => $faq)
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-0" aria-expanded="true" aria-controls="collapseOne">
                                                       {{ app()->getLocale() == 'ar' ? $faq->title_ar ?? ($faq->question ?? ($faq->title ?? '')) : $faq->title_en ?? ($faq->question ?? ($faq->title ?? '')) }}
                                                    </button>
                                                </h2>
                                            </div>
                                    
                                            <div id="collapse-0" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>{!! app()->getLocale() == 'ar'
                                            ? $faq->text_ar ?? ($faq->answer ?? ($faq->text ?? ''))
                                            : $faq->text_en ?? ($faq->answer ?? ($faq->text ?? '')) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="sidebar">

                    <div class="sidebar__single sidebar__post">
                        <h3 class="sidebar__title">{{ trans('home.blogs') }}</h3>
                        <ul class="sidebar__post-list list-unstyled">
                            @foreach ($blogs as $relatedBlog)
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="{{ $relatedBlog->image }}" alt="relatedBlog">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <h3>
                                            <a href="{{ $relatedBlog->link }}">{{ $relatedBlog->title }}</a>
                                        </h3>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================== BlogDetails End ==============================-->
