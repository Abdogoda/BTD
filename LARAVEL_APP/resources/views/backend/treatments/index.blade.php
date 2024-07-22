@extends('layouts.backend.master')
@section('title') Treatments @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Treatments ({{$all_treatments_count}})</h5>
    <a href="{{route('admin.treatment_create')}}" class="btn btn-primary mb-4">Add New Treatment <i class="ti ti-plus"></i></a>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <td>#</td>
            <td>Title</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          @forelse ($treatments as $treatment)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$treatment->title}}</td>
              <td class="d-flex justify-content-center gap-2">
                <a href="{{route('admin.treatment', $treatment)}}" class="btn btn-primary">Show / Edit</a>
                <a href="{{route('admin.treatment_delete', $treatment)}}" onclick="return confirm('Are you sure to delete this treatment?')" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          @empty
              <tr><td colspan="3" class="text-center text-muted">There Is No treatments Available!</td></tr>
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