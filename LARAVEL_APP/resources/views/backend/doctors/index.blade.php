@extends('layouts.backend.master')
@section('title') Doctors @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Doctors ({{$all_doctors_count}})</h5>
   </div>
   <div class="row">
    @forelse ($doctors as $doctor)
      <div class="col-sm-6 col-xl-3">
        <div class="card overflow-hidden rounded-2">
          <div class="position-relative">
            <a href="{{route('admin.doctor', $doctor)}}"><img src="{{$doctor->user->picture ? asset('storage/'.$doctor->user->picture) : asset('assets/frontend/images/team/4.jpg')}}" class="card-img-top rounded-0" alt="doctor-image"></a>
            <a href="#"
                  class="bg-{{$doctor->user->status == "active" ? "primary" :"danger"}} rounded-circle p-2 text-white d-inline-flex position-absolute top-0 end-0 mt-1 me-1"><i class="ti ti-{{$doctor->user->status == "active" ? "check" :"xbox-x"}} fs-4"></i></a>
          </div>
          <div class="card-body pt-3 p-4">
            <h6 class="fw-semibold fs-4">{{$doctor->user->first_name}} {{$doctor->user->last_name}}</h6>
            <h6 class="fw-semibold fs-4 mb-0 text-muted">{{$doctor->specialization->name}}</h6>
          </div>
        </div>
      </div>
    @empty
        <h3 class="col-12 text-center text-muted p-2 border">There Are No Doctors Available!</h3>
    @endforelse
  </div>
  <div class="mt-3">{{$doctors->links()}}</div>
 </div>
</div>
@endsection

@section('js')
@endsection