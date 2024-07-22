<aside class="left-sidebar">
 <!-- Sidebar scroll-->
 <div>
   <div class="brand-logo d-flex align-items-center justify-content-between">
     <a href="{{auth()->user()->role == 'admin' ? route('admin.dashboard') : route('doctor.dashboard')}}" class="text-nowrap logo-img">
       <img src="{{asset('assets/frontend/images/logo.png')}}" style="max-width: 50px; max-height: 50px;" alt="logo-image" /> <span class="fs-6 ml-2 text-dark fw-bold"><b>{{$siteSettings['name']->value ?? 'BTD'}}</b></span>
     </a>
     <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
       <i class="ti ti-x fs-8"></i>
     </div>
   </div>
   <!-- Sidebar navigation-->
   <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
     <ul id="sidebarnav">
       <li class="nav-small-cap">
         <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
         <span class="hide-menu">Home</span>
       </li>
       <li class="sidebar-item">
         <a class="sidebar-link" href="{{auth()->user()->role == 'admin' ? route('admin.dashboard') : route('doctor.dashboard')}}" aria-expanded="false">
           <span>
             <i class="ti ti-layout-dashboard"></i>
           </span>
           <span class="hide-menu">Dashboard</span>
         </a>
       </li>
       <li class="nav-small-cap">
         <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
         <span class="hide-menu">Pages</span>
       </li>
       @if (auth()->user()->role == 'admin')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.hospitals')}}" aria-expanded="false">
            <span>
              <i class="ti ti-building-hospital"></i>
            </span>
            <span class="hide-menu">Hospitals</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.doctors')}}" aria-expanded="false">
            <span>
              <i class="ti ti-users"></i>
            </span>
            <span class="hide-menu">Doctors</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.admins')}}" aria-expanded="false">
            <span>
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu">Admins</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.tumors')}}" aria-expanded="false">
            <span>
              <i class="ti ti-brain"></i>
            </span>
            <span class="hide-menu">Tumors</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.treatments')}}" aria-expanded="false">
            <span>
              <i class="ti ti-vaccine"></i>
            </span>
            <span class="hide-menu">Treatments</span>
          </a>
        </li>
       @endif
       @if (auth()->user()->role == 'doctor')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('doctor.clinics')}}" aria-expanded="false">
            <span>
              <i class="ti ti-building-hospital"></i>
            </span>
            <span class="hide-menu">Clinics</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('doctor.appointments')}}" aria-expanded="false">
            <span>
              <i class="ti ti-list"></i>
            </span>
            <span class="hide-menu">Appointments</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('doctor.detections')}}" aria-expanded="false">
            <span>
              <i class="ti ti-brain"></i>
            </span>
            <span class="hide-menu">Detections</span>
          </a>
        </li>
       @endif
       <li class="nav-small-cap">
         <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
         <span class="hide-menu">EXTRA</span>
       </li>
       @if (auth()->user()->role == 'admin')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.messages')}}" aria-expanded="false">
            <span>
              <i class="ti ti-message"></i>
            </span>
            <span class="hide-menu d-flex align-items-center gap-2">
              Messages
              @if (\App\Models\Message::where('read', 0)->count() > 0)
              <small class="badge bg-danger mb-0">{{\App\Models\Message::where('read', 0)->count()}}</small>
              @endif
            </span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('admin.settings')}}" aria-expanded="false">
            <span>
              <i class="ti ti-settings"></i>
            </span>
            <span class="hide-menu">Settings</span>
          </a>
        </li>
       @endif
       <li class="sidebar-item">
         <a class="sidebar-link" href="{{url('/')}}" aria-expanded="false">
           <span>
             <i class="ti ti-app-window"></i>
           </span>
           <span class="hide-menu">{{$siteSettings['name']->value ?? 'BTD'}} Website</span>
         </a>
       </li>
     </ul>
   </nav>
   <!-- End Sidebar navigation -->
 </div>
 <!-- End Sidebar scroll-->
</aside>