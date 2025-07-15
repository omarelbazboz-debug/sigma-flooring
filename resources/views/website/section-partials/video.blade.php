<section>
    <div class="cs_height_110 cs_height_lg_70"></div>
    <div class="container">
        <div class="cs_height_50 cs_height_lg_50"></div>
    </div>
    <div class="container">
        <div class="cs_project_grid cs_style_1">
            <div class="row">
                @foreach($videos as $video)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="vedio-item">
                        <iframe src="{{$video->youtube_link}}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="cs_height_120 cs_height_lg_80"></div>
</section>
