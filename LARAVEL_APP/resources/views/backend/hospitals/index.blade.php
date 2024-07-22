@extends('layouts.backend.master')
@section('title') Hospitals @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Hospitals ({{$all_hospitals_count}})</h5>
    <a href="{{route('admin.hospital_create')}}" class="btn btn-primary mb-4">Add New Hospital <i class="ti ti-plus"></i></a>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table text-center align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Doctors</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($hospitals as $hospital)
            <tr>
              <td>{{$hospital->id}}</td>
              <td><img src="{{$hospital->picture ? asset('storage/'.$hospital->picture) : asset('assets/frontend/images/defualts/hospital-defualt.jpg')}}" alt="hospital image" style="width: 50px; height:50px" class="rounded-circle"></td>
              <td>{{$hospital->name}}</td>
              <td>{{$hospital->phone}}</td>
              <td>{{$hospital->email}}</td>
              <td>{{$hospital->doctors->count()}}</td>
              <td><a href="{{route('admin.hospital', $hospital)}}" class="btn btn-primary">View Details</a></td>
           </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted">There Is No Hospitals Available!</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      {{$hospitals->links()}}
    </div>
  </div>
 </div>
</div>
@endsection

@section('js')
@endsection