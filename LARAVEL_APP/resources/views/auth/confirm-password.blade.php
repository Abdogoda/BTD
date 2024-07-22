@extends('layouts.frontend.auth_master')
@section('title') Confirm Password  @endsection
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
								<form action="{{ route('password.confirm') }}" method="post" class="row bg-gray py-4 px-2 rounded">
									@csrf
									<div class="col-md-12">
                                        <p>This is a secure area of the application. Please confirm your password before continuing.</p>
										<div class="form-group">
											<label for="password">Password Address</label>
											<input type="password" autofocus autocomplete="current-password" required value="{{old('password')}}" class="form-control" name="password" id="password">
										</div>
										@if ($errors->has('password'))
											<span class="text-danger">{{ $errors->first('password') }}</span>
										@endif
									</div>
									<div class="col-md-12 mt-3">
										<div class="form-group">
											<button type="submit" class="btn btn-main">CONFIRM</button>
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