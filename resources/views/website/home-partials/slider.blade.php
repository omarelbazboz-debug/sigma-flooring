@if ($sliders->isNotEmpty())
    <!--================= Slider ================-->
    <div class="hero-slider">
        <div class="owl-carousel hero owl-theme">
            @foreach ($sliders as $slider)
                <div class="item">
                    <img src="{{ $slider->image }}"
                        alt="Slider 1" class="w-100" loading="lazy" />
                    <div class="overlay"></div>
                    {{--
                        <div class="slider-content">
                            <h2> {{ $slider->title }} </h2>
                            <p> {!! $slider->text !!} </p>
                        </div>
                    --}}
                </div>
            @endforeach
        </div>
    </div>
@endif
