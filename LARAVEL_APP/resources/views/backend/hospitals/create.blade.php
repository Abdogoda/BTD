@extends('layouts.backend.master')
@section('title') Create Hospital @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Create New Hospital</h5>
    <p class="mb-4"><a href="{{route('admin.hospitals')}}">Hospitals</a> / New</p>
   </div>
   <form action="{{route('admin.hospital_store')}}" method="post" class="card" enctype="multipart/form-data">
    @csrf
     <div class="card-body">
       <div class="row">
         <div class="col-md-12 mb-3">
           <label for="name" class="form-label">Hospital Name</label>
           <input type="text" class="form-control" name="name" id="name" autofocus value="{{old('name')}}">
           @error('name')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
           <label for="email" class="form-label">Hospital Email</label>
           <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
           @error('email')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
          <label for="phone" class="form-label">Hospital Phone</label>
          <input type="string" name="phone" minlength="11" maxlength="11" class="form-control" id="phone" value="{{old('phone')}}">
          @error('phone')
          <span class="text-danger">{{ $message }}</span>
          @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="address" class="form-label">Hospital Address</label>
           <input type="string" name="address" class="form-control" id="address" value="{{old('address')}}">
           @error('address')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
           <label for="location" class="form-label">Hospital Location</label>
           <input type="string" name="location" class="form-control" id="location" value="{{old('location')}}">
           @error('location')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-6 mb-3">
           <label for="picture" class="form-label">Hospital Picture</label>
           <input type="file" name="picture" accept=".jpg,.jpeg,.png" class="form-control" id="picture">
           @error('picture')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="description" class="form-label">Hospital description</label>
           <textarea class="form-control" name="description" id="description" rows="5">{{old('description')}}</textarea>
           @error('description')
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