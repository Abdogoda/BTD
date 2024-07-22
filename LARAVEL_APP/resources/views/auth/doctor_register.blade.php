@extends('layouts.frontend.auth_master')
@section('title') Doctor Register @endsection
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
                        <a href="{{route('register')}}" class="btn btn-main-2 mx-2">As a User</a>
                        <a href="{{route('doctor-register')}}" class="btn btn-main mx-2">As a Doctor</a>
                    </div>
                    <img src="{{asset('assets/frontend/images/bg/register.svg')}}" alt="register image" class="d-none d-lg-block mt-3 mx-auto text-center">
                </div>
                <div class="col-lg-7 mt-3 mt-lg-0">
                    <h3>Sign Up As A Doctor</h3>
                    <form action="{{route('store_doctor')}}" method="post" class="row bg-gray py-4 px-2 rounded" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="role" value="doctor">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('first_name')}}" autofocus autocomplete="first_name"  name="first_name" id="first_name">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('last_name')}}" autocomplete="last_name"  name="last_name" id="last_name">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{old('phone')}}" minlength="11" maxlength="11" autocomplete="phone"  name="phone" id="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{old('email')}}" autocomplete="username"  name="email" id="email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="year_of_birth">Year Of Birth</label>
                                <input type="number" placeholder="YYYY" minlength="4" maxlength="4" min="1920" max="2024" class="form-control" name="year_of_birth" id="year_of_birth" autocomplete="year_of_birth" value="{{old('year_of_birth')}}">
                                @error('year_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="years_of_experience">Years of Experience</label>
                                <input type="number" minlength="1" maxlength="2" min="0" max="50" class="form-control" name="years_of_experience" id="years_of_experience" autocomplete="years_of_experience" value="{{old('years_of_experience') | 0}}">
                                @error('years_of_experience')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="specialization_id">Specialization <span class="text-danger">*</span></label>
                                <select class="form-control"  name="specialization_id" id="specialization_id">
                                    <option value="" disabled selected>Select Your Specialization</option>
                                    @foreach ($specializations as $specialization)
                                        <option value="{{$specialization->id}}" {{old('specialization_id') == $specialization->id ? 'selected' : '' }}>{{$specialization->name}}</option>
                                    @endforeach
                                </select>
                                @error('specialization_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hospital_id">Hospital</label>
                                <select class="form-control" name="hospital_id" id="hospital_id">
                                    <option value="" disabled selected>Select Your hospital</option>
                                    @foreach ($hospitals as $hospital)
                                        <option value="{{$hospital->id}}" {{old('hospital_id') == $hospital->id ? 'selected' : '' }}>{{$hospital->name}}</option>
                                    @endforeach
                                </select>
                                @error('hospital_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" minlength="6"  autocomplete="new-password" name="password" id="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" minlength="6"  autocomplete="new-password" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-file my-3">
                                <label for="picture" class="custom-file-label">Profile Picture</label>
                                <input type="file" class="custom-file-input" name="picture" id="picture" accept=".jpg,.jpeg,.png">
                                @error('picture')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-file my-3">
                                <label for="documents" class="custom-file-label">Doctor Documents <span class="text-danger">*</span> </label>   
                                <input type="file" multiple class="custom-file-input"  name="documents[]" id="documents" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                @error('documents')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" autocomplete="address" name="address" id="address">{{old('address')}}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="about">About Me</label>
                                <textarea class="form-control" autocomplete="about" name="about" id="about">{{old('about')}}</textarea>
                                @error('about')
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