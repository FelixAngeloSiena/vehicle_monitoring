@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Vehicle </strong> Record</h1>
            </div>

            <div class="card">
                <div class="card-body shadow-sm">
                    <table id="vehicleTable" class="table-striped display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vehicle Type</th>
                                <th>Year Model</th>
                                <th>Plate#</th>
                                <th>MV File#</th>
                                <th>Motor#</th>
                                <th>Chasis#</th>
                                <th>Current Odo</th>
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
 Modal for Update Odo Moter Of Vehicle
 ----------------------------------------}}

 <div class="modal fade" id="update_odoMeter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #F4F3EF">

            <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Update Odo Meter</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>

            <div class="modal-body">
                <form id="updateOdoVehicle">
                    @csrf
                    <input type="hidden" id="vehicleId" name="vehicleId">
                    <div class="card shadow" style="border:solid 1px #cfcfcf">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label mb-0"><small>Current Odo Meter</small> </label>
                                <input type="text" class="form-control" name="updateOdo" id="updateOdo" value="">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" id="submitDriverInfo" class="btn btn-primary mb-3"> Update Odo Meter
                                </button>
                            </div>
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
    $(document).ready(function() {
        $('#vehicleTable').DataTable({
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'{{route("audit.vehicles")}}',
            columns:[
                {'data':'vehicle_id' },
                {'data':'vehicle_type' },
                {'data':'vehicle_year_model' },
                {'data':'plate_no' },
                {'data':'mv_file_no' },
                {'data':'motor_no' },
                {'data':'chasis_no' },
                {'data':'current_odo' },
                {'data':'actions'}
            ]
        });
    });

    const updateOdo = (id) => {
        $('#update_odoMeter').modal('show');
        $('#vehicleId').val(id);
    }


    $('#updateOdoVehicle').on('submit', (e) => {
        e.preventDefault();

        var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Updating Odo Meter of Vehicle ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });


        var data = $('#updateOdoVehicle').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{route('audit.update.odometer')}}",
                data: data,
                success: function(response) {
                    location.reload();
                }
            });
    });



</script>

@endsection
