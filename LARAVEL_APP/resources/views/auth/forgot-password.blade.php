@extends('layouts.frontend.auth_master')
@section('title') Forgot Password  @endsection
@section('css')
@endsection
@section('content')
		<section class="p-2">
			<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<h2 class="title-color">Forgot Password?</h2>
							<div class="divider mt-4 mb-5 mb-lg-0"></div>
							<img src="{{asset('assets/frontend/images/bg/change_password.svg')}}" alt="register image" class="d-none d-lg-block mt-3 mx-auto text-center">
						</div>
							<div class="col-lg-7">
								<form action="{{ route('password.email') }}" method="post" class="row bg-gray py-4 px-2 rounded">
									@csrf
									<div class="col-md-12">
                                        <p>Forgot Password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
										<div class="form-group">
											<label for="email">Email Address</label>
											<input type="email" autofocus autocomplete="username" required value="{{old('email')}}" class="form-control" name="email" id="email">
										</div>
										@if ($errors->has('email'))
											<span class="text-danger">{{ $errors->first('email') }}</span>
										@endif
									</div>
									<div class="col-md-12 mt-3">
										<div class="form-group">
											<button type="submit" class="btn btn-main">Submit</button>
										</div>
									</div>
								</form>
							</div>
					</div>
			</div>
	</section>
	
@endsection

@section('js')
@endsection