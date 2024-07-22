@extends('layouts.backend.master')
@section('title') Dashbaord @endsection
@section('css')
<style>
  .dashboard-box .card, .dashboard-box .dashboard-box-icon{
    transition: 0.3s;
    cursor: default;
  }
  .dashboard-box.primary .dashboard-box-icon{
    color: var(--bs-primary)
  }
  .dashboard-box.danger .dashboard-box-icon{
    color: var(--bs-danger)
  }
  .dashboard-box.warning .dashboard-box-icon{
    color: var(--bs-warning)
  }
  .dashboard-box.success .dashboard-box-icon{
    color: var(--bs-success)
  }
  .dashboard-box:hover .card, .dashboard-box:hover h1, .dashboard-box:hover .dashboard-box-icon{
    color: #fff !important;
  }
  .dashboard-box.primary:hover .card{
    background: var(--bs-primary)
  }
  .dashboard-box.danger:hover .card{
    background: var(--bs-danger)
  }
  .dashboard-box.warning:hover .card{
    background: var(--bs-warning)
  }
  .dashboard-box.success:hover .card{
    background: var(--bs-success)
  }
</style>
@endsection
@section('content')
 <!--  Row 1 -->
  <div class="row">
      <div class="col-12">
        <div class="card w-100">
          <div class="card-body d-flex align-items-center flex-wrap justify-content-between">
            <h6 class="text-muted">Welcome Back Admin/ {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h6>
            <a href="{{route('admin.profile')}}" class="btn btn-primary">View Profile  </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 dashboard-box primary">
        <div class="card card-body">
          <div class="d-flex justify-content-between gap-3 align-items-center">
            <div>
              <p>Total Admins</p>
              <h1 class="fw-bold">{{$admins}}</h1>
            </div>
            <h1><i class="ti ti-settings dashboard-box-icon"></i></h1>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 dashboard-box warning">
        <div class="card card-body">
          <div class="d-flex justify-content-between gap-3 align-items-center">
            <div>
              <p>Total Patients</p>
              <h1 class="fw-bold">{{$users}}</h1>
            </div>
            <h1><i class="ti ti-users dashboard-box-icon"></i></h1>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 dashboard-box danger">
        <div class="card card-body">
          <div class="d-flex justify-content-between gap-3 align-items-center">
            <div>
              <p>Expert Doctors</p>
              <h1 class="fw-bold">{{$doctors}}</h1>
            </div>
            <h1><i class="ti ti-stethoscope dashboard-box-icon"></i></h1>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 col-xl-3 dashboard-box success">
        <div class="card card-body">
          <div class="d-flex justify-content-between gap-3 align-items-center">
            <div>
              <p>Appointments</p>
              <h1 class="fw-bold">{{$appointments}}</h1>
            </div>
            <h1><i class="ti ti-medal dashboard-box-icon"></i></h1>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <div class="mb-4">
            <h5 class="card-title fw-semibold">Recent Detections</h5>
          </div>
          <ul class="timeline-widget position-relative mb-3">
            @foreach ($recent_detections as $detection)
               <li class="timeline-item d-flex position-relative overflow-hidden">
                 <div class="timeline-time text-dark flex-shrink-0 text-end">{{$detection->created_at->diffForHumans()}}</div>
                 <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                   <span class="timeline-badge border border-primary flex-shrink-0 my-8"></span>
                   <span class="timeline-badge-border d-block flex-shrink-0"></span>
                 </div>
                 <div class="timeline-desc fs-3">
                  <a href="{{route('admin.doctor', $detection->doctor)}}">Dr/ {{$detection->doctor->user->first_name}}</a> <br>
                  <span class="text-{{$detection->detection_result == 0 ? 'success' : 'danger'}}">{{$detection->detection_result == 0 ? 'There is no tumor' : 'There is tumor found'}}</span>
                 </div>
               </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-8 d-flex align-items-stretch">
      <div class="card w-100">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold mb-4">Recent Appointments</h5>
          <div class="table-responsive">
            <table class="table text-nowrap mb-0 align-middle text-center">
              <thead class="text-dark fs-4">
                <tr>
                  <th class="">
                    <h6 class="fw-semibold mb-0">Id</h6>
                  </th>
                  <th class="">
                    <h6 class="fw-semibold mb-0">Patient</h6>
                  </th>
                  <th class="">
                    <h6 class="fw-semibold mb-0">Doctor</h6>
                  </th>
                  <th class="">
                    <h6 class="fw-semibold mb-0">Status</h6>
                  </th>
                  <th class="">
                    <h6 class="fw-semibold mb-0">Date</h6>
                  </th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($recent_appointments as $appointment)
                   <tr>
                     <td class="border-bottom-0">
                       <h6 class=" mb-0">{{$appointment->id}}</h6>
                     </td>
                     <td class="border-bottom-0">
                       <h6 class=" mb-1">{{$appointment->user->first_name ?? 'Deleted'}}</h6>
                     </td>
                     <td class="border-bottom-0">
                       <p class="mb-0"><a href="{{route('admin.doctor', $appointment->doctor)}}">{{$appointment->doctor->user->first_name}}</a></p>
                     </td>
                     <td class="border-bottom-0 text-center">
                       <div class="d-flex align-items-center gap-2">
                         @if ($appointment->status == 'pending')
                           <?php $color = 'warning'?>
                         @elseif ($appointment->status == 'completed')
                           <?php $color = 'success'?>
                         @else
                           <?php $color = 'danger'?>
                         @endif
                         <span class="badge bg-{{$color}} rounded-3 ">{{$appointment->status}}</span>
                       </div>
                     </td>
                     <td class="border-bottom-0">
                       <h6 class=" mb-0 fs-4">{{$appointment->created_at->diffForHumans()}}</h6>
                     </td>
                   </tr>
                 @empty
                     <tr>
                       <td colspan="6" class="text-muted text-center"></td>
                     </tr>
                 @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="{{asset('assets/backend/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
@endsection