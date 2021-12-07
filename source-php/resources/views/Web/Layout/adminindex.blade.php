<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->
@include('Web.Layout.header')
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
@include('Web.Layout.menu-top')
@yield('content')
<!-- Li's Trendding Products Area End Here -->
    <!-- Begin Footer Area -->
@include('Web.Layout.footer')
<!-- Footer Area End Here -->
</div>
<!-- Body Wrapper End Here -->
<!-- jQuery-V1.12.4 -->
<script src={{asset("js/vendor/jquery-1.12.4.min.js")}}></script>
<!-- Popper js -->
<script src={{asset("js/vendor/popper.min.js")}}></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src={{asset("js/bootstrap.min.js")}}></script>
<!-- Ajax Mail js -->
<script src={{asset("js/ajax-mail.js")}}></script>
<!-- Meanmenu js -->
<script src={{asset("js/jquery.meanmenu.min.js")}}></script>
<!-- Wow.min js -->
<script src={{asset("js/wow.min.js")}}></script>
<!-- Slick Carousel js -->
<script src={{asset("js/slick.min.js")}}></script>
<!-- Owl Carousel-2 js -->
<script src={{asset("js/owl.carousel.min.js")}}></script>
<!-- Magnific popup js -->
<script src={{asset("js/jquery.magnific-popup.min.js")}}></script>
<!-- Isotope js -->
<script src={{asset("js/isotope.pkgd.min.js")}}></script>
<!-- Imagesloaded js -->
<script src={{asset("js/imagesloaded.pkgd.min.js")}}></script>
<!-- Mixitup js -->
<script src={{asset("js/jquery.mixitup.min.js")}}></script>
<!-- Countdown -->
<script src={{asset("js/jquery.countdown.min.js")}}></script>
<!-- Counterup -->
<script src={{asset("js/jquery.counterup.min.js")}}></script>
<!-- Waypoints -->
<script src={{asset("js/waypoints.min.js")}}></script>
<!-- Barrating -->
<script src={{asset("js/jquery.barrating.min.js")}}></script>
<!-- Jquery-ui -->
<script src={{asset("js/jquery-ui.min.js")}}></script>
<!-- Venobox -->
<script src={{asset("js/venobox.min.js")}}></script>
<!-- Nice Select js -->
<script src={{asset("js/jquery.nice-select.min.js")}}></script>
<!-- ScrollUp js -->
<script src={{asset("js/scrollUp.min.js")}}></script>
<!-- Main/Activator js -->
<script src={{asset("js/main.js")}}></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.js"></script>
</body>
@yield('script')
<!-- index30:23-->
</html>
