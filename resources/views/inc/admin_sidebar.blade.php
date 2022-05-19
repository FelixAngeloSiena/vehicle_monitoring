<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="container mt-3">
            <div class="row">
              <div class="col-md-3 pe-2">
                <img src="{{asset('img/FMLC1.png')}}" class="img-responsive mt-2" style="max-width: 100%;"/> 
              </div>
              <div class="col-9 ps-0">
                <p class="mb-0" style="font-size: 30px;color:#fff;font-weight:bold"> Filipinas </p> 
                <p style="font-size: 16px;line-height:2px;color:#fff;font-weight:500">Multi-Line Corp.</p> 
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


    {{-- APPROVER SIDE BAR --}}
        @elseif (Auth::user()->role == 'approver')
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('approver.dashboard')}}">
            <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
            <span class="align-middle">Request Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('approver.approve')}}">
            <img src="https://img.icons8.com/windows/25/ffffff/sign-document.png"/>
            <span class="align-middle">Approve Reservations</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{route('approver.cancel')}}">
            <img src="https://img.icons8.com/ios/25/ffffff/checked--v1.png"/>
            <span class="align-middle">Cancel Reservations</span>
          </a>
        </li>


    {{-- MANAGER SIDE BAR --}}
        @elseif (Auth::user()->role == 'manager')

        <li class="sidebar-item {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{route('admin_dashboard')}}">
            <ion-icon name="podium-outline" class="align-middle" style="font-size: 20px;"></ion-icon>
            <span class="align-middle" style="font-size:18px;">Dashboard</span>
          </a>
        </li>

        <li class="sidebar-item accordion" id="accordionExample">
          <a class="sidebar-link collapsed "  href="#" data-bs-toggle="collapse" data-bs-target="#approver-collapse" aria-expanded="true" >
            <img src="https://img.icons8.com/color/30/000000/overtime.png"/> <span class="align-middle">Reservations</span><span style="float: right" class="mt-1"><img src="https://img.icons8.com/ios-filled/15/738A96/right-down2.png"/></span>
          </a>
            <div class="collapse" id="approver-collapse">
              <ul class="sidebar-nav ps-3">
                
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('vehicle.view.reservation')}}">
                    <img src="https://img.icons8.com/color/25/000000/thumb-up--v1.png"/>
                    <span class="align-middle" style="font-size:18px;">For Approval</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('view.approve.reservation')}}">
                    <img src="https://img.icons8.com/color/25/000000/checked-radio-button--v1.png"/>
                    <span class="align-middle" style="font-size:18px;">Completed</span>
                  </a>
                </li>

                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{route('view.cancel.reservation')}}">
                    <img src="https://img.icons8.com/color/23/000000/cancel-2--v1.png"/>
                    <span class="align-middle" style="font-size:18px;">Cancelation</span>
                  </a>
                </li>

              </ul>
            </div>
        </li>

        <li class="sidebar-item {{ request()->routeIs('vehicle.maintenance') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{route('vehicle.maintenance')}}">
            <ion-icon name="chatbubble-outline" style="font-size: 20px;"></ion-icon>
            <span class="align-middle" style="font-size:18px;"> Request </span>
          </a>
        </li>

 
    {{-- LOGISTIC AND ADMIN SIDE BAR --}}  
      @elseif (Auth::user()->role == 'logistic' || Auth::user()->role == 'admin')
          <li class="sidebar-item {{ request()->routeIs('admin_dashboard') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('admin_dashboard')}}">
              <img src="https://img.icons8.com/glyph-neue/25/ffffff/bar-chart.png"/>
              <span class="align-start" style="font-size:18px;"> Dashboard</span>
            </a>
          </li>


          <li class="sidebar-item accordion" id="accordionExample">
            <a class="sidebar-link collapsed "  href="#" data-bs-toggle="collapse" data-bs-target="#approver-collapse" aria-expanded="true" >
              <img src="https://img.icons8.com/glyph-neue/25/ffffff/overtime.png"/>
                <span >Reservations</span><span style="float: right">
                <img src="https://img.icons8.com/ios-filled/15/738A96/right-down2.png"/></span>
            </a>
              <div class="collapse" id="approver-collapse">
                <ul class="sidebar-nav ps-3">
                  
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('vehicle.view.reservation')}}">
                      <i class="fas fa-file-signature"></i>
                      <span class="align-middle" style="font-size:18px;">For Approval</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('view.approve.reservation')}}">
                      <i class="fas fa-check"></i>
                      <span class="align-middle" style="font-size:18px;">Approve</span>
                    </a>
                  </li>

                  <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('view.completed.reservation')}}">
                      <i class="fas fa-check-double"></i>
                      <span class="align-middle" style="font-size:18px;">Completed</span>
                    </a>
                  </li>

                  
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('view.cancel.reservation')}}">
                      <i class="fas fa-ban"></i>
                      <span class="align-middle" style="font-size:18px;">Cancelation</span>
                    </a>
                  </li>
                </ul>
              </div>
          </li>



          <li class="sidebar-item {{ request()->routeIs('vehicles') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicles')}}">
              <img src="https://img.icons8.com/glyph-neue/25/ffffff/car-service.png"/>
              <span class="align-middle" style="font-size:18px;"> Vehicles</span>
            </a>
          </li>

          <li class="sidebar-item {{ request()->routeIs('vehicle.driver') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{route('vehicle.driver')}}">
              <img src="https://img.icons8.com/glyph-neue/25/ffffff/group.png"/>
                <span class="align-middle" style="font-size:18px;"> Drivers</span>
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
