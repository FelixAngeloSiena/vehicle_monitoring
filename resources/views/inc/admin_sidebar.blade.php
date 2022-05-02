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

    @elseif (Auth::user()->role == 'logistic')
          <li class="sidebar-item {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
              <a class="sidebar-link" href="{{route('admin_dashboard')}}">
                <ion-icon name="podium-outline" class="align-middle" style="font-size: 20px;"></ion-icon>
                  <span class="align-middle" style="font-size:18px;">Dashboard</span>
              </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicle.reservation') ? 'active' : '' }}">
              <a class="sidebar-link" href="{{route('vehicle.reservation')}}">
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

        <li class="sidebar-item {{ request()->routeIs('user.account') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{route('user.account')}}">
            <ion-icon name="person-add-outline" class="align-middle"  style="font-size: 20px;"></ion-icon>
              <span class="align-middle" style="font-size:18px;">User Account</span>
          </a>
      </li>
      @endif
      



            {{-- <li class="sidebar-item accordion" id="accordionExample">
            <a class="sidebar-link collapsed "  href="#" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="true" >
              <img src="https://img.icons8.com/stickers/25/ffffff/settings.png"/> <span class="align-middle">Settings</span><span style="float: right" class="mt-1"><img src="https://img.icons8.com/ios-filled/15/738A96/right-down2.png"/></span>
            </a>
              <div class="collapse" id="dashboard-collapse" style="background: #25364C">
                <ul class="sidebar-nav ps-3">
                  <li class="sidebar-item " >
                    <a class="sidebar-link" href="pages-blank.html"  style="background: #25364C">
                      <img src="https://img.icons8.com/stickers/25/ffffff/area-chart.png"/> <span>Sales records</span>
                    </a>
                  </li>
                  <li class="sidebar-item ">
                    <a class="sidebar-link" href="pages-blank.html" style="background: #25364C">
                      <img src="https://img.icons8.com/stickers/25/ffffff/data-backup.png"/><span> Employee records</span>
                    </a>
                  </li>
                  <li class="sidebar-item ">
                    <a class="sidebar-link" href="pages-blank.html" style="background: #25364C">
                      <img src="https://img.icons8.com/stickers/25/ffffff/pencil-tip.png"/> <span>employee activity</span>
                    </a>
                  </li>
                </ul>
              </div>
          </li> --}}
          
        </ul>
    </div>
</nav>
