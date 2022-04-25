<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="container">
            <div class="row py-4 ps-3">
                <div class="col-md-12 col-sm-12 col-12 pt-1 ps-1" style="color:#fff">
                    <p class="mb-0" style="font-size: 18px;font-family: 'Kanit', sans-serif;">ML Logistic</p>
                    <p style="font-size: 25px;line-height:12px;font-family: 'Kanit', sans-serif;">
                        Vehicle Monitoring</p>
                </div>
            </div>
        </div>


        <ul class="sidebar-nav" style="font-family: 'Kanit', sans-serif; font-size:16px;">
            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{route('admin_dashboard')}}">
                  <img src="https://img.icons8.com/fluency-systems-regular/25/ffffff/dashboard-layout.png"/>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('vehicle.reservation')}}">
                  <img src="https://img.icons8.com/material-sharp/25/ffffff/overtime.png"/>
                    <span class="align-middle">Vehicle Reservation</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('vehicles')}}">
                  <img src="https://img.icons8.com/ios-glyphs/27/ffffff/steering-wheel.png"/>
                    <span class="align-middle"> Vehicle Records</span>
                </a>
            </li>

            
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('vehicle.driver')}}">
                <img src="https://img.icons8.com/material-rounded/26/ffffff/driver.png"/>
                  <span class="align-middle"> Driver Records</span>
              </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{route('user.account')}}">
              <img src="https://img.icons8.com/material-outlined/26/ffffff/add-user-group-man-man.png"/>
                <span class="align-middle">User Account</span>
            </a>
        </li>



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
