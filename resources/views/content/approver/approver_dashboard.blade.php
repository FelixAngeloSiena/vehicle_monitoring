@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Approver Request</strong> Reservation</h1>
            </div>
            <div class="card">
                <div class="card-body shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-striped" id="approverReservationInitTable" width="100%">
                            <thead style="width:100%">
                                        <tr>
                                            <th>Requestor Name</th>
                                            <th>Driver Name</th>
                                            <th>Vehicle Name</th>
                                            <th>Vehicle Plate#</th>
                                            <th>Date Reserve</th>
                                            <th>Created_at</th>
                                            <th>Status</th>
                                            <th>actions</th>
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
    
    //INITIATE DATATABLE WHEN THE DOM IS READY
    $( document ).ready(function() {
        initTable();
    });

    //FUNCTION FOR SET DATA TO THE DATATABLE
    const initTable = () => {
        $('#approverReservationInitTable').DataTable({
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'/approver/fetch/reservation',
            columns:[
                {'data':'requestor_name'},
                {'data':'_driver_name'},
                {'data':'vehicle_type'},
                {'data':'plate_no' },
                {'data':'reservation_date'},
                {'data':'createdAt'},
                {'data':'status'},
                {'data':'actions'},
            ]
        });
    }

    //ONCLICK FUNCTION THAT APPROVE THE RESERVATION REQUEST
    const approve_reservation = (id) => {
            var swal = Swal.fire({
            title: 'Please Wait',
            text: 'Cancel Reservation Process...',
            icon: 'info',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            type: "GET",
            url: "/approver/approve/reservation/"+id,
            success: function(response) {
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
                        initTable();
                        swal.close();
                    })
                }
            }
        });
 
    }

    //ONCLICK FUNCTION THAT CANCEL THE RESERVATION REQUEST
    const cancel_reservation = (id) => {
        var swal = Swal.fire({
            title: 'Please Wait',
            text: 'Cancel Reservation Process...',
            icon: 'info',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            type: "GET",
            url: "/approver/cancel/reservation/"+id,
            success: function(response) {
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
                        initTable();
                        swal.close();
                    })
                }
            }
        });
    }

    </script>
@endsection