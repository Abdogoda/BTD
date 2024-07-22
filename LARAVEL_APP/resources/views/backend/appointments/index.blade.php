@extends('layouts.backend.master')
@section('title') Appointments @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">Your Appointments ({{$all_appointments_count}})</h5>
    <d-flex class="gap-2 flex-wrap align-items-center justify-content-end">
      <a href="{{ route('doctor.appointments', ['status' => 'pending']) }}" class="btn btn-sm btn-warning">Pending</a>
      <a href="{{ route('doctor.appointments', ['status' => 'completed']) }}" class="btn btn-sm btn-success">Completed</a>
      <a href="{{ route('doctor.appointments', ['status' => 'cancelled']) }}" class="btn btn-sm btn-danger">Cancelled</a>
      <a href="{{ route('doctor.appointments') }}" class="btn btn-sm btn-primary">All</a>
    </d-flex>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table align-middle text-center">
        <thead>
          <tr>
            <th>Patient</th>
            <th>Clinic</th>
            <th>Date</th>
            <th>Time</th>
            <th>Number</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($appointments as $appointment)
            <tr>
              <td>{{$appointment->patient_name}}</td>
              <td><a href="{{route('doctor.clinic', $appointment->clinic)}}">{{$appointment->clinic->name}}</a></td>
              <td>{{$appointment->appointment_date .' ('.$appointment->appointment_day.')'}}</td>
              <td>{{$appointment->appointment_time}}</td>
              <td>{{$appointment->appointment_number}}</td>
              <td><i class="text-uppercase">{{$appointment->appointment_type}}</i></td>
              @if ($appointment->status == 'pending')
                <?php $color = 'warning'?>
              @elseif ($appointment->status == 'completed')
                <?php $color = 'success'?>
              @else
                <?php $color = 'danger'?>
              @endif
              <td><span class="badge bg-{{$color}} text-capitalize">{{$appointment->status}}</span></td>
              <td><a href="{{route('doctor.appointment', $appointment)}}" class="btn btn-primary">View</a></td>
           </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center text-muted">There Is No appointments Available!</td>
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