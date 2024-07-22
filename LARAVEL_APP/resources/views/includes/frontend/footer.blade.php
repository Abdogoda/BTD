<footer class="footer section gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mr-auto col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <div class="logo mb-4">
                        <img src="{{asset('assets/frontend/images/logo.png')}}" alt="logo" class="img-fluid" style="max-width: 50px; max-height: 50px;"> <span class="logo ml-1">{{$siteSettings['name']->value ?? 'BTD'}}</span>
                    </div>
                    <p>{{$siteSettings['about']->value ?? '"BTD" is an AI-driven platform for brain tumor detection, offering image analysis, medical resources, patient support, specialist directories, and educational content, ensuring privacy and catering to a global audience.'}}</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Quick Links</h4>
                    <div class="divider mb-4"></div>

                    <ul class="list-unstyled footer-menu lh-35">
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('about')}}">About BT</a></li>
                        <li><a href="{{route('doctors')}}">Doctors</a></li>
                        <li><a href="{{route('hospitals')}}">Hospitals </a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="widget mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Services</h4>
                    <div class="divider mb-4"></div>
                    <ul class="list-unstyled footer-menu lh-35">
                        <li><a href="{{route('user.appointment')}}">Book Appointments</a></li>
                        <li><a href="{{route('doctor.detections.create')}}">Tumor Detections</a></li>
                        <li><a href="{{route('doctor.detections.create')}}">Tumor Classifications</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="widget widget-contact mb-5 mb-lg-0">
                    <h4 class="text-capitalize mb-3">Get in Touch</h4>
                    <div class="divider mb-4"></div>

                    <div class="footer-contact-block mb-4">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-email mr-3"></i>
                            <span class="h6 mb-0">Support Available for 24/7</span>
                        </div>
                        <h4 class="mt-2"><a href="mailto:{{$siteSettings['email']->value ?? 'support@gmail.com'}}">{{$siteSettings['email']->value ?? 'support@gmail.com'}}</a></h4>
                    </div>

                    <div class="footer-contact-block">
                        <div class="icon d-flex align-items-center">
                            <i class="icofont-support mr-3"></i>
                            <span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
                        </div>
                        <h4 class="mt-2"><a href="tel:{{$siteSettings['phone']->value ?? '01142366716'}}">{{$siteSettings['phone']->value ?? '01142366716'}}</a></h4>
                    </div>
                </div>
            </div>
        </div>
        
            <div class="footer-btm">
                <div class="row">
                    <div class="col-lg-4">
                        <a class="backtop js-scroll-trigger" href="#top">
                            <i class="icofont-long-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</footer>