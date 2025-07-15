<!--===================== StartProjects =========================-->

<div class="pr-portfolio-area pt-90 pb-50">
    <div class="container">
        <div class="row">
         @foreach($projectsTitle as $title)
            <div class="col-xl-12 col-lg-12">
                <div class="tp-service-title-box mb-40">
                    <span class="tp-section-respect1 mb-10">{{$title->title}}</span>
                    <h4 class="tp-section-title tp_reveal_anim">{{$title->title1}}</h4>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pr-portfolio-masonary-wrap mb-30">
            <div class="row">
               @foreach ($projects as $index=> $project)
                <div class="col-xl-4 col-lg-4">
                    <div class="pr-portfolio-item p-relative mb-30 wow animate__bounceInLeft" data-wow-duration="1.5s"
                        data-wow-delay="0s">
                        <div class="pr-portfolio-icon">
                            <a class="" href="{{$project->image}}" data-fancybox="album1-{{$index}}"
                                data-caption="cairo">
                                <img src="{{$project->image}}" alt="image">
                            </a>
                        </div>
                        <div class="pr-portfolio-img">
                            <img src="{{$project->image}}" alt="image">
                            @foreach ($project->images as $image)
                            <a href="{{$image->image_url}}" data-fancybox="album1-{{$index}}"
                                data-caption="cairo"></a>
                            @endforeach
                        </div>
                        <div class="pr-portfolio-content">
                            <h4 class="pr-portfolio-title"><a href="{{$project->link}}">{{$project->name}}</a>
                            </h4>
                            <span><a href="{{$project->link}}">{{ trans('home.Show Project') }}</a></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="tp-project-item  p-relative">
            <div class="tp-service-btn-box">
                <div class="tp-blog-4-btn">
                    <a class="tp-btn-circle tp-hover-btn-wrapper   tp-hover-btn" href="{{Helper::AppUrl('projects')}}">
                        <span class="tp-btn-circle-text"> {{ trans('home.More Projects') }}</span>
                        <i class="fa-solid fa-arrow-right"></i>
                        <i class="tp-btn-circle-dot"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===================== EndProjects =====================-->
