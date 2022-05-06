@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        @foreach ($driverInfos as $driverInfo)
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Your </strong> Profile</h1>
            </div>

            
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <img src="/driver-retrieve-profile/{{$driverInfo->profile_image_path}}" class="img-responsive p-4" style="max-width:100%"/>  
                        <p class="text-center fs-4 mb-0" style="font-weight: bold">{{$driverInfo->name}}</p>
                            <div class="d-flex justify-content-center">
                                <a type="submit" id="submitUpdateVehicle" style="font-size: 17px;background-color:#251D3A;color:#fff;border-radius:0px;font-weight:bold;" class="btn mb-3"><i class="fas fa-camera"></i>  Change Profile</a>
                            </div>
                       
                     
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <p style="font-size:30px;font-weight:bold">Personal Information</p>
                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0">ID#:</label>
                            <input type="text" value="{{$driverInfo->id_no}}" class="form-control" id="vehicleType" name="vehicleType">
                        </div>
                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0">Name:</label>
                            <input type="text" value="{{$driverInfo->name}}" class="form-control" id="vehicleType" name="vehicleType">
                        </div>
                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0">License Type:</label>
                            <select class="form-select" id="license_type" name="license_type">
                            <option selected >{{$driverInfo->license_type}}</option>
                            <option>Non Pro Driver Lisence </option>
                            <option>Pro Driver Lisence </option>
                        </select>
                        </div>
                        
                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0">License Restriction</label>
                            <select class="form-select" id="license_restriction" name="license_restriction">
                                <option selected >{{$driverInfo->restriction}}</option>
                                <option>A - Motorcycle</option>
                                <option>A1 - Tricycle</option>
                                <option>B - Vehicles up to 5,000 kgs. GVW/8 seats</option>
                                <option>B1 - Vehicles up to 5,000 kgs. GVW/9 or more seats</option>
                                <option>B2 - Vehicles carrying goods ≤ 3,500 kgs GVW </option>
                                <option>C - Vehicles carrying goods >3,500 kgs GVW</option>
                                <option>D - Bus > 5,000 kgs GVW/9 or more seats</option>
                                <option>BE – Trailers ≤ 3,500 kgs</option>
                                <option>CE - Articulated C > 3,500 kgs combined GVW</option>
                        </select>
                        </div>

                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0">License Registration Date:</label>
                            <input type="date" value="{{$driverInfo->license_reg_date}}" class="form-control" id="vehicleType" name="vehicleType">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0">License Expiration Date</label>
                            <input type="date" value="" class="form-control" id="vehicleType" name="vehicleType">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" id="submitUpdateVehicle" style="font-size: 17px;background-color:#251D3A;color:#fff;border-radius:0px;font-weight:bold;" class="btn mb-3"> Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
    

        </div>
        @endforeach
    </div>
@endsection
@section('script')

@endsection
