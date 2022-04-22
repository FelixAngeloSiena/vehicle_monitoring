@extends('apps.app_auth')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-3 col-xl-3" style="position:absolute;top:40%;left:50%;transform:translate(-50%, -50%)">
            <div class="card shadow card-login">
              <div class="card-header">
                <p class="mb-0" style="font-size: 25px;font-family: 'Kanit', sans-serif;font-weight:600;color:#fff">ML Logistic
                   <span style="float: right" class="pt-2">
                    <img src="https://img.icons8.com/stickers/60/000000/interstate-truck.png"/>
                  </span>
                </p>
                <p style="font-size: 25px;font-weight:700;line-height:12px;font-family: 'Kanit', sans-serif;color:#fff">Vehicle Monitoring</p>
              </div>
              <div class="card-body">
                      {{-- <div class="alert alert-danger py-2 alert-dismissible fade show"  style="font-size: 13px;font-weight:600;padding-right:20px" role="alert">
                      <p class="mb-0"><i class="fas fa-exclamation-triangle"></i> Invalid Credentials  <span style="float: right;cursor: pointer;" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></span></p>
                       </div> --}}
                <form action="{{route('attempt.login')}}" method="POST">
                  @csrf
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" style="font-size: 13px;font-weight:600;font-family: 'Kanit', sans-serif;" class="form-label mb-0">*Username:</label>
                      <input type="email" class="form-control" name="email" style="font-family: 'Kanit', sans-serif;" placeholder="username/email">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" style="font-size: 13px;font-weight:600;font-family: 'Kanit', sans-serif;" class="form-label mb-0">*Password:</label>
                      <input type="password" class="form-control" name="password" style="font-family: 'Kanit', sans-serif;" placeholder="password">
                    </div>
                    <div class="d-grid gap-2 mb-2">
                      <button class="btn btn-login" id="btn-login" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
@endsection
