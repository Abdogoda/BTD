@extends('layouts.backend.master')
@section('title') Profile @endsection
@section('css')
@endsection
@section('content')
{{-- user profile --}}
<div class="card">
 <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">My Profile</h5>
   </div>
   <div class="row">
    <div class="col-md-4 mt-4 d-flex justify-content-center">
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
      <input type="text" name="first_name" id="first_name" class="form-control"
       value="{{auth()->user()->first_name}}" />
      @error('first_name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="last_name">First Name</label>
      <input type="text" name="last_name" id="last_name" class="form-control" value="{{auth()->user()->last_name}}" />
      @error('last_name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="email">Email Address</label>
      <input type="email" name="email" id="email" class="form-control" value="{{auth()->user()->email}}" />
      @error('email')
      <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="phone">Phone</label>
      <input type="text" minlength="11" maxlength="11" name="phone" id="phone" class="form-control"
       value="{{auth()->user()->phone}}" />
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
    </form>
      <form method="POST" action="{{ route('logout') }}">
       @csrf
       <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();"
        class="btn btn-outline-danger d-block">Logout</a>
      </form>
     </div>
    </div>
   </div>
  </div>
</div>

{{-- password update --}}
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
      <input type="password" name="current_password" autocomplete="current-password" id="current_password"
       class="form-control" />
      @error('current_password')
      <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="password">New Password</label>
      <input type="password" name="password" autocomplete="current-password" id="password" class="form-control" />
      @error('password')
      <span class="text-danger">{{ $message }}</span>
      @enderror
     </div>
     <div class="col-md-6 form-group mb-3">
      <label for="password_confirmation">Password Confirmaiton</label>
      <input type="password" name="password_confirmation" autocomplete="current-password" id="password_confirmation"
       class="form-control" />
     </div>
     <div class="col-md-12 form-group mb-3">
      <button type="submit" class="btn btn-primary">Update Password</button>
     </div>
    </div>
   </div>
  </form>
</div>

{{-- doctor information --}}
<div class="card">
 <form action="{{route('doctor.profile_update')}}" method="post" enctype="multipart/form-data">
  @csrf
  @method('patch')
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Doctor Information</h5>
   </div>
   <div class="row">
      <div class="col-md-6 mb-3">
          <div class="form-group">
              <label for="specialization_id">Specialization <span class="text-danger">*</span></label>
              <select class="form-control"  name="specialization_id" id="specialization_id">
                  <option value="" disabled selected>Select Your Specialization</option>
                  @foreach ($specializations as $specialization)
                      <option value="{{$specialization->id}}" {{$doctor->specialization_id == $specialization->id ? 'selected' : '' }}>{{$specialization->name}}</option>
                  @endforeach
              </select>
              @error('specialization_id')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6 mb-3">
          <div class="form-group">
              <label for="hospital_id">Hospital</label>
              <select class="form-control" name="hospital_id" id="hospital_id">
                  <option value="" disabled selected>Select Your hospital</option>
                  @foreach ($hospitals as $hospital)
                      <option value="{{$hospital->id}}" {{$doctor->hospital_id == $hospital->id ? 'selected' : '' }}>{{$hospital->name}}</option>
                  @endforeach
              </select>
              @error('hospital_id')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6 mb-3">
          <div class="form-group">
              <label for="years_of_experience">Years of Experience</label>
              <input type="number" minlength="1" maxlength="2" min="0" max="50" class="form-control" name="years_of_experience" id="years_of_experience" autocomplete="years_of_experience" value="{{$doctor->years_of_experience | 0}}">
              @error('years_of_experience')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="form-group">
            <label for="documents">Doctor Documents</label>   
            <input type="file" multiple class="form-control"  name="documents[]" id="documents" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
            @error('documents')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
     <div class="col-md-12 mb-3">
        <div class="form-group">
            <label for="about">About Me</label>
            <textarea class="form-control" autocomplete="about" name="about" id="about">{{$doctor->about}}</textarea>
            @error('about')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
     <div class="col-md-12 form-group mb-3">
      <button type="submit" class="btn btn-primary">Update Information</button>
     </div>
    </div>
  </div>
 </form>
</div>

{{-- doctor documents --}}
<div class="card">
  <div class="card-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
      <h5 class="card-title fw-semibold mb-4">Doctor Documents</h5>
    </div>
    <form action="{{route('doctor.document_store')}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('post')
      <div class="form-group mb-3">
          <label for="documents">Add Documents</label>   
          <input type="file" multiple class="form-control"  name="documents[]" id="documents" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
          @error('documents')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      <div class="form-group mb-3">
        <button type="submit" class="btn btn-primary">Save Data</button>
      </div>
    </form>
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Name</th>
            <th class="text-center">Type</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($doctor->documents as $document)
              <tr>
                <td>{{basename($document->path)}}</td>
                <td class="text-center">{{$document->type}}</td>
                <td class="d-flex align-items-center justify-content-center text-center gap-2 flex-wrap">
                  <a href="{{asset('storage/'.$document->path)}}" target="__blank" class="btn btn-primary btn-sm">View <i class="ti ti-eye"></i></a>
                  <a href="{{asset('storage/'.$document->path)}}" download="" class="btn btn-success btn-sm">Download <i class="ti ti-download"></i></a>
                  <a href="{{route('doctor.document_delete', $document->id)}}" onclick="return confirm('Are you sure you want to delete this doctor document?')" class="btn btn-danger btn-sm">Delete <i class="ti ti-trash"></i></a>
                </td>
              </tr>
          @empty
              <tr><td colspan="3" class="text-muted text-center">There is no documents for you here!</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('js')
@endsection