@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
              
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle Drivers</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="fas fa-edit"></i> Add Reservation</button>
                </div>

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
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-eye"></i> View Details</button></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-reservation-title">Create Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form >
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label mb-0"><small>Vehicle Plate#</small> </label>
                        <input type="text" class="form-control" name="vehicle_plate"  id="plate_number" value="">
                    </div>
  
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver Name</small> </label>
                          <input type="text" class="form-control" name="vehicle_driver" id="name">
                      </div>
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label mb-0"><small>Driver Contact</small> </label>
                          <input type="text" class="form-control" name="driver_contact" id="contact">
                      </div>
                      <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Needed</small> </label>
                          <input type="date" class="form-control" name="address" id="address">
                      </div>
  
                      <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-primary mb-3"> Submit </button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

@endsection
