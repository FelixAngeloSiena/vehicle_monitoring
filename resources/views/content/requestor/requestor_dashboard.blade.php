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
                        <div class="row">
                            <div class="col-md-7">
                                @if (count($scheduleTodays) > 0)
                                <p style="font-size: 20px;font-weight:bold">Your Reservation Today</p>
                                    @foreach ($scheduleTodays as $scheduleToday)
                                    <div class="alert alert-success" role="alert">
                                        <p class="mb-0" style="font-size:25px;font-weight:bold">{{date('d M Y', strtotime($scheduleToday->reservation_date)) }}</p>
                                        <p class="mb-0" style="font-size:20px;">Vehicle: {{$scheduleToday->vehicle_type}}</p>
                                        <p class="mb-0" style="font-size:20px;">Vehicle Plate#: {{$scheduleToday->plate_no}}</p>
                                        <p class="mb-0" style="font-size:20px;">Driver ID#: {{$scheduleToday->id_no}}</p>
                                        <p class="mb-0" style="font-size:20px;">Driver Name: {{$scheduleToday->name}}</p>
                                      </div>
                                    @endforeach
                                @else
                                    <div class="img-sched d-flex justify-content-center">
                                        <lottie-player src="https://assets6.lottiefiles.com/temporary_files/PH5YkW.json"
                                            background="transparent" speed="1" style="max-width:100%;" loop autoplay>
                                        </lottie-player>
                                    </div>

                                        <p class="mb-0 text-center" class="text-center">No Reservation Found Today!</p>
                                   
                                @endif
                            </div>


                            <div class="col-md-5">
                                <div class="card" style="border:solid 1px #cfcfcf">
                                    <div class="card-body">
                                        <p style="font-size:25px;font-weight:bold">Request Schedule for Vehicle</p>
                                <form id="createReservation">
                                    @csrf
                                    <input type="hidden" value="" id="userId" name="userId">
                                    <input type="hidden" value="" id="vehicleId" name="vehicleId">
                                    <input type="hidden" value="" id="dateReserve" name="dateReserve">
                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date
                                                Needed:</small> </label>
                                        <input type="date" min="{{now()->format('Y-m-d')}}" class="form-control" name="date_reservation"
                                            id="date_reservation" value="">
                                    </div>


                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Company</small> </label>
                                        <select class="form-select" id="company" name="company"
                                            aria-label="Default select example">
                                            <option selected disabled>Select Company</option>
                                            @foreach ($companies as $company)
                                             <option value="{{$company->id}}">{{ $company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Available
                                                Vehicle:</small> </label>
                                        <select class="form-select" id="availableVehicle" name="availableVehicle"
                                            aria-label="Default select example">
                                            <option selected disabled>Select Vehicle</option>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver
                                                        Id#:</small> </label>
                                                <input type="text" class="form-control" name="driver_id" readonly
                                                    id="driver_id" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="mb-0">
                                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver
                                                        Name:</small> </label>
                                                <input type="text" class="form-control" name="driver_name" readonly
                                                    id="driver_name" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>License
                                                Type:</small> </label>
                                        <input type="text" class="form-control" name="driver_license_type" readonly
                                            id="driver_license_type" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>License
                                                Restriction:</small> </label>
                                        <input type="text" class="form-control" name="driver_license_restriction" readonly
                                            id="driver_license_restriction" value="">
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary mb-3"><img
                                                src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png" />
                                            Submit Request </button>
                                    </div>
                            </div>
                            </form>
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

        $('#date_reservation').on('change', () => {
            var date_reservation = $('#date_reservation').val();
            $('#dateReserve').val(date_reservation);
        })


        $('#company').on('change',() => {
            var companyId = $('#company').val();
            var dateReserve =  $('#dateReserve').val();
            
            $.ajax({
                type: "POST",
                url: "{{ route('available.vehicle') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "company_id": companyId,
                    "date_reserve":dateReserve
                },
                success: function(response) {
                    $('#availableVehicle').empty();
                    $('#availableVehicle').append(' <option selected disabled>Select Vehicle</option>')   
                    $.each(response, function(index, data) {
                         $('#availableVehicle').append('<option value="'+data.id+'">'+data.vehicle_type+ '</option>')   
                    })
                }
            });
            
        })


        $('#availableVehicle').on('change', () => {
            var vehicleId = $('#availableVehicle').val();
            $.ajax({
                type: "POST",
                url: "{{ route('vehicle.driver.info') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": vehicleId
                },
                success: function(response) {
                    $.each(response, function(index, data) {
                        $('#userId').val(data.userID);
                        $('#vehicleId').val(data.vehicleID);
                        $('#driver_id').val(data.id_no);
                        $('#driver_name').val(data.name);
                        $('#driver_license_type').val(data.license_type);
                        $('#driver_license_restriction').val(data.restriction);
                    })
                }
            });
        });



        $('#createReservation').on('submit', (e) => {
            e.preventDefault();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Saving New Driver in database ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#createReservation').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{ route('create.reservation') }}",
                data: data,
                success: function(response) {
                    location.reload();
                }
            });
        });
    </script>
@endsection
