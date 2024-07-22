@extends('layouts.backend.master')
@section('title') Dashbaord @endsection
@section('css')
@endsection
@section('content')
 <!--  Row 1 -->
 <div class="row">
  <div class="col-12">
    <div class="card w-100">
      <div class="card-body d-flex align-items-center flex-wrap justify-content-between">
        <h6 class="text-muted">Welcome Back Dr/ {{auth()->user()->first_name}} {{auth()->user()->last_name}}</h6>
        <a href="{{route('doctor.profile')}}" class="btn btn-primary">View Profile  </a>
      </div>
    </div>
  </div>
   <div class="col-lg-8 d-flex align-items-strech">
     <div class="card w-100">
       <div class="card-body">
         <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
           <div class="mb-3 mb-sm-0">
             <h5 class="card-title fw-semibold">Try Our Official Brain Tumor Detection AI Models Now</h5>
           </div>
         </div>
         <div class="row">
          <div class="col-lg-6">
            <img src="{{asset('assets/backend/images/cancer.svg')}}" alt="cancer image" style="max-width: 100%;">
          </div>
          <div class="col-lg-6">
            <img src="{{asset('assets/backend/images/brain.svg')}}" alt="brain image" style="max-width: 100%;">
          </div>
         </div>
         <div><a href="{{route('doctor.detections.create')}}" class="btn btn-primary mt-3">Try it out now</a></div>
        </div>
        
     </div>
   </div>
   <div class="col-lg-4">
     <div class="row">
       <div class="col-lg-12">
         <!-- Yearly Breakup -->
         <div class="card overflow-hidden">
           <div class="card-body p-4">
             <h5 class="card-title mb-9 fw-semibold">Appointments Status</h5>
             <div class="row align-items-center">
               <div class="col-8">
                 <h4 class="fw-semibold mb-3">{{$all_appointments}} <small class="text-muted fw-light">+</small></h4>
                 <div class="d-flex align-items-center mb-3">
                   <span
                     class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                     <i class="ti ti-arrow-up-left text-success"></i>
                   </span>
                   <p class="text-dark me-1 fs-3 mb-0">+{{100 * $this_month_appointments / ($all_appointments == 0 ? 1 : $all_appointments)}}%</p>
                   <p class="fs-3 mb-0">last month</p>
                 </div>
               </div>
               <div class="col-4">
                 <div class="d-flex justify-content-center">
                   <div id="order_status"></div>
                 </div>
               </div>
               <div class="col-12">
                <div class="d-flex align-items-center">
                  <div class="me-4">
                    <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                    <span class="fs-2">Completed</span>
                  </div>
                  <div class="me-4">
                    <span class="round-8 bg-warning rounded-circle me-2 d-inline-block"></span>
                    <span class="fs-2">Pending</span>
                  </div>
                  <div>
                    <span class="round-8 bg-danger rounded-circle me-2 d-inline-block"></span>
                    <span class="fs-2">Cancelled</span>
                  </div>
                </div>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col-lg-12">
         <!-- Monthly Earnings -->
         <div class="card">
           <div class="card-body">
             <div class="row alig n-items-start">
               <div class="col-8">
                 <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                 <h4 class="fw-semibold mb-3">{{$currentMonthEarnings}} EGP</h4>
                 <div class="d-flex align-items-center pb-1">
                   <span
                     class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                     <i class="ti ti-arrow-up-right text-success"></i>
                   </span>
                   <p class="text-dark me-1 fs-3 mb-0">{{100 * ($currentMonthEarnings - $previousMonthEarnings) / (($currentMonthEarnings + $previousMonthEarnings) == 0 ? 1 : ($currentMonthEarnings + $previousMonthEarnings))}}%</p>
                   <p class="fs-3 mb-0">last month</p>
                 </div>
               </div>
               <div class="col-4">
                 <div class="d-flex justify-content-end">
                   <div
                     class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                     <i class="ti ti-currency-dollar fs-6"></i>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <div id="earning"></div>
         </div>
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
         <ul class="timeline-widget mb-0 position-relative mb-n5">
           @forelse ($recent_detections as $detection)
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">{{$detection->created_at->diffForHumans()}}</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border border-primary flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-{{$detection->detection_result == 0 ? 'success' : 'danger'}} mt-n1">{{$detection->detection_result == 0 ? 'There is no tumor' : 'There is tumor found'}}</div>
              </li>
           @empty
               
           @endforelse
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
                 <th class="border-bottom-0">
                   <h6 class="fw-semibold mb-0">Id</h6>
                 </th>
                 <th class="border-bottom-0">
                   <h6 class="fw-semibold mb-0">Patient</h6>
                 </th>
                 <th class="border-bottom-0">
                   <h6 class="fw-semibold mb-0">Clinic</h6>
                 </th>
                 <th class="border-bottom-0">
                   <h6 class="fw-semibold mb-0">Status</h6>
                 </th>
                 <th class="border-bottom-0">
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
                      <p class="mb-0 fw-normal">{{$appointment->clinic->name}}</p>
                    </td>
                    <td class="border-bottom-0">
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
                      <h6 class=" mb-0 fs-4">{{$appointment->appointment_date}}</h6>
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
<script>
  $(function () {

// =====================================
// order_status
// =====================================
if(document.querySelector("#order_status")){
  var order_status = {
    color: "#adb5bd",
    series: [{{$completed_appointments}}, {{$pending_appointments}}, {{$cancelled_appointments}}],
    labels: ["Completed", "Pending", "Cancelled"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#13DEB9", "#FFAE1F", "#FA896B"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };
  new ApexCharts(document.querySelector("#order_status"), order_status).render();
}



// =====================================
// Earning
// =====================================
if(document.querySelector("#earning")){
  // Prepare data
  const monthlySums = @json($monthly_sums);
  const months = [];
  const sums = [];
  
  for (let i = 1; i <= 12; i++) {
      const monthData = monthlySums.find(item => item.month == i);
      months.push(new Date(0, i - 1).toLocaleString('default', { month: 'long' }));
      sums.push(monthData ? parseFloat(monthData.total) : 0);
  }

  var earning = {
    chart: {
      id: "sparkline3",
      type: "area",
      height: 60,
      sparkline: {
        enabled: true,
      },
      group: "sparklines",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    series: [
      {
        name: "Earnings",
        color: "#49BEFF",
        data: sums,
      },
    ],
    stroke: {
      curve: "smooth",
      width: 2,
    },
    fill: {
      colors: ["#f3feff"],
      type: "solid",
      opacity: 0.05,
    },

    markers: {
      size: 0,
    },
    tooltip: {
      theme: "dark",
      fixed: {
        enabled: true,
        position: "right",
      },
      x: {
        show: false,
      },
    },
  };
  new ApexCharts(document.querySelector("#earning"), earning).render();
}


})
</script>
<script src="{{asset('assets/backend/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
@endsection