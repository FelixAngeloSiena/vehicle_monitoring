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
                                  <div class="card" id="odoLogs" onclick="onClickOdoLogs({{$id}})"
                                      style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body px-2 py-3">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/odo_icon.webp') }}" style="max-width: 63%"
                                                  class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title" style="background-color: #251D3A;color:#fff;padding:10px 20px">Odo Kilometers</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="card" id="registrationLogs" onclick="onClickRegistrationLogs({{$id}})"
                                  style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body px-2 py-3">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/registration_icon.webp') }}"
                                                  style="max-width: 75%" class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title"  style="background-color: #251D3A;color:#fff;padding:10px 20px">Registration</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="card" id="tireLogs" onclick="onClickTireLogs({{$id}})"
                                  style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/tire_icon.webp') }}" style="max-width: 60%"
                                                  class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title" style="background-color: #251D3A;color:#fff;padding:10px 20px">Tires</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="card" id="batteryLogs" onclick="onClickBatteryLogs({{$id}})"
                                  style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/battery_icon.webp') }}" style="max-width: 72%"
                                                  class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title" style="background-color: #251D3A;color:#fff;padding:10px 20px">Battery</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="card" id="insuranceLogs"  onclick="onClickInsuranceLogs({{$id}})"
                                  style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/insurance_icon.webp') }}" class="py-2" style="max-width: 100%"
                                                  class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title" style="background-color: #251D3A;color:#fff;padding:10px 20px">Insurance</h4>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="card" id="pmsLogs"  onclick="onClickPmsLogs({{$id}})"
                                  style="border:solid 1px#251D3A;border-radius:0px;box-shadow: -2px 2px 109px -35px rgba(0,0,0,0.6);">
                                      <div class="card-body">
                                          <div id="icon-container">
                                              <img src="{{ asset('img/pms_icon.webp') }}" style="max-width: 92%"
                                                  class="img-responsive">
                                          </div>
                                          <h4 class="mb-0 text-center" id="icon-title" style="background-color: #251D3A;color:#fff;padding:10px 20px">PMS</h4>
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
ODO METER LOGS MODAL
 -----------------------------------------}}
<div class="modal fade" id="odoLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#F4F3EF">
            <div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Vehicle Odo Meter Logs</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
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
                                                <th>Updated_at</th>
                                            </tr>
                                        </thead>
                                        <tbody >
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
            <div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Vehicle Tire Logs</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
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
                                            <th scope="col">Date Tire Changed</th>
                                            <th scope="col">Date Tire Next Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
<div class="modal fade" id="registrationLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#F4F3EF">
            <div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
              <h5 class="modal-title" id="modal-reservation-title"
                  style="color:#fff;font-size:20px;font-weight:bold">Vehicle Registration Logs</h5>
              <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>
            <div class="modal-body">
                @if(Auth::user()->role == 'logistic')
                <div class="card">
                    <div class="card-body">
                        <form id="updateRegistrationForm">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="vehicleId" value="{{$id}}" />

                                <table class="table  table-striped">
                                    <thead>
                                      <tr>
                                        <th scope="col">Date Registered:</th>
                                        <th scope="col">Date Registration Expired:</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td><input type="date" value="" class="form-control" id="date_vehicle_registration" name="date_vehicle_registration"></td>
                                        <td> <input type="date" value="" class="form-control" id="date_vehicle_xpiration" name="date_vehicle_xpiration"></td>
                                        <td>
                                        <button type="submit" class="btn"
                                            style="color:#fff;font-size:15px;font-weight:bold;background-color:#251D3A">
                                            <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/20/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/>
                                                Re-new Registration
                                        </button>
                                        </td>
                                      </tr>
                                
                                    </tbody>
                                  </table>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="registrationLogsInitTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date Registered</th>
                                            <th scope="col">Date Registration Expired</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
						<div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
							<h5 class="modal-title" id="modal-reservation-title"
									style="color:#fff;font-size:20px;font-weight:bold">Vehicle Battery Logs</h5>
							<i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
						</div>
						<div class="modal-body">
								<div class="card">
										<div class="card-body">
												<div class="row">
														<div class="col-md-12">
																<table class="table table-striped" id="batteryLogsInitTable" style="width:100%">
																		<thead>
																				<tr>
																						<th scope="col">Battery Supplier Name</th>
																						<th scope="col">Date Battery Changed</th>
																						<th scope="col">Date Battery Next Change</th>
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
INSURANCE MODAL
-------------------------------------- --}}
<div class="modal fade" id="insuranceLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#F4F3EF">
            <div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
            <h5 class="modal-title" id="modal-reservation-title"
                style="color:#fff;font-size:20px;font-weight:bold">Vehicle Insurance Logs</h5>
            <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>
            <div class="modal-body">
            @if(Auth::user()->role == 'logistic')
                <div class="card">
                    <div class="card-body">
                        <form id="insuranceFormUpdate">
                            @csrf
                        <div class="row">
                            <input type="hidden" name="vehicleId" value="{{$id}}">
                            <table class="table  table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">Date of Insurance Registered:</th>
                                    <th scope="col">Date of Insurance Expired:</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><input type="date" value="" class="form-control" id="date_insurance_applied" name="date_insurance_applied"></td>
                                    <td><input type="date" value="" class="form-control" id="date_insurance_xpired" name="date_insurance_xpired"></td>
                                    <td>
                                    <button type="submit" class="btn" 
                                        style="color:#fff;font-size:15px;font-weight:bold;background-color:#251D3A" >
                                        <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/20/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/>
                                        Re-new Insurance
                                    </button>
                                    </td>
                                  </tr>
                            
                                </tbody>
                              </table>
                        </div>
                    </form>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped" id="insuranceLogsInitTable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col"> Date of Insurance Registered</th>
                                            <th scope="col">Date of Insurance Expired</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
PREVENTIVE MAINTENANCE MODAL
-------------------------------------- --}}
<div class="modal fade" id="pmsLogsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
				<div class="modal-content" style="background-color:#F4F3EF">
						<div class="d-flex justify-content-between p-3" style="background-color: #251D3A;">
								<h5 class="modal-title" id="modal-reservation-title"
										style="color:#fff;font-size:20px;font-weight:bold">Vehicle Preventive Maintenance Logs</h5>
								<i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
							</div>
						<div class="modal-body">
								<div class="card">
										<div class="card-body">
												<div class="row">
														<div class="col-md-12">
																<table class="table table-striped" id="pmsLogsInitTable" style="width:100%">
																		<thead>
																				<tr>
																						<th scope="col">Vehicle Odo Meter</th>
																						<th scope="col">Date Of Preventive Maintenance</th>
																						<th scope="col">Date Of Next Preventive Maintenance</th>
																				</tr>
																		</thead>
																		<tbody>
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
        //INITIALIZE DATA OF ODO LOGS IN DATATABLE
        const onClickOdoLogs = (id) => {
            $('#odoLogsModal').modal('show');
                $('#odoLogsInitTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel', 'pdf', 'print',
                    ],
                    destroy: true,
                    responsive: true,
                    serverSide:true,
                    processing:true,
                    ajax:'/vehicle/odo/logs/' +id,
                    columns:[
                        {'data':'current_odo' },
                        {'data':'created_at' },
                    ]
                });
        }

        //INITIALIZE DATA OF TIRE LOGS IN DATATABLE
        const onClickTireLogs = (id) => {
            $('#tireLogsModal').modal('show');
                $('#tireLogsInitTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel', 'pdf', 'print',
                    ],
                    destroy: true,
                    responsive: true,
                    serverSide:true,
                    processing:true,
                    ajax:'/vehicle/tire/logs/'+id,
                    columns:[
                        {'data':'front_left_tire' },
                        {'data':'front_right_tire' },
                        {'data':'rear_left_tire' },
                        {'data':'rear_right_tire' },
                        {'data':'_date_changed' },
                        {'data':'_date_next_change'},
                    ]
                });
        }

        //FUNCTION INITIALIZE DATA OF REGISTRATION LOGS IN DATATABLE
        const initTableRegistration = (id) => {
            $('#registrationLogsInitTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print',
                ],
                destroy: true,
                responsive: true,
                serverSide:true,
                processing:true,
                ajax:'/vehicle/registration/logs/'+id,
                columns:[
                    {'data':'_date_registration' },
                    {'data':'_date_expired' },
                ]
            });
        }



        //INITIALIZE DATA OF REGISTRATION LOGS IN DATATABLE
        const onClickRegistrationLogs = (id) => {
            initTableRegistration(id);
            $('#registrationLogsModal').modal('show');
         
        }

        //INITIALIZE DATA OF BATTERY LOGS IN DATATABLE
        const onClickBatteryLogs = (id) => {
            $('#batteryLogsModal').modal('show');
                $('#batteryLogsInitTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print',
                ],
                destroy: true,
                responsive: true,
                serverSide:true,
                processing:true,
                ajax:'/vehicle/battery/logs/'+id,
                columns:[
                    {'data':'brand_name' },
                    {'data':'_date_changed' },
                    {'data':'_date_next_change' },
                ]
            });
        }


        //FUNCTION INITIALIZE DATA OF REGISTRATION LOGS IN DATATABLE
        const initTableInsurance = (id) => {
            $('#insuranceLogsInitTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                        'csv', 'excel', 'pdf', 'print',
                ],
                destroy: true,
                responsive: true,
                serverSide:true,
                processing:true,
                ajax:'/vehicle/insurance/logs/'+id,
                columns:[
                        {'data':'_date_insurance_applied' },
                        {'data':'_date_insurance_expired' },
                ]
            });
 
        }


        //INITIALIZE DATA OF BATTERY LOGS IN DATATABLE
        const onClickInsuranceLogs = (id) => {
            initTableInsurance(id)
            $('#insuranceLogsModal').modal('show');
       
        }

        //INITIALIZE DATA OF PMS LOGS IN DATATABLE
        const onClickPmsLogs = (id) => {
            $('#pmsLogsModal').modal('show');
                $('#pmsLogsInitTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                                'csv', 'excel', 'pdf', 'print',
                        ],
                        destroy: true,
                        responsive: true,
                        serverSide:true,
                        processing:true,
                        ajax:'/vehicle/pms/logs/'+id,
                        columns:[
                                {'data':'kilometer_odo' },
                                {'data':'_date_of_pm' },
                                {'data':'_date_of_next_pms' },
                        ]
                });
        }

        //SUBMIT FORM OF UPDATED VEHICLE DETAILS
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

        //UPDATE REGISTRATION FORM 
        $('#updateRegistrationForm').on('submit', (e) => {
            e.preventDefault();
            var swal = Swal.fire({
                    title: 'Please Wait',
                    text: 'Updating Vehicle Registration ...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                     Swal.showLoading();
                    }
            });

            var data = $('#updateRegistrationForm').serializeArray();
            $.ajax({
                    type: "POST",
                    url: "{{route('vehicle.update.registration')}}",
                    data: data,
                    success: function(response) {
                        initTableRegistration(response.id);
                        swal.close();
            }
        });
    });

    
    $('#insuranceFormUpdate').on('submit', (e) => {
            e.preventDefault();
            var swal = Swal.fire({
                    title: 'Please Wait',
                    text: 'Updating Vehicle Insurance ...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                     Swal.showLoading();
                    }
            });

            var data = $('#insuranceFormUpdate').serializeArray();
            $.ajax({
                    type: "POST",
                    url: "{{route('vehicle.update.insurance')}}",
                    data: data,
                    success: function(response) {
                        initTableInsurance(response.id);
                        swal.close();
            }
        });
    });



    </script>
@endsection
