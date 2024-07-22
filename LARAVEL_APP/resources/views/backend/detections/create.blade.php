@extends('layouts.backend.master')
@section('title') Make Detection @endsection
@section('css')
@section('css')
<style>
  #printableContent {
        display: none;
    }
  @media print {
    #printableContent {
      display: block;
    }
    #nonPrintableContent, header, .toast-container{
      display: none !important;
    }

    @page {
        margin: 0;
    }
    
    body {
        margin: 0 15px;
    }
  }
</style>
@endsection
@section('content')
<div id="nonPrintableContent">
  <div class="card">
    <div class="card-body">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h5 class="card-title fw-semibold mb-4">Make New Detection</h5>
        <p class="mb-4"><a href="{{route('doctor.detections')}}">Detections</a> / New</p>
      </div>
      <form action="{{route('doctor.detections.store')}}" method="post" class="card" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="form-group mb-3">
                <label for="picture" class="form-label">Detection Input Image</label>
                <input type="file" class="form-control" name="picture" id="picture" required value="{{old('picture')}}" accept=".jpg,.jpeg,.png,.svg,.webp" >
                @error('picture')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <button type="submit" class="btn btn-primary">Detect & Classify Tumor <i class="ti ti-brain"></i></button>
                <button type="button" id="cancelImagePreview" class="btn btn-outline-danger" style="display: none">Cancel</button>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <img src="" alt="detection input image" class="" style="max-width: 100%;display: none" id="imagePreview"/>
            </div>
          </div>
          
          {{-- result --}}
          @if (session('output_image') && session('input_image'))
            <hr>
            <h2 class="mt-4">Detection And Classification Results</h2>
            <div class="row mt-4">
              <div class="col-md-4 mb-4">
                <img src="{{asset('storage/'.session('output_image'))}}" alt="detection ouput image" class="" style="max-width: 100%"/>
              </div>
              <div class="col-md-8 mb-4">
                <table class="table table-bordered">
                  <tr>
                    <td class="table-active"><b>Detection Result:</b> </td>
                    <td class="text-center bg-{{session('detection_result') == 0 ? 'success' : 'danger'}}"><span class="text-uppercase text-white">{{session('detection_result') == 0 ? 'There is no tumor' : 'There is a tumor found'}}</span></td>
                  </tr>
                  <tr>
                    <td class="table-active"><b>Classification Result:</b> </td>
                    <td class="text-center"><span class="text-{{session('classification_result') == 'no_tumor' ? 'success' : 'dark'}}">{{ucwords(str_replace('_', ' ', session('classification_result')))}}</span></td>
                  </tr>
                </table>
                <button type="button" class="btn btn-success" onclick="printReport()">Print Report <i class="ti ti-print"></i></button>
              </div>
            </div>
          @endif
        </div>
      </form>
    </div>
  </div>
</div>

{{-- printable section --}}
@if (session('output_image') && session('input_image'))
    <div id="printableContent">
      <div class="d-flex align-items-center gap-2">
        <img src="{{asset('assets/frontend/images/logo.png')}}" width="100px" height="100px" alt="BDT LOGO">
        <div>
          <h2>{{$siteSettings['name']->value ?? 'BDT'}}</h2>
          <p><b>Your Health Care Solution</b></p>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <table class="middle-center table table-bordered">
            <tbody>
              <tr>
                <td><b>Doctor:</b></td>
                <td>{{ auth()->user()->first_name." ".auth()->user()->last_name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-6">
          <table class="middle-center table table-bordered">
            <tbody>
              <tr>
                <td><b>Date:</b></td>
                <td>{{ session('time') }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <h2 class="mt-2">Detection And Classification Result</h2>
      <div class="row">
        <div class="col-4 mt-2">
          <img src="{{asset('storage/'.session('output_image'))}}" alt="detection ouput image" class="" style="max-width: 100%"/>
        </div>
        <div class="col-8 mt-2">
          <table class="table table-bordered">
            <tr>
              <td class="table-active"><b>Detection Result:</b> </td>
              <td class="text-center text-uppercase table-{{session('detection_result') == 0 ? 'success' : 'danger'}}"><span>{{session('detection_result') == 0 ? 'There is no tumor' : 'There is a tumor found'}}</span></td>
            </tr>
            <tr>
              <td class="table-active"><b>Classification Result:</b> </td>
              <td class="text-center"><span class="text-{{session('classification_result') == 'no_tumor' ? 'success' : 'dark'}}">{{ucwords(str_replace('_', ' ', session('classification_result')))}}</span></td>
            </tr>
          </table>
        </div>
      </div>
      @if (session('tumor_title') && session('tumor_description'))
          <div class="row pt-4">
            <h2>{{session('tumor_title')}}</h2>
            <p>{!! session('tumor_description') !!}</p>
          </div>
      @endif
    </div>

@endif

@endsection

@section('js')

<script>
  const imagePreview = document.getElementById('imagePreview');
  const cancelImagePreview = document.getElementById('cancelImagePreview');
  const imageInput = document.getElementById('picture');
  imageInput.addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        cancelImagePreview.style.display = 'block';
      }
      reader.readAsDataURL(file);
    }
  });
  cancelImagePreview.addEventListener('click', function(event) {
    imagePreview.src = '';
    imageInput.value = null;
    imagePreview.style.display = 'none';
    cancelImagePreview.style.display = 'none';
  });
</script>

{{-- print --}}
@if (session('input_image') && session('output_image'))
    <script>
        function printReport() {
            window.print();
        }
    </script>
@endif

@endsection