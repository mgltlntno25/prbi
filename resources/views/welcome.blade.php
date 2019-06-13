<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" type="image/x-icon" href="{{asset("/img/islaw.png")}}" />
	<title>Pinoy Road Bikers Inc.</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="{{asset("homepage/css/bootstrap.min.css")}}">
	<link rel="stylesheet" href="{{asset("homepage/css/animate.css")}}">
	<link rel="stylesheet" href="{{asset("homepage/css/font-awesome.min.css")}}">
	<link rel="stylesheet" href="{{asset("homepage/css/owl.theme.css")}}">
	<link rel="stylesheet" href="{{asset("homepage/css/owl.carousel.css")}}">

	<!-- Main css -->

	<link rel="stylesheet" href="{{asset("homepage/css/style.css")}}">
	<!-- Google Font -->
	<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'>

</head>


<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

	<!-- =========================
     PRE LOADER       
============================== -->
	<div class="preloader">
		<div class="sk-rotating-plane"></div>
	</div>


	<!-- =========================
     NAVIGATION LINKS     
============================== -->
	<div class="navbar navbar-fixed-top custom-navbar" role="navigation">
		<div class="container">

			<!-- navbar header -->
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">
					<font color="#e74c3c">P</font>inoy <font color="#f1c40f">R</font>oad <font color="#2980b9">B</font>ikers Inc.
				</a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<!-- <li>
						<a href="#intro" class="smoothScroll">Intro</a>
					</li>
					<li>
						<a href="#overview" class="smoothScroll">Overview</a>
					</li>
					<li>
						<a href="#speakers" class="smoothScroll">Speakers</a>
					</li>
					<li>
						<a href="#program" class="smoothScroll">Programs</a>
					</li> -->
					<li>
						<a href='{{url("/registration")}}' class="smoothScroll">Register</a>
					</li>
					<li>
						<a href='{{url("user/login")}}' class="smoothScroll">Login</a>
					</li>
					<!-- <li>
						<a href="#sponsors" class="smoothScroll">Sponsors</a>
					</li>
					<li>
						<a href="#contact" class="smoothScroll">Contact</a>
					</li> -->
				</ul>

			</div>

		</div>
	</div>


	<!-- =========================
    INTRO SECTION   
============================== -->
	<section id="intro" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<h3 class="wow bounceIn" data-wow-delay="0.9s">Welcome Islaw!</h3>
					<h1 class="wow fadeInUp" data-wow-delay="1.6s">Be a part of our family</h1>
					<a href='{{url("/registration")}}' class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s">REGISTER NOW</a>
				</div>


			</div>
		</div>
	</section>


	<!-- =========================
    OVERVIEW SECTION   
============================== -->
	<section id="overview" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
					<h3>Pinoy Road Bikers Inc.</h3>
					S.E.C Reg.No CN201810967<br><br>
					<p>Is a non-stock, non-porfit legal entity.
						First action as corporation - to enter in a contract
						an insurance company to provide the group with insurance
						policy at a reasonable cost.
						As a corporation, we can now open a bank account for donations, tie up with business establishment to secure
						discount and sue on behalf of members.
					</p>
					<br> MABUHAY PRBI! #goodvibes
				</div>

				<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
							<div class="item active">
								<img src="{{asset("homepage/images/prbi1.jpg")}}" alt="Los Angeles" style="width:100%;">
							</div>

							<div class="item">
								<img src="{{asset("homepage/images/prbi2.jpg")}}" alt="Chicago" style="width:100%;">
							</div>

							<div class="item">
								<img src="{{asset("homepage/images/prbi3.jpg")}}" alt="New york" style="width:100%;">
							</div>
							<div class="item">
								<img src="{{asset("homepage/images/prbi4.jpg")}}" alt="New york" style="width:100%;">
							</div>
						</div>

						<!-- Left and right controls -->
					</div>
				</div>
			</div>

		</div>
		</div>
	</section>


	<!-- =========================
    DETAIL SECTION   
============================== -->
	<section id="detail" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInLeft col-md-4 col-sm-4" data-wow-delay="0.3s">
					<i class="fa fa-group"></i>
					<h3>{{$users_count}} Active Members</h3>
					<p>Come and be a part of a wonderful community</p>
				</div>

				<div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
					<i class="fa fa-calendar"></i>
					<h3>{{$events_count}} Events</h3>
					<p>Join our fun and challenging events! Test your ability and compete with other cyclist</p>
				</div>

				<div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
					<i class="fa fa-shopping-cart"></i>
					<h3>{{$afs_count}} Affiliated Stores</h3>
					<p>You can avail 10% discounts on all regular prices. Just visit out affiliated stores and present your PRBi-card</p>
				</div>

			</div>
		</div>
	</section>


	<!-- =========================
    VIDEO SECTION   
============================== -->
	<section id="video" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.3s">
					<h2>UPGRADE TO PREMIUM</h2>
					<h3>Enjoy 10% discounts on all of our affiliated stores.</h3>
					<p>Also avail our insurance and get: </p>
					<p>
						<ul>
							<li>
								60,000 pesos for accidental death dismemberment</li>
							<li>12,500 reimbursements for hospitalization expenses</li>
							<li>5,000 pesos for burial assistance.</li>

						</ul>
					</p>
				</div>
				<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.6s">
					<div class="embed-responsive embed-responsive-16by9">
						<img src="{{asset("homepage/images/membership2.png")}}" height="260" width="450">
					</div>
				</div>

			</div>
		</div>
	</section>


	<!-- =========================
    SPEAKERS SECTION   
============================== -->
	<section id="speakers" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12 wow bounceIn">
					<div class="section-title">
						<h2>Meet our Admins</h2>
						<p>The foundation of the Pinoy Road Bikers Inc.</p>
					</div>
				</div>

				<!-- Testimonial Owl Carousel section
			================================================== -->
				<div id="owl-speakers" class="owl-carousel">

					@foreach($admins as $admin)
					<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
						<div class="speakers-wrapper">
							<img src="{{ url("/img/admindp/". $admin->profile_image)  }}" class="img-responsive" alt="speakers" height="80" width="80">
							<div class="speakers-thumb">
								<h3>{{$admin->fname}} {{$admin->lname}} </h3>

							</div>
						</div>
					</div>
					@endforeach
				</div>

			</div>
		</div>
	</section>


	<!-- =========================
    PROGRAM SECTION   
============================== -->
	<section id="program" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="0.6s">
					<div class="section-title">
						
					</div>
				</div>


			</div>
	</section>


	<!-- =========================
   REGISTER SECTION   
============================== -->
	<section id="register" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="0.6s">
					<h2>DOWNLOAD OUR MOBILE APPLICATION NOW</h2>
					<h3>to get updates when your passing bike shops. Help other cyclist who are in need, take a photo and send it. Save Lives mga ka Islaw!</h3>
					<p align="right"><a href="https://play.google.com/" type="button" class="btn btn-success lg-2"><i class="fa fa-download"></i> DOWNLOAD NOW!</a>
					</p>
				</div>
				<div class="wow fadeInUp col-md-5" data-wow-delay="1s">
					<image src="{{asset("homepage/images/mobile.png")}}" height="500" width="500"></image>
				</div>

				<div class="col-md-1"></div>

			</div>
		</div>
	</section>


	<!-- =========================
    FAQ SECTION   
============================== -->
	<section id="faq" class="parallax-section">
		<div class="container">
			<div class="row">

				<!-- Section title
			================================================== -->
				<div class="wow bounceIn col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 text-center">
					<div class="section-title">
						<h2>Do you have Questions?</h2>
						<p></p>
					</div>
				</div>

				<div class="wow fadeInUp col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10" data-wow-delay="0.9s">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						@foreach ($faqs as $faq)
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne">
										{{$faq->title}}
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									{!!$faq->description!!}
								</div>
							</div>
						</div>
						@endforeach

					</div>
				</div>

			</div>
		</div>
	</section>


	<!-- =========================
    VENUE SECTION   
============================== -->
	<section id="venue" class="parallax-section">
		<div class="container">
			<div class="row">

				<!-- <div class="wow fadeInLeft col-md-offset-1 col-md-5 col-sm-8" data-wow-delay="0.9s">
					<h2>Venue</h2>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore
						magna aliquam erat volutpat.</p>
					<h4>New Event</h4>
					<h4>120 Market Street, Suite 110</h4>
					<h4>San Francisco, CA 10110</h4>
					<h4>Tel: 010-020-0120</h4>
				</div> -->

				<br><br><br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>
	</section>


	<!-- =========================
    SPONSORS SECTION   
============================== -->
	<section id="sponsors" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow bounceIn col-md-12 col-sm-12">
					<div class="section-title">
						<h2>Our Sponsors</h2>
						<p>Pinoy Road Bikers Inc. is powered by:</p>
					</div>
				</div>


				@foreach ($sponsors as $sponsor)
				<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.3s">
					<img src="{{asset("img/sponsor/" . $sponsor->sponsor_image)}}" width="150" heigh="100" class="img-responsive" alt="sponsors">
				</div>




				@endforeach


			</div>
		</div>
	</section>


	<!-- =========================
    CONTACT SECTION   
============================== -->
	<section id="contact" class="parallax-section">
		<div class="container">
			<div class="row">

				<div class="wow fadeInUp col-md-offset-1 col-md-5 col-sm-6" data-wow-delay="0.6s">
					<div class="contact_des">
						<font color="white">
							<h3>Contact Us!</h3>
						</font>
						<p>
							<font color="white">Tells us your concerns, suggestions, questions.<br> Email us at islaw.prbi@gmail.com #goodvibes!</font>
						</p>

					</div>
				</div>

				<div class="wow fadeInUp col-md-5 col-sm-6" data-wow-delay="0.9s">
					<div class="contact_detail">
						<div class="section-title">
							<h2></h2>
						</div>
						<form action="#" method="post">
							<input name="name" type="text" class="form-control" id="name" placeholder="Name">
							<input name="email" type="email" class="form-control" id="email" placeholder="Email">
							<textarea name="message" rows="5" class="form-control" id="message" placeholder="Message"></textarea>
							<div class="col-md-6 col-sm-10">
								<input name="submit" type="submit" class="form-control" id="submit" value="SEND">
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>


	<!-- =========================
    FOOTER SECTION   
============================== -->
	<footer>
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<p class="wow fadeInUp" data-wow-delay="0.6s">Copyright &copy; 2019 LUCKY A.C.E.S | Design:
						<a rel="nofollow" href="http://www.templatemo.com/page/1" target="_parent">Templatemo</a>
					</p>

					<ul class="social-icon">
						<li>
							<a href="https://www.facebook.com/groups/PRBInc/" class="fa fa-facebook wow fadeInUp" data-wow-delay="1s"></a>
						</li>
					</ul>

				</div>

			</div>
		</div>
	</footer>


	<!-- Back top -->
	<a href="#back-top" class="go-top">
		<i class="fa fa-angle-up"></i>
	</a>


	<!-- =========================
     SCRIPTS   
============================== -->
	<script src="{{asset("homepage/js/jquery.js")}}"></script>
	<script src="{{asset("homepage/js/bootstrap.min.js")}}"></script>
	<script src="{{asset("homepage/js/jquery.parallax.js")}}"></script>
	<script src="{{asset("homepage/js/owl.carousel.min.js")}}"></script>
	<script src="{{asset("homepage/js/smoothscroll.js")}}"></script>
	<script src="{{asset("homepage/js/wow.min.js")}}"></script>
	<script src="{{asset("homepage/js/custom.js")}}"></script>

</body>

</html>