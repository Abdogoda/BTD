@extends('layouts.frontend.master')
@section('title') Appointment @endsection
@section('css')
@endsection
@section('content')
		<section class="page-title bg-1">
			<div class="overlay"></div>
			<div class="container">
					<div class="row">
							<div class="col-md-12">
									<div class="block text-center">
											<span class="text-white">Book your Seat</span>
											<h1 class="text-capitalize text-lg">Appoinment</h1>
									</div>
							</div>
					</div>
			</div>
		</section>

		<section class="appoinment section">
			<div class="container">
					<div class="row">
							<div class="col-lg-4">
											<div class="mt-3">
													<div class="feature-icon mb-3">
															<i class="icofont-support text-lg"></i>
													</div>
														<span class="h3">Call for an Emergency Service!</span>
															<h2 class="text-color mt-3">{{$siteSettings['phone']->value ?? '01142366716'}} </h2>
											</div>
							</div>

							<div class="col-lg-8">
												<div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
														<h2 class="mb-2 title-color">Book an appoinment</h2>
														<p class="mb-4">Mollitia dicta commodi est recusandae iste, natus eum asperiores corrupti qui velit . Iste dolorum atque similique praesentium soluta.</p>
														@livewire('appointment')
													</div>
									</div>
							</div>
					</div>
			</div>
		</section>


@endsection

@section('js')
@endsection