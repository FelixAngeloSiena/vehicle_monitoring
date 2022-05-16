<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="container mt-3">
            <div class="row">
              <div class="col-md-3 pe-2">
                <img src="{{asset('img/FMLC1.png')}}" class="img-responsive mt-2" style="max-width: 100%;"/> 
              </div>
              <div class="col-9 ps-0">
                <p class="mb-0" style="font-size: 25px;color:#fff"> Online Vehicle</p> 
                <p style="font-size: 16px;line-height:2px;color:#fff;font-weight:500">Reservation&Monitoring</p> 
              </div>
            </div>
        </div>
        <hr>
        <ul class="sidebar-nav" style="font-family: 'Kanit', sans-serif; font-size:16px;">
   

    {{-- DRIVER SIDE BAR --}} 
        @if(Auth::user()->role == 'driver') 
          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('driver.dashboard')}}">
              <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
                <span class="align-middle">Your Dashboard</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('driver.schedule.logs')}}">
              <img src="https://img.icons8.com/material-outlined/26/ffffff/log.png"/>
                <span class="align-middle">Schedule Logs</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('driver.profile')}}">
              <img src="https://img.icons8.com/material-outlined/25/ffffff/gender-neutral-user.png"/>
                <span class="align-middle">Driver Profile</span>
            </a>
          </li>


    {{-- REQUESTOR SIDE BAR --}} 
      @elseif (Auth::user()->role == 'requestor')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('requestor.dashboard')}}">
            <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
              <span class="align-middle">Your Dashboard</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="">
            <img src="https://img.icons8.com/material-outlined/26/ffffff/log.png"/>
              <span class="align-middle">Request Logs</span>
          </a>
        </li>

    {{-- AUDIT SIDE BAR --}}  
      @elseif (Auth::user()->role == 'audit')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('requestor.dashboard')}}">
            <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
              <span class="align-middle">Your Dashboard</span>
          </a>
        </li>

    {{-- PUCHASING SIDE BAR --}}
      @elseif (Auth::user()->role == 'purchasing')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('purchasing.dashboard')}}">
            <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
            <span class="align-middle">Your Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('purchasing.request.po')}}">
            <img src="https://img.icons8.com/windows/25/ffffff/sign-document.png"/>
            <span class="align-middle">Request For P.O</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('purchasing.completed.po')}}">
            <img src="https://img.icons8.com/ios/25/ffffff/checked--v1.png"/>
            <span class="align-middle">Completed</span>
          </a>
        </li>

 
    {{-- LOGISTIC AND ADMIN SIDE BAR --}}  
      @elseif (Auth::user()->role == 'logistic' || Auth::user()->role == 'admin')
          <li class="sidebar-item {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('admin_dashboard')}}">
              <ion-icon name="podium-outline" class="align-middle" style="font-size: 20px;"></ion-icon>
              <span class="align-middle" style="font-size:18px;">Dashboard</span>
            </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicle.reservation') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicle.view.reservation')}}">
              <ion-icon name="calendar-clear-outline" class="align-middle"  style="font-size: 18px;"></ion-icon>
              <span class="align-middle" style="font-size:18px;">Reservations</span>
            </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicles') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicles')}}">
              <ion-icon name="car-outline" class="align-middle" style="font-size: 22px;"></ion-icon>
              <span class="align-middle" style="font-size:18px;"> Vehicles</span>
            </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicle.driver') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicle.driver')}}">
              <ion-icon name="timer-outline" class="align-middle"  style="font-size: 22px;"></ion-icon>
                <span class="align-middle" style="font-size:18px;"> Drivers</span>
            </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicle.maintenance') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicle.maintenance')}}">
              <ion-icon name="chatbubble-outline" style="font-size: 20px;"></ion-icon>
              <span class="align-middle" style="font-size:18px;"> Request </span>
            </a>
          </li>


    {{-- ADMIN SIDE BAR --}} 
        @if (Auth::user()->role == 'admin')
          <li class="sidebar-item {{ request()->routeIs('user.account') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('user.account')}}">
              <ion-icon name="chatbubble-ellipses-outline"  style="font-size: 20px;"></ion-icon>
                <span class="align-middle" style="font-size:18px;">User Account</span>
            </a>
          </li>
        @endif

      @endif
          
      </ul>
  </div>
</nav>
