@extends('apps.app_admin')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h1 class="h3 mb-3"><strong>Request For </strong> PO</h1>
            </div>
            <div class="card">
                <div class="card-body shadow-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped" id="requestPOInitTable" width="100%">
                                    <thead style="width:100%">
                                        <tr>
                                            <th>Vehicle Type</th>
                                            <th>Vehicle Plate#</th>
                                            <th>Request Type</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
{{----------------------------------------------------------
Create PO Modal
--------------------------------------------------------- --}}

<div class="modal fade" id="create-po" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="d-flex justify-content-between p-3" style="background-color: #3B7DDD;">
                <h5 class="modal-title" id="modal-reservation-title"
                    style="color:#fff;font-size:20px;font-weight:bold">Create PO Request</h5>
                <i class="fas fa-times fa-2x" data-bs-dismiss="modal" style="cursor: pointer;color:#fff"></i>
            </div>
            <div class="modal-body">
                <div class="card shadow" style="border:solid 1px #cfcfcf">
                    <div class="card-body pb-0">
                        <form id="createPoRequest">
                            @csrf
                                <div class="d-flex justify-content-between mb-0">
                                    <div>
                                        <p style="font-size: 20px;" class="mb-0" id="vehicleType"></p>
                                        <p class="mb-0"> Plate#: <span id="vehiclePlate"></span></p>
                                    </div>
                                    <p>Request Type: <span id="requestType" style="font-size: 20px;font-weigth:bold;text-transform: capitalize;"></span></p>
                              </div>
                              <p class="mb-3" > Description: <span id="requestDesc" style="color:red;font-weight:bold;"></span></p>
                              <hr>
                                <input type="hidden" name="request_id" id="request_id">
                              <div class="row" id="container_form">

                              </div>

                              <div class="d-flex flex-row-reverse bd-highlight">
                                <button type="submit" class="btn btn-warning mb-3 "><i class="fas fa-save"></i>  Save Po Request </button>  
                              </div>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script>

    $( document ).ready(function() {
        initTable();
    });

    const initTable = () => {
        $('#requestPOInitTable').DataTable({
            destroy: true,
            responsive: true,
            serverSide:true,
            processing:true,
            ajax:'/purchasing/fetch/request/',
            columns:[
                {'data':'vehicle_type' },
                {'data':'plate_no' },
                {'data':'request_type'},
                {'data':'request_date'},
                {'data':'status' },
                {'data':'actions'},
            ]
        });
    }

    const initForm = (id, po_number, date_sent, supplier_name, remarks) => {
        return  `
            <div class="col">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>PO Number</small></label>
                    <input type="text" class="form-control" value="${po_number}" name="po_number[]" >
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Supplier</small></label>
                    <input type="text" class="form-control" value="${supplier_name}" name="supplier[]" >
                </div>
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Date Sent</small></label>
                    <input type="date" class="form-control" value="${date_sent}" name="date_sent[]" >
                </div>
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label mb-0"><small>Remarks</small></label>
                    <input type="text" class="form-control" value="${remarks}" name="remarks[]" >
                </div>
            </div>   
        `;
    }

    const createPo = (id) => {
        $('#create-po').modal('show');
        $.ajax({
            type: "GET",
            url: "/purchasing/fetch/request/details/"+id,
            success: function(response) {
        
            $('#container_form').empty();
                var value = response.details;
                $('#vehicleType').text(value.vehicle_type);
                $('#vehiclePlate').text(value.plate_no);
                $('#requestType').text(value.request_type);
                $('#requestDesc').text(value.description);
                $('#request_id').val(value.id);

                var flt = false;
                var frt = false;
                var rlt = false;
                var rrt = false;
                var counts = 0;
                var res = response.po;

                if(value.request_type == 'tire'){

                    if(value.front_left_tire == 'isChecked') { flt = true; counts++; }
                    if(value.front_right_tire == 'isChecked') { frt = true; counts++; }
                    if(value.rear_left_tire == 'isChecked') { rlt = true; counts++; }
                    if(value.rear_right_tire == 'isChecked') { rrt = true; counts++; }
                                    
                    for(var x =0; x<counts; x++) {
                        var po_id = "NULL";
                        var tirepos = "";
                        var id = "";
                        var po_number = "";
                        var date_sent = "";
                        var supplier = "";
                        var remarks = "";
                        
                        if(x < response.po_counts) {
                            po_id = res[x].id;
                            tirepos = res[x].tire_position;
                            po_number = res[x].po_number;
                            date_sent = res[x].date_sent;
                            supplier = res[x].supplier_name;
                            remarks = res[x].remarks;
                        }
                        if(flt){
                                $('#container_form').append(`
                                <p class="mb-0" style="font-size:16px;font-weight:bold;">Front Left Tire: </p>
                                <input type="hidden" name="tire_position[]" value="${ (!tirepos)? 'flt': tirepos}"/>
                                <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                                ${initForm(id, po_number, date_sent,supplier,remarks )}`)
                                flt = false;
                        }
                        else if(frt){
                            $('#container_form').append(`
                            <p class="mb-0" style="font-size:16px;font-weight:bold;">Front Right Tire: </p>
                            <input type="hidden" name="tire_position[]" value="${ (!tirepos)? 'frt': tirepos}"/>
                            <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                            ${initForm(id, po_number, date_sent,supplier,remarks )}`)
                            frt = false;		
                        }
                        else if(rlt){
                                $('#container_form').append(`
                                <p class="mb-0" style="font-size:16px;font-weight:bold;">Rear Left Tire: </p>
                                <input type="hidden" name="tire_position[]" value="${ (!tirepos)? 'rlt': tirepos}"/>
                                <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                                ${initForm(id, po_number, date_sent,supplier,remarks )}`)
                                rlt = false;
                        }
                        else if(rrt){
                                $('#container_form').append(`
                                <p class="mb-0" style="font-size:16px;font-weight:bold;">Rear Right Tire: </p>
                                <input type="hidden" name="tire_position[]" value="${ (!tirepos)? 'rrt': tirepos}"/>
                                <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                                ${initForm(id, po_number, date_sent,supplier,remarks )}`)
                                rrt = false;
                        }
                    }             
                }
                else{
                    if(response.po_counts >= 1){
                        $('#container_form').append(`
                        <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                        <input type="hidden" name="tire_position[]" value=""/>
                        ${initForm(
                            res[0].po_id,
                            res[0].po_number,
                            res[0].date_sent,
                            res[0].supplier_name,
                            res[0].remarks 
                        )}`)
                    }else{
                        $('#container_form').append(`
                        <input type="hidden" name="po_id[]" value="${ (!po_id) ? '' : po_id}"/>
                        <input type="hidden" name="tire_position[]" value=""/>
                        ${initForm("", "", "", "", "")}`) 
                    }
                }
            }
        });
    }

    $('#createPoRequest').on('submit',(e) => {
        e.preventDefault();
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Creating PO to Request  ...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        var data = $('#createPoRequest').serializeArray();
            $.ajax({
                type: "POST",
                url: "{{route('purchasing.create.request.po')}}",
                data: data,
                success: function(response) {
                    console.log(response);
                $('#create-po').modal('hide');
                    if (response.status == 'ERROR') {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                } else if (response.status == "SUCCESS") {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success'
                    }).then((result) => {
                        initTable();
                    })
                }
            }
        })
    });

    const submitPo = (id) => {
            var swal = Swal.fire({
                title: 'Please Wait',
                text: 'Submit PO Request...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                type: "GET",
                url: "/purchasing/submit/request/po/"+id,
                success: function(response) {
                    if (response.status == 'ERROR') {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                } else if (response.status == "SUCCESS") {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success'
                    }).then((result) => {
                        initTable();
                    })
                }
            }
        })
    }
  
    
</script>

@endsection