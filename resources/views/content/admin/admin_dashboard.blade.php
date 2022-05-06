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
                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Driver Name</th>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle Plate#</th>
                                    <th>Date Reserve</th>
                                    <th>Created_at</th>
                                    @if (Auth::user()->role == 'manager')
                                        <th>Action</th>
                                    @endif
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allReservationTodays as $allReservationToday)
                                    <tr>
                                        <td>{{ $allReservationToday->name }}</td>
                                        <td>{{ $allReservationToday->vehicle_type }}</td>
                                        <td>{{ $allReservationToday->plate_no }}</td>
                                        <td>{{ $allReservationToday->reservation_date }}</td>
                                        <td>{{ date('Y-m-d', strtotime($allReservationToday->created_at)) }}</td>
                                        @if (Auth::user()->role == 'manager')
                                        <td>
                                            <button type="button" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel </button>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
