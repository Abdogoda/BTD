@extends('layouts.backend.master')
@section('title') Messages @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
   <h5 class="card-title fw-semibold mb-4">All Messages</h5>
   <a href="{{route('admin.messages_read')}}" class="btn btn-primary mb-4">Mark All As Read ({{$unreaded_count}})</a>
  </div>
   <div class="mt-3">
    @forelse ($messages as $message)
        <div class="border-bottom mt-3">
         <div class="d-flex align-items-center justify-content-between flex-wrap">
          <div>
            <div class="d-flex gap-2">
              <h5>{{$message->name}} <small>(<i class="text-muted">{{$message->created_at->diffForHumans()}}</i>)</small></h5>
             </div>
             <a href="mailto:{{$message->email}}">{{$message->email}}</a>
          </div>
          <div class="d-flex align-items-center gap-2">
           @if ($message->read == '0')
             <a href="{{route('admin.message_read', $message)}}" class="btn btn-sm btn-primary" title="Mark as read"><i class="ti ti-eye"></i></a>
           @endif
           <a href="{{route('admin.message_delete', $message)}}" class="btn btn-sm btn-danger" title="Delete"><i class="ti ti-trash"></i></a>
          </div>
         </div>
         
         <p class="mt-3" style="{{$message->read == '0' ? 'font-weight:bold' : ''}}">{{ $message->message }}</p>
        </div>
    @empty
        <div class="border p-2 text-center text-muted">There is no messages for you yet!</div>
    @endforelse
   </div>
 </div>
</div>
@endsection

@section('js')
@endsection