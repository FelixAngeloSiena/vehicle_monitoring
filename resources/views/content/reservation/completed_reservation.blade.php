@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Cancel</strong> Reservation</h1>
            </div>
            <div class="card" style="border: 1px solid #251D3A">
                <div class="card-body shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped" id="reservationCompletedInitTable" width="100%">
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
                                <tbody>
                                </tbody>
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
            $('#reservationCompletedInitTable').DataTable({
                destroy: true,
                responsive: true,
                serverSide:true,
                processing:true,
                ajax:'/fetch/approve/completed',
                columns:[
                    {'data':'name'},
                    {'data':'_driver_name' },
                    {'data':'vehicle_type' },
                    {'data':'plate_no'},
                    {'data':'reservation_date'},
                    {'data':'_created_at' },
                    {'data':'_status'},
                ]
            });
        }
    </script>
@endsection