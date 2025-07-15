{{-- <div class="container py-5">
        @if ($albumDetails)
            <h1 class="mb-4">{{ $albumDetails->title ?? 'تفاصيل الألبوم' }}</h1>
            <div class="mb-3">
                <strong>الوصف:</strong>
                <p>{{ $albumDetails->description ?? '-' }}</p>
            </div>
            <div class="row">
                @if (isset($albumDetails->items) && count($albumDetails->items))
                    @foreach ($albumDetails->items as $item)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset($item->image) }}" class="card-img-top" alt="صورة الألبوم">
                                <div class="card-body">
                                    <p class="card-text">{{ $item->caption ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>لا توجد صور في هذا الألبوم.</p>
                @endif
            </div>
        @else
            <p>لا توجد تفاصيل متاحة لهذا الألبوم.</p>
        @endif
    </div> --}}
    <div class="tp-border-line-wrap">
        <div class="tp-border-line"></div>
        <div class="tp-border-line line-2"></div>
        <div class="tp-border-line line-3"></div>
        <div class="tp-border-line line-4"></div>
    </div>

    <div class="sv-details-area pt-135 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="sv-details-sidebar-wrap">
                        <div class="sv-details-category-list">
                            <ul>
                                <li>
                                    <a href="#">
                                        Project Management
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="#">
                                        Construction Design
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Building Renovation
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Structural Engineering
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Site Planning
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        MEP Engineering (Mechanical, Electrical, Plumbing)
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Project Consultation
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Cost Estimation & Budgeting
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Project Consultation
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="sv-details-right-wrap">
                        <div class="sv-details-thumb">
                            <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="mySwiper" thumbs-swiper=".mySwiper2" space-between="10">
                                <swiper-slide>
                                    <img src="{{$albumDetails->image}}" alt="صورة الغلاف">
                                </swiper-slide>
                                @foreach ($albumDetails->images  as $index=> $img)
                                    <swiper-slide>
                                        <img src="{{ asset('uploads/album_items/source/' .$img->name) }}" alt="صورة من الألبوم">
                                    </swiper-slide>
                                @endforeach
                            </swiper-container>
                            <swiper-container class="mySwiper2" space-between="10" slides-per-view="4" free-mode="true"
                                watch-slides-progress="true">
                                @foreach ($albumDetails->images as $index=> $img)
                                    <swiper-slide>
                                        <img src="{{ asset('uploads/album_items/source/' .$img->name) }}" alt="صورة من الألبوم">
                                    </swiper-slide>
                                @endforeach
                            </swiper-container>
                        </div>
                    </div>
                </div>
                <div class="row mt-50">
                    <div class="col-12">
                        <div class="taps-prudcts mb-50">
                            <button class="tablink" onclick="openPage('Home', this, '#171b24')" id="defaultOpen">System
                                Information</button>
                            <button class="tablink" onclick="openPage('Contact', this, '#171b24')">Advantages</button>

                            <div id="Home" class="tabcontent">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores repudiandae iusto
                                    cumque et, quam inventore dicta vitae suscipit consectetur amet fuga consequuntur,
                                    aliquam adipisci praesentium sed quisquam enim reiciendis nulla.</p>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam architecto neque
                                    amet natus itaque nam est sapiente saepe. Voluptatibus cupiditate culpa itaque,
                                    alias, delectus maiores corporis illo aliquid magnam enim odit minus molestias ab
                                    ipsum tenetur voluptatum sequi molestiae modi exercitationem. Adipisci, repellat
                                    inventore vitae itaque quasi quia earum velit.</p>
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempora ad labore minima
                                    hic necessitatibus enim quod, placeat officia est ratione. Aliquam aperiam saepe
                                    molestias consequatur non deserunt aspernatur temporibus consectetur?</p>
                            </div>


                            <div id="Contact" class="tabcontent">
                                <u class="list-stile-prudcts">
                                    <li><i class="fa-regular fa-star"></i>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, voluptatum.
                                        </p>
                                    </li>
                                    <li><i class="fa-regular fa-star"></i>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, voluptatum.
                                        </p>
                                    </li>
                                    <li><i class="fa-regular fa-star"></i>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, voluptatum.
                                        </p>
                                    </li>
                                    <li><i class="fa-regular fa-star"></i>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maxime, voluptatum.
                                        </p>
                                    </li>
                                </u>
                            </div>
                        </div>
                        <div class="contact-right-wrap">
                            <div class="team-details-contactform">
                                <!---Form--->
                                <x-contact-form />
                                <!---Form--->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
