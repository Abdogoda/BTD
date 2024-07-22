<header class="app-header">
 <nav class="navbar navbar-expand-lg navbar-light">
   <ul class="navbar-nav">
     <li class="nav-item d-block d-xl-none">
       <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="#">
         <i class="ti ti-menu-2"></i>
       </a>
     </li>
     <li class="nav-item">
       <a class="nav-link nav-icon-hover" href="{{auth()->user()->role == 'admin' ? route('admin.notifications') : route('doctor.notifications')}}">
         <i class="ti ti-bell-ringing"></i>
         @if (auth()->user()->role == 'admin' && \App\Models\Notification::where('notification_for', 'admin')->where('read', 0)->count() > 0)
          <div class="notification bg-primary rounded-circle"></div>
         @endif
         @if (auth()->user()->role == 'doctor' && \App\Models\Notification::where('notification_for', 'doctor')->where('doctor_id', auth()->user()->doctor->id)->where('read', 0)->count() > 0)
          <div class="notification bg-primary rounded-circle"></div>
         @endif
       </a>
     </li>
   </ul>
   <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
     <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
       <li class="nav-item dropdown">
         <a class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown"
           aria-expanded="false">
           @if (Auth::user()->picture)
                <img src="{{asset("storage/".Auth::user()->picture)}}" alt="profile image" width="35" height="35" class="rounded-circle">
            @else
                <img src="{{asset('assets/backend/images/profile/user-1.jpg')}}" alt="logo-image" width="35" height="35" class="rounded-circle">
            @endif
         </a>
         <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
           <div class="message-body">
             <a href="{{auth()->user()->role == 'admin' ? route('admin.profile') : route('doctor.profile')}}" class="d-flex align-items-center gap-2 dropdown-item">
               <i class="ti ti-user fs-6"></i>
               <p class="mb-0 fs-3">My Profile</p>
             </a>
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
             </form>
           </div>
         </div>
       </li>
     </ul>
   </div>
 </nav>
</header>