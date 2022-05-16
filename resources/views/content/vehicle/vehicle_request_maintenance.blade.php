@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Request for </strong> Maintenance </h1>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                    style="color:#fff;font-size:17px;font-weight:bold" data-bs-target="#create_request"> 
                    <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/>
                    Create Request
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                         <table id="requestAcknowledeInitTable" class="table-striped display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Request Type</th>
                                <th>Description</th>
                                <th>Request Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


{{-- ----------------------------------------
 Modal for Create Request PMS Of Vehicle
 ----------------------------------------}}
 <div class="modal fade" id="create_request" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #F4F3EF">

            <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Create Request</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>

            <div class="modal-body">
                <form id="createRequestMaintenance">
                    @csrf
                    <div class="card shadow" style="border:solid 1px #cfcfcf">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label mb-0"><small>Available Vehicles</small> </label>
                                 <select class="form-select" id="vehicleId"
                                    name="vehicleId">
                                    <option selected disabled>Select Vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{$vehicle->id}}">{{ $vehicle->vehicle_type}} - {{$vehicle->plate_no}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label mb-0"><small>Request Type</small> </label>
                                 <select class="form-select" id="request_type" name="request_type"
                                    name="request_type">
                                    <option >Select Type</option>
                                    <option value="tire">Tire</option>
                                    <option value="battery">Battery</option>
                                    <option value="pms">PMS</option>
                                </select>
                            </div>
                            <div id="tireCheckbox" style="border: 1px solid #ced4da;display:none">
                                <div class="row p-2">
                                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Select Position Of Tire</small> </label>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="frontLeftTire" value="isChecked" id="frontLeftTire">
                                            <label class="form-check-label" for="flexCheckDefault">Front Left Tire </label>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="frontRightTire" value="isChecked" id="frontRightTire">
                                            <label class="form-check-label" for="flexCheckDefault">Front Right Tire </label>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="rearLeftTire" value="isChecked" id="rearLeftTire">
                                            <label class="form-check-label" for="flexCheckDefault">Rear Left Tire </label>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="rearRightTire" value="isChecked" id="rearRightTire">
                                            <label class="form-check-label" for="flexCheckDefault">Rear Right Tire </label>
                                          </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3" id="description">
                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Description</small> </label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="create_request" class="btn btn-primary mb-3"> Create Request </button>
                            </div>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- ----------------------------------------
 Modal for Request Details
 ----------------------------------------}}
 <div class="modal fade" id="request_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #F4F3EF">

            <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Request Details</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>

            <div class="modal-body">
              
                    <div class="card shadow" style="border:solid 1px #cfcfcf">
                        <div class="card-body">
                            <form id="acknowledge-form">
                                @csrf
									<div class="d-flex justify-content-between mb-0">
										<div>
											<p style="font-size: 20px;" class="mb-0" id="vehicleType"></p>
											<p class="mb-0"> Plate#: <span id="vehiclePlate"></span></p>
										</div>
										<p>Request Type: <span id="requestType" style="font-size: 20px;font-weigth:bold;text-transform: capitalize;"></span></p>
								  </div>
								  <p class="mb-3" > Description: <span id="requestDesc" style="color:red;font-weight:bold;"></span></p>
								  <hr>
                                 <input type="hidden" id="request_id" name="requestId" value="">
                                 <input type="hidden" id="requestTypeInput" name="requestType" value="">
                                 <input type="hidden" id="requestVehicleId" name="requestVehicleId" value="">
                                 <input type="hidden" id="requestSupplier" name="requestSupplier" value="">
                                  <div id="errorMessage">
                                  </div>
                                  <table class="table" id="TablePODetails" style="max-width: 100%">
                                    <thead>
                                      <tr>
                                        <th scope="col">PO#</th>
                                        <th scope="col">Request Type</th>
                                        <th scope="col">Date Sent</th>
                                        <th scope="col">supplier_name</th>
                                        <th scope="col">remarks</th>
                                      </tr>
                                    </thead>
                                    <tbody id="poDetails">
                                    </tbody>
                                  </table>
                                    <div id="successMsg" style="display: none">
                                        <div class="card" style="background-color:#1CBB8C">
                                            <div class="card-body">
                                                <p class="text-center fs-4" style="color:#fff;">This request finish to acknowledge</p>
                                            </div>
                                        </div>
                                    
                                    </div>
                                  <div class="d-flex justify-content-between bd-highlight">
                                    <div class="mb-0" id="dateReplaceContainer">
                                        <label for="exampleFormControlInput1"
                                            class="form-label mb-0"><small>Date of Replacement</small>
                                        </label>
                                        <input type="date" class="form-control" name="dateChange" id="dateChange" required>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" id="btnAcknowledgement" class="btn btn-primary mb-3"> <i class="fas fa-check-double"></i> Acknowledge </button>
                                    </div>
                                  </div>
                            </form>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>


    const initTable = () => {
     $('#requestAcknowledeInitTable').DataTable({
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'{{route("vehicle.create.maintenance.record")}}',
            columns:[
                {'data':'request_type' },
                {'data':'description' },
                {'data':'status'},
                {'data': 'created_at'},
                {'data':'actions' },
       
            ]
        });
    }

    $(document).ready(function() {
        initTable();
    });

    $('#createRequestMaintenance').on('submit', (e) => {
        e.preventDefault();
        var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Creating New Request Maintenance ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            var data = $('#createRequestMaintenance').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{route('vehicle.create.maintenance')}}",
                data: data,
                success: function(response) {
                    location.reload();
                }
            });
    });

    $('#request_type').on('change',() => {
      var requestType =  $('#request_type').val();
      requestType == 'tire' ? $('#tireCheckbox').show() : $('#tireCheckbox').hide(); 
    })

    const requestDetails = (id) => {
             $.ajax({
				type: "GET",
				url: "/vehicle/request/maintenance/details/"+id,
				success: function(response) {                    
                    $('#request_details').modal('show');
                    var value = response.request_details;
                    var res = response.po_details;
             
                    $('#poDetails').empty();
                    $('#errorMessage').empty();
                    $('#vehicleType').text(value.vehicle_type)
                    $('#vehiclePlate').text(value.plate_no)
                    $('#requestType').text(value.request_type)
                    $('#requestDesc').text(value.description)	
                    $('#request_id').val(id)	
                    $('#requestTypeInput').val(value.request_type)
                    $('#requestVehicleId').val(value.vehicle_id);
                  
                                  
                    if(response.po_counts > 0 && res[0].status == 'ready'){
                        console.log('ready')
                    
                    for(var x = 0; x < response.po_counts; x++) {
                        $('#requestSupplier').val(res[x].supplier_name);
                        $('#poDetails').append(`
                        <tr>
                            <td>${res[x].po_number}</td>
                            <td>${res[x].request_type}</td>  
                            <td>${res[x].date_sent}</td>           
                            <td>${res[x].supplier_name}</td>    
                            <td>${res[x].remarks}</td>    
                        </tr> 
                        `) 
                    }  
                        $('#successMsg').hide();
                        $('#btnAcknowledgement').show();
                        $('#TablePODetails').show();
                        $('#dateReplaceContainer').show();
               
                    }
                    else if(response.po_counts > 0 && res[0].status == 'completed'){
                        $('#successMsg').show();
                        $('#btnAcknowledgement').hide();
                        $('#TablePODetails').hide();
                        $('#dateReplaceContainer').hide();
                    }
                    
                    else{
                        $('#btnAcknowledgement').hide();
                        $('#TablePODetails').hide();
                        $('#errorMessage').append(`
                            <div class="alert " role="alert">
                                <div class="card" style="background-color:#E40568">
                                    <div class="card-body">
                                        <p class="text-center fs-4" style="color:#fff;">Pending For P.O Creating</p>
                                    </div>
                                </div>
                            </div>
                        `)
                        $('#successMsg').hide();
                        $('#dateReplaceContainer').hide();
                    }        

				}
		});
    }
    $('#acknowledge-form').on('submit', (e) => {
        e.preventDefault();
        var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Acknowledge PO Request ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            var data = $('#acknowledge-form').serializeArray();
        $.ajax({
				type: "POST",
				url: "{{route('vehicle.acknowledge.request')}}",
                data: data,
				success: function(response) {  
                    console.log(response);
                if (response.status == 'ERROR') {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                } else if (response.status == "SUCCESS") {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success'
                    }).then((result) => {
                        $('#request_details').modal('hide');
                        swal.close();
                        initTable();
                    })
                }       
			}
		});
    })


</script>
@endsection
