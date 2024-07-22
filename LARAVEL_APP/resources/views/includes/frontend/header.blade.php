<header>
	
	<nav class="navbar navbar-expand-lg navigation bg-white" id="navbar">
		<div class="container">
		 	 <a class="navbar-brand" href="{{route('index')}}">
			  	<img src="{{asset('assets/frontend/images/logo.png')}}" alt="logo-image" class="img-fluid" style="max-width: 50px; max-height: 50px;"> <span class="logo ml-1">{{$siteSettings['name']->value ?? 'BTD'}}</span>
			  </a>

		  	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
			<span class="icofont-navigation-menu"></span>
		  </button>
	  
		  <div class="collapse navbar-collapse" id="navbarmain">
			<ul class="navbar-nav ml-auto align-items-center">
			    <li class="nav-item" data-to="Home"><a class="nav-link" href="{{route('index')}}">Home</a></li>
                <li class="nav-item" data-to="AboutBT"><a class="nav-link" href="{{route('about')}}">About BT</a></li>
                <li class="nav-item" data-to="Doctors"><a class="nav-link" href="{{route('doctors')}}">Doctors</a></li>
                <li class="nav-item" data-to="Hospitals"><a class="nav-link" href="{{route('hospitals')}}">Hospitals</a></li>
                <li class="nav-item" data-to="Contact"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                @auth
                    @if (Auth::user()->role == 'doctor')
                        <li class="nav-item" data-to="Detection"><a class="btn btn-main btn-round-full py-2 px-3" data-to="Appointment" href="{{route('doctor.detections.create')}}">Make Detection<i class="icofont-brain ml-2"></i></a></li>
                    @endif
                    @if (Auth::user()->role == 'user')
                        <li class="nav-item" data-to="Detection"><a class="btn btn-main btn-round-full py-2 px-3" data-to="Appointment" href="{{route('user.appointment')}}">Make Appointment<i class="icofont-simple-right ml-2"></i></a></li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{route('user.profile')}}" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->picture)
                                <img src="{{asset("storage/".Auth::user()->picture)}}" alt="profile image" class="avatar">
                            @else
                                <i class="icofont-user"></i> 
                            @endif
                            <i class="icofont-thin-down"></i>
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="dropdown05" style="min-width: fit-content; width:150px">
                            @if (Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{route('admin.profile')}}" title="view Profile">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</a></li>
                            @endif
                            @if (Auth::user()->role == 'doctor')
                                <li><a class="dropdown-item" href="{{route('doctor.profile')}}" title="view Profile">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</a></li>
                            @endif
                            @if (Auth::user()->role == 'user')
                                <li><a class="dropdown-item" href="{{route('user.profile')}}" title="view Profile">{{ Auth::user()->first_name." ".Auth::user()->last_name }}</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-danger rounded-0 d-block px-1">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="nav-item" data-to="Login"><a class="nav-link" href="{{route('login')}}" title="Login"><i class="icofont-user"></i></a></li>
                @endguest
			</ul>
		  </div>
		</div>
	</nav>
</header>