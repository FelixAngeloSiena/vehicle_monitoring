@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle Drivers</strong> Records</h1>
                </div>
                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="reservationInitTable" class="table-striped display" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle Plate#</th>
                                    <th>Date Reserve</th>
                                    <th>Created_at</th>
                                    <th>Status</th>
                                    <th>action</th>
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
@endsection
@section('script')
<script>

$( document ).ready(function() {
    $('#reservationInitTable').DataTable({
            dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print',
                ],
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'/fetch/reservation',
            columns:[
                {'data':'driver_name'},
                {'data':'vehicle_type'},
                {'data':'plate_no' },
                {'data':'reservation_date'},
                {'data':'createdAt'},
                {'data':'status'},
                {'data':'actions'},
            ]
        });
});

const cancel_reservation = (id) => {
    console.log(id);
}
     

</script>
@endsection
