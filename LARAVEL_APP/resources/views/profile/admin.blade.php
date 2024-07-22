@extends('layouts.backend.master')
@section('title') Profile @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">My Profile</h5>
   </div>
    <div class="row">
     <div class="col-md-4 mt-4 justify-content-center">
      <label for="picture" class="label-image">
       @if (auth()->user()->picture)
           <img src="{{asset('storage/'.auth()->user()->picture)}}" alt="admin image" class="img-fluid">
       @else
           <img src="{{asset('assets/backend/images/profile/user-1.jpg')}}" alt="admin image" class="img-fluid">
       @endif
      </label>
      <input type="file" name="picture" id="picture" accept=".jpg,.jpeg,.png" style="display: none">
     </div>
     <div class="col-md-8 mt-4 row">
     <div class="col-md-6 form-group mb-3">
      <label for="first_name">First Name</label>
      <input type="text" name="first_name" id="first_name" class="form-control" value="{{auth()->user()->first_name}}"/>
      @error('first_name')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="last_name">First Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" value="{{auth()->user()->last_name}}"/>
      @error('last_name')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}"/>
      @error('email')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="phone">Phone</label>
      <input type="text" minlength="11" maxlength="11" name="phone" id="phone" class="form-control" value="{{auth()->user()->phone}}"/>
      @error('phone')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-12 form-group mb-3">
      <label for="address">Address</label>
      <textarea name="address" id="address" class="form-control" rows="5">{{auth()->user()->address}}</textarea>
      @error('address')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-12 form-group mb-3 d-flex gap-2 flex-wrap align-items-center">
      <button type="submit" class="btn btn-primary">Update Data</button>
      <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-outline-danger d-block">Logout</a>
       </form>
     </div>
     </div>
    </div>
  </div>
 </form>
</div>
<div class="card">
 <form action="{{route('password.update')}}" method="post">
  @csrf
  @method('put')
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Update Password</h5>
   </div>
    <div class="row">
     <div class="col-md-12 form-group mb-3">
      <label for="current_password">Current Password</label>
      <input type="password" name="current_password" autocomplete="current-password" id="current_password" class="form-control"/>
      @error('current_password')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="password">New Password</label>
      <input type="password" name="password" autocomplete="current-password" id="password" class="form-control"/>
      @error('password')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="password_confirmation">Password Confirmaiton</label>
      <input type="password" name="password_confirmation" autocomplete="current-password" id="password_confirmation" class="form-control"/>
     </div>
     <div class="col-md-12 form-group mb-3">
      <button type="submit" class="btn btn-primary">Update Password</button>
     </div>
    </div>
  </div>
 </form>
</div>
@endsection

@section('js')
@endsection