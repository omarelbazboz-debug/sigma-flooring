<div class="social-icon position-fixed bottom-0 mb-5 me-3 d-flex flex-column gap-2 z-2 wow fadeInRight" data-wow-duration="1s">
  <!-- مجموعة الاتصال -->
  <div class="contact-group d-flex  align-items-center gap-1">
    <!-- أيقونة الهاتف الرئيسية -->
    <a " class="btn d-flex align-items-center justify-content-center rounded-3">
      <i class="fas fa-phone"></i>
    </a>

    <div class="sub-icons d-flex  align-items-center gap-2 ">
            @foreach ($phones as $phone) 
     <a href="tel:+2{{ $phone->phone }}" class="sub-contact d-flex align-items-center justify-content-center rounded-circle bg-primary" >
        <i class="fas fa-phone"></i>
      </a>
    @endforeach

    </div>
  </div>
  
  <div class="contact-group d-flex  align-items-center gap-1">
    <!-- أيقونة الهاتف الرئيسية -->
    <a  class="btn d-flex align-items-center justify-content-center rounded-3">
               <i class="fab fa-whatsapp"></i>
    </a>

    <!-- الأيقونات الفرعية -->
   <div class="sub-icons d-flex align-items-center gap-2">
        @foreach ($phones as $phone)
        <a href="https://wa.me/+2{{ $phone->phone }}" class="sub-contact  d-flex align-items-center justify-content-center rounded-circle"style="background:#25D366; color:#FFF;">
               <i class="fab fa-whatsapp"></i>
        </a>
    @endforeach
    </div>
  </div>


  <!-- زر العودة -->
  <button id="back-top" class="back-to-top d-flex align-items-center justify-content-center rounded-3">
    <i class="fas fa-long-arrow-up"></i>
  </button>
</div>





<!--<div id="bw-contact-info">-->
<!--    @foreach ($phones as $phone)-->
<!--        <a href="https://wa.me/+2{{ $phone->phone }}" style="background:#25D366;color:#FFF;">-->
<!--        </a>-->
<!--    @endforeach-->


<!--</div>-->



<!--<div id="bw-contact-info" class="btn-call">-->

<!--    @foreach ($phones as $phone) -->
<!--        <a href="tel:+2{{ $phone->phone }}" style="background:orange;color:#FFF;">-->

<!--        </a>-->
<!--    @endforeach-->
<!--    </div>-->