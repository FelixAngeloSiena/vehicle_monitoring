@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Your Schedule</strong> Today</h1>
                </div>

                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Requestor</th>
                                    <th>Date Needed</th>
                                    <th>Date Reserved</th>
                                    <th>Vehicle Type</th>
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

@endsection
