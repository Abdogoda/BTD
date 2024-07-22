@extends('layouts.frontend.auth_master')
@section('title') Verify Email  @endsection
@section('css')
@endsection
@section('content')
		<section class="p-2">
			<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<h2 class="title-color">Verify Your Email</h2>
							<div class="divider mt-4 mb-5 mb-lg-0"></div>
							<img src="{{asset('assets/frontend/images/bg/verify.svg')}}" alt="reset password image" class="d-none d-lg-block mt-3 mx-auto text-center">
						</div>
							<div class="col-lg-7">
                                <div class="bg-gray py-4 px-2 rounded">
                                    <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                                    <div class=" d-flex align-items-center flex-wrap">
                                        <form action="{{ route('verification.send') }}" method="post">
                                            @csrf
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-main">Send Verification Email</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger">Log Out</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
							</div>
					</div>
			</div>
	</section>
	
@endsection

@section('js')
@endsection