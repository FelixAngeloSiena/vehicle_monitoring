@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Approver Approve</strong> Reservation</h1>
            </div>
            <div class="card">
                <div class="card-body shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped" id="approverApproveReservationInitTable" width="100%">
                            <thead style="width:100%">
                                        <tr>
                                            <th>Requestor Name</th>
                                            <th>Driver Name</th>
                                            <th>Vehicle Name</th>
                                            <th>Vehicle Plate#</th>
                                            <th>Date Reserve</th>
                                            <th>Created_at</th>
                                            <th>Status</th>
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



@endsection
@section('script')
    <script>

    $( document ).ready(function() {
        initTable();
    });

    const initTable = () => {
        $('#approverApproveReservationInitTable').DataTable({
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'{{route('fetch.approver.cancel.reservation')}}',
            columns:[
                {'data':'requestor_name'},
                {'data':'_driver_name'},
                {'data':'vehicle_type'},
                {'data':'plate_no' },
                {'data':'reservation_date'},
                {'data':'createdAt'},
                {'data':'status'},
            ]
        });
    }
    </script>
@endsection