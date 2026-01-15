<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Welcome to {{ config("app.name") }}</title>

    <!-- Bootstrap 4.1.3 -->
    <link rel="stylesheet" href="{{ asset("_web/css/bootstrap.min.css") }}">
    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset("_web/css/plugins/animate.css") }}">
    <!-- Google Font -->
    <link href="{{ asset("_web/fonts.googleapis.com/csse8f1.css?family=Nunito:200,300,400,600,700,800,900") }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset("_web/font-awesome/4.7.0/css/font-awesome.min.css") }}" rel="stylesheet">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset("_web/css/plugins/slick.css") }}">
    <link rel="stylesheet" href="{{ asset("_web/css/plugins/slick-theme.css") }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset("_web/css/plugins/magnific-popup.css") }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset("_web/css/main.css") }}">
</head>
<body>
<!-- Page Loading -->
<div class="se-pre-con"></div>
<!-- ======== Start Navbar ======== -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route("home") }}"><img src="{{ asset("images/Nigeria-French-Language-Village-NFLV.jpg") }}" alt="logo" height="100px"></a>
        <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("home") }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#programmes">Our Programmes</a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link" href="#price">Contact</a>
                </li>

            </ul>
            <a href="{{ route("register") }}" class="btn-1">Apply!</a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route("login") }}" class="bdtn-1 nav-link">Portal Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- ======== End Navbar ======== -->

<!-- ======== Start Slider ======== -->
<section class="slider align-items-center" id="slider">
    <div>
        <div class="container">
            <div class="content">
                <div class="row d-flex align-items-center">
                    <div class="col text-center">
                        <div class="left">
                            <h1 class="mb-5">Welcome to the <br> <b>{{ ucfirst(config("app.name")) }}</b></h1>
                            <a href="{{ route("login") }}" class="btn-1"><i class="fa fa-dashboard d-none"></i> Portal Login</a>
                            <a href="{{ route("register") }}" class="btn-2"><i class="fa fa-user d-none"></i> Apply now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Slider ======== -->

<!-- ======== Start Features ======== -->
<section class="features" id="features">
    <div class="container text-center">
        <div class="heading">
            <h2>About Us</h2>
        </div>
        <div class="line"></div>
        <div class="row text-left">
            <!-- Box-1 -->
            <div class="col-md-6">
                <div class="box text-center" style="min-height: 444px;margin-bottom: 20px">
                    <div class="">
                        <img src="{{ asset("_web/img/feature-2.png") }}" alt="feature-1" class="">
                    </div>
                    <h3 class="text-center">Vision</h3>
                    <p>
                        To empower all persons, irrespective of age, culture, creed or sex, with appropriate communication skills in the effective use of French Language at both professional and inter-personal levels.
                    </p>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-md-6">
                <div class="box text-center" style="min-height: 444px;margin-bottom: 20px">
                    <div class="">
                        <img src="{{ asset("_web/img/feature-1.png") }}" alt="feature-1" class="">
                    </div>
                    <h3 class="text-center">Mission</h3>
                    <p>
                        To develop an outstanding center of excellence for the study, research and development of French in Nigeria using skilled and innovative personnel and applying appropriate modern technology and teaching methodology to foster a culture of transnational bilingualism for nation building, regional integration as well as international cooperation and understanding.
                    </p>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-md-8 offset-md-2">
                <div class="box text-center" style="min-height: 444px;margin-bottom: 20px">
                    <div class="">
                        <img src="{{ asset("_web/img/feature-3.png") }}" alt="feature-1" class="">
                    </div>
                    <h3 class="text-center">Mandates</h3>
                    <p>
                        - Provide a domestic alternative to the mandatory year- abroad language immersion programmes for undergraduates of French studies from Nigerian Universities and Colleges of Education.
                        <br>
                        Service tertiary institutions in Nigeria with adequate human, material and infrastructural backing for the effective teaching, learning as well as conduct of research in French
                        <br>
                        Explore areas of practical application of the French Language to the Nigerian situation.
                        <br>
                        Promote economic, technical and social integration of the African Continent.
                        <br>
                        Provide information and serve as think-tank to government and other relevant corporate entities on the exploration and exploitation of the French Language in policy formulation and decision-making. 
                        <br>
                        -	Coordinate activities relating to the teaching and learning of 	French in Nigeria.
                        <br>
                        - 	Collaborate with relevant agencies in the setting and conduct 	of examinations, preparation of curricula as well as vital 	documentation on the French Language in Nigeria.
                        <br>
                        - 	Retrain teachers of French for the implementation of the policy-directive on French in Nigerian secondary schools. 
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- ======== End Features ======== -->

<!-- ======== Start Some Facts ======== -->
<section class="some-facts d-none">
    <div class="container text-center">
        <div class="row">
            <!-- Box-1 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="{{ asset("_web/img/some-fact/1.png") }}" alt="some-fact-1">
                    <h3>
                        <span class="counter">1,200</span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Clients</h4>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="{{ asset("_web/img/some-fact/2.png") }}" alt="some-fact-1">
                    <h3>$
                        <span class="counter">3,15</span>M</h3>
                    <div class="line mx-auto"></div>
                    <h4>Invested</h4>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="{{ asset("_web/img/some-fact/3.png") }}" alt="some-fact-1">
                    <h3>
                        <span class="counter">14</span>%</h3>
                    <div class="line mx-auto"></div>
                    <h4>Growth p.a</h4>
                </div>
            </div>
            <!-- Box-4 -->
            <div class="col-lg-3 col-sm-6">
                <div class="items">
                    <img src="{{ asset("_web/img/some-fact/4.png") }}" alt="some-fact-1">
                    <h3>
                        <span class="counter">2,500</span>+</h3>
                    <div class="line mx-auto"></div>
                    <h4>Hours of Work</h4>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- ======== End Some Facts ======== -->

<section class="project-2 d-none">
    <div class="container">
        <div class="row d-flex align-items-center">
            <!-- Left -->
            <div class="col-md-5">
                <div class="left">
                    <span class="text-uppercase" style="font-size: 23px">Welcome address of the director</span>
                    <h2 class="d-none">
                        Welcome address of the director
                    </h2>
                    <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                        and filter to focus in on anything form a single project to an individual
                        person's workload Discover where each customer came from, how they interact with
                        your and gain deeper insights into what drives them to purchase
                        <br><br>
                        Plan ahead by day, week, or month, and see project status at a glance. Search
                        and filter to focus in on anything form a single project to an Plan ahead by
                        day, week, or month .</p>
                    <a href="{{ route("register") }}" class="btn-1">Click here to apply</a>
                </div>
            </div>
            <!-- Right -->
            <div class="col-md-7">
                <img src="{{ asset("_web/img/project-2-img.png") }}" alt="project" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- ======== Start Project ======== -->
<section class="project">
    <div class="container">
        <div class="row d-flex align-items-center">
            <!-- Left -->
            <div class="col-md-6 text-center">
                <img src="{{ asset("images/director.JPG") }}" alt="project" class="img-fluid">
            </div>
            <!-- Right -->
            <div class="col-md-5">
                <div class="right">
                    <span class="text-uppercase" style="font-size: 23px">Welcome address of the director</span>
                    <h2 class="d-none">
                        Welcome address of the director
                    </h2>
                    <p>
                        You are all welcome to Nigerian French language village eportal website where students and everyone can watch the development, academic structure of our great citadel of learning. We hope to make a big change to the world through language. Enjoy the view, good day.
                    </p>
                    <a href="{{ route("register") }}" class="btn-1">Click here to apply</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Project ======== -->

<section class="portfolio" id="portfolio">
    <div class="container-fluid">
        <div class="row">
            <!-- Box-4 -->
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="box p-0">
                    <div class="single-portfolio-item ">
                        <img src="{{ asset("images/The New Admin Block.JPG") }}" alt="" class="img-fluid">
                        <div class="overlay text-center">
                            <div class="content">
                                <h3>The New Admin Block</h3>
                                <p>{{ config("app.name") }}</p>
                                <a href="{{ asset("images/The New Admin Block.JPG") }}" class="image-link">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box-1 -->
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="box m-0">
                    <div class="single-portfolio-item ">
                        <img src="{{ asset("images/Inside View Of A Section Of The Library.JPG") }}" alt="" class="img-fluid">
                        <div class="overlay text-center">
                            <div class="content">
                                <h3>Inside View Of A Section Of The Library</h3>
                                <p>{{ config("app.name") }}</p>
                                <a href="{{ asset("images/Inside View Of A Section Of The Library.JPG") }}" class="image-link">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="box m-0">
                    <div class="single-portfolio-item ">
                        <img src="{{ asset("images/Language Resource Centre (LRC).JPG") }}" alt="" class="img-fluid">
                        <div class="overlay text-center">
                            <div class="content">
                                <h3>Language Resource Centre (LRC)</h3>
                                <p>{{ config("app.name") }}</p>
                                <a href="{{ asset("images/Language Resource Centre (LRC).JPG") }}" class="image-link">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-lg-3 col-sm-6 p-0">
                <div class="box m-0">
                    <div class="single-portfolio-item ">
                        <img src="{{ asset("images/The Executive Students Hostel.JPG") }}" alt="" class="img-fluid">
                        <div class="overlay text-center">
                            <div class="content">
                                <h3>The Executive Students Hostel.JPG</h3>
                                <p>{{ config("app.name") }}</p>
                                <a href="{{ asset("images/The Executive Students Hostel.JPG") }}" class="image-link">
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-price" id="programmes" style="">
    <div class="container text-center">
        <div class="heading text-center">
            <h2>What we offer</h2>
        </div>
        <div class="line text-center"></div>

        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <h3>Our Departments</h3>
                    <ul>
                        <li>Linguistics</li>
                        <li>Literature, Culture & Civilization</li>
                        <li>Language & Communication</li>
                        <li>Translation & Interpretation</li>
                        <li>French for Specific Purposes</li>
                        <li>French Teachers’ Continuing Education</li>
                        <li>NCE & DELF/DALF</li>
                    </ul>
                    <a href="#0" class="btn-2 d-none">Get Started</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <h3>Our Programmes</h3>
                    <ul>
                        <li>Language Immersion Programme (LIP)</li>
                        <li>University Undergraduates</li>
                        <li>College Of Education students</li>
                    </ul>
                    <a href="#0" class="btn-2 d-none">Get Started</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <h3 class="d-none">Our Programmes</h3>
                    <h4 class="">Pre-University Programme</h4>
                    <ul>
                        <li>Diploma in French</li>
                        <li>Certificate in French</li>
                    </ul>
                    <h4 class="">Postgraduate Programmes</h4>
                    <ul>
                        <li>PGD in Bilingual Secretaryship</li>
                        <li>PGD Translation & Interpretation</li>
                    </ul>
                    <h4 class="">Intensive French Programmes for</h4>
                    <ul>
                        <li>Individuals</li>
                        <li>Professionals</li>
                        <li>Corporate Bodies </li>
                    </ul>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-md-4 d-none">
                <div class="box box-center">
                    <a href="#0" class="top-btn">Popular</a>
                    <h3>Standard</h3>
                    <h4>$<span class="blue">45</span>/ year</h4>
                    <ul>
                        <li>Admin Panel</li>
                        <li>300GB Storge</li>
                        <li>Unlimited Email</li>
                    </ul>
                    <a href="#0" class="btn-1">Get Started</a>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-md-4 d-none">
                <div class="box">
                    <h3>Ultimate</h3>
                    <h4>$<span>85</span>/ year</h4>
                    <ul>
                        <li>Admin Panel</li>
                        <li>500GB Storge</li>
                        <li>Unlimited Email</li>
                    </ul>
                    <a href="#0" class="btn-2">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======== Start Benefits ======== -->
<section class="benefits d-none" id="benefits">
    <div class="container text-center">
        <div class="heading">
            <h2>List of Programmes</h2>
        </div>
        <div class="line"></div>
        <div class="row">
            <!-- Box-1 -->
            <div class="col-md-4 col-sm-6">
                <div class="box mb-30">
                    <img src="{{ asset("_web/img/benefits/1.png") }}" alt="benefits" class="d-nones">
                    <h3>University Undergraduates</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni tur.</p>

                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-md-4 col-sm-6">
                <div class="box mb-30">
                    <img src="{{ asset("_web/img/benefits/2.png") }}" alt="benefits" class="d-nones">
                    <h3>College Of Education students</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni ture.</p>

                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-md-4 col-sm-6">
                <div class="box mb-30">
                    <img src="{{ asset("_web/img/benefits/3.png") }}" alt="benefits" class="d-nones">
                    <h3>Diploma in French</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni ture.</p>

                </div>
            </div>
            <!-- Box-4 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="{{ asset("_web/img/benefits/4.png") }}" alt="benefits" class="d-nones">
                    <h3>Certificate in French</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni ture.</p>

                </div>
            </div>
            <!-- Box-5 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="{{ asset("_web/img/benefits/5.png") }}" alt="benefits" class="d-nones">
                    <h3>PGD in Bilingual Secretaryship</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni ture.</p>

                </div>
            </div>
            <!-- Box-6 -->
            <div class="col-md-4 col-sm-6">
                <div class="box">
                    <img src="{{ asset("_web/img/benefits/6.png") }}" alt="benefits" class="d-nones">
                    <h3>PGD Translation & Interpretation</h3>
                    <p class="d-none">The aim of being a good designer is to an influence. If you design furni ture.</p>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Benifits ======== -->

<!-- ======== Start Get Started ======== -->
<section class="get-started">
    <div class="container text-center">
        <span class="">get started</span>
        <br>
        <a href="{{ route("register") }}" class="btn-1 text-uppercase">Start your application now!</a>

    </div>
</section>
<!-- ======== End Get Started ======== -->

<!-- ======== Start Testimonial ======== -->
<section class="testimonials d-none">
    <div class="container text-center">
        <div class="heading">
            <h2>Testimonials</h2>
        </div>
        <div class="line"></div>
        <div class="slick-slider">
            <!-- Box-1 -->
            <div class="box">
                <img src="{{ asset("_web/img/testimonials/1.png") }}" alt="" class="m-auto">
                <h3>Alamin Musa</h3>
                <span>Graphic Designer</span>
                <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                    and filter to focus in on anything form a single what drives them to purchase.a.</p>
            </div>
            <!-- Box-1 -->
            <div class="box">
                <img src="{{ asset("_web/img/testimonials/2.png") }}" alt="" class="m-auto">
                <h3>Mohamed Moaz</h3>
                <span>Logo Designer</span>
                <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                    and filter to focus in on anything form a single what drives them to purchase.a.</p>
            </div>
            <!-- Box-1 -->
            <div class="box">
                <img src="{{ asset("_web/img/testimonials/3.png") }}" alt="" class="m-auto">
                <h3>Musa Ahmed</h3>
                <span>Web Designer</span>
                <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                    and filter to focus in on anything form a single what drives them to purchase.a.</p>
            </div>
            <!-- Box-1 -->
            <div class="box">
                <img src="{{ asset("_web/img/testimonials/1.png") }}" alt="" class="m-auto">
                <h3>Gassim Ahmed</h3>
                <span>Back End Developer</span>
                <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                    and filter to focus in on anything form a single what drives them to purchase.a.</p>
            </div>
            <!-- Box-1 -->
            <div class="box">
                <img src="{{ asset("_web/img/testimonials/2.png") }}" alt="" class="m-auto">
                <h3>Adil Elsaeed</h3>
                <span>Wordpress Developer</span>
                <p>Plan ahead by day, week, or month, and see project status at a glance. Search
                    and filter to focus in on anything form a single what drives them to purchase.a.</p>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Testimonial ======== -->

<!-- ======== Start Our Price ======== -->
<section class="our-price d-none" id="price">
    <div class="container text-center">
        <div class="heading">
            <h2>Our Price</h2>
        </div>
        <div class="line"></div>
        <div class="row">
            <!-- Box-1 -->
            <div class="col-md-4">
                <div class="box">
                    <h3>Basic</h3>
                    <h4>$<span>25</span>/ year</h4>
                    <ul>
                        <li>Admin Panel</li>
                        <li>100GB Storge</li>
                        <li>Unlimited Email</li>
                    </ul>
                    <a href="#0" class="btn-2">Get Started</a>
                </div>
            </div>
            <!-- Box-2 -->
            <div class="col-md-4">
                <div class="box box-center">
                    <a href="#0" class="top-btn">Popular</a>
                    <h3>Standard</h3>
                    <h4>$<span class="blue">45</span>/ year</h4>
                    <ul>
                        <li>Admin Panel</li>
                        <li>300GB Storge</li>
                        <li>Unlimited Email</li>
                    </ul>
                    <a href="#0" class="btn-1">Get Started</a>
                </div>
            </div>
            <!-- Box-3 -->
            <div class="col-md-4">
                <div class="box">
                    <h3>Ultimate</h3>
                    <h4>$<span>85</span>/ year</h4>
                    <ul>
                        <li>Admin Panel</li>
                        <li>500GB Storge</li>
                        <li>Unlimited Email</li>
                    </ul>
                    <a href="#0" class="btn-2">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Our Price ======== -->

<!-- ======== Start Clients ======== -->
<section class="clients d-none">
    <div class="container">
        <div class="slick-slider-clients">
            <div class="item"><img src="{{ asset("_web/img/clients/1.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/2.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/3.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/4.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/5.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/1.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/2.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/3.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/4.png") }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ asset("_web/img/clients/5.png") }}" alt="" class="img-fluid"></div>
        </div>
    </div>
</section>
<!-- ======== End Clients ======== -->

<!-- ======== Start Contact Us ======== -->
<section class="contact" id="contact">
    <div class="container">
        <div class="heading text-center">
            <h2>Keep In Touch</h2>
            <div class="line"></div>
        </div>

        <div class="row">
            <div class="col-md-4 text-center offset-md-2">
                <div class="title">
                    {{--<h3>Contact Us :</h3>--}}
                    <p class="d-none">
                        For more information or request, kindly contact us:
                    </p>
                </div>
                <div class="content">
                    <!-- Info-3 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">ADDRESS :<br>
                            <span>
                                Department of French for Special Purposes
                                <br>
                                The Nigeria French Language Village
                                <br>
                                P.M.B.1011, Ajara-Badagry
                                <br>
                                Lagos State, Nigeria
                            </span>
                        </h4>
                    </div>
                    <!-- Info-1 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">PHONE :
                            <br>
                            <span>(234) 08034713954</span></h4>
                    </div>
                    <!-- Info-2 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">EMAIL :
                            <br>
                            <span><a href="mailto:nflvconsult@yahoo.com">nflvconsult@yahoo.com</a></span></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="title">
                    {{--<h3>Contact Us :</h3>--}}
                    <p class="d-none">
                        For more information or request, kindly contact us:
                    </p>
                </div>
                <div class="content">
                    <!-- Info-3 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-street-view" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">ADDRESS :<br>
                            <span>
                                Head, Liaison Office
                                <br>
                                Nigeria French Language Village
                                <br>
                                Plot A3311,ACO Estate,Sbon Lugbe District
                                <br>
                                Airport Road,Abuja.
                                <br>
                            </span>
                        </h4>
                    </div>
                    <!-- Info-1 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">PHONE :
                            <br>
                            <span>08037698180, 08026958084, 08090590196</span></h4>
                    </div>
                    <!-- Info-2 -->
                    <div class="info d-flexs text-center">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <br>
                        <h4 class="d-inline-block">EMAIL :
                            <br>
                            <span><a href="mailto:nflvabuja@yahoo.com">nflvabuja@yahoo.com</a></span></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-7 d-none">

                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" id="comment" placeholder="Message"></textarea>
                    </div>
                    <button class="btn btn-block" type="submit">Send Now!</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- ======== End Contact Us ======== -->

<!-- ======== Start Footer ======== -->
<footer class="footer">
    <div class="container text-center">
        <img src="{{ asset("images/Nigeria-French-Language-Village-NFLV.jpg") }}" alt="" height="60px">
        <p>© {{ date("Y") }} {{ config("app.name") }}. All rights reserved.</p>
    </div>
</footer>
<!-- ======== End Footer ======== -->

<!-- ======== Java Script ======== -->
<script src="{{ asset("_web/js/plugins/jquery-3.3.1.min.js") }}"></script>
<!-- Bootstrap 4.1.3 -->
<script src="{{ asset("_web/js/plugins/popper.min.js") }}"></script>
<script src="{{ asset("_web/js/bootstrap.min.js") }}"></script>
<!-- Slick Slider -->
<script src="{{ asset("_web/js/plugins/slick.min.js") }}"></script>
<!-- Couner Up-->
<script src="{{ asset("_web/js/plugins/jquery.waypoints.min.js") }}"></script>
<script src="{{ asset("_web/js/plugins/jquery.counterup.min.js") }}"></script>
<!-- Wow JS -->
<script src="{{ asset("_web/js/plugins/wow.min.js") }}"></script>
<!-- Magnific Popup-->
<script src="{{ asset("_web/js/plugins/magnific-popup.min.js") }}"></script>
<!-- Main Js-->
<script src="{{ asset("_web/js/main.js") }}"></script>
</body>

</html>