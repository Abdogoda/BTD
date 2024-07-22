@extends('layouts.backend.master')
@section('title') Admins @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Admins ({{$admins->count()}})</h5>
    <a href="{{route('admin.admin_create')}}" class="btn btn-primary mb-4">Add New Admin <i class="ti ti-plus"></i></a>
   </div>
   <div class="table-responsive my-4">
    <table class="table align-middle mb-0 bg-white">
      <thead class="bg-light">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($admins as $admin)
          <tr>
            <td>
              <div class="d-flex align-items-center">
                <img
                    src="{{$admin->picture ? asset('storage/'.$admin->picture) : asset('assets/backend/images/profile/user-1.jpg')}}"
                    class="rounded-circle"
                    alt="admin logo"
                    style="width: 45px; height: 45px"
                    />
                <div class="ms-3">
                  <p class="fw-bold mb-1">{{$admin->first_name.' '.$admin->last_name}}</p>
                </div>
              </div>
            </td>
            <td><a href="mailto:{{$admin->email}}" class="fw-normal mb-1">{{$admin->email}}</a></td>
            <td><a href="tel:{{$admin->phone}}">{{$admin->phone}}</a></td>
            <td>
              <a href="{{route('admin.profile')}}" class="btn btn-outline-primary btn-rounded fw-bold {{$admin->id == auth()->user()->id ? "" : "disabled"}}">Edit</a>
            </td>
          </tr>
        @empty
            
        @endforelse
      </tbody>
    </table>
   </div>
 </div>
</div>
@endsection

@section('js')
@endsection