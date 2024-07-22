@extends('layouts.backend.master')
@section('title') Create Admin @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Create New Admin</h5>
    <p class="mb-4"><a href="{{route('admin.admins')}}">Admins</a> / New</p>
   </div>
   <form action="{{route('admin.admin_store')}}" method="post" class="card" enctype="multipart/form-data">
    @csrf
     <div class="card-body">
      <input type="hidden" name="role" value="admin">
       <div class="row">
         <div class="col-md-6 mb-3">
           <label for="first_name" class="form-label">First Name</label>
           <input type="text" class="form-control" name="first_name" id="first_name" autofocus value="{{old('first_name')}}">
           @error('first_name')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
           <label for="last_name" class="form-label">Last Name</label>
           <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}">
           @error('last_name')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
           <label for="email" class="form-label">Email</label>
           <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
           @error('email')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="string" name="phone" minlength="11" maxlength="11" class="form-control" id="phone" value="{{old('phone')}}">
          @error('phone')
          <span class="text-danger">{{ $message }}</span>
          @enderror
         </div>
         <div class="col-md-6 mb-3">
              <label for="year_of_birth" class="form-label">Year Of Birth</label>
              <input type="number" placeholder="YYYY" minlength="4" maxlength="4" min="1920" max="2024" class="form-control" name="year_of_birth" id="year_of_birth" autocomplete="year_of_birth" value="{{old('year_of_birth')}}">
              @error('year_of_birth')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
      </div>
        <div class="col-md-6 mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" name="gender" id="gender">
                    <option value="" disabled selected>Select Your Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control"  minlength="6" autocomplete="new-password" name="password" id="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control"  minlength="6" autocomplete="new-password" name="password_confirmation" id="password_confirmation">
        </div>
         <div class="col-md-16 mb-3">
           <label for="picture" class="form-label">Picture</label>
           <input type="file" name="picture" accept=".jpg,.jpeg,.png" class="form-control" id="picture">
           @error('picture')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="address" class="form-label">Address</label>
           <textarea class="form-control" name="address" id="address" rows="5">{{old('address')}}</textarea>
           @error('address')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
       </div>
     </div>
   </form>
 </div>
</div>
@endsection

@section('js')
@endsection