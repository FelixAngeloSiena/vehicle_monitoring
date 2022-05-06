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
        console.log(id);
    }
</script>

@endsection
