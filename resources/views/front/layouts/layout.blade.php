<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- index28:48-->
<head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Multi-Vendors Ecommerce</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="{{ url('front/css/material-design-iconic-font.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('front/css/font-awesome.min.css') }}">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="{{ url('front/css/fontawesome-stars.css') }}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{ url('front/css/meanmenu.css') }}">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{ url('front/css/owl.carousel.min.css') }}">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="{{ url('front/css/slick.css') }}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{ url('front/css/animate.css') }}">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="{{ url('front/css/jquery-ui.min.css') }}">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="{{ url('front/css/venobox.css') }}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ url('front/css/nice-select.css') }}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{ url('front/css/magnific-popup.css') }}">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="{{ url('front/css/bootstrap.min.css') }}">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="{{ url('front/css/helper.css') }}">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ url('front/css/style.css') }}">
        <!-- Easy Zoom CSS -->
        <link rel="stylesheet" href="{{ url('front/css/easyzoom.css') }}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ url('front/css/responsive.css') }}">
        <!-- Modernizr js -->
        <script src="{{ url('front/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
             <!-- Begin Header Area -->
             @include('front.layouts.header')
             <!-- Header Area End Here -->
             @yield('content')
             <!-- Begin Footer Area -->
             @include('front.layouts.footer')
             <!-- Footer Area End Here -->
             <!-- Begin Quick View | Modal Area -->
             @include('front.layouts.modals')
             <!-- Quick View | Modal Area End Here -->


        </div>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="{{ url('front/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <!-- Popper js -->
        <script src="{{ url('front/js/vendor/popper.min.js') }}"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="{{ url('front/js/bootstrap.min.js') }}"></script>
        <!-- Ajax Mail js -->
        <script src="{{ url('front/js/ajax-mail.js') }}"></script>
        <!-- Meanmenu js -->
        <script src="{{ url('front/js/jquery.meanmenu.min.js') }}"></script>
        <!-- Wow.min js -->
        <script src="{{ url('front/js/wow.min.js') }}"></script>
        <!-- Slick Carousel js -->
        <script src="{{ url('front/js/slick.min.js') }}"></script>
        <!-- Owl Carousel-2 js -->
        <script src="{{ url('front/js/owl.carousel.min.js') }}"></script>
        <!-- Magnific popup js -->
        <script src="{{ url('front/js/jquery.magnific-popup.min.js') }}"></script>
        <!-- Isotope js -->
        <script src="{{ url('front/js/isotope.pkgd.min.js') }}"></script>
        <!-- Imagesloaded js -->
        <script src="{{ url('front/js/imagesloaded.pkgd.min.js') }}"></script>
        <!-- Mixitup js -->
        <script src="{{ url('front/js/jquery.mixitup.min.js') }}"></script>
        <!-- Countdown -->
        <script src="{{ url('front/js/jquery.countdown.min.js') }}"></script>
        <!-- Counterup -->
        <script src="{{ url('front/js/jquery.counterup.min.js') }}"></script>
        <!-- Waypoints -->
        <script src="{{ url('front/js/waypoints.min.js') }}"></script>
        <!-- Barrating -->
        <script src="{{ url('front/js/jquery.barrating.min.js') }}"></script>
        <!-- Jquery-ui -->
        <script src="{{ url('front/js/jquery-ui.min.js') }}"></script>
        <!-- Venobox -->
        <script src="{{ url('front/js/venobox.min.js') }}"></script>
        <!-- Nice Select js -->
        <script src="{{ url('front/js/jquery.nice-select.min.js') }}"></script>
        <!-- ScrollUp js -->
        <script src="{{ url('front/js/scrollUp.min.js') }}"></script>
        <!-- Main/Activator js -->
        <script src="{{ url('front/js/main.js') }}"></script>
        <!-- Custom js file -->
        <script src="{{ url('front/js/custom.js') }}"></script>
        <!-- Easy Zoom JS -->
        <script src="{{ url('front/js/easyzoom.js') }}"></script>
        <script>
		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});
	</script>
        @include('front/layouts/scripts')
    </body>

<!-- index30:23-->
</html>      