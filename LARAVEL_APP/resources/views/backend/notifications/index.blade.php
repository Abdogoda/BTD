@extends('layouts.backend.master')
@section('title') Notifications @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
   <h5 class="card-title fw-semibold mb-4">All Notifications</h5>
   <a href="{{auth()->user()->role == 'admin' ? route('admin.notifications_read') : route('doctor.notifications_read')}}" class="btn btn-primary mb-4">Mark All As Read ({{$unreaded_count}})</a>
  </div>
   <div class="mt-3">
    @forelse ($notifications as $notification)
        <div class="border-bottom mt-3 p-2 {{$notification->read == '0' ? 'bg-light' : ''}}">
         <div class="d-flex align-items-center justify-content-between flex-wrap">
          <div class="d-flex gap-2">
           <h5 class="text-primary">From <a class="text-primary" href="{{route('index')}}">BTD</a></h5>
          <i class="text-muted">{{$notification->created_at->diffForHumans()}}</i>
          </div>
          <div class="d-flex align-items-center gap-2">
           @if ($notification->read == '0')
             <a href="{{route('notification_read', $notification)}}" class="btn btn-sm btn-primary" title="Mark as read"><i class="ti ti-eye"></i></a>
           @endif
           <a href="{{route('notification_delete', $notification)}}" class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></a>
          </div>
         </div>
         
         <p class="mt-3">{!! $notification->message !!}</p>
        </div>
    @empty
        <div class="border p-2 text-center text-muted">There is no notifications for you yet!</div>
    @endforelse
   </div>
 </div>
</div>
@endsection

@section('js')
@endsection