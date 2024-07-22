@extends('layouts.backend.master')
@section('title') Clinics @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All clinics ({{$all_clinics_count}})</h5>
    <a href="{{route('doctor.clinic_create')}}" class="btn btn-primary mb-4">Add New Clinic <i class="ti ti-plus"></i></a>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Schedule</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($clinics as $clinic)
            <tr>
              <td>{{$clinic->name}}</td>
              <td>{{$clinic->address}}</td>
              <td>
                <ul>
                  @forelse ($clinic->clinic_schedule as $day)
                    <li style="list-style-type: circle;"><span class="text-capitalize">{{$day->day}}</span> {{$day->start_time->format('h:i A')}} - {{$day->end_time->format('h:i A')}}</li>
                  @empty
                    <li><b><i>No Scheduled Days</i></b></li>
                  @endforelse
                </ul>
              </td>
              <td>{{$clinic->visiting_price}} EGP / {{$clinic->follow_up_price}} EGP</td>
              <td><a href="{{route('doctor.clinic', $clinic)}}" class="btn btn-primary">View</a></td>
           </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center text-muted">There Is No Clinics Available!</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
 </div>
</div>
@endsection

@section('js')
@endsection