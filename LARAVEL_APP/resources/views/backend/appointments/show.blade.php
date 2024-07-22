@extends('layouts.backend.master')
@section('title') Appointment {{$appointment->id}} @endsection
@section('css')
<style>
  #printableContent {
        display: none;
    }
  @media print {
    #printableContent {
      display: block;
    }
    .nonPrintableContent, header{
      display: none;
    }
  }
</style>
@endsection
@section('content')
<div class="nonPrintableContent">
  <div class="card">
    <div class="card-body">
      <div class="d-flex mb-3 flex-wrap align-items-center justify-content-between">
        <h5 class="card-title fw-semibold mb-1">Appointment: {{$appointment->id}}</h5>
        <p class="mb-1"><a href="{{route('doctor.appointments')}}">Appointments</a> / {{$appointment->id}}</p>
      </div>
      <p><b>Patient Name:</b> {{$appointment->patient_name}}</p>
      @if ($appointment->patient_phone) <p><b>Patient Phone:</b> {{$appointment->patient_phone}}</p> @endif
      @if ($appointment->patient_age) <p><b>Patient Age:</b> {{$appointment->patient_age}} Years Old</p> @endif
      @if ($appointment->patient_gender) <p><b>Patient Gender:</b> {{$appointment->patient_gender}}</p> @endif
      <hr>
      <p><b>Clinic Name:</b> <a href="{{route('doctor.clinic', $appointment->clinic_id)}}">{{$appointment->clinic->name}}</a></p>
      <p><b>Clinic Address:</b> <a href="{{$appointment->clinic->address}}">{{$appointment->clinic->address}}</a></p>
      <hr>
      <p><b>Appointment Price:</b> <span class="text-success">{{$appointment->appointment_price}} EGP  </span></p>
      <p><b>Appointment Date:</b> {{$appointment->appointment_date}} ({{$appointment->appointment_day}})</p>
      <p><b>Appointment Time:</b> {{$appointment->appointment_time}}</p>
      <p><b>Appointment Number:</b> <span class="badge bg-success">{{$appointment->appointment_number}}</span></p>
      <p><b>Appointment Type:</b> <i class="text-uppercase">{{$appointment->appointment_type}}</i></p>
      @if ($appointment->status == 'pending')
        <?php $color = 'warning'?>
      @elseif ($appointment->status == 'completed')
        <?php $color = 'success'?>
      @else
        <?php $color = 'danger'?>
      @endif
      <p><b>Appointment Status:</b> <span class="badge bg-{{$color}} text-capitalize">{{$appointment->status}}</span></p>
      @if ($appointment->message) <p><b>Appointment Message:</b> {{$appointment->message}}</p> @endif
      <hr>
      @if ($appointment->status == 'pending')
        <div class="my-4 d-flex gap-2 flex-wrap align-items-center">
          <form action="{{route('doctor.appointment_update_staus', $appointment)}}" method="post">
            @csrf
            <input type="hidden" name="status" value="completed">
            <button type="submit" class="btn btn-success" onclick="return confirm('Sure you want to complete this appointment?')">Complete Appointment</button>
          </form>
          <form action="{{route('doctor.appointment_update_staus', $appointment)}}" method="post">
            @csrf
            <input type="hidden" name="status" value="cancelled">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Sure you want to cancel this appointment?')">Cancel Appointment</button>
          </form>
        </div>
      @endif
    </div>
  </div>
  
  <div class="card mt-4">
    @if ($appointment->status == 'pending')
      <div class="card-body">
        <h3>Add a Report</h3>
        <form action="{{route('doctor.appointment_add_report', $appointment)}}" method="post">
          @csrf
          <div class="form-group mb-3">
            <label for="diagnosis">Appointment Diagnosis</label>
            <input type="text" class="form-control" name="diagnosis" id="diagnosis" value="{{old('diagnosis')}}" >
            @error('diagnosis')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-3">
            <label for="report">Appointment Report</label>
            <textarea id="report" name="report" rows="10" >{{old('report')}}</textarea>
            @error('report')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Add Report</button>
          </div>
        </form>
      </div>
    @elseif($appointment->status == 'completed' && isset($appointment->report))
      <div class="card-body">
        <h3 class="mb-3">Appointment Report</h3>
        <div class="border p-3">
          <h4>{{$appointment->report->diagnosis}}</h4>
          <p>{!! $appointment->report->report !!}</p>
          <div class="mt-3"><button onclick="printReport()" class="btn btn-primary">Print Report</button></div>
        </div>
      </div>
    @endif
  </div>
</div>


@if($appointment->report)
  <div id="printableContent">
    <div class="d-flex align-items-center gap-2">
      <img src="{{asset('assets/frontend/images/logo.png')}}" width="100px" height="100px" alt="BDT LOGO">
      <div>
        <h2>{{$siteSettings['name']->value ?? 'BDT'}}</h2>
        <p><b>Your Health Care Solution</b></p>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-6">
        <table class="mt-3 middle-center table table-bordered">
          <tbody>
            <tr>
              <td><b>Doctor:</b></td>
              <td>{{ auth()->user()->first_name." ".auth()->user()->last_name }}</td>
            </tr>
            <tr>
              <td><b>Clinic:</b></td>
              <td>{{ $appointment->clinic->name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-6">
        <table class="mt-3 middle-center table table-bordered">
          <tbody>
            <tr>
              <td><b>Patient:</b></td>
              <td>{{ $appointment->patient_name }}</td>
            </tr>
            <tr>
              <td><b>Date:</b></td>
              <td>{{ $appointment->appointment_date }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <table class="mt-3 middle-center table table-bordered">
      <tbody>
        <tr>
          <td><b>Diagnosis:</b></td>
          <td>{{ $appointment->report->diagnosis }}</td>
        </tr>
      </tbody>
    </table>
    <h1 class="mt-3">Report Details</h1>
    <p>{!! $appointment->report->report !!}</p>
  </div>
@endif
@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea#report',
  menubar: false,
  plugins: 'code table lists',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table ',
});
</script>
@if ($appointment->status == 'completed')
    <script>
        function printReport() {
            window.print();
        }
    </script>
@endif
@endsection