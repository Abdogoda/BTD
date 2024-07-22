@extends('layouts.backend.master')
@section('title') Tumors @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Tumors ({{$all_tumors_count}})</h5>
    <a href="{{route('admin.tumor_create')}}" class="btn btn-primary mb-4">Add New Tumor <i class="ti ti-plus"></i></a>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table text-center align-middle">
        <thead>
          <tr>
            <td>#</td>
            <td>Image</td>
            <td>Title</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>
          @forelse ($tumors as $tumor)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td><img src="{{$tumor->picture ? asset('storage/'.$tumor->picture) : asset('assets/frontend/images/defualts/tumor.jpg')}}" alt="tumor image" style="width: 50px; height:50px" class="rounded-circle"></td>
              <td>{{$tumor->title}}</td>
              <td class="d-flex justify-content-center gap-2">
                <a href="{{route('admin.tumor', $tumor)}}" class="btn btn-primary">Show / Edit</a>
                <a href="{{route('admin.tumor_delete', $tumor)}}" onclick="return confirm('Are you sure to delete this tumor?')" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          @empty
              <tr><td colspan="4" class="text-center text-muted">There Is No Tumors Available!</td></tr>
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