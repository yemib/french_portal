<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome to {{ config("app.name") }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="https://frenchvillage.edu.ng/picture_logo/logo.png">
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset("_new_web/fonts/lato/lato.css") }}">
    <!-- CSS -->
    <!-- Bootstrap CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/css/bootstrap.min.css") }}">
    <!-- Icon Font CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/css/icofont.css") }}">
    <!-- Plugins CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/css/plugins.css") }}">
    <!-- ShortCodes CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/css/shortcode/shortcodes.css") }}">
    <!-- Style CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/style.css") }}">
    <!-- Responsive CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset("_new_web/css/responsive.css") }}">
    <!-- Style customizer (Remove these two lines please) -->
    {{--<link rel="stylesheet" href="{{ asset("_new_web/css/style-customizer.css") }}">--}}
    {{--<link href="#" data-style="styles" rel="stylesheet">--}}
    <!-- Modernizer JS
    ============================================ -->
    <script src="{{ asset("_new_web/js/vendor/modernizr-2.8.3.min.js") }}"></script>
</head>
<body>

<!-- Body main wrapper start -->
<div class="wrapper fix">
    <!-- Header 1
    ============================================ -->
    <div class="header-area header-absolute header-transparent">
        <div class="header-top hidden">
            <div class="container">
                <div class="row">
                    <!-- Header Top -->
                    <div class="header-top-wrapper fix">
                        <div class="header-top-left text-left col-sm-6">
                            <p><i class="icofont icofont-envelope"></i><span>info@example.com</span></p>
                            <p><i class="icofont icofont-ui-call"></i><span>+012 345 678 102 </span></p>
                        </div>
                        <div class="header-top-right text-right col-sm-6">
                            <p><i class="icofont icofont-clock-time"></i><span>Mon - Sat : 8am - 9pm</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom sticky">
            <div class="container">
                <div class="row">
                    <!-- Header Bottom -->
                    <div class="col-xs-12">
                        <div class="navbar-header">
                            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu">
                                <i class="icofont icofont-navigation-menu menu-open"></i>
                                <i class="icofont icofont-close menu-close"></i>
                            </button>
                            <a href="onepage-text-effect.html" class="logo navbar-brand"><img id="logo_img" src="https://frenchvillage.edu.ng/picture_logo/logo.png" alt="logo" height="50" style="height: 50px;" /></a>
                        </div>

                        <div class="main-menu onepage-nav collapse navbar-collapse float-right" id="main-menu">
                            <nav>
                                <ul>
                                    <li class="active"><a href="#hero-area">home</a></li>
                                    <li><a href="#feature-area">features</a></li>
                                    <li><a href="#course-area">services</a></li>
                                    <li><a href="#gallery-area">gallery</a></li>
                                    <li><a href="#instructor-area">instructors</a></li>
                                    <li><a href="#pricing-area">pricing</a></li>
                                    <li><a href="#contact-area">contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area
    ============================================ -->
    <div id="hero-area" class="hearo-area hero-static hero-bg overlay overlay-black overlay-60 fix">
        <div class="container">
            <div class="hero-slide-content text-center">
                <h3>welcome to the</h3>
                <h1>{{--the best--}}{{ config("app.name") }}<span class="tlt"><span class="texts">
				<span data-in-effect="bounceInDown" data-out-effect="bounceOutDown"></span>
				{{--<span data-in-effect="bounceInLeft" data-out-effect="bounceOutRight">safety</span>--}}
			</span></span> {{--measures--}}</h1>
                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, minim veniamsed sed do <br />eiusmod tempor maksu rez ut labore  magna do eiusmod</p>--}}
                <div class="button-group">
                    <a href="{{ route("login") }}" class="btn transparent">portal login</a>
                    <a href="{{ route("register") }}" class="btn color">apply now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Instructor Area
    ============================================ -->
    <div id="instructor-area" class="instructor-area bg-gray pt-90 pb-60">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">Welcome address of the director</h3>
                    <div class="excerpt hidden">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- Instructor Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active row" id="instructor-1">
                            <div class="instructor-image col-md-2 col-md-offset-2 col-sm-6 col-xs-12" style="margin-top: 0;">
                                <img src="{{ asset("images/director.JPG") }}" alt="" style="width: 100%" />
                            </div>
                            <div class="instructor-details text-left col-md-6 col-xs-12">
                                <h4 class="instructor-name hidden">jonathon joe</h4>
                                <p>
                                    You are all welcome to Nigerian French language village eportal website where students and everyone can watch the development, academic structure of our great citadel of learning. We hope to make a big change to the world through language. Enjoy the view, good day.
                                </p>

                                <h5 class="instructor-title"><i>- Director</i></h5>

                                <div class="fix">
                                    <a href="{{ route("register") }}" class="btn color">apply now!</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade row" id="instructor-2">
                            <div class="instructor-details text-left col-md-7 col-xs-12">
                                <h4 class="instructor-name">Martin Adam</h4>
                                <h5 class="instructor-title">Instructor</h5>
                                <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look even slightly believable.There are many many variations of passages of Lorem Ipsum available,but the on majority have suffered   alteration in some form, by hum maksu rez words which is don't look even slightly believable.</p>
                                <div class="instructor-social fix">
                                    <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                                    <a href="#"><i class="icofont icofont-social-pinterest"></i></a>
                                    <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                                    <a href="#"><i class="icofont icofont-social-google-plus"></i></a>
                                </div>
                            </div>
                            <div class="instructor-image col-md-5 col-sm-6 col-xs-12">
                                <img src="{{ asset("_new_web/img/instructor/big-2.jpg") }}" alt="" />
                            </div>
                        </div>
                        <div class="tab-pane fade row" id="instructor-3">
                            <div class="instructor-details text-left col-md-7 col-xs-12">
                                <h4 class="instructor-name">Gabriel Stan</h4>
                                <h5 class="instructor-title">Instructor</h5>
                                <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look even slightly believable.There are many many variations of passages of Lorem Ipsum available,but the on majority have suffered   alteration in some form, by hum maksu rez words which is don't look even slightly believable.</p>
                                <div class="instructor-social fix">
                                    <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                                    <a href="#"><i class="icofont icofont-social-pinterest"></i></a>
                                    <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                                    <a href="#"><i class="icofont icofont-social-google-plus"></i></a>
                                </div>
                            </div>
                            <div class="instructor-image col-md-5 col-sm-6 col-xs-12">
                                <img src="{{ asset("_new_web/img/instructor/big-3.jpg") }}" alt="" />
                            </div>
                        </div>
                        <div class="tab-pane fade row" id="instructor-4">
                            <div class="instructor-details text-left col-md-7 col-xs-12">
                                <h4 class="instructor-name">Thomas Smith</h4>
                                <h5 class="instructor-title">Instructor</h5>
                                <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look even slightly believable.There are many many variations of passages of Lorem Ipsum available,but the on majority have suffered   alteration in some form, by hum maksu rez words which is don't look even slightly believable.</p>
                                <div class="instructor-social fix">
                                    <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                                    <a href="#"><i class="icofont icofont-social-pinterest"></i></a>
                                    <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                                    <a href="#"><i class="icofont icofont-social-google-plus"></i></a>
                                </div>
                            </div>
                            <div class="instructor-image col-md-5 col-sm-6 col-xs-12">
                                <img src="{{ asset("_web/img/project-2-img.png") }}" alt="" />
                            </div>
                        </div>
                    </div>
                    <!-- Instructor Tab List -->
                    <ul class="instructor-tab-list fix hidden">
                        <li class="active"><a href="#instructor-1" data-toggle="tab"><img src="{{ asset("_new_web/img/instructor/1.jpg") }}" alt="" /></a></li>
                        <li><a href="#instructor-2" data-toggle="tab"><img src="{{ asset("_new_web/img/instructor/2.jpg") }}" alt="" /></a></li>
                        <li><a href="#instructor-3" data-toggle="tab"><img src="{{ asset("_new_web/img/instructor/3.jpg") }}" alt="" /></a></li>
                        <li><a href="#instructor-4" data-toggle="tab"><img src="{{ asset("_new_web/img/instructor/4.jpg") }}" alt="" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area
    ============================================ -->
    <div id="feature-area" class="feature-area bg-gray pt-90 pb-90">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">our programmes</h3>
                    <div class="excerpt">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <div class="row">
                <!-- Left Feature -->
                <div class="feature-wrapper feature-left text-right col-md-4 col-xs-12">
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-file-spreadsheet"></i></div>
                        <div class="text fix">
                            <h4>Quick License</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-car-alt-4"></i></div>
                        <div class="text fix">
                            <h4>Unlimited Car Support</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-video-alt"></i></div>
                        <div class="text fix">
                            <h4>Video Classes</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature Image -->
                <div class="feature-image text-center col-md-4 col-xs-12">
                    <img src="{{ asset("_new_web/img/feature.png") }}" alt="feature" />
                </div>
                <!-- Right Feature -->
                <div class="feature-wrapper feature-right text-left col-md-4 col-xs-12">
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-man-in-glasses"></i></div>
                        <div class="text fix">
                            <h4>Experience Instructors</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-clock-time"></i></div>
                        <div class="text fix">
                            <h4>Any Time Any Place</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                    <div class="single-feature">
                        <div class="icon"><i class="icofont icofont-direction-sign"></i></div>
                        <div class="text fix">
                            <h4>Learning Roads</h4>
                            <p>Lorem ipsum dolor sit amet to be consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Funfact Area
    ============================================ -->
    <div class="funfact-area overlay overlay-white overlay-80 pt-90 pb-60">
        <div class="container">
            <div class="row">
                <div class="single-facts text-center col-sm-3 col-xs-12 mb-30">
                    <i class="icofont icofont-hat-alt"></i>
                    <h1 class="counter plus">6500</h1>
                    <p>graduted from here</p>
                </div>
                <div class="single-facts text-center col-sm-3 col-xs-12 mb-30">
                    <i class="icofont icofont-user-suited"></i>
                    <h1 class="counter">56</h1>
                    <p>teachers number</p>
                </div>
                <div class="single-facts text-center col-sm-3 col-xs-12 mb-30">
                    <i class="icofont icofont-history"></i>
                    <h1 class="counter">11</h1>
                    <p>years on market</p>
                </div>
                <div class="single-facts text-center col-sm-3 col-xs-12 mb-30">
                    <i class="icofont icofont-users-social"></i>
                    <h1 class="counter plus">550</h1>
                    <p>present students</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Area
    ============================================ -->
    <div id="course-area" class="course-area bg-gray pt-90 pb-60">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">course category</h3>
                    <div class="excerpt">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <!-- Course Wrapper -->
            <div class="course-wrapper row">
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30 fix">
                    <div class="course-item text-center">
                        <i class="icofont icofont-car-alt-4"></i>
                        <h4>normal driving</h4>
                        <p>There are many variations of items passag LoIpsum available the majority ratomised </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30 fix">
                    <div class="course-item text-center">
                        <i class="icofont icofont-ambulance-cross"></i>
                        <h4>defensive</h4>
                        <p>There are many variations of items passag LoIpsum available the majority ratomised </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30 fix">
                    <div class="course-item text-center">
                        <i class="icofont icofont-fast-delivery"></i>
                        <h4>power booster</h4>
                        <p>There are many variations of items passag LoIpsum available the majority ratomised </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30 fix">
                    <div class="course-item text-center">
                        <i class="icofont icofont-rocket-alt-2"></i>
                        <h4>crash level</h4>
                        <p>There are many variations of items passag LoIpsum available the majority ratomised </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery Area
    ============================================ -->
    <div id="gallery-area" class="gallery-area bg-gray pt-90 pb-60">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">our gallery</h3>
                    <div class="excerpt hidden">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <!-- Gallery Grid -->
            <div class="gallery-grid row">
                <div class="gallery-item cars col-md-3 col-sm-4 col-xs-12">
                    <a href="{{ asset("images/The New Admin Block.JPG") }}" class="gallery-image image-popup">
                        <img src="{{ asset("images/The New Admin Block.JPG") }}" alt="" />
                        <div class="content">
                            <i class="icofont icofont-search"></i>
                            <h4>The New Admin Block</h4>
                        </div>
                    </a>
                </div>
                <div class="gallery-item cars exam col-md-3 col-sm-4 col-xs-12">
                    <a href="{{ asset("images/Inside View Of A Section Of The Library.JPG") }}" class="gallery-image image-popup">
                        <img src="{{ asset("images/Inside View Of A Section Of The Library.JPG") }}" alt="" />
                        <div class="content">
                            <i class="icofont icofont-search"></i>
                            <h4>Inside View Of A Section Of The Library</h4>
                        </div>
                    </a>
                </div>
                <div class="gallery-item classroom col-md-3 col-sm-4 col-xs-12">
                    <a href="{{ asset("images/Language Resource Centre (LRC).JPG") }}" class="gallery-image image-popup">
                        <img src="{{ asset("images/Language Resource Centre (LRC).JPG") }}" alt="" />
                        <div class="content">
                            <i class="icofont icofont-search"></i>
                            <h4>Language Resource Centre (LRC)</h4>
                        </div>
                    </a>
                </div>
                <div class="gallery-item col-md-3 col-sm-4 col-xs-12">
                    <a href="{{ asset("images/The Executive Students Hostel.JPG") }}" class="gallery-image image-popup">
                        <img src="{{ asset("images/The Executive Students Hostel.JPG") }}" alt="" />
                        <div class="content">
                            <i class="icofont icofont-search"></i>
                            <h4>The Executive Students Hostel</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Area
    ============================================ -->
    <div id="testimonial-area" class="testimonial-area overlay overlay-white overlay-80 text-center pt-90 pb-90 hidden">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-xs-12">
                    <!-- Testimonial Image Slider -->
                    <div class="ti-slider mb-40">
                        <div class="single-slide"><div class="image fix"><img src="{{ asset("_new_web/img/testimonial/1.jpg") }}" alt="" /></div></div>
                        <div class="single-slide"><div class="image fix"><img src="{{ asset("_new_web/img/testimonial/2.jpg") }}" alt="" /></div></div>
                        <div class="single-slide"><div class="image fix"><img src="{{ asset("_new_web/img/testimonial/3.jpg") }}" alt="" /></div></div>
                        <div class="single-slide"><div class="image fix"><img src="{{ asset("_new_web/img/testimonial/4.jpg") }}" alt="" /></div></div>
                    </div>
                    <!-- Testimonial Content Slider -->
                    <div class="tc-slider">
                        <div class="single-slide">
                            <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look believable.</p>
                            <h5>momen bhuiyan</h5>
                            <span>Graphic Designer</span>
                        </div>
                        <div class="single-slide">
                            <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look believable.</p>
                            <h5>Tasnim Akter</h5>
                            <span>Graphic Designer</span>
                        </div>
                        <div class="single-slide">
                            <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look believable.</p>
                            <h5>momen bhuiyan</h5>
                            <span>Graphic Designer</span>
                        </div>
                        <div class="single-slide">
                            <p>There are many many variations of passages of Lorem Ipsum available, but the majority have suffered   alteration in some form, by hum domised words which is don't look believable.</p>
                            <h5>Tasnim Akter</h5>
                            <span>Graphic Designer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Arrows -->
        <button class="ts-arrows ts-prev"><i class="icofont icofont-caret-left"></i></button>
        <button class="ts-arrows ts-next"><i class="icofont icofont-caret-right"></i></button>
    </div>
    <!-- Pricing Area
    ============================================ -->
    <div id="pricing-area" class="pricing-area overlay overlay-black overlay-40 pt-90 pb-60">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title title-white text-center col-xs-12 mb-45">
                    <h3 class="heading">your pricing plan</h3>
                    <div class="excerpt">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30">
                    <div class="single-pricing text-center">
                        <div class="pricing-head">
                            <h4>basic</h4>
                        </div>
                        <div class="pricing-price">
                            <h2><span>$</span>200</h2>
                        </div>
                        <ul class="pricing-details">
                            <li>2 Month Course</li>
                            <li>3 Hours Per Day</li>
                            <li>Weekly 1 Test</li>
                            <li>20 Video Classes</li>
                            <li>Driving Licence</li>
                        </ul>
                        <a href="#" class="pricing-action">choose plan</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30">
                    <div class="single-pricing text-center">
                        <div class="pricing-head">
                            <h4>upgrade</h4>
                        </div>
                        <div class="pricing-price">
                            <h2><span>$</span>300</h2>
                        </div>
                        <ul class="pricing-details">
                            <li>3 Month Course</li>
                            <li>4 Hours Per Day</li>
                            <li>Weekly 2 Test</li>
                            <li>25 Video Classes</li>
                            <li>Driving Licence</li>
                        </ul>
                        <a href="#" class="pricing-action">choose plan</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30">
                    <div class="single-pricing active text-center">
                        <div class="pricing-head">
                            <h4>smart</h4>
                        </div>
                        <div class="pricing-price">
                            <h2><span>$</span>400</h2>
                        </div>
                        <ul class="pricing-details">
                            <li>4 Month Course</li>
                            <li>5 Hours Per Day</li>
                            <li>Weekly 2 Test</li>
                            <li>30 Video Classes</li>
                            <li>Driving Licence</li>
                        </ul>
                        <a href="#" class="pricing-action">choose plan</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 mb-30">
                    <div class="single-pricing text-center">
                        <div class="pricing-head">
                            <h4>over smart</h4>
                        </div>
                        <div class="pricing-price">
                            <h2><span>$</span>500</h2>
                        </div>
                        <ul class="pricing-details">
                            <li>6 Month Course</li>
                            <li>5 Hours Per Day</li>
                            <li>Weekly 3 Test</li>
                            <li>35 Video Classes</li>
                            <li>Driving Licence</li>
                        </ul>
                        <a href="#" class="pricing-action">choose plan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Area
    ============================================ -->
    <div id="faq-area" class="faq-area bg-white pt-90 pb-60">
        <div class="container">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">Frequently asked questions</h3>
                    <div class="excerpt">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel-group" id="faq">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#faq-1">There are many variations of passages of Lorem Ipsum?</a></h4>
                            </div>
                            <div id="faq-1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <p>It is a long established fact that a reader will be distracted by the readaible is an content of  the page when looking at its layout. The point of using Lorem Ipsum is that it has a more less normal.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#faq-2">There are many variations of passages of Lorem Ipsum?</a></h4>
                            </div>
                            <div id="faq-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>It is a long established fact that a reader will be distracted by the readaible is an content of  the page when looking at its layout. The point of using Lorem Ipsum is that it has a more less normal.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#faq-3">There are many variations of passages of Lorem Ipsum?</a></h4>
                            </div>
                            <div id="faq-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>It is a long established fact that a reader will be distracted by the readaible is an content of  the page when looking at its layout. The point of using Lorem Ipsum is that it has a more less normal.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#faq-4">There are many variations of passages of Lorem Ipsum?</a></h4>
                            </div>
                            <div id="faq-4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>It is a long established fact that a reader will be distracted by the readaible is an content of  the page when looking at its layout. The point of using Lorem Ipsum is that it has a more less normal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="faq-image col-md-6">
                    <img src="{{ asset("_new_web/img/faq.png") }}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Contatc Area
    ============================================ -->
    <div id="contact-area" class="contact-area bg-gray">
        <div class="container pb-90 pt-90">
            <!-- Section Title -->
            <div class="row">
                <div class="section-title text-center col-xs-12 mb-45">
                    <h3 class="heading">touch in driveon</h3>
                    <div class="excerpt">
                        <p>Lorem ipsum dolor sit amet, consectetur maksu rez do eiusmod tempor magna aliqua</p>
                    </div>
                    <i class="icofont icofont-traffic-light"></i>
                </div>
            </div>
            <div class="row">
                <!-- Contact Info -->
                <div class="contact-info col-md-4 col-sm-5 col-xs-12">
                    <div class="single-info text-left fix">
                        <div class="icon"><i class="icofont icofont-phone"></i></div>
                        <div class="content fix">
                            <h5>call us</h5>
                            <p>+ 1 432 789 5647 <br />+ 1 432 789 5673</p>
                        </div>
                    </div>
                    <div class="single-info text-left fix">
                        <div class="icon"><i class="icofont icofont-envelope"></i></div>
                        <div class="content fix">
                            <h5>your message</h5>
                            <p><a href="#">info@example.com</a><a href="#">info@example.com</a></p>
                        </div>
                    </div>
                    <div class="single-info text-left fix">
                        <div class="icon"><i class="icofont icofont-location-pin"></i></div>
                        <div class="content fix">
                            <h5>our location</h5>
                            <p>3756 Melrose place, <br />CA 87031, Australia</p>
                        </div>
                    </div>
                </div>
                <!-- Contact Form -->
                <div class="contact-form form text-left col-md-8 col-sm-7 col-xs-12">
                    <form id="contact-form" action="https://d29u17ylf1ylz9.cloudfront.net/driveon-preview/driveon-light/mail.php" method="post">
                        <div class="input-2">
                            <div class="input"><input type="text" name="name" placeholder="Name" /></div>
                            <div class="input"><input type="email" name="email" placeholder="E-mail" /></div>
                        </div>
                        <div class="input"><input type="text" name="subject" placeholder="Subject" /></div>
                        <div class="input textarea"><textarea name="message" placeholder="Message"></textarea></div>
                        <div class="input input-submit"><input type="submit" value="send message" /></div>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA Area
    ============================================ -->
    <div class="cta-area pb-40 pt-40">
        <div class="container">
            <div class="row">
                <div class="call-to-action text-left col-md-10 col-md-offset-1 col-xs-12">
                    <h3>try to get our amazing free lesson</h3>
                    <a href="#" class="btn transparent ">get  lesson</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area
    ============================================ -->
    <div class="footer-area overlay overlay-black overlay-70 pt-90">
        <div class="container">
            <div class="row">
                <div class="footer-widget text-left col-md-3 col-sm-6 col-xs-12">
                    <h4 class="widget-title">about drive on</h4>
                    <div class="about-widget">
                        <p>It is a long established fact that is a reader will be distracted by the readable content of page when looking at its layout. it’s the more fact that is reader will be by the readable looking its layout.</p>
                        <div class="widget-social fix">
                            <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                            <a href="#"><i class="icofont icofont-social-pinterest"></i></a>
                            <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                            <a href="#"><i class="icofont icofont-social-rss"></i></a>
                        </div>
                    </div>
                </div>
                <div class="footer-widget text-left col-md-3 col-sm-6 col-xs-12">
                    <h4 class="widget-title">quick contact</h4>
                    <div class="contact-widget">
                        <h5>address:</h5>
                        <p>Flor. 4,  House. 15,  Block-C. <br />Banasree Main Road,  Dhaka.</p>
                        <h5>phone:</h5>
                        <p>+012 345 678 102 <br />+012 105 668 182 </p>
                        <h5>e-mail</h5>
                        <p>
                            <a href="#">info@example.com</a>
                            <a href="#">www.example.com</a>
                        </p>
                    </div>
                </div>
                <div class="footer-widget text-left col-md-3 col-sm-6 col-xs-12">
                    <h4 class="widget-title">blog post</h4>
                    <div class="blog-widget">
                        <div class="widget-blog fix">
                            <a href="#" class="image float-left"><img src="img/blog-widget/1.jpg" alt="" /></a>
                            <div class="content fix">
                                <a href="#">new project</a>
                                <p>It is a long established fact that is a reader will be...</p>
                            </div>
                        </div>
                        <div class="widget-blog fix">
                            <a href="#" class="image float-left"><img src="img/blog-widget/2.jpg" alt="" /></a>
                            <div class="content fix">
                                <a href="#">google maps</a>
                                <p>It is a long established fact that is a reader will be...</p>
                            </div>
                        </div>
                        <div class="widget-blog fix">
                            <a href="#" class="image float-left"><img src="img/blog-widget/3.jpg" alt="" /></a>
                            <div class="content fix">
                                <a href="#">learn first</a>
                                <p>It is a long established fact that is a reader will be...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-widget text-left col-md-3 col-sm-6 col-xs-12">
                    <h4 class="widget-title">instagram gallary</h4>
                    <div class="instagram-widget">
                        <div class="instagram-item"><a href="#"><img src="img/instagram/1.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/2.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/3.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/4.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/5.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/6.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/7.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/8.jpg" alt="" /></a></div>
                        <div class="instagram-item"><a href="#"><img src="img/instagram/9.jpg" alt="" /></a></div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center col-xs-12">
                <p class="copyright">Copyright &copy; <a href="#">Driveon</a> ALL Right Reserved</p>
            </div>
        </div>
    </div>

</div>
<!-- Body main wrapper end -->

<!-- JS -->

<!-- jQuery JS
============================================ -->
<script src="{{ asset("_new_web/js/vendor/jquery-1.12.0.min.js") }}"></script>
<!-- Bootstrap JS
============================================ -->
<script src="{{ asset("_new_web/js/bootstrap.min.js") }}"></script>
<!-- Plugins JS
============================================ -->
<script src="{{ asset("_new_web/js/plugins.js") }}"></script>
<!-- Ajax Mail JS
============================================ -->
<script src="{{ asset("_new_web/js/ajax-mail.js") }}"></script>
<!-- WOW JS
============================================ -->
<script src="{{ asset("_new_web/js/wow.min.js") }}"></script>
<!-- Google Map APi
============================================ -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdWLY_Y6FL7QGW5vcO3zajUEsrKfQPNzI"></script>
<script src="{{ asset("_new_web/js/map.js") }}"></script>
<!-- Style Customizer JS
============================================ -->
{{--<script src="{{ asset("_new_web/js/style-customizer.js") }}"></script>--}}
<!-- Main JS
============================================ -->
<script src="{{ asset("_new_web/js/main.js") }}"></script>

</body>
</html>
