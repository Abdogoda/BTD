@extends('layouts.frontend.master')
@section('title') Home @endsection
@section('css')
    <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css')}}">
@endsection
@section('content')
		<section class="banner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12 col-xl-7">
						<div class="block">
							<div class="divider mb-3"></div>
							<span class="text-uppercase text-sm letter-spacing ">Total Health care solution</span>
							<h1 class="mb-3 mt-3">Your most trusted health partner</h1>
							<div class="btn-container ">
								<a href="{{route('user.appointment')}}" class="btn btn-main-2 btn-icon btn-round-full">Make appoinment <i class="icofont-simple-right ml-2  "></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="features">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="feature-block d-lg-flex">
							<div class="feature-item mb-5 mb-lg-0">
								<div class="feature-icon mb-4">
									<i class="icofont-surgeon-alt"></i>
								</div>
								<span>24 Hours Service</span>
								<h4 class="mb-3">Online Appoinment</h4>
								<p class="mb-4">Get ALl time support for emergency.We have introduced the principle of family medicine.</p>
								<a href="{{route('user.appointment')}}" class="btn btn-main btn-round-full">Make a appoinment</a>
							</div>
						
							<div class="feature-item mb-5 mb-lg-0">
								<div class="feature-icon mb-4">
									<i class="icofont-ui-clock"></i>
								</div>
								<span>Timing schedule</span>
								<h4 class="mb-3">Working Hours</h4>
								<ul class="w-hours list-unstyled">
																								<li class="d-flex justify-content-between">Sun - Wed : <span>8:00 - 17:00</span></li>
																								<li class="d-flex justify-content-between">Thu - Fri : <span>9:00 - 17:00</span></li>
																								<li class="d-flex justify-content-between">Sat - sun : <span>10:00 - 17:00</span></li>
																				</ul>
							</div>
						
							<div class="feature-item mb-5 mb-lg-0">
								<div class="feature-icon mb-4">
									<i class="icofont-support"></i>
								</div>
								<span>Emegency Cases</span>
								<h4 class="mb-3">{{$siteSettings['phone']->value ?? '01142366716'}}</h4>
								<p>Get ALl time support for emergency.We have introduced the principle of family medicine.Get Conneted with us for any urgency .</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
			<section class="section about">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-4 col-sm-6">
							<div class="about-img">
								<img src="{{asset('assets/frontend/images/about/img-1.jpg')}}" alt="about image 1" class="img-fluid">
								<img src="{{asset('assets/frontend/images/about/img-2.jpg')}}" alt="about image 2" class="img-fluid mt-4">
							</div>
						</div>
						<div class="col-lg-4 col-sm-6">
							<div class="about-img mt-4 mt-lg-0">
								<img src="{{asset('assets/frontend/images/about/img-3.jpg')}}" alt="about image 3" class="img-fluid">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="about-content pl-4 mt-4 mt-lg-0">
								<h2 class="title-color">Who Are We? <br>Get To Know About Us</h2>
								<p class="mt-4 mb-5">{{$siteSettings['about']->value ?? '"BTD" is an AI-driven platform for brain tumor detection, offering image analysis, medical resources, patient support, specialist directories, and educational content, ensuring privacy and catering to a global audience.'}}</p>
			
								<a href="service.html" class="btn btn-main-2 btn-round-full btn-icon">Services<i class="icofont-simple-right ml-3"></i></a>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="cta-section ">
				<div class="container">
					<div class="cta position-relative">
						<div class="row">
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="counter-stat">
									<i class="icofont-users-alt-5"></i>
									<span class="h3">{{$users}}</span>+
									<p>Happy Clients</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="counter-stat">
									<i class="icofont-check-circled"></i>
									<span class="h3">{{$appointments}}</span>+
									<p>Appointment Comepleted</p>
								</div>
							</div>
							
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="counter-stat">
									<i class="icofont-doctor"></i>
									<span class="h3">{{$doctors}}</span>+
									<p>Expert Doctors</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 col-sm-6">
								<div class="counter-stat">
									<i class="icofont-file-image"></i>
									<span class="h3">20</span>
									<p>Success Detection</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section service gray-bg">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-7 text-center">
							<div class="section-title">
								<h2>Why Choose Us</h2>
								<div class="divider mx-auto my-4"></div>
								<p>{{$siteSettings['choose']->value ?? 'Choose "BTD" for precise AI-driven brain tumor detection, comprehensive resources, expert directories, and strong privacy measures. We support a global community with multilingual accessibility and top-notch medical insights.'}}</p>
							</div>
						</div>
					</div>
			
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-file-image text-lg"></i>
									<h4 class="mt-3 mb-3">AI Image Analysis</h4>
								</div>
								<div class="content">
									<p class="mb-4">Upload medical images for brain tumor detection and receive detailed reports.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-surgeon-alt text-lg"></i>
									<h4 class="mt-3 mb-3">Doctor Appointments</h4>
								</div>
								<div class="content">
									<p class="mb-4">Schedule consultations with brain tumor specialists and healthcare providers.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-laboratory text-lg"></i>
									<h4 class="mt-3 mb-3">Laboratory services</h4>
								</div>
								<div class="content">
									<p class="mb-4">Find comprehensive information about diagnostic laboratories.</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-hospital text-lg"></i>
									<h4 class="mt-3 mb-3">Hospital services</h4>
								</div>
								<div class="content">
									<p class="mb-4">Find comprehensive information about hospitals.</p>
								</div>
							</div>
						</div>
			
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-brain-alt text-lg"></i>
									<h4 class="mt-3 mb-3">Neurology Sargery</h4>
								</div>
								<div class="content">
									<p class="mb-4">Surgery for brain, spine, and nerve conditions, including tumor removal.</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="service-item mb-4">
								<div class="icon d-flex align-items-center">
									<i class="icofont-notepad text-lg"></i>
									<h4 class="mt-3 mb-3">Healthcare Reviews</h4>
								</div>
								<div class="content">
									<p class="mb-4">Read patient reviews and ratings to make informed decisions about doctors.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="section testimonial-2">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-7">
							<div class="section-title text-center">
								<h2>We served over 5000+ Patients</h2>
								<div class="divider mx-auto my-4"></div>
								<p>Browse through client reviews to gain insights and make well-informed decisions regarding your healthcare choices.</p>
							</div>
						</div>
					</div>
				</div>
			
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-12 testimonial-wrap-2">
							<div class="testimonial-block style-2  gray-bg">
								<i class="icofont-quote-right"></i>
			
								<div class="testimonial-thumb">
									<img src="{{asset('assets/frontend/images/team/test-thumb1.jpg')}}" alt="testimonial-thumb-1" class="img-fluid">
								</div>
			
								<div class="client-info ">
									<h4>Amazing service!</h4>
									<span>John Partho</span>
									<p>
										They provide great service facilty consectetur adipisicing elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a vel eos adipisci suscipit fugit placeat.
									</p>
								</div>
							</div>
			
							<div class="testimonial-block style-2  gray-bg">
								<div class="testimonial-thumb">
									<img src="{{asset('assets/frontend/images/team/test-thumb2.jpg')}}" alt="testimonial-thumb-1" class="img-fluid">
								</div>
			
								<div class="client-info">
									<h4>Expert doctors!</h4>
									<span>Mullar Sarth</span>
									<p>
										They provide great service facilty consectetur adipisicing elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a vel eos adipisci suscipit fugit placeat.
									</p>
								</div>
								
								<i class="icofont-quote-right"></i>
							</div>
			
							<div class="testimonial-block style-2  gray-bg">
								<div class="testimonial-thumb">
									<img src="{{asset('assets/frontend/images/team/test-thumb3.jpg')}}" alt="testimonial-thumb-1" class="img-fluid">
								</div>
			
								<div class="client-info">
									<h4>Good Support!</h4>
									<span>Kolis Mullar</span>
									<p>
										They provide great service facilty consectetur adipisicing elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a vel eos adipisci suscipit fugit placeat.
									</p>
								</div>
								
								<i class="icofont-quote-right"></i>
							</div>
			
							<div class="testimonial-block style-2  gray-bg">
								<div class="testimonial-thumb">
									<img src="{{asset('assets/frontend/images/team/test-thumb4.jpg')}}" alt="testimonial-thumb-1" class="img-fluid">
								</div>
			
								<div class="client-info">
									<h4>Nice Environment!</h4>
									<span>Partho Sarothi</span>
									<p class="mt-4">
										They provide great service facilty consectetur adipisicing elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a vel eos adipisci suscipit fugit placeat.
									</p>
								</div>
								<i class="icofont-quote-right"></i>
							</div>
			
							<div class="testimonial-block style-2  gray-bg">
								<div class="testimonial-thumb">
									<img src="{{asset('assets/frontend/images/team/test-thumb1.jpg')}}" alt="testimonial-thumb-1" class="img-fluid">
								</div>
			
								<div class="client-info">
									<h4>Modern Service!</h4>
									<span>Kolis Mullar</span>
									<p>
										They provide great service facilty consectetur adipisicing elit. Itaque rem, praesentium, iure, ipsum magnam deleniti a vel eos adipisci suscipit fugit placeat.
									</p>
								</div>
								<i class="icofont-quote-right"></i>
							</div>
						</div>
					</div>
				</div>
			</section>
@endsection

@section('js')
				<!-- Slick Slider -->
    <script src="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.min.js')}}"></script>
@endsection