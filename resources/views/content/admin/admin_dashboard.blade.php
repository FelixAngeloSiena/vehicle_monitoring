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
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">50</p>
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
                                    style="font-size:40px;font-weight:bold;font-family: 'Kanit', sans-serif;">20</p>
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
                                    <th>Requestor Name</th>
                                    <th>Driver Name</th>
                                    <th>Vehicle Type</th>
                                    <th>Vehicle Plate#</th>
                                    <th>Date Reserve</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Charde Marshall</td>
                                    <td>Lemmuel Lapuz</td>
                                    <td>Ford Ranger</td>
                                    <td>BAB6189</td>
                                    <td>04-15-2022</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-eye"></i> View Details</button>
                                        <button type="button" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{{------------------------------------------
 Modal for Reservation Details
 -------------------------------------- --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" style="background-color:#F4F3EF">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-reservation-title">Reservation Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-lg-6" style="position: relative">
                            <div style=" position: absolute; top: 20%; ">
                                <img src="{{ asset('img/sedan.png') }}" class="img-responsive" style="max-width:100%" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="mb-0" style="font-size: 20px">Charde Marshall</h4>
                            <p>Date Reserve: Jul 15 2022</p>
                            <div class="card shadow" style="border:solid 1px #cfcfcf">
                                <div class="card-body">
                                    <h4 class="mb-0" style="font-size:16px;">Driver Details</h4>
                                    <p class="mb-0">Driver Name: Lemmuel Lapuz</p>
                                    <p class="mb-0">Driver Address: Sta Maria Bulacan</p>
                                    <p class="mb-0">Driver Contact #: 09971620530</p>
                                </div>
                            </div>

                            <div class="card"
                                style="border:solid 1px #cfcfcf">
                                <div class="card-body">
                                    <h4 class="mb-0" style="font-size:16px;">Vehicle Details</h4>
                                    <p class="mb-0">Vehicle Type: Ford Ranger</p>
                                    <p class="mb-0">Plate#: BAB6189</p>
                                    <p class="mb-0">MV File#: 1340-00000508170</p>
                                    <p class="mb-0">Motor#: 2AR0756003</p>
                                    <p class="mb-0">Chasis#: MR053AK5004003485</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
