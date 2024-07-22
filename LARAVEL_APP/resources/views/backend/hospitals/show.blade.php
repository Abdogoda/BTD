@extends('layouts.backend.master')
@section('title') {{$hospital->name}} @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <form action="{{route('admin.hospital_update', $hospital)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-1">Hospital: {{$hospital->name}}</h5>
    <p class="mb-1"><a href="{{route('admin.hospitals')}}">Hospitals</a> / {{$hospital->name}}</p>
   </div>
    <div class="row">
     <div class="col-md-4 mt-4">
      <label for="picture" class="label-image"><img src="{{$hospital->picture ? asset('storage/'.$hospital->picture) : asset('assets/frontend/images/defualts/hospital-defualt.jpg')}}" alt="hospital image" class="img-fluid"></label>
      <input type="file" name="picture" id="picture" accept=".jpg,.jpeg,.png,.svg,.webp" style="display: none">
     </div>
     <div class="col-md-8 mt-4">
     <div class="form-group mb-3">
      <label for="name">Hospital Name</label>
      <input type="text" name="name" id="name" class="form-control" value="{{$hospital->name}}"/>
      @error('name')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3">
      <label for="address">Hospital Address</label>
      <input type="text" name="address" id="address" class="form-control" value="{{$hospital->address}}"/>
      @error('address')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3">
      <label for="location">Hospital Location</label>
      <input type="text" name="location" id="location" class="form-control" value="{{$hospital->location}}"/>
      @error('location')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3">
      <label for="email">Hospital Email</label>
      <input type="email" name="email" id="email" class="form-control" value="{{$hospital->email}}"/>
      @error('email')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3">
      <label for="phone">Hospital Phone</label>
      <input type="text" minlength="11" maxlength="11" name="phone" id="phone" class="form-control" value="{{$hospital->phone}}"/>
      @error('phone')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3">
      <label for="description">Hospital Description</label>
      <textarea name="description" id="description" class="form-control" rows="5">{{$hospital->description}}</textarea>
      @error('description')
          <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="form-group mb-3 d-flex gap-2 flex-wrap align-items-center">
      <button type="submit" class="btn btn-primary">Update Data</button>
      <a href="{{route('admin.hospital_delete', $hospital)}}" onclick="return confirm('Sure you want to delete this hospital?')" class="btn btn-danger">Delete Hospital</a>
     </div>
     </div>
    </div>
  </div>
 </form>
</div>
<h3>Hospital Doctors</h3>
<div class="row">
 @foreach ($hospital->doctors as $doctor)
   <div class="col-sm-6 col-xl-3">
     <div class="card overflow-hidden rounded-2">
       <div class="position-relative">
         <a href="{{route('admin.doctor', $doctor)}}"><img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/4.jpg')}}" class="card-img-top rounded-0" alt="doctor-image"></a>
       </div>
       <div class="card-body pt-3 p-4">
         <h6 class="fw-semibold fs-4">{{$doctor->user->first_name}} {{$doctor->user->last_name}}</h6>
         <h6 class="fw-semibold fs-4 mb-0 text-muted">{{$doctor->specialization->name}}</h6>
       </div>
     </div>
   </div>
 @endforeach
</div>
@endsection

@section('js')
@endsection