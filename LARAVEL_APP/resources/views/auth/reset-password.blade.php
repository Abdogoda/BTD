@extends('layouts.frontend.auth_master')
@section('title') Reset Password  @endsection
@section('css')
@endsection
@section('content')
		<section class="p-2">
			<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<h2 class="title-color">Reset Password Now</h2>
							<div class="divider mt-4 mb-5 mb-lg-0"></div>
							<img src="{{asset('assets/frontend/images/bg/reset.svg')}}" alt="reset password image" class="d-none d-lg-block mt-3 mx-auto text-center">
						</div>
							<div class="col-lg-7">
								<form action="{{ route('password.store') }}" method="post" class="row bg-gray py-4 px-2 rounded">
									@csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email Address</label>
											<input type="email" autofocus value="{{old('email', $request->email)}}" required class="form-control" name="email" id="email">
										</div>
										@if ($errors->has('email'))
											<span class="text-danger">{{ $errors->first('email') }}</span>
										@endif
									</div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" autocomplete="new-password" required minlength="6" name="password" id="password">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" autocomplete="new-password" required minlength="6" name="password_confirmation" id="password_confirmation">
                                        </div>
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