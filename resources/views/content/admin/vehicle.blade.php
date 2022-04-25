@extends('apps.app_admin')
@section('content')
    {{-- ----------------------------------------
     Vehicle Records Dashboard
 -------------------------------------- --}}

    <div class="container-fluid p-0">
        <div class="row">

            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createVehicleModal" style="color:#fff;font-size:17px;font-weight:bold">
                        <i class="fas fa-edit"></i> Add another vehicle</button>
                </div>



                <div class="card">
                    <div class="card-body shadow-sm">

                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Vehicle Type</th>
                                    <th>Year Model</th>
                                    <th>Plate#</th>
                                    <th>Company</th>
                                    <th>Department</th>
                                    <th>MV File#</th>
                                    <th>Chasis#</th>
                                    <th>Motor#</th>
                                    <th>Assigned Driver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->vehicle_type }}</td>
                                        <td>{{ $vehicle->vehicle_year_model }}</td>
                                        <td>{{ $vehicle->plate_no }}</td>
                                        <td>{{ $vehicle->company_name }}</td>
                                        <td>{{ $vehicle->department_name }}</td>
                                        <td>{{ $vehicle->mv_file_no }}</td>
                                        <td>{{ $vehicle->chasis_no }}</td>
                                        <td>{{ $vehicle->motor_no }}</td>
                                        <td>{{ $vehicle->driver_id === null ? 'No Driver Assigned' : $vehicle->driver_name }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary"
                                                onclick="onClickVehicleDetail({{ $vehicle->id }})"><i
                                                    class="fas fa-eye"></i> View Details</button>
                                            @if ($vehicle->driver_id === null)
                                                <button type="button" class="btn btn-danger"
                                                    onclick="onClickAssignedDriver({{ $vehicle->id }})"><i
                                                        class="fas fa-user-edit"></i> Assign Driver</button>
                                            @else
                                                <button type="button" class="btn btn-danger"
                                                    onclick="onClickChangeDriver({{ $vehicle->id }})"><i
                                                        class="fas fa-random"></i> Change Driver</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------------------------
      Modal for Vehicle Details
 -------------------------------------- --}}

    <div class="modal fade" id="vehicleDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="d-flex justify-content-between p-3"  style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;font-size:20px;font-weight:bold">Vehicle Details</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>
                <div class="modal-body">
                    <div class="row py-3">

                        <input type="hidden" value="" id="vehicleIdForMaintenance">

                        <div class="col-lg-6" style="position: relative">
                            <div style=" position: absolute; top: 30%; ">
                                <img id="imageFile" class="img-responsive" style="max-width:100%" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" style="border:solid 1px #cfcfcf">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-0" style="font-size: 20px" id="vehicleName">Ford Ranger</h4>
                                        <a type="button" id="openOffCanvas" class="btn position-relative px-2" style="border-radius:50%;background-color:#fff;box-shadow: 4px 1px 8px 0px rgba(0,0,0,0.44);border:solid 1px #cfcfcf">
                                            <i class="fas fa-cog" style="font-size:20px;"></i>
                                             <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                 <i class="fas fa-bell"></i>
                                             </span>
                                         </a>
                                    </div>
                                    <hr>

                                    <div class="row mb-0">
                                        <div class="col-md-7">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label mb-0"><small>Plate#:</small> </label>
                                                <input type="text" class="form-control" value="" name="vehiclePlateInfo"
                                                    id="vehiclePlateDetails">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Year
                                                        Model:</small> </label>
                                                <input type="text" class="form-control" value=""
                                                    name="vehicleModelDetails" id="vehicleModelDetails">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>MV
                                                File#:</small> </label>
                                        <input type="text" class="form-control" value="" name="vehicleMVFileDetails"
                                            id="vehicleMVFileDetails">
                                    </div>

                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Motor#:</small>
                                        </label>
                                        <input type="text" class="form-control" value="" name="vehicleMotorDetails"
                                            id="vehicleMotorDetails">
                                    </div>

                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1"
                                            class="form-label mb-0"><small>Chasis#:</small> </label>
                                        <input type="text" class="form-control" value="" name="vehicleChasisDetails"
                                            id="vehicleChasisDetails">
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Current
                                                        Odo Meter:</small> </label>
                                                <input type="text" class="form-control" readonly value=""
                                                    name="vehicleOdoDetails" id="vehicleOdoDetails">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1"
                                                    class="form-label mb-0"><small>Registration Date:</small> </label>
                                                <input type="text" class="form-control" value="" name="vehicleRegDetails"
                                                    id="vehicleRegDetails" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary mb-3"> Update Vehicle Details </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------------------------
      Modal for Create New Vehicle
 -------------------------------------- --}}

    <div class="modal fade" id="createVehicleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="d-flex justify-content-between p-3"  style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;font-size:20px;font-weight:bold">Create Vehicle</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>
                <form id="vehicleForm">
                    @csrf
                    <div class="modal-body">

                        <div class="card shadow" style="border:solid 1px #cfcfcf">
                            <div class="card-body">
                                <div class="row mb-0">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Vehicle
                                                    Type:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleType"
                                                id="vehicleType">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Year
                                                    Model:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleModel"
                                                id="vehicleModel">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Plate#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehiclePlate"
                                                id="vehiclePlate">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>MV
                                                    File#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleMV"
                                                id="vehicleMV">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Motor#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleMotor"
                                                id="vehicleMotor">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Chasis#:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleChasis"
                                                id="vehicleChasis">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Company:</small> </label>
                                            <select class="form-select" id="selectedCompany" name="vehicle_company"
                                                aria-label="Default select example">
                                                <option selected disabled>Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option value={{ $company->id }}>{{ $company->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Department:</small> </label>
                                            <select class="form-select" id="selectedDepartment"
                                                name="vehicle_department" aria-label="Default select example">
                                                <option selected disabled>Select Department</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Tire
                                                    Name:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleTire"
                                                id="vehicleTire">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date of
                                                    Purchase Tire:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleTirePurchase"
                                                id="vehicleTirePurchase">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Battery
                                                    Name:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleBattery"
                                                id="vehicleBattery">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date of
                                                    Purchase Battery:</small> </label>
                                            <input type="date" class="form-control" value=""
                                                name="vehicleBatteryPurchase" id="vehicleBatteryPurchase">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Current
                                                    Odo:</small> </label>
                                            <input type="text" class="form-control" value="" name="vehicleOdo"
                                                id="vehicleOdo">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Of
                                                    Last PMS:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleLastPMS"
                                                id="vehicleLastPMS">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-0">
                                            <label for="exampleFormControlInput1"
                                                class="form-label mb-0"><small>Registration Date:</small> </label>
                                            <input type="date" class="form-control" value="" name="vehicleRegDate"
                                                id="vehicleRegDate">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Upload Vehicle
                                            Image:</small> </label>
                                    <input type="file filepond" name="file" id="uploadVehicleImage">
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" id="submitVehicleInfo" class="btn btn-primary mb-3"> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ----------------------------------------
      Assigned Driver Vehicle Modal
 -------------------------------------- --}}
    <div class="modal fade" id="assignedDriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Assigned Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" value="" name="vehicle_id" id="vehicleId">
                    <div class="mb-3">
                        <p class="mb-0" id="vehicleTypeTemp" style="font-size:20px;"></p>
                        <p> Plate#: <span id="vehiclePlateNo"></span></p>
                        <label for="exampleFormControlInput1" class="form-label mb-0"><small> Available Drivers:</small>
                        </label>
                        <select class="form-select" id="selectedDriver" name="vehicle_driver"
                            aria-label="Default select example">
                            <option selected disabled>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value={{ $driver->id }}>{{ $driver->driver_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="submitDriverAssigned" class="btn btn-primary mb-3"> Assigned Driver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------------------------
      Change Driver Vehicle Modal
 --------------------------------------- --}}
    <div class="modal fade" id="changeDriver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Change Driver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" value="" name="changeVehicleDriverId" id="changeVehicleDriverId">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Available
                                Drivers:</small> </label>
                        <select class="form-select" id="selectedChangeDriver" name="vehicle_change_driver"
                            aria-label="Default select example">
                            <option selected disabled>Select Driver</option>
                            @foreach ($drivers as $driver)
                                <option value={{ $driver->id }}>{{ $driver->driver_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="button" id="submitChangeDriver" class="btn btn-primary mb-3"> Changed Driver
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ----------------------------------------
    Odo Meter Logs Modal
 -------------------------------------- --}}
    <div class="modal fade" id="odoLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Odo Meter Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="odoLogsInitTable" width="100%">
                                            <thead style="width:100%">
                                                <tr>
                                                    <th>Vehicle Kilometer Odo</th>
                                                    <th>Created_at</th>
                                                </tr>
                                            </thead>
                                            <tbody id="odoLogsTable">

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ----------------------------------------
    Tire Logs Modal
 -------------------------------------- --}}
    <div class="modal fade" id="tireLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Tires Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="tireLogsInitTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Front Left Tire</th>
                                                <th scope="col">Front Right Tire</th>
                                                <th scope="col">Rear Left Tire</th>
                                                <th scope="col">Rear Right Tire </th>
                                                <th scope="col">Date Replace</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tireLogsTable">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ----------------------------------------
    Battery Logs Modal
 -------------------------------------- --}}
    <div class="modal fade" id="batteryLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Batteries Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="batteryLogsInitTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Vehicle Kilometer Odo</th>
                                                <th scope="col">Created_at</th>
                                            </tr>
                                        </thead>
                                        <tbody id="batteryLogsTable">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ----------------------------------------
    PMS Modal
 -------------------------------------- --}}
    <div class="modal fade" id="pmsLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Preventive Maintenance Logs
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="pmsLogsInitTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">Vehicle Kilometer Odo</th>
                                                <th scope="col">Date Of Preventive Maintenance</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pmsLogsTable">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ----------------------------------------
    Registration Logs Modal
 -------------------------------------- --}}
    <div class="modal fade" id="registrationLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Registration Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped" id="registrationLogsInitTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Date Registered</th>
                                                <th scope="col">Date Registration Expired</th>
                                            </tr>
                                        </thead>
                                        <tbody id="registrationLogsTable">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- -------------------------------------------
    Vehicle Preventive Maintenance Offcanvas
 ----------------------------------------------- --}}
    <div class="offcanvas offcanvas-bottom" id="OdoLogRecords" aria-labelledby="offcanvasBottomLabel"
        style="background-color: #F4F3EF;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel"></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card" id="odoLogs" onclick="">
                            <div class="card-body px-2 py-3">
                                <div id="icon-container">
                                    <img src="{{ asset('img/odo_icon.png') }}" style="max-width: 60%"
                                        class="img-responsive">
                                </div>
                                <h4 class="mb-0 text-center" id="icon-title">Odo Kilometers</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" id="registrationLogs">
                            <div class="card-body px-2 py-3">
                                <div id="icon-container">
                                    <img src="{{ asset('img/registration_icon.png') }}" style="max-width: 60%"
                                        class="img-responsive">
                                </div>
                                <h4 class="mb-0 text-center" id="icon-title">Registration</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" id="tireLogs">
                            <div class="card-body">
                                <div id="icon-container">
                                    <img src="{{ asset('img/tire_icon.png') }}" style="max-width: 65%"
                                        class="img-responsive">
                                </div>
                                <h4 class="mb-0 text-center" id="icon-title">Tires</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" id="batteryLogs">
                            <div class="card-body">
                                <div id="icon-container">
                                    <img src="{{ asset('img/battery_icon.png') }}" style="max-width: 65%"
                                        class="img-responsive">
                                </div>
                                <h4 class="mb-0 text-center" id="icon-title">Battery</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card" id="pmsLogs">
                            <div class="card-body">
                                <div id="icon-container">
                                    <img src="{{ asset('img/pms_icon.png') }}" style="max-width: 65%"
                                        class="img-responsive">
                                </div>
                                <h4 class="mb-0 text-center" id="icon-title">PMS</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        //onchange function on company to select department
        $('#selectedCompany').on('change', () => {
            var vehicleCompanyId = $('#selectedCompany').val();
            axios.get('/vehicle-company/' + vehicleCompanyId)
                .then(function(response) {
                    $('#selectedDepartment').empty();
                    $('#selectedDepartment').append('<option selected disabled>Select Department</option>');
                    response.data.forEach(value => {
                        $('#selectedDepartment').append('<option value=' + value.id + '>' + value
                            .department_name + '</option>')
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //file upload using filepond
        var pond = FilePond.create(document.getElementById("uploadVehicleImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40",
            maxFiles: "1",
            server: {
                process: {
                    url: "/vehicle/upload-image",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                revert: {
                    url: "/vehicle/revert-image",
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    onload: function(x) {},
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            },
            onwarning(error) {
                if (error.code == 0) {
                    Swal.fire({
                        title: "Warning",
                        text: "You can only upload 1 Excel File.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok.",
                    });
                }
            },
        });

        //submit form of adding new vehicle
        $('#vehicleForm').on('submit', (e) => {
            e.preventDefault();

            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Saving New Vehicle in database ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#vehicleForm').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{ route('create.vehicle') }}",
                data: data,
                success: function(response) {
                    console.log(response);
                    location.reload();
                    $('#createVehicleModal').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }
                }
            });
        });

        //get Id of Vehicle to assigned vehicle Driver
        const onClickAssignedDriver = ($id) => {
            $('#vehicleId').val($id);
            axios.get('/vehicle-details/' + $id)
                .then(function(response) {
                    response.data.forEach(value => {
                        console.log(value);
                      $('#vehicleTypeTemp').text(value.vehicle_type);
                      $('#vehiclePlateNo').text(value.plate_no);
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })

            $('#assignedDriver').modal('show');
        }

        //get Id of Vehicle to change vehicle Driver
        const onClickChangeDriver = ($id) => {
            $('#changeVehicleDriverId').val($id);
            $('#changeDriver').modal('show');
        }

        //submit button for vehicle change driver
        $('#submitChangeDriver').on('click', () => {
            var selectedChangeDriverId = $('#selectedChangeDriver').val();
            var changeVehicleDriver = $('#changeVehicleDriverId').val();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Changed Driver to Vehicle ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('change.vehicle.driver') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'driver_id': selectedChangeDriverId,
                    'vehicle_id': changeVehicleDriver
                },
                success: function(response) {
                    location.reload();
                    $('#assignedDriver').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }

                }
            });
        })

        //submit button for vehicle driver assigned
        $('#submitDriverAssigned').on('click', () => {
            var selectedDriverId = $('#selectedDriver').val();
            var vehicleId = $('#vehicleId').val();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Assigned Driver to Vehicle ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('update.vehicle.driver') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'driver_id': selectedDriverId,
                    'vehicle_id': vehicleId
                },
                success: function(response) {
                    location.reload();
                    $('#assignedDriver').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }

                }
            });
        })

        // get vehicle information
        const onClickVehicleDetail = ($id) => {
            $('#vehicleDetailsModal').modal('show');
            axios.get('/vehicle-details/' + $id)
                .then(function(response) {
                    response.data.forEach(value => {
                        $('#vehicleName').text(value.vehicle_type)
                        $('#vehiclePlateDetails').val(value.plate_no)
                        $('#vehicleModelDetails').val(value.vehicle_year_model)
                        $('#vehicleMVFileDetails').val(value.mv_file_no)
                        $('#vehicleMotorDetails').val(value.motor_no)
                        $('#vehicleChasisDetails').val(value.chasis_no)
                        $('#vehicleOdoDetails').val(value.current_odo)
                        $('#vehicleRegDetails').val(value.date_registration)
                        $('#imageFile').attr('src', "/vehicle-retrieve-imagefile/" + value.image_path);
                        $('#vehicleIdForMaintenance').val(value.id);
                    });
                })
        }

        //open OffCanvas
        $('#openOffCanvas').on('click', function() {
            $('#OdoLogRecords').offcanvas('show');
            $('#vehicleDetailsModal').modal('hide');
        })

        //get request OdoLogs of vehicle using axios
        $('#odoLogs').on('click', function() {
            $('#odoLogsModal').modal('show');
            var id = $('#vehicleIdForMaintenance').val();
            axios.get('/vehicle-odo-logs/' + id)
                .then(function(response) {
                    $('#odoLogsTable').empty();
                    response.data.forEach(value => {
                        var dateObj = new Date(value.created_at);
                        var month = dateObj.getUTCMonth() + 1; //months from 1-12
                        var day = dateObj.getUTCDate();
                        var year = dateObj.getUTCFullYear();
                        var updatedOdoDate = year + "-" + month + "-" + day;
                        $('#odoLogsTable').append('<tr><td>' + value.current_odo + '</td><td>' +
                            updatedOdoDate + '</td></tr>')
                    });
                    $('#odoLogsInitTable').DataTable({
                        "destroy": true,
                        "order": [
                            [1, "desc"]
                        ]
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //get request Tire Log of vehicle using axios
        $('#tireLogs').on('click', function() {
            $('#tireLogsModal').modal('show');
            var id = $('#vehicleIdForMaintenance').val();
            axios.get('/vehicle-tire-logs/' + id)
                .then(function(response) {
                    $('#tireLogsTable').empty();
                    response.data.forEach(value => {
                        $('#tireLogsTable').append('<tr><td>' + value.front_left_tire + '</td><td>' +
                            value.front_right_tire + '</td><td>' + value.rear_left_tire +
                            '</td><td>' + value.rear_right_tire + '</td><td>' + value.date_replace +
                            '</td></tr>')
                    });
                    $('#tireLogsInitTable').DataTable({
                        "destroy": true,
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //get request Battery Log of vehicle using axios
        $('#batteryLogs').on('click', function() {
            $('#batteryLogsModal').modal('show');
            var id = $('#vehicleIdForMaintenance').val();
            axios.get('/vehicle-battery-logs/' + id)
                .then(function(response) {
                    $('#batteryLogsTable').empty();
                    response.data.forEach(value => {
                        $('#batteryLogsTable').append('<tr><td>' + value.brand_name + '</td><td>' +
                            value.date_replace + '</td></tr>')
                    });
                    $('#batteryLogsInitTable').DataTable({
                        "destroy": true,
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //get request Tire Log of vehicle using axios
        $('#pmsLogs').on('click', function() {
            $('#pmsLogsModal').modal('show');
            var id = $('#vehicleIdForMaintenance').val();
            axios.get('/vehicle-pms-logs/' + id)
                .then(function(response) {
                    $('#pmsLogsTable').empty();
                    response.data.forEach(value => {
                        $('#pmsLogsTable').append('<tr><td>' + value.kilometer_odo + '</td><td>' + value
                            .date_of_pm + '</td></tr>')
                    });
                    $('#pmsLogsInitTable').DataTable({
                        "destroy": true,
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })

        //get request Registration Log of vehicle using axios
        $('#registrationLogs').on('click', function() {
            $('#registrationLogsModal').modal('show');
            var id = $('#vehicleIdForMaintenance').val();
            axios.get('/vehicle-registration-logs/' + id)
                .then(function(response) {
                    $('#registrationLogsTable').empty();
                    response.data.forEach(value => {
                        $('#registrationLogsTable').append('<tr><td>' + value.date_registration +
                            '</td><td>' + value.date_expired + '</td></tr>')
                    });
                    $('#registrationLogsInitTable').DataTable({
                        "destroy": true,
                    });
                })
                .catch(function(error) {
                    console.log(error);
                })
        })
    </script>
@endsection
