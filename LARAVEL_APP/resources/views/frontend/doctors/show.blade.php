@extends('layouts.frontend.master')
@section('title') Doctors @endsection
@section('css')
<!-- Slick Slider  CSS -->
<link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css')}}">
<style>
	.star {
  font-size: 10vh;
  cursor: pointer;
}
 
.one {
  color: rgb(255, 0, 0);
}
 
.two {
  color: rgb(255, 106, 0);
}
 
.three {
  color: rgb(251, 255, 120);
}
 
.four {
  color: rgb(255, 255, 0);
}
 
.five {
  color: rgb(24, 159, 14);
}
</style>
@endsection
@section('content')

<section class="page-title bg-1">
	<div class="overlay"></div>
	<div class="container">
			<div class="row">
					<div class="col-md-12">
							<div class="block text-center">
									<span class="text-white">Doctor Details</span>
									<h1 class="text-capitalize text-lg">{{$doctor->user->first_name." ".$doctor->user->last_name}}</h1>

									<ul class="list-inline breadcumb-nav">
											<li class="list-inline-item"><a href="{{route('doctors')}}" class="text-white">Doctors</a></li>
											<li class="list-inline-item"><span class="text-white">/</span></li>
											<li class="list-inline-item"><a href="#" class="text-white-50">{{$doctor->user->first_name." ".$doctor->user->last_name}}</a></li>
									</ul>
							</div>
					</div>
			</div>
	</div>
</section>


<section class="section doctor-single">
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-md-6">
			<div class="doctor-img-block">
				<img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/1.jpg')}}" alt="doctor image" class="img-fluid w-100">

				<div class="info-block mt-4">
					<h4 class="mb-0">{{$doctor->user->first_name." ".$doctor->user->last_name}}</h4>
					<p>{{$doctor->specialization->name}}</p>

				</div>
			</div>
		</div>

		<div class="col-lg-8 col-md-6">
			<div class="doctor-details mt-4 mt-lg-0">
				<h2 class="text-md">Introducing to myself</h2>
				<div class="divider my-4"></div>
				<p>
					<a href="tel:{{$doctor->user->phone}}" target="_blank"><i class="icofont-phone"></i> {{$doctor->user->phone}}</a><br>
					<a href="mailto:{{$doctor->user->email}}" target="_blank"><i class="icofont-envelope"></i> {{$doctor->user->email}}</a><br>
					@if ($doctor->hospital_id)
						<a href="{{route('hospitals.show', $doctor->hospital)}}"><i class="icofont-hospital"></i> {{$doctor->hospital->name}}</a><br>
					@endif
					@if ($doctor->years_of_experience)
						<span><i class="icofont-check-circled"></i> {{$doctor->years_of_experience}} Year Of Experiences</span><br>
					@endif
					@if ($doctor->user->gender)
						<span><i class="icofont-user-{{$doctor->user->gender}}"></i> {{$doctor->user->gender}}</span><br>
					@endif
					@if ($doctor->user->year_of_birth)
						<span><i class="icofont-doctor"></i> {{\Carbon\Carbon::createFromDate($doctor->user->year_of_birth)->diffInYears(\Carbon\Carbon::now())}}</span> Years Old<br>
					@endif
				</p>
				<p>{{$doctor->about}}</p>
			</div>
		</div>

	</div>
</div>
</section>

@if ($doctor->clinics->count() > 0)
		<section class="mb-5">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="sidebar-widget  gray-bg p-4">
							<h5 class="mb-4">Doctor Schedule</h5>
				
							<ul class="list-unstyled lh-35">
								@foreach ($doctor->schedule as $day)
											<li class="d-flex flex-wrap mt-3 justify-content-between align-items-center">
													<p class="m-0"><a href="#" class="text-capitalize mr-2">{{$day->day}}</a> {{$day->start_time->format('h:i A')}} - {{$day->end_time->format('h:i A')}}</p>
													<span>{{$day->clinic->name}} - (<a href="{{$day->clinic->location}}">{{$day->clinic->address}}</a>)</span>
											</li>
											<hr>
									@endforeach
							</ul>
							<div class="d-flex justify-content-between align-items-center flex-wrap">
									<a href="{{route('user.appointment')}}" target="_blank" class="mt-3 btn btn-main-2 btn-icon">Make appoinment <i class="icofont-simple-right ml-2  "></i></a>
									<div class="mt-3 sidebar-contatct-info">
										<p class="mb-0">Need Urgent Help?</p>
										<h3 class="text-color-2"><a href="tel:{{$doctor->user->phone}}">{{$doctor->user->phone}}</a></h3>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endif

@if ($doctor->experiences->count() > 0 || $doctor->educations->count() > 0) 
	<section class="section doctor-qualification gray-bg pb-1">
		<div class="container">
				@if ($doctor->educations->count() > 0)
							<div class="section-title">
								<h3>My Educational Qualifications</h3>
								<div class="divider my-3"></div>
							</div>
						<div class="row">
							@foreach ($doctor->educations as $education)
											<div class="col-md-6">
														<div class="edu-block mb-5">
															<span class="h6 text-muted">Year({{$education->start}}-{{$education->end ? $education->end : "Present"}}) </span>
															<h4 class="mb-3 title-color">{{$education->name}}</h4>
															<p>{{$education->description}}</p>
														</div>
											</div>
								@endforeach
						</div>
						<hr class="pb-4">
				@endif
				@if ($doctor->experiences->count() > 0)
							<div class="section-title">
								<h3>My Previous Work</h3>
								<div class="divider my-3"></div>
							</div>
						<div class="row">
								@foreach ($doctor->experiences as $experience)
											<div class="col-md-6">
														<div class="edu-block mb-5">
															<span class="h6 text-muted">Year({{$experience->start}}-{{$experience->end ? $experience->end : "Present"}}) </span>
															<h4 class="mb-3 title-color">{{$experience->name}}</h4>
															<p>{{$experience->description}}</p>
														</div>
											</div>
								@endforeach
						</div>
				@endif
		</div>
	</section>
@endif

<section class="my-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="section-title text-center mt-5">
					<h2>Doctor Reviews</h2>
					<div class="divider mx-auto mt-3"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		@if ($doctor->reviews->count() > 0)
				<div class="row align-items-center">
					<div class="col-lg-12 doctor-reviews">
						
						@foreach ($doctor->reviews as $review)
							<div class="testimonial-block style-2  gray-bg">
								<div class="client-info ">
									<h4>{{$review->user->first_name}} {{$review->user->last_name}}</h4>
									<p>
										@for ($i = 0; $i < $review->stars; $i++)
											<i class="icofont-star"></i>
										@endfor
									</p>
									<p>{{$review->comment}}</p>
								</div>
							</div>
						@endforeach
						
					</div>
				</div>
		@endif
		<div class="mt-3">
			<h3>Add Your Rating</h3>
				<form action="{{route('review_store')}}" method="post">
					@csrf
					<div class="d-flex gap-1 stars-rating">
						<span onclick="gfg(1)"	class="star">★</span>
						<span onclick="gfg(2)"	class="star">★</span>
						<span onclick="gfg(3)" class="star">★</span>
						<span onclick="gfg(4)" class="star">★</span>
						<span onclick="gfg(5)" class="star">★</span>
					</div>
					<input type="hidden" name="stars" id="stars_input">
					@error('stars')
									<span class="text-danger">{{ $message }}</span>
					@enderror
					<input type="hidden" name="doctor_id" value="{{$doctor->id}}">
					<div class="form-group mb-3">
						<label for="comment">Comment</label>
						<textarea name="comment" class="form-control" id="comment" rows="5">{{old('comment')}}</textarea>
						@error('comment')
										<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<button type="submit" class="btn btn-main">Post</button>
				</form>
		</div>
	</div>
</section>


@endsection

@section('js')
<!-- Slick Slider -->
<script src="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.min.js')}}"></script>

<script>
	// To access the stars
let stars = document.getElementsByClassName("star");
let stars_input = document.getElementById("stars_input");
 
// Funtion to update rating
function gfg(n) {
    remove();
    for (let i = 0; i < n; i++) {
        if (n == 1) cls = "one";
        else if (n == 2) cls = "two";
        else if (n == 3) cls = "three";
        else if (n == 4) cls = "four";
        else if (n == 5) cls = "five";
        stars[i].className = "star " + cls;
    }
    stars_input.value =  n ;
}
 
// To remove the pre-applied styling
function remove() {
    let i = 0;
    while (i < 5) {
        stars[i].className = "star";
        i++;
    }
}
</script>
@endsection