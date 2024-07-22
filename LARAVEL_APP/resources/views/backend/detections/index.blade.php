@extends('layouts.backend.master')
@section('title') Detections @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex align-items-center justify-content-between flex-wrap">
    <h5 class="card-title fw-semibold mb-4">All Detections ({{$detections->count()}})</h5>
    <a href="{{route('doctor.detections.create')}}" class="btn btn-primary mb-4">Make New Detection <i class="ti ti-plus"></i></a>
   </div>
   <div class="row">
    <div class="table-responsive">
      <table class="table text-center align-middle table-bordered">
        <thead>
          <tr>
            <td>Input Image</td>
            <td>Output Image</td>
            <td>Detection Result</td>
            <td>Classification Result</td>
            <td>Date</td>
          </tr>
        </thead>
        <tbody>
          @forelse ($detections as $detection)
            <tr>
              <td>
                <a href="{{asset('storage/'.$detection->input_image)}}" target="__blank">
                  <img src="{{asset('storage/'.$detection->input_image)}}" alt="input detection image" style="width: 50px; height:50px">
                </a>
              </td>
              <td>
                <a href="{{asset('storage/'.$detection->output_image)}}" target="__blank">
                  <img src="{{asset('storage/'.$detection->output_image)}}" alt="output detection image" style="width: 50px; height:50px">
                </a>
              </td>
              <td><span class="badge bg-{{$detection->detection_result == 0 ? 'success' : 'danger'}}">{{$detection->detection_result == 0 ? 'No Tumor' : 'Tumor Found'}}</span></td>
              <td>{{ucwords(str_replace('_', ' ', $detection->classification_result))}}</td>
              <td>{{$detection->created_at->diffForHumans()}}</td>
            </tr>
          @empty
              <tr><td colspan="5" class="text-center text-muted">There Is No Detections Available!</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    {{$detections->links()}}
  </div>
 </div>
</div>
@endsection

@section('js')
@endsection