@extends('layouts.frontend.master')
@section('title') Hospitals @endsection
@section('css')
@endsection
@section('content')
	<section class="page-title bg-1">
		<div class="overlay"></div>
		<div class="container">
				<div class="row">
						<div class="col-md-12">
								<div class="block text-center">
										<span class="text-white">Hospital Details</span>
										<h1 class="text-capitalize text-lg">{{$hospital->name}}</h1>
										<ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="{{route('hospitals')}}" class="text-white">Hospitals</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">{{$hospital->name}}</a></li>
          </ul>
								</div>
						</div>
				</div>
		</div>
	</section>


	<section class="section department-single">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="department-content mt-3">
					<h3 class="text-md">{{$hospital->name}}</h3>
					<div class="divider my-3"></div>
					@if ($hospital->picture)
					<img src="{{asset('storage/'.$hospital->picture)}}" alt="hospital-imaeg" class="img-fluid">
					@endif
					@if ($hospital->description)
						<p class="lead mt-3">{{$hospital->description}}</p>
						<div class="divider my-4"></div>
					@endif
					<ul class="list-unstyled department-service">
						<li><i class="icofont-check mr-3"></i><a href="{{$hospital->location}}" target="_blank"><i class="icofont-location-pin mr-1"></i> {{$hospital->address}}</a></li>
						<li><i class="icofont-check mr-3"></i><a href="mailto:{{$hospital->email}}" target="_blank"><i class="icofont-envelope mr-1"></i> {{$hospital->email}}</a></li>
						<li><i class="icofont-check mr-3"></i><a href="tel:{{$hospital->phone}}" target="_blank"><i class="icofont-phone mr-1"></i> {{$hospital->phone}}</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
					<div class="sidebar-widget schedule-widget mt-3">
						<h5 class="mb-4">Time Schedule</h5>
						<ul class="list-unstyled">
								<li class="d-flex justify-content-between align-items-center">
										<a href="#">Monday - Friday</a>
										<span>9:00 - 17:00</span>
								</li>
								<li class="d-flex justify-content-between align-items-center">
										<a href="#">Saturday</a>
										<span>9:00 - 16:00</span>
								</li>
								<li class="d-flex justify-content-between align-items-center">
										<a href="#">Sunday</a>
										<span>Closed</span>
								</li>
						</ul>
						<div class="sidebar-contatct-info mt-4">
							<p class="mb-0">Need Urgent Help?</p>
							<h3><a href="tel:{{$hospital->phone}}" target="_blank">{{$hospital->phone}}</a></h3>
						</div>
					</div>
				</div>
		</div>
		@if ($hospital->doctors->count() > 0)
				<h3 class="mt-2 mb-4">Hospital Doctors</h3>
				<div class="divider my-4"></div>
				<div class="row">
					@forelse ($hospital->doctors as $doctor)
							<div class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item illustration">
									<div class="position-relative doctor-inner-box">
										<div class="doctor-profile">
											<div class="doctor-img">
												<img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/4.jpg')}}" style="max-height: 255px" alt="doctor-image" class="img-fluid w-100">
											</div>
											</div>
											<div class="content mt-3">
												<h4 class="mb-0"><a href="{{route('doctors.show', $doctor)}}">{{$doctor->user->first_name." ".$doctor->user->last_name}}</a></h4>
												<p>{{$doctor->specialization->name}}</p>
											</div> 
										</div>
								</div>
					@empty
					<div class="col-12 p-2 text-center text-muted">There is No Doctors For this hospital</div>
					@endforelse
				</div>
		@endif
	</div>
	</section>
@endsection

@section('js')
@endsection
