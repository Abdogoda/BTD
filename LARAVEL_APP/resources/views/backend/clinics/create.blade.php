@extends('layouts.backend.master')
@section('title') Create Clinic @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Create New Clinic</h5>
    <p class="mb-4"><a href="{{route('doctor.clinics')}}">Clinics</a> / New</p>
   </div>
   <form action="{{route('doctor.clinic_store')}}" method="post" class="card" enctype="multipart/form-data">
    @csrf
     <div class="card-body">
       <div class="row">
         <div class="col-md-12 mb-3">
           <label for="name" class="form-label">Clinic Name <span class="text-danger">*</span></label>
           <input type="text" class="form-control" name="name" id="name" autofocus value="{{old('name')}}">
           @error('name')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="phone" class="form-label">Clinic Phone <span class="text-danger">*</span></label>
           <input type="string" name="phone" minlength="11" maxlength="11" class="form-control" id="phone" value="{{old('phone')}}">
          @error('phone')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-12 mb-3">
          <label for="address" class="form-label">Clinic Address <span class="text-danger">*</span></label>
          <input type="string" name="address" class="form-control" id="address" value="{{old('address')}}">
          @error('address')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-12 mb-3">
          <label for="location" class="form-label">Clinic Location <span class="text-danger">*</span></label>
          <input type="string" name="location" class="form-control" id="location" value="{{old('location')}}">
          @error('location')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6 mb-3">
          <label for="visiting_price" class="form-label">Clinic Visiting Price <span class="text-danger">*</span> <small class="text-muted">(EGP)</small></label>
          <input type="number" class="form-control" min="10" max="10000000" name="visiting_price" id="visiting_price" value="{{old('visiting_price')}}">
          @error('visiting_price')
           <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="col-md-6 mb-3">
          <label for="follow_up_price" class="form-label">Clinic FollowUp Price <small class="text-muted">(EGP)</small></label>
          <input type="number" class="form-control" min="10" max="10000000" name="follow_up_price" id="follow_up_price" value="{{old('follow_up_price')}}">
          @error('follow_up_price')
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