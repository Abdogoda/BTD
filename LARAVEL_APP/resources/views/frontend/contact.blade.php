@extends('layouts.frontend.master')
@section('title') Contact @endsection
@section('css')
    <!-- Slick Slider  CSS -->
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick.css')}}">
  <link rel="stylesheet" href="{{asset('assets/frontend/plugins/slick-carousel/slick/slick-theme.css')}}">
@endsection
@section('content')

    <section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="block text-center">
            <span class="text-white">Contact Us</span>
            <h1 class="text-capitalize text-lg">Get in Touch</h1>
            </div>
        </div>
        </div>
    </div>
    </section>
    <!-- contact form start -->

    <section class="section contact-info pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-live-support"></i>
                        <h5>Call Us</h5>
                        {{$siteSettings['phone']->value ?? '01142366716'}}
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-support-faq"></i>
                        <h5>Email Us</h5>
                        {{$siteSettings['email']->value ?? 'support@gmail.com'}}
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-md-6">
                    <div class="contact-block mb-4 mb-lg-0">
                        <i class="icofont-location-pin"></i>
                        <h5>Address</h5>
                        {{$siteSettings['address']->value ?? 'address not exists'}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h2 class="text-md mb-2">Contact us</h2>
                        <div class="divider mx-auto my-4"></div>
                        <p class="mb-5">Laboriosam exercitationem molestias beatae eos pariatur, similique, excepturi mollitia sit perferendis maiores ratione aliquam?</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <form id="contact-form" class="contact__form " method="post" action="{{route('store_message')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="name" required id="name" type="text" class="form-control" placeholder="Your Full Name" >
                                </div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input name="email" required id="email" type="email" class="form-control" placeholder="Your Email Address">
                                </div>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group-2 mb-4">
                            <textarea name="message" id="message" class="form-control" rows="8" placeholder="Your Message" required></textarea>
                        </div>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="text-center">
                            <input class="btn btn-main btn-round-full" name="submit" type="submit" value="Send Messege"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <div class="map-container">
        <div id="map"><iframe src="{{$siteSettings['location']->value}}" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </div>
@endsection

@section('js')
@endsection
