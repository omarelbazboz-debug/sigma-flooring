

 <script src="{{Helper::getFrontPath('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{Helper::getFrontPath('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{Helper::getFrontPath('js/owl.carousel.min.js')}}"></script>
    <script src="{{Helper::getFrontPath('js/wow.min.js')}}"></script>
    <script src="{{Helper::getFrontPath('js/main.js')}}"></script>
    <script>
      new WOW().init();
    </script>
     <script src="{{Helper::getFrontPath('js/fancybox.umd.js')}}"></script>

 <script>
        Fancybox.bind("[data-fancybox]", {
            caption: (fancybox, slide) => {
                const caption = slide.caption || "";
            },
        });
    </script>
         
        <script>
           new WOW().init();
        </script>


<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ env('RECAPTCHA_SITEKEY') }}', {action: 'contact'}).then(function (token) {
            document.getElementById('recaptcha_token').value = token;
        });
    });
</script>



@yield('script')
