@extends('layouts.frontend.auth_master')
@section('title') Login @endsection
@section('css')
@endsection
@section('content')
		<section class="p-2">
			<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<h2 class="title-color">Sign In Now</h2>
							<div class="divider mt-4 mb-5 mb-lg-0"></div>
							<img src="{{asset('assets/frontend/images/bg/login.svg')}}" alt="register image" class="d-none d-lg-block mt-3 mx-auto text-center">
						</div>
							<div class="col-lg-7">
								<form action="{{ route('login') }}" method="post" class="row bg-gray py-4 px-2 rounded">
									@csrf
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email Address</label>
											<input type="email" class="form-control" value="{{old('email')}}" autocomplete="username" autofocus name="email" id="email">
										</div>
										@if ($errors->has('email'))
														<span class="text-danger">{{ $errors->first('email') }}</span>
										@endif
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" class="form-control" autocomplete="new-password" name="password" id="password">
										</div>
										@if ($errors->has('password'))
														<span class="text-danger">{{ $errors->first('password') }}</span>
										@endif
										<p>Forgot Your Password? <a href="{{ route('password.request') }}">Reset Now</a></p>
									</div>
									<div class="col-md-12 mt-3">
										<div class="form-group">
											<button type="submit" class="btn btn-main">Login Now</button>
										</div>
										<p>Don't Have an account? <a href="{{ route('register') }}">Register Now</a></p>
									</div>
								</form>
							</div>
					</div>
			</div>
	</section>
	
@endsection

@section('js')
@endsection