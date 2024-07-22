@extends('layouts.backend.master')
@section('title') Settings @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
   <h5 class="card-title fw-semibold mb-4">All Website Settings</h5>
  </div>
  <div class="mt3">
   @forelse ($settings as $setting)
       <form action="{{route('admin.setting_update', $setting)}}" method="post" class="mt-4">
         @csrf
         @method('put')
         <div class="form-group mb-2">
          <label for="{{$setting->key}}" class="text-capitalize">{{$setting->key}}</label>
          <textarea name="value" class="form-control" rows="5" id="{{$setting->key}}" required>{{$setting->value}}</textarea>
         </div>
         <button type="submit" class="btn btn-primary">Update</button>
       </form>
   @empty
       
   @endforelse
  </div>
 </div>
</div>
@endsection

@section('js')
@endsection