@extends('layouts.backend.master')
@section('title') {{$tumor->title}} @endsection
@section('css')
@endsection
@section('content')
<div class="card">
 <div class="card-body">
   <div class="d-flex flex-wrap align-items-center justify-content-between">
    <h5 class="card-title fw-semibold mb-4">{{$tumor->title}}</h5>
    <p class="mb-4"><a href="{{route('admin.tumors')}}">Tumors</a> / {{$tumor->title}}</p>
   </div>
   <form action="{{route('admin.tumor_update', $tumor)}}" method="post" class="card" enctype="multipart/form-data">
    @csrf
     <div class="card-body">
       <div class="row">
         <div class="col-md-12 mb-3">
           <label for="title" class="form-label">tumor Title</label>
           <input type="text" class="form-control" name="title" id="title" autofocus value="{{$tumor->title}}">
           @error('title')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="picture" class="form-label">Tumor Image</label>
           <div class="mb-2"><img src="{{$tumor->picture ? asset('storage/'.$tumor->picture) : asset('assets/frontend/images/defualts/tumor.jpg')}}" alt="tumor image" style="max-height:200px"></div>
            <input type="file" class="form-control" name="picture" id="picture" value="{{old('picture')}}" accept=".jpg,.jpeg,.png" >
            @error('picture')
              <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-12 mb-3">
           <label for="description" class="form-label">tumor description</label>
           <textarea class="form-control" name="description" id="description" rows="10">{{$tumor->description}}</textarea>
           @error('description')
            <span class="text-danger">{{ $message }}</span>
           @enderror
         </div>
         <div class="d-flex flex-wrap gap-2">
          <button type="submit" class="btn btn-primary">Update <i class="ti ti-edit"></i></button>                
          <a href="{{route('admin.tumor_delete', $tumor)}}" onclick="return confirm('Are you sure to delete this tumor?')" class="btn btn-danger">Delete <i class="ti ti-trash"></i></a>
         </div>
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