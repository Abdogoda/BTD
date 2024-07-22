<!DOCTYPE html>
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

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/bootstrap/css/bootstrap.min.css')}}">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/icofont/icofont.min.css')}}">

  @yield('css')

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
  @livewireStyles

</head>

<body id="top" data-title="@yield('title')">

<!-- Header Start -->
@include('includes.frontend.header')
<!-- Header End -->

<div class="full-content">

    <!-- Content Start -->
        @yield('content')
    <!-- Content End -->


    <!-- Footer Start -->
        @include('includes.frontend.footer')
    <!-- Footer End -->
    
</div>

    <!-- Essential Scripts =====================================-->

    
    <!-- Main jQuery -->
    <script src="{{asset('assets/frontend/plugins/jquery/jquery.js')}}"></script>
    <!-- Bootstrap 4.3.2 -->
    <script src="{{asset('assets/frontend/plugins/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('assets/frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/frontend/plugins/counterup/jquery.easing.js')}}"></script>
    
    <!-- Counterup -->
    <script src="{{asset('assets/frontend/plugins/counterup/jquery.waypoints.min.js')}}"></script>
    
    <script src="{{asset('assets/frontend/plugins/shuffle/shuffle.min.js')}}"></script>
    <script src="{{asset('assets/frontend/plugins/counterup/jquery.counterup.min.js')}}"></script>
    
    @yield('js')

    <script src="{{asset('assets/frontend/js/script.js')}}"></script>
    @livewireScripts

  </body>
  </html>
   