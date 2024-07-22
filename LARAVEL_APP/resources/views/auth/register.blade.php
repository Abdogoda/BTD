@extends('layouts.frontend.auth_master')
@section('title') User Register @endsection
@section('css')
@endsection
@section('content')
    <section class="px-2 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h2 class="title-color">Join Us Now</h2>
                    <div class="divider mt-4 mb-5 mb-lg-0"></div>
                    <div class="d-flex mt-3 flex-wrap align-items-center">
                        <a href="{{route('register')}}" class="btn btn-main mx-2">As a User</a>
                        <a href="{{route('doctor-register')}}" class="btn btn-main-2 mx-2">As a Doctor</a>
                    </div>
                    <img src="{{asset('assets/frontend/images/bg/register.svg')}}" alt="register image" class="d-none d-lg-block mt-3 mx-auto text-center">
                </div>
                <div class="col-lg-7 mt-3 mt-lg-0">
                    <h3>Sign Up As A User</h3>
                    <form action="{{route('register')}}" method="post" class="row bg-gray py-4 px-2 rounded" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" autofocus  autocomplete="first_name" value="{{old('first_name')}}">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name"  autocomplete="last_name" value="{{old('last_name')}}">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" minlength="11" maxlength="11"  autocomplete="phone" value="{{old('phone')}}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"  autocomplete="username" value="{{old('email')}}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="year_of_birth">Year Of Birth</label>
                                <input type="number" placeholder="YYYY" minlength="4" maxlength="4" min="1920" max="2024" class="form-control" name="year_of_birth" id="year_of_birth" autocomplete="year_of_birth" value="{{old('year_of_birth')}}">
                                @error('year_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="" disabled selected>Select Your Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control"  minlength="6" autocomplete="new-password" name="password" id="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control"  minlength="6" autocomplete="new-password" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-file my-3">
                                <label for="picture" class="custom-file-label">Profile Picture</label>
                                <input type="file" class="custom-file-input" name="picture" id="picture" accept=".jpg,.jpeg,.png">
                                @error('picture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" autocomplete="address">{{old('address')}}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-main">Submit Now</button>
                            </div>
                            <p>Already have an account? <a href="{{route('login')}}">Login Now</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
	
@endsection

@section('js')
@endsection