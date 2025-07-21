

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
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.addEventListener('click', function () {
                        const mainImg = document.getElementById('mainHDFImage');
                        mainImg.src = this.dataset.fullimg;
                    });
                });

                document.getElementById('zoomBtn').addEventListener('click', function () {
                    const currentImg = document.getElementById('mainHDFImage');
                    Fancybox.show([{
                        src: this.dataset.fullimg || currentImg.src,
                        caption: this.dataset.caption || currentImg.alt
                    }]);
                });
            });
        </script>
        <script>
           new WOW().init();
        </script>


@yield('script')
