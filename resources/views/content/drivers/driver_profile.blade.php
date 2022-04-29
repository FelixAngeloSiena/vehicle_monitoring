@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Your </strong> Profile</h1>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center mb-3" >
                                    @foreach ($driverInfos as $driverInfo)
                                    <img src="/driver-retrieve-profile/{{$driverInfo->profile_image_path}}" class="img-responsive" style="max-width:100%"/>
                                @endforeach
                                </div>
                                <div class="d-flex justify-content-center" >                              
                                    <button type="button" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size:30px;font-weight:bold">Personal Information</p>
                                <p class="mb-0">Id#: <span>{{$driverInfo->id_no}}</span></p>
                                <p class="mb-0">Name: <span>{{$driverInfo->name}}</span></p>
                                <p class="mb-0">License Type:  <span>{{$driverInfo->license_type}}</span></p>
                                <p class="mb-0">License Registration Date:  <span>{{$driverInfo->license_reg_date}}</span></p>
                                <p class="mb-0">License Expiration Date  <span>{{$driverInfo->license_exp_date}}</span></p>
                                <p class="mb-0">License Expiration Date  <span>{{$driverInfo->restriction}}</span></p>
                            </div>
                        

                   </div>   
                </div>
            </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center mb-3" >
                                    @foreach ($driverInfos as $driverInfo)
                                    <img src="/driver-retrieve-profile/{{$driverInfo->profile_image_path}}" class="img-responsive" style="max-width:100%"/>
                                @endforeach
                                </div>
                                <div class="d-flex justify-content-center" >                              
                                    <button type="button" class="btn btn-primary">Update Profile</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size:30px;font-weight:bold">Driver License Information</p>
                                <p class="mb-0">Id#: <span>{{$driverInfo->id_no}}</span></p>
                                <p class="mb-0">Name: <span>{{$driverInfo->name}}</span></p>
                                <p class="mb-0">License Type:  <span>{{$driverInfo->license_type}}</span></p>
                                <p class="mb-0">License Registration Date:  <span>{{$driverInfo->license_reg_date}}</span></p>
                                <p class="mb-0">License Expiration Date  <span>{{$driverInfo->license_exp_date}}</span></p>
                                <p class="mb-0">License Expiration Date  <span>{{$driverInfo->restriction}}</span></p>
        
                            </div>
                        </div>
                 
                   </div>   
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')

@endsection
