@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Vehicle Monitoring</strong> Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card" style="background-color: #251D3A">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-auto">
                                <img src="https://img.icons8.com/glyph-neue/100/ffffff/bar-chart.png"/>
                            </div>
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:50px;font-weight:bold;color:#fff;font-family: 'Kanit', sans-serif;">{{$vehiclesCount > 0 ?  $vehiclesCount : '0'}}</p>
                                <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:18px;color:#fff;line-height:2px;font-weight:bold">Total Vehicles</p>
                            </div>

                        
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3">
                <div class="card" style="background-color: #251D3A">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-auto">
                                <img src="https://img.icons8.com/glyph-neue/100/ffffff/area-chart.png"/>
                            </div>
                            <div class="col mt-0">
                                <p class="mb-0"
                                    style="font-size:50px;font-weight:bold;font-family: 'Kanit', sans-serif;color:#fff;">{{$reservationsCount > 0 ?  $reservationsCount : '0'}}</p>
                                    <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:18px;color:#fff;line-height:2px;font-weight:bold">Today's Reservations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card" style="background-color: #251D3A">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-auto">
                                <img src="https://img.icons8.com/glyph-neue/100/ffffff/group.png"/>
                            </div>
                            <div class="col mt-0">
                           
                                <p class="mb-0"
                                    style="font-size:50px;font-weight:bold;font-family: 'Kanit', sans-serif;color:#fff;">{{$driverCounts > 0 ?  $driverCounts : '0'}}</p>
                                    <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:18px;color:#fff;line-height:2px;font-weight:bold">Total Driver's</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="background-color: #251D3A">
                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-auto">
                                <img src="https://img.icons8.com/glyph-neue/100/ffffff/overtime.png"/>
                            </div>
                            <div class="col mt-0">
                                <p class="mb-0"
                               
                                    style="font-size:50px;font-weight:bold;font-family: 'Kanit', sans-serif;color:#fff;">{{$reservationApproverCounts > 0 ?  $reservationApproverCounts : '0'}}</p>
                                    <p class="mb-0"
                                    style="font-family: 'Kanit', sans-serif;font-size:18px;color:#fff;line-height:2px;font-weight:bold">Total Reservations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12">
                <h1 class="h3 mb-3"><strong>Today's</strong> Reservation</h1>
                <div class="card" style="border: 1px solid #251D3A">
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