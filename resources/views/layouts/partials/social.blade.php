{{--
<div class="social-icon position-fixed  bottom-0 mb-5 me-3 d-flex flex-column gap-1 z-2 wow fadeInRight"
    data-wow-duration="1s">
    <a href="tel:2{{ $setting->mobile }}" class="btn d-flex align-items-center justify-content-center rounded-3"
        style="width: 40px; height: 40px">
        <i class="fas fa-phone"></i>
    </a>
    <a href="http://wa.me/2{{ $setting->mobile }}" target="_blank"
        class="btn d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px">
        <i class="fab fa-whatsapp"></i>
    </a>
    <!-- Back To Top start -->
    <button id="back-top" class="back-to-top d-flex align-items-center justify-content-center rounded-3 ">
        <i class="fas fa-long-arrow-up"></i>
    </button>
</div>
--}}


<div id="bw-contact-info">
    @foreach ($phones as $phone)
        <a href="https://wa.me/+2{{ $phone->phone }}" style="background:#25D366;color:#FFF;">
            <i class="icon fs-14 icon-whatsapp"></i>{{ $phone->phone }}
        </a>
    @endforeach


</div>



<div id="bw-contact-info" class="btn-call">

    @foreach ($phones as $phone)
        <a href="tel:+2{{ $phone->phone }}" style="background:orange;color:#FFF;">
{{ $phone->phone }}
        </a>
    @endforeach




</div>
