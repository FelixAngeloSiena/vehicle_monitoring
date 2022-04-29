@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Welcome </strong>{{ Auth::user()->name }}</h1>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="img-sched d-flex justify-content-center">
                            <lottie-player src="https://assets6.lottiefiles.com/temporary_files/PH5YkW.json"  background="transparent"  speed="1"  style="max-width:50%;"  loop  autoplay></lottie-player>
                        </div>
                        <p class="text-center" style="font-size: 20px;">No Reservation Found Today!</p>
                        <div class="img-sched d-flex justify-content-center">
                            <button type="button" class="btn mb-3" data-bs-toggle="modal"
                            data-bs-target="#request_vehicle"  style="color:#fff;font-size:16px;font-weight:700;background-color:#074995;">
                                <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/> Request Vehicle</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <p style="font-size: 20px;"><img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/000000/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/> Request Schedule</p>
                        
                      
                        <div class="mb-0">
                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Needed:</small> </label>
                            <input type="date" class="form-control" name="vehicle_plate"  id="plate_number" value="">
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-0">
                                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Available Vehicle:</small> </label>
                                    <select class="form-select" id="selectedCompany" name="vehicle_company"
                                    aria-label="Default select example">
                                    <option selected disabled>Select Vehicle</option>
                             
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-0">
                                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Vehicle Plate#:</small> </label>
                                    <input type="text" class="form-control" value="" readonly name="vehicleModel"
                                    id="vehicleModel">
                                </div>
                            </div>
                        </div>

                    
                  
                    </div>
                </div>
            </div> --}}

        </div>
    </div>

<div class="modal fade" id="request_vehicle" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:#F4F3EF">
            <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Request Vehicle</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>
            <div class="modal-body ">
                <div class="row mx-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                          
                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Needed:</small> </label>
                                <input type="date" class="form-control" name="date_reservation"  id="date_reservation" value="">
                            </div>
    
                     
                         
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Available Vehicle:</small> </label>
                                        <select class="form-select" id="availableVehicle" name="availableVehicle"
                                        aria-label="Default select example">
                                        <option selected disabled>Select Vehicle</option>
                                 
                                    </select>
                                    </div>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver Id#:</small> </label>
                                        <input type="text" class="form-control" name="driver_id" readonly  id="driver_id" value="">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver Name:</small> </label>
                                        <input type="text" class="form-control" name="driver_name" readonly  id="driver_name" value="">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>License Type:</small> </label>
                                <input type="text" class="form-control" name="driver_license_type" readonly id="driver_license_type" value="">
                            </div>
                            <div class="mb-0">
                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>License Restriction:</small> </label>
                                <input type="text" class="form-control" name="driver_license_restriction" readonly id="driver_license_restriction" value="">
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
<script>
    $('#date_reservation').on('change',()=> {
        var date_reservation = $('#date_reservation').val();
        $.ajax({
                type: "POST",
                url: "{{ route('available.vehicle') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "date": date_reservation
                    },
                     success: function(response) {
                        $('#availableVehicle').empty();
                        response.forEach(value => {
                        $('#availableVehicle').append('<option value="'+value.id+'">'+value.vehicle_type+' - '+value.plate_no+'</option>');
                   
                    });
                }
            });
        })

        $('#availableVehicle').on('change',() => {
            var vehicleId = $('#availableVehicle').val();
            $.ajax({
                type: "POST",
                url: "{{ route('vehicle.driver.info')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": vehicleId
                    },
                     success: function(response) {
                        response.forEach(value => {
                         $('#driver_id').val(value.id_no);
                         $('#driver_name').val(value.name);
                         $('#driver_license_type').val(value.license_type);
                         $('#driver_license_restriction').val(value.restriction);
                    });
                
                        
                }
            });

        });

</script>
@endsection
