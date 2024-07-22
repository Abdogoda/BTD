@extends('layouts.frontend.master')
@section('title') Doctors @endsection
@section('css')
@endsection
@section('content')
		<section class="page-title bg-1">
			<div class="overlay"></div>
			<div class="container">
					<div class="row">
							<div class="col-md-12">
									<div class="block text-center">
											<span class="text-white">All Doctors</span>
											<h1 class="text-capitalize text-lg">Specalized doctors</h1>
									</div>
							</div>
					</div>
			</div>
		</section>


		<!-- portfolio -->
		<section class="section doctors">
			<div class="container">
						<div class="row justify-content-center">
														<div class="col-lg-6 text-center">
																	<div class="section-title">
																					<h2>Doctors</h2>
																					<div class="divider mx-auto my-4"></div>
																					<p>We provide a wide range of creative services adipisicing elit. Autem maxime rem modi eaque, voluptate. Beatae officiis neque </p>
																	</div>
													</div>
									</div>

							<div class="col-md-8 mx-auto text-center  mb-5">
								<select name="shuffle-filter" id="shuffle-filter" class="form-control">
										<option value="all">All Doctors</option>
										@foreach ($specializations as $specialization)
												<option value="{{$specialization->id}}">{{$specialization->name}} Doctors</option>
										@endforeach
								</select>
							</div>

					<div class="row shuffle-wrapper portfolio-gallery">
								@forelse ($doctors as $doctor)
										<div class="col-lg-3 col-sm-6 col-md-6 mb-4 shuffle-item" data-groups="[&quot;{{$doctor->specialization_id}}&quot;]">
											<div class="position-relative doctor-inner-box">
													<div class="doctor-profile">
																			<div class="doctor-img">
																					<img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/1.jpg')}}" style="max-height: 255px" alt="doctor-image" class="img-fluid w-100">
																			</div>
																</div>
																			<div class="content mt-3">
																				<h4 class="mb-0"><a href="{{route('doctors.show', $doctor)}}">{{$doctor->user->first_name." ".$doctor->user->last_name}}</a></h4>
																				<p>{{$doctor->specialization->name}}</p>
																			</div> 
											</div>
										</div>
								@empty
										<div class="col-12 p-2 text-muted text-center border"><h3>There Is No Doctors Found!</h3></div>
								@endforelse
					</div>
					<div>{{$doctors->links()}}</div>
			</div>
		</section>
		<!-- /portfolio -->
		<section class="section cta-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<div class="cta-content">
						<div class="divider mb-4"></div>
						<h2 class="mb-5 text-lg">We are pleased to offer you the <span class="title-color">chance to have the healthy</span></h2>
						<a href="appoinment.html" class="btn btn-main-2 btn-round-full">Get appoinment<i class="icofont-simple-right  ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
		</section>
@endsection

@section('js')
@endsection

