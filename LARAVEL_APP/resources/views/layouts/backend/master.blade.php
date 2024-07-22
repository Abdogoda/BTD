<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="BTD is an AI-driven platform for brain tumor detection, offering image analysis, medical resources, patient support, specialist directories, and educational content, ensuring privacy and catering to a global audience.">
    <meta name="author" content="abdogoda0a@gmail.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>{{ config('app.name', 'BTD') }} | @yield('title')</title>
  
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/frontend/images/logo.png')}}" />
  
  <link rel="stylesheet" href="{{asset('assets/backend/css/styles.css')}}" />
  @yield('css')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"  
  data-sidebar-position="fixed" data-header-position="fixed">
  <!-- Sidebar Start -->
  @include('includes.backend.sidebar')
  <!--  Sidebar End -->
  <!--  Main wrapper -->
  <div class="body-wrapper">
    <!--  Header Start -->
    @include('includes.backend.header')
    <!--  Header End -->
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>
</div>
<script src="{{asset('assets/backend/libs/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/backend/js/sidebarmenu.js')}}"></script>
<script src="{{asset('assets/backend/js/app.min.js')}}"></script>
<script src="{{asset('assets/backend/libs/simplebar/dist/simplebar.js')}}"></script>
{{-- <script src="{{asset('assets/backend/js/dashboard.js')}}"></script> --}}
@yield('js')
</body>

</html>