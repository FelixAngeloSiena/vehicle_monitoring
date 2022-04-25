@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
    
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h1 class="h3 mb-3"><strong>User Account</strong>  Records</h1>
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" style="color:#fff;font-size:17px;font-weight:bold"
                        data-bs-target="#exampleModal"><i class="fas fa-edit"></i> Add another account</button>
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
                             
                                <tr>
                                  
                              </tr>
                        
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
