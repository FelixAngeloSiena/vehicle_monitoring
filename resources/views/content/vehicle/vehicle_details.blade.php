@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            @foreach ($vehicles as $vehicle)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center mt-5">
                                        <img src="/vehicle/retrieve-imagefile/{{ $vehicle->image_path }}" alt="a balloon" style="  max-width: 100%; height: 40vh; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card" style="border:solid 1px #251D3A">
                                        <div class="card-body">
                                            <form id="updateVehicleForm">
                                                @csrf
                                            <input type="hidden" name="vehicleId" value="{{$vehicle->id}}">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="mb-0" style="font-size: 26px" id="vehicleName">{{ $vehicle->vehicle_type }}</h4>
                                                <p class="mb-0" style="font-size: 16px"> <small>Registration Date:</small><span> {{ $vehicle->date_registration }}</span></p>
                                            </div>
                                                <p class="mb-0" style="font-size: 16px"><small>Driver:</small><span>{{ $vehicle->name == null ? 'No Drivers Assigned' : $vehicle->name }}</span></p>
                                                <p style="font-size: 16px"><small>Current Odo Meter:</small> <span> {{ $vehicle->current_odo }}/km</span></p>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1" class="form-label">Vehicle Type:</label>
                                                            <input type="text" value="{{$vehicle->vehicle_type}}" class="form-control" id="vehicleType" name="vehicleType">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1" class="form-label">Year Model:</label>
                                                            <input type="text" value="{{ $vehicle->vehicle_year_model }}" class="form-control" name="updateYearModel" id="updateYearModel">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1" class="form-label">Plate#:</label>
                                                            <input type="text" value="{{ $vehicle->plate_no }}" class="form-control" name="updatePlateNumber" id="updatePlateNumber">
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                                <div class="mb-0">
                                                    <label for="exampleFormControlInput1" class="form-label">MV File#:</label>
                                                    <input type="text" value="{{ $vehicle->mv_file_no }}" class="form-control" name="updateMVFile" id="updateMVFile">
                                                </div>
                                                <div class="mb-0">
                                                    <label for="exampleFormControlInput1" class="form-label">Motor#:</label>
                                                    <input type="text" value="{{ $vehicle->motor_no }}" class="form-control" name="updateMotor" id="updateMotor">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Chasis#:</label>
                                                    <input type="text" value="{{ $vehicle->chasis_no }}" class="form-control" id="updateChasis" name="updateChasis">
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <button type="submit" id="submitUpdateVehicle" style="font-size: 17px;background-color:#251D3A;color:#fff;border-radius:0px;font-weight:bold;" class="btn mb-3"> Update Vehicle</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

              
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card" id="odoLogs" onclick="odoLogs({{$id}})"
                                        style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body px-2 py-3">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/odo_icon.webp') }}" style="max-width: 63%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title" style="background-color: #FF0066;color:#fff;padding:10px 20px">Odo Kilometers</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="registrationLogs" onclick="registrationLogs({{$id}})"
                                    style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body px-2 py-3">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/registration_icon.webp') }}"
                                                    style="max-width: 75%" class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title"  style="background-color: #FF0066;color:#fff;padding:10px 20px">Registration</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="tireLogs" onclick="tireLogs({{$id}})"
                                    style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/tire_icon.webp') }}" style="max-width: 60%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title" style="background-color: #FF0066;color:#fff;padding:10px 20px">Tires</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="batteryLogs" onclick="batteryLogs({{$id}})"
                                    style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/battery_icon.webp') }}" style="max-width: 72%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title" style="background-color: #FF0066;color:#fff;padding:10px 20px">Battery</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="insuranceLogs"  onclick="insuranceLogs({{$id}})"
                                    style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/insurance_icon.webp') }}" class="py-2" style="max-width: 100%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title" style="background-color: #FF0066;color:#fff;padding:10px 20px">Insurance</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="pmsLogs"  onclick="pmsLogs({{$id}})"
                                    style="border:solid 1px#FF0066;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/pms_icon.webp') }}" style="max-width: 92%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title" style="background-color: #FF0066;color:#fff;padding:10px 20px">PMS</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



{{------------------------------------------
    ODO METER
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


{{------------------------------------------
TIRE MODAL
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


{{------------------------------------------
BATTERY MODAL
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

{{------------------------------------------
PMS MODAL
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
REGISTRATION MODAL
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

{{-- ----------------------------------------
INSURANCE MODAL
-------------------------------------- --}}
    <div class="modal fade" id="insuranceLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title" style="color:#fff;">Insuramce Logs</h5>
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
                                                <th scope="col"> Date of Insurance Registered</th>
                                                <th scope="col">Date of Insurance Expired</th>
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


@endsection
@section('script')
    <script>
        //GET ODO LOGS OF THE VEHICLE
        const odoLogs = (id) => {
            $('#odoLogsModal').modal('show');
            axios.get('/vehicle/odo-logs/' +id)
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
        }

        //GET REGISTRATION OF THE VEHICLE
        const registrationLogs = (id) => {
            $('#registrationLogsModal').modal('show');
            axios.get('/vehicle/registration-logs/' + id)
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
        }

         //GET TIRE OF THE VEHICLE
        const tireLogs = (id) => {
            $('#tireLogsModal').modal('show')
            axios.get('/vehicle/tire-logs/' + id)
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
        }

         //GET BATTERY LOGS OF THE VEHICLE
        const batteryLogs = (id) => {
            $('#batteryLogsModal').modal('show');
            axios.get('/vehicle/battery-logs/' + id)
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
        }
        
         //GET INSURANCE LOG OF THE VEHICLE
        const insuranceLogs = (id) => {
            $('#insuranceLogsModal').modal('show');
        }

         //GET PREVENTIVE MAINTENCE OF THE VEHICLE
        const pmsLogs = (id) => {
            $('#pmsLogsModal').modal('show');
            axios.get('/vehicle/pms-logs/' + id)
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
        }


     //submit form of adding new driver
     $('#updateVehicleForm').on('submit', (e) => {
            e.preventDefault();

            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Update Vehicle Details ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#updateVehicleForm').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{route('vehicle.update.details')}}",
                data: data,
                success: function(response) {
                    location.reload();
            
                }
            });
        });


    </script>
@endsection
