@extends('layouts.backend.master')
@section('title') Create Treatment @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">Create New Treatment</h5>
    <p class="mb-4"><a href="{{route('admin.treatments')}}">Treatments</a> / New</p>
   </div>
   <form action="{{route('admin.treatment_store')}}" method="post" class="card">
    @csrf
     <div class="card-body">
       <div class="row">
         <div class="col-md-12 mb-3">
           <label for="title" class="form-label">Treatment Title</label>
           <input type="text" class="form-control" name="title" id="title" autofocus value="{{old('title')}}">
           @error('title')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="description" class="form-label">Treatment description</label>
           <textarea class="form-control" name="description" id="description" rows="10">{{old('description')}}</textarea>
           @error('description')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
       </div>
     </div>
   </form>
 </div>
</div>
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea#description',
  menubar: false,
  plugins: 'code table lists',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table ',
});
</script>

@endsection