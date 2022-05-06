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
                                @foreach ($reservationRecords as $reservationRecord)
                                    <tr>
                                        <td>{{ $reservationRecord->name }}</td>
                                        <td>{{ $reservationRecord->vehicle_type }}</td>
                                        <td>{{ $reservationRecord->plate_no }}</td>
                                        <td>{{ $reservationRecord->reservation_date }}</td>
                                        <td>{{ date('Y-m-d', strtotime($reservationRecord->created_at)) }}</td>
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
