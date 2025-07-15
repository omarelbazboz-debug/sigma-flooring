
<section class="experience-section">
    <div class="experience-content">
        @foreach ($aboutStrucTitle->take(1) as $title )
        <h2> {{$title->title}} </h2>
        <p>
           {!! $title->text !!}
        </p>
        @endforeach
    </div>
</section>
