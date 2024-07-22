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
									<span class="text-white">All Hospitals</span>
									<h1 class="text-capitalize text-lg">Care Hospitals</h1>
							</div>
					</div>
			</div>
	</div>
</section>


<section class="section service-2">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-7 text-center">
			<div class="section-title">
				<h2>Award Winning Hospitals Care</h2>
				<div class="divider mx-auto my-4"></div>
			</div>
		</div>
	</div>

	<div class="row">
		
		@forelse ($hospitals as $hospital)
				<div class="col-lg-4 col-md-6 mb-5	">
					<div class="department-block mb-5 mb-lg-0">
						<img src="{{$hospital->picture ? asset('storage/'.$hospital->picture) : asset('assets/frontend/images/defualts/hospital-defualt.jpg')}}" alt="hospital image" style="height: 250px" class="img-fluid w-100">
						<div class="content">
							<h4 class="mt-4 mb-2 title-color">{{$hospital->name}}</h4>
							<p class="mb-2"><a href="{{$hospital->location}}">{{$hospital->address}}</a></p>
							<a href="{{route('hospitals.show', $hospital)}}" class="read-more">Learn More <i class="icofont-simple-right ml-2"></i></a>
						</div>
					</div>
				</div>
		@empty
						<div class="col-12 text-center p-2 text-gray"><h3>There No Hospitals Found</h3></div>
		@endforelse

	</div>
	 <!-- Pagination Links -->
		<div class="text-center mx-auto mt-4">{{ $hospitals->links() }}</div>
</div>
</section>
@endsection

@section('js')
@endsection