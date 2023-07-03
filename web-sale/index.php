<?php
function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[random_int(0, $charactersLength - 1)];
  }
  return $randomString;
}

$v = generateRandomString(10);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Valet &mdash; Free HTML5 Bootstrap Template by FREEHTML5.co</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
  <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
  <meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
	
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 	https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  <!-- Facebook and Twitter integration -->
  <meta property="og:title" content="" />
  <meta property="og:image" content="" />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="" />
  <meta property="og:description" content="" />
  <meta name="twitter:title" content="" />
  <meta name="twitter:image" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:card" content="" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="favicon.ico" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Google Webfont -->
  <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'> -->
  <!-- Themify Icons -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/themify-icons.css" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/bootstrap.css" />
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/owl.carousel.min.css" />
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/owl.theme.default.min.css" />
  <!-- Magnific Popup -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/magnific-popup.css" />
  <!-- Superfish -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/superfish.css" />
  <!-- Easy Responsive Tabs -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/easy-responsive-tabs.css" />
  <!-- Animate.css -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/animate.css" />
  <!-- Theme Style -->
  <link rel="stylesheet" href="/bai-tap/web-sale/css/csscopy/style.css" />

  <!-- Modernizr JS -->
  <script src="/bai-tap/web-sale/js/jscopy/modernizr-2.6.2.min.js"></script>

  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div id="fh5co-hero" style="background-image: url(images/vietnamese_food_top_banner.jpeg)">
    <div class="overlay"></div>
    <a href="#fh5co-main" class="smoothscroll fh5co-arrow to-animate hero-animate-4"><i class="ti-arrow-down"></i></a>
    <!-- End fh5co-arrow -->
    <div class="container">
      <div class="col-md-12">
        <div class="fh5co-hero-wrap">
          <div class="fh5co-hero-intro">
            <h1 class="to-animate hero-animate-1">Web bán đồ ăn</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="fh5co-main">
    <div class="fh5co-cards">
      <div class="container-fluid">
        <div class="row animate-box">
          <div class="col-md-12 heading text-center">
            <h2>Món ăn bán chạy</h2>
          </div>
        </div>
        <div class="row" id="list"></div>
      </div>
    </div>
    <div class="fh5co-cards">
      <div class="container-fluid">
        <div class="row animate-box">
          <div class="col-md-12 heading text-center">
            <h2>Danh sách món ăn</h2>
          </div>
        </div>
        <div class="row" id="list2"></div>
      </div>
    </div>
    <div class="fh5co-cards">
      <div class="container-fluid">
        <div class="row animate-box">
          <div class="col-md-12 heading text-center">
            <h2>Món ăn mới nhất</h2>
          </div>
        </div>
        <div class="row" id="list3"></div>
      </div>
    </div>
    <div class="fh5co-cards">
      <div class="container-fluid">
        <div class="row animate-box">
          <div class="col-md-12 heading text-center">
            <h2>Món ăn khuyến mãi</h2>
          </div>
        </div>
        <div class="row" id="list4"></div>
      </div>
    </div>
    <div id="fh5co-testimonial">
      <div class="container">
        <div class="row">
          <!-- Start Slider Testimonial -->
          <h2 class="fh5co-uppercase-heading-sm text-center animate-box">
            Customer Says...
          </h2>
          <div class="fh5co-spacer fh5co-spacer-xs"></div>
          <div class="owl-carousel-fullwidth animate-box">
            <div class="item">
              <p class="text-center quote">
                &ldquo;Design must be functional and functionality must be
                translated into visual aesthetics, without any reliance on
                gimmicks that have to be explained. &rdquo;
                <cite class="author">&mdash; Ferdinand A. Porsche</cite>
              </p>
            </div>
            <div class="item">
              <p class="text-center quote">
                &ldquo;Creativity is just connecting things. When you ask
                creative people how they did something, they feel a little
                guilty because they didn’t really do it, they just saw
                something. It seemed obvious to them after a while.
                &rdquo;<cite class="author">&mdash; Steve Jobs</cite>
              </p>
            </div>
            <div class="item">
              <p class="text-center quote">
                &ldquo;I think design would be better if designers were much
                more skeptical about its applications. If you believe in the
                potency of your craft, where you choose to dole it out is not
                something to take lightly. &rdquo;<cite class="author">&mdash; Frank Chimero</cite>
              </p>
            </div>
          </div>
          <!-- End Slider Testimonial -->
        </div>
        <!-- END row -->
      </div>
    </div>
  </div>
  <!-- END fhtco-main -->

  <footer role="contentinfo" id="fh5co-footer">
    <a href="#" class="fh5co-arrow fh5co-gotop footer-box"><i class="ti-arrow-up"></i></a>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 footer-box">
          <h3 class="fh5co-footer-heading">Company</h3>
          <ul class="fh5co-footer-links">
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Our Products</a></li>
            <li><a href="#">Our Culture</a></li>
            <li><a href="#">Team</a></li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-6 footer-box">
          <h3 class="fh5co-footer-heading">More Links</h3>
          <ul class="fh5co-footer-links">
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Our Careers</a></li>
            <li><a href="#">Support &amp; FAQ's</a></li>
            <li><a href="#">Sign up</a></li>
            <li><a href="#">Log in</a></li>
          </ul>
        </div>
        <div class="col-md-4 col-sm-12 footer-box">
          <h3 class="fh5co-footer-heading">Get in touch</h3>
          <ul class="fh5co-social-icons">
            <li>
              <a href="#"><i class="ti-google"></i></a>
            </li>
            <li>
              <a href="#"><i class="ti-twitter-alt"></i></a>
            </li>
            <li>
              <a href="#"><i class="ti-facebook"></i></a>
            </li>
            <li>
              <a href="#"><i class="ti-instagram"></i></a>
            </li>
            <li>
              <a href="#"><i class="ti-dribbble"></i></a>
            </li>
          </ul>
        </div>
        <div class="col-md-12 footer-box text-center">
          <div class="fh5co-copyright">
            <p>
              &copy; 2015 Free Valet. All Rights Reserved. <br />Designed by
              <a href="http://freehtml5.co" target="_blank">FREEHTML5.co</a>
              Images by:
              <a href="http://unsplash.com" target="_blank">Unsplash</a>
            </p>
          </div>
        </div>
      </div>
      <!-- END row -->
      <div class="fh5co-spacer fh5co-spacer-md"></div>
    </div>
  </footer>
  <script src="/bai-tap/web-sale/php/list.js"></script>
  <!-- jQuery -->
  <script src="/bai-tap/web-sale/js/jscopy/jquery-1.10.2.min.js"></script>
  <!-- jQuery Easing -->
  <script src="/bai-tap/web-sale/js/jscopy/jquery.easing.1.3.js"></script>
  <!-- Bootstrap -->
  <script src="/bai-tap/web-sale/js/jscopy/bootstrap.js"></script>
  <!-- Owl carousel -->
  <script src="/bai-tap/web-sale/js/jscopy/owl.carousel.min.js"></script>
  <!-- Magnific Popup -->
  <script src="/bai-tap/web-sale/js/jscopy/jquery.magnific-popup.min.js"></script>
  <!-- Superfish -->
  <script src="/bai-tap/web-sale/js/jscopy/hoverIntent.js"></script>
  <script src="/bai-tap/web-sale/js/jscopy/superfish.js"></script>
  <!-- Easy Responsive Tabs -->
  <script src="/bai-tap/web-sale/js/jscopy/easyResponsiveTabs.js"></script>
  <!-- FastClick for Mobile/Tablets -->
  <script src="/bai-tap/web-sale/js/jscopy/fastclick.js"></script>
  <!-- Parallax -->
  <!-- <script src="/bai-tap/web-sale/jscopy/jquery.parallax-scroll.min.js"></script> -->
  <!-- Waypoints -->
  <script src="/bai-tap/web-sale/js/jscopy/jquery.waypoints.min.js"></script>
  <!-- Main JS -->
  <!-- <script src="/bai-tap/web-sale/jscopy/main.js"></script> -->
  <script src="/bai-tap/web-sale/js/jscopy/main.js?v=<?= $v ?>"></script>
</body>

</html>
<style>
  .img-responsive {
    width: 425px;
    height: 500px;
  }
</style>