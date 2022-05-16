@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Request</strong> Completed</h1>
            </div>
            <div class="card">
                <div class="card-body shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped" id="requestCompletedInitTable" width="100%">
                            <thead style="width:100%">
                                <tr>
                                    <th>Request#</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Plate#</th>
                                    <th>Request Type</th>
                                    <th>Request Date</th>
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
        $('#requestCompletedInitTable').DataTable({
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'/purchasing/fetch/request/completed',
            columns:[
                {'data':'id'},
                {'data':'vehicle_type'},
                {'data':'plate_no' },
                {'data':'request_type'},
                {'data':'request_date'},
                {'data':'status' },
            ]
        });
    }
    </script>
@endsection