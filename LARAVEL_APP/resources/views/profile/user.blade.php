@extends('layouts.frontend.master')
@section('title') Profile @endsection
@section('css')
<style>
	.picture-label{
		position: relative;
	}
	.picture-label::before{
		content: '+';position: absolute;
		top: 0;left: 0;width: 100%;height: 100%;
		background: rgba(255, 255, 255, 0.5);opacity: 0;
		display: flex;align-items: center;justify-content: center;
		font-size: 50px;
		transition: 0.3s ease-in-out
	}
	.picture-label:hover::before{
		opacity: 1; 
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
											<h1 class="text-capitalize text-lg">Your Profile</h1>
									</div>
							</div>
					</div>
			</div>
		</section>

		<section class="appoinment section">
			<div class="container">
					<form  class="row" method="post" action="{{route('profile.edit')}}" enctype="multipart/form-data">
						@csrf
						@method('patch')
						<div class="col-lg-4">
								<h2 class="mb-4 title-color">Edit your profile</h2>
											<label for="picture" class="picture-label">
												<img src="{{auth()->user()->picture ? asset('storage/'.auth()->user()->picture) : asset('assets/frontend/images/defualts/default_user.png')}}" alt="user profile image" style="max-width: 100%">
											</label>
											@error('picture')
															<span class="text-danger">{{ $message }}</span>
											@enderror
											<input type="file" name="picture" id="picture" accept=".jpg,.jpeg,.png" style="display: none">
							</div>

							<div class="col-lg-8">
										<div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
											<div class="row">
												<div class="col-md-6 form-group mb-3">
													<label for="first_name">First Name</label>
													<input type="text" name="first_name" id="first_name" class="form-control" value="{{auth()->user()->first_name}}"/>
													@error('first_name')
																	<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 form-group mb-3">
													<label for="last_name">First Name</label>
													<input type="text" name="last_name" id="last_name" class="form-control" value="{{auth()->user()->last_name}}"/>
													@error('last_name')
																	<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 form-group mb-3">
													<label for="email">Email Address</label>
													<input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}"/>
													@error('email')
																	<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-6 form-group mb-3">
													<label for="phone">Phone</label>
													<input type="text" minlength="11" maxlength="11" name="phone" id="phone" class="form-control" value="{{auth()->user()->phone}}"/>
													@error('phone')
																	<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
												<div class="col-md-12 form-group mb-3">
													<label for="address">Address</label>
													<textarea name="address" id="address" class="form-control" rows="5">{{auth()->user()->address}}</textarea>
													@error('address')
																	<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											<button type="submit" class="btn btn-main btn-round-full">Update Profile <i class="icofont-edit ml-2"></i></button>
										</div>
									</div>
							</form>
					</div>
			</div>
		</section>

		@if (auth()->user()->appointments->count() > 0)
				<section class="mb-5">
					<div class="container">
						<h1 class="mb-4 title-color">Your Appointments</h1>
						<div class="table-responsive">
							<table class="table table-bordered align-middle text-center">
								<thead>
									<tr>
										<th>Doctor</th>
										<th>Clinic</th>
										<th>Date</th>
										<th>Type</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach (auth()->user()->appointments as $appointment)
											<tr>
												<td><a href="{{route('doctors.show', $appointment->doctor)}}">{{$appointment->doctor->user->first_name}}</a></td>
												<td>{{$appointment->clinic->name}}</td>
												<td>{{$appointment->appointment_date}}</td>
												<td class="text-uppercase"><i>{{$appointment->appointment_type}}</i></td>
												@if ($appointment->status == 'pending')
														<?php $color = 'warning'?>
												@elseif ($appointment->status == 'completed')
														<?php $color = 'success'?>
												@else
														<?php $color = 'danger'?>
												@endif
            <td><span class="badge bg-{{$color}} text-capitalize">{{$appointment->status}}</span></td>
            <td>
													@if ($appointment->status == 'completed')
															<button class="btn btn-success py-1 px-2">Print Report <i class="icofont-print ml-2"></i></button>
													@endif
												</td>
											</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</section>
		@endif

@endsection

@section('js')
<script>
	function printReport() {
					window.print();
	}
</script>
@endsection