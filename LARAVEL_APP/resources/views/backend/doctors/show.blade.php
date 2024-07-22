@extends('layouts.backend.master')
@section('title') {{$doctor->user->first_name." ".$doctor->user->last_name}} @endsection
@section('css')
@endsection
@section('content')
<div class="card">
  <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-1">Doctor: {{$doctor->user->first_name." ".$doctor->user->last_name}}</h5>
    <p class="mb-1"><a href="{{route('admin.doctors')}}">Doctors</a> / {{$doctor->user->first_name." ".$doctor->user->last_name}}</p>
   </div>
    <div class="row">
     <div class="col-md-4 mt-4">
      <img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/4.jpg')}}" alt="doctor image" class="img-fluid">
     </div>
     <div class="col-md-8 mt-4">
      <p><b>Name: </b>{{$doctor->user->first_name." ".$doctor->user->last_name}}</p>
      <p><b>Specialization: </b>{{$doctor->specialization->name}}</p>
      <p><b>Hospital : </b> <a href="{{route('hospitals.show', $doctor->hospital)}}">{{$doctor->hospital->name}}</a></p>
      <p><b>Phone: </b> <a href="tel:{{$doctor->user->phone}}" target="_blank">{{$doctor->user->phone}}</a></p>
      <p><b>Email: </b> <a href="mailto:{{$doctor->user->email}}" target="_blank">{{$doctor->user->email}}</a></p>
      @if ($doctor->hospital_id)
      @endif
      @if ($doctor->user->gender)
      <p><b>Gender: </b> {{$doctor->user->gender}}</p>
      @endif
      @if ($doctor->user->year_of_birth)
      <p><b>Age:</b> {{\Carbon\Carbon::createFromDate($doctor->user->year_of_birth)->diffInYears(\Carbon\Carbon::now())}} Years Old</p> 
      @endif
      @if ($doctor->years_of_experience)
        <p>{{$doctor->years_of_experience}} Year Of Experiences</p>
      @endif
      @if ($doctor->clinics->count() > 0)
        <p>{{$doctor->clinics->count()}} Clinics</p>
      @endif
      <p>{{$doctor->about}}</p>
     <div class="form-group mb-3 d-flex gap-2 flex-wrap align-items-center">
      <a href="{{route('admin.doctor_change_status', $doctor)}}" onclick="return confirm('Sure you want to change the doctor status?')" class="btn btn-{{$doctor->user->status == 'active' ? "danger" : "success"}}">{{$doctor->user->status == 'active' ? "Deactivate" : "Activate"}} Doctor</a>
     </div>
     </div>
    </div>
  </div>
</div>

@if ($doctor->documents->count() > 0)
  <div class="card card-body mt-4">
    <h3>Doctor Documents</h3>
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
                </td>
              </tr>
          @empty
              <tr><td class="text-muted">There is no documents for you here!</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endif

@if ($doctor->clinics->count() > 0)
  <div class="card card-body mt-4">
    <h3>Doctor Clinics</h3>
    <div class="row my-3">
      @foreach ($doctor->clinics as $clinic)
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{$clinic->name}}</h5><br>
              <p class="card-text"><i class="ti ti-map-pin mr-2"></i>{{$clinic->address}}</p>
              <p class="card-text"><i class="ti ti-phone mr-2"></i>{{$clinic->phone}}</p>
              <p class="card-text"><b>Visiting Price:</b>{{$clinic->visiting_price}} EGP</p>
              <p class="card-text"><b>Follow Up Price:</b>{{$clinic->follow_up_price}} EGP</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="card card-body mt-4">
    <h3>Doctor Schedule</h3>
    <div class="table-responsive">
      <table class="table align-middle my-3 bg-white">
        <thead class="bg-light">
          <tr>
            <th>Day</th>
            <th>Time</th>
            <th>Clinic</th>
            <th>Phone</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($doctor->schedule as $day)
            <tr>
              <td><h6 class="text-uppercase">{{$day->day}}</h6></td>
              <td>{{$day->start_time}} - {{$day->end_time}}</td>
              <td>{{$day->clinic->name}}</td>
              <td><a href="tel:{{$day->clinic->phone}}">{{$day->clinic->phone}}</a></td>
              <td><a href="{{$day->clinic->location}}">{{$day->clinic->address}}</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endif
@endsection

@section('js')
@endsection