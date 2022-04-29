@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>Vehicle Drivers</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        style="color:#fff;font-size:17px;font-weight:bold" data-bs-target="#create_driver"> <img src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png"/>Add another driver</button>
                </div>

                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Driver Id#</th>
                                    <th>Driver Name</th>
                                    <th>License Reg Date</th>
                                    <th>License Exp Date</th>
                                    <th>License Type</th>
                                    <th>License Restriction</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{$driver->id_no}}</td>
                                    <td>{{$driver->name}}</td>
                                    <td>{{$driver->license_reg_date}}</td>
                                    <td>{{$driver->license_exp_date}}</td>
                                    <td>{{$driver->license_type}}</td>
                                    <td>{{$driver->restriction}}</td>
                                  @if ($driver->status == 'assigned')
                                        <td><span class="badge bg-danger">{{$driver->status}}</span> </td>
                                     @else
                                        <td><span class="badge bg-success">{{$driver->status}}</span> </td>
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


    {{-- ----------------------------------------
 Modal for Reservation Details
 -------------------------------------- --}}

    <div class="modal fade" id="create_driver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #F4F3EF">

                <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title"
                        style="color:#fff;font-size:20px;font-weight:bold">Create Driver</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>

                <div class="modal-body">
                    <form id="createDriverForm">
                        @csrf
                        <div class="card shadow" style="border:solid 1px #cfcfcf">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                 
                                            <div class="col-md-6">
                                                <div class="card" style="border: 1px solid #f2f2f2">
                                                    <div class="card-body">
                                                        <p class="mb-0"
                                                            style="font-weight: bold;font-size:20px; ">Driver Details</p>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>ID#</small> </label>
                                                            <input type="text" class="form-control" name="driver_id"
                                                                id="driver_id">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>Username</small> </label>
                                                            <input type="text" class="form-control" name="driver_username"
                                                                id="driver_name">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>Password</small> </label>
                                                            <input type="text" class="form-control" name="driver_password"
                                                                id="driver_name">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>Driver Name</small> </label>
                                                            <input type="text" class="form-control" name="driver_name"
                                                                id="driver_name">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>Upload Profile
                                                                    Picture:</small> </label>
                                                            <input type="file filepond" name="driver_profile" id="uploadProfileImage">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card" style="border: 1px solid #f2f2f2">
                                                    <div class="card-body">
                                                        <p class="mb-0"
                                                            style="font-weight: bold;font-size:20px; ">Driver License Driver
                                                        </p>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>License Registration Date</small>
                                                            </label>
                                                            <input type="date" class="form-control" name="license_reg_date" id="license_reg_date">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>License Expiration Date</small>
                                                            </label>
                                                            <input type="date" class="form-control" name="license_exp_date" id="license_exp_date">
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>License Type</small> </label>
                                                            <select class="form-select" id="license_type"
                                                                name="license_type">
                                                                <option selected disabled>Select Driver License</option>
                                                                <option>Non Pro Driver Lisence </option>
                                                                <option>Pro Driver Lisence </option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>License Restriction</small>
                                                            </label>
                                                            <select class="form-select" id="license_restriction"
                                                                name="license_restriction">
                                                                <option selected disabled>Select License Restriction
                                                                </option>
                                                                <option>A - Motorcycle</option>
                                                                <option>A1 - Tricycle</option>
                                                                <option>B - Vehicles up to 5,000 kgs. GVW/8 seats</option>
                                                                <option>B1 - Vehicles up to 5,000 kgs. GVW/9 or more seats
                                                                </option>
                                                                <option>B2 - Vehicles carrying goods ≤ 3,500 kgs GVW
                                                                </option>
                                                                <option>C - Vehicles carrying goods >3,500 kgs GVW</option>
                                                                <option>D - Bus > 5,000 kgs GVW/9 or more seats</option>
                                                                <option>BE – Trailers ≤ 3,500 kgs</option>
                                                                <option>CE - Articulated C > 3,500 kgs combined GVW</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-0">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label mb-0"><small>Upload License Image:</small>
                                                            </label>
                                                            <input type="file filepond" name="driver_license" id="uploadLicenseImage">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" id="submitDriverInfo" class="btn btn-primary mb-3"> Submit
                                    </button>
                                </div>
           
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );
            FilePond.create(document.getElementById("uploadProfileImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40mb",
            maxFiles: "1",
            server: {
                process: {
                    url: "/driver/upload-profile",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                revert: {
                    url: "/driver/revert-profile",
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    onload: function(x) {},
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            },
            onwarning(error) {
                if (error.code == 0) {
                    Swal.fire({
                        title: "Warning",
                        text: "You can only upload 40mb image File.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok.",
                    });
                }
            },
        });

            FilePond.create(document.getElementById("uploadLicenseImage"), {
            acceptedFileTypes: ['image/*'],
            maxFileSize: "40mb",
            maxFiles: "1",
            server: {
                process: {
                    url: "/driver/upload-license",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                revert: {
                    url: "/driver/revert-license",
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    onload: function(x) {},
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            },
            onwarning(error) {
                if (error.code == 0) {
                    Swal.fire({
                        title: "Warning",
                        text: "You can only upload 1 Excel File.",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok.",
                    });
                }
            },
        });

        //submit form of adding new driver
        $('#createDriverForm').on('submit', (e) => {
            e.preventDefault();

            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Saving New Driver in database ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#createDriverForm').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{ route('create.driver') }}",
                data: data,
                success: function(response) {
                    location.reload();
                    $('#create_driver').modal('hide');
                    if (response.status == 'ERROR') {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    } else if (response.status == "WARNING") {
                        Swal.fire({
                            title: 'Warning',
                            text: response.message,
                            icon: 'warning'
                        });
                    } else if (response.status == "OK") {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success'
                        }).then((result) => {
                            view_request();
                        })
                    }
                }
            });
        });
    </script>
@endsection
