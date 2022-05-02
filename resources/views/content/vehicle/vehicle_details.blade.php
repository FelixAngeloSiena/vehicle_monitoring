@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            @foreach ($vehicles as $vehicle)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card" style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <img src="/vehicle/retrieve-imagefile/{{ $vehicle->image_path }}"
                                                    alt="a balloon" style="  max-width: 100%;
                                                height: 40vh;
                                                object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-5">
                                    <h4 class="mb-0" style="font-size: 26px" id="vehicleName">
                                        {{ $vehicle->vehicle_type }}</h4>
                                    <p style="font-size: 16px">
                                        Driver:<span>{{ $vehicle->name == null ? 'No Drivers Assigned' : $vehicle->name }}</span>
                                    </p>
                                    <hr>
                                    <p class="mb-0" style="font-size: 16px"> Plate#:<span>
                                            {{ $vehicle->plate_no }}</span></p>
                                    <p class="mb-0" style="font-size: 16px"> Year Model#:<span>
                                            {{ $vehicle->vehicle_year_model }}</span></p>
                                    <p class="mb-0" style="font-size: 16px"> MV File#:<span>
                                            {{ $vehicle->mv_file_no }}</span></p>
                                    <p class="mb-0" style="font-size: 16px"> Motor#:<span>
                                            {{ $vehicle->motor_no }}</span></p>
                                    <p class="mb-0" style="font-size: 16px"> Chasis#:<span>
                                            {{ $vehicle->chasis_no }}</span></p>
                                    <p class="mb-0" style="font-size: 16px"> Registration Date:<span>
                                            {{ $vehicle->date_registration }}</span></p>
                                    <p style="font-size: 16px"> Current Odo Meter:<span> {{ $vehicle->current_odo }}</span>
                                    </p>
                                    <button type="button" class="btn btn-primary"
                                        style="color:#fff;font-size:17px;font-weight:bold"> <img
                                            src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png" />
                                        Update Details</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card" id="odoLogs" onclick="odoLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body px-2 py-3">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/odo_icon.png') }}" style="max-width: 63%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title">Odo Kilometers</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="registrationLogs" onclick="registrationLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body px-2 py-3">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/registration_icon.png') }}"
                                                    style="max-width: 75%" class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title">Registration</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="tireLogs" onclick="tireLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/tire_icon.png') }}" style="max-width: 60%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title">Tires</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="batteryLogs" onclick="batteryLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/battery_icon.png') }}" style="max-width: 72%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title">Battery</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="insuranceLogs"  onclick="insuranceLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/insurance_icon.png') }}" class="py-2" style="max-width: 100%"
                                                    class="img-responsive">
                                            </div>
                                            <h4 class="mb-0 text-center" id="icon-title">Insurance</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card" id="pmsLogs"  onclick="pmsLogs({{$id}})"
                                        style="background-color: #EDEDED;border-radius:0px">
                                        <div class="card-body">
                                            <div id="icon-container">
                                                <img src="{{ asset('img/pms_icon.png') }}" style="max-width: 90%"
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

    </script>
@endsection
