@extends('apps.app_auth')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-3 col-xl-3" style="position:absolute;top:40%;left:50%;transform:translate(-50%, -50%)">
            <div class="card shadow card-login">

              <div class="container" style="background-color: #251D3A">
                <div class="row justify-content-start">
                  <div class="col-3 py-3 ">
                    <img src="{{asset('img/FMLC1.png')}}" class="img-responsive" style="max-width: 100%;"/> 
                  </div>
                  <div class="col-9 ps-0">
                    <p class="mb-0" style="font-size: 50px;font-weight:bold;color:#fff;"> Filipinas</p> 
                    <p class="mb-0" style="font-size: 25px;line-height:5px;color:#fff">Multi-line Corp.</p> 
                  </div>
                </div>
              </div>
              <div class="card-body ">
               @if (Session::has('error'))
                    <div class="alert alert-danger py-2 alert-dismissible fade show"  style="font-size: 15px;padding-right:20px" role="alert">
                      <p class="mb-0"><i class="fas fa-exclamation-circle"></i> Invalid Credentials  <span style="float: right;cursor: pointer;" data-bs-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></span></p>
                    </div>
               @endif
                   
                <form action="{{route('attempt.login')}}" method="POST" autocomplete="off">
                  @csrf
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" style="font-size: 13px;font-weight:600;font-family: 'Kanit', sans-serif;" class="form-label mb-0">*Username:</label>
                      <input type="email" id="userInput"  class="form-control" name="email" style="font-family: 'Kanit', sans-serif;" placeholder="username/email"  value="">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" style="font-size: 13px;font-weight:600;font-family: 'Kanit', sans-serif;" class="form-label mb-0">*Password:</label>
                      <input type="password" id="passwordInput"  class="form-control" name="password" style="font-family: 'Kanit', sans-serif;" placeholder="password" value="">
                    </div>
                    <div class="d-grid gap-2 mb-2">
                      <button class="btn btn-login" id="btn-login" type="submit">Login</button>
                  </div>
                  <a href="#" style="float:right">Forgot Password?</a>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
@endsection
