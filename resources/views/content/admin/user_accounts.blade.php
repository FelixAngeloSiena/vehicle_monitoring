@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>User Account</strong> Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        style="color:#fff;font-size:17px;font-weight:bold" data-bs-target="#create-user"> <img
                            src="https://img.icons8.com/external-anggara-glyph-anggara-putra/25/ffffff/external-edit-basic-ui-anggara-glyph-anggara-putra.png" />
                        Add another account</button>
                </div>

                <div class="card">
                    <div class="card-body shadow-sm">
                        <table id="example" class="table-striped display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{----------------------------------------------------------
Add another user Modal
--------------------------------------------------------- --}}

    <div class="modal fade" id="create-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                    <h5 class="modal-title" id="modal-reservation-title"
                        style="color:#fff;font-size:20px;font-weight:bold">Create User Account</h5>
                    <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
                </div>
                <div class="modal-body">
                    <form id="userAccountForm">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Name</small> </label>
                            <input type="text" class="form-control" name="create_user_name" id="create_user_name"
                                value="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Email</small> </label>
                            <input type="text" class="form-control" name="create_user_email" id="create_user_email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Password</small> </label>
                            <input type="password" class="form-control" name="create_user_password"
                                id="create_user_password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label mb-0"><small>Role</small> </label>
                            <select class="form-select" id="create_user_role" name="create_user_role">
                                <option selected disabled>Select Role</option>
                                <option value="audit">Audit</option>
                                <option value="logistic">Logistic</option>
                                <option value="purchasing">Purchasing</option>
                                <option value="requestor">Requestor</option>
                                <option value="manager">Warehouse Manager</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary mb-3"> Create User </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        //submit form of adding new vehicle
        $('#userAccountForm').on('submit', (e) => {
            e.preventDefault();

            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Saving New User Account ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            var data = $('#userAccountForm').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{ route('create.user') }}",
                data: data,
                success: function(response) {
                    location.reload();
                    $('#create-user').modal('hide');
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
