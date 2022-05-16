@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Vehicle Monitoring</strong> Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">{{$vehiclesCount > 0 ?  $vehiclesCount : '0'}}</p>
                                <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:20px;line-height:2px;">Total</p>
                                <p style="font-family: 'Kanit', sans-serif;font-size:20px;">Vehicles</p>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-car-alt fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">{{$reservationsCount > 0 ?  $reservationsCount : '0'}}</p>
                                <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:20px;line-height:2px;">Today's</p>
                                <p style="font-family: 'Kanit', sans-serif;font-size:20px;">Reservations</p>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img src="https://img.icons8.com/ultraviolet/30/000000/overtime.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">20</p>
                                    <p class="mb-0"
                                        style="font-family: 'Kanit', sans-serif;font-size:20px;line-height:2px;">Total
                                        Unregistered</p>
                                    <p style="font-family: 'Kanit', sans-serif;font-size:20px;">Vehicle</p>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img src="https://img.icons8.com/ultraviolet/30/000000/identity-theft.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">20</p>
                                <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:20px;line-height:2px;">Total Vehicle
                                </p>
                                <p style="font-family: 'Kanit', sans-serif;font-size:20px;">Need Maintenance</p>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <img src="https://img.icons8.com/ultraviolet/30/000000/automotive.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-md-12">
                <h1 class="h3 mb-3"><strong>Today's</strong> Reservation</h1>
                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="reservationTodayInitTable" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle Plate#</th>
                                    <th>Date Reserve</th>
                                    <th>Created_at</th>
                                  
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
    $('#reservationTodayInitTable').DataTable({
            dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print',
                ],
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'/dashboard/fetch/reservation',
            columns:[
                {'data':'driver_name'},
                {'data':'vehicle_type'},
                {'data':'plate_no' },
                {'data':'reservation_date'},
                {'data':'createdAt'},
            ]
        });
});
     

</script>
@endsection