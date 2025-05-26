@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
    <div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
       
            <li class="nav-item" role="presentation">
                <a href="{{ route('travel_records.list') }}"> 
                <button class="nav-link " type="button">
                   Travel Requests
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('subordinate_travel_requests.list') }}"> 
                <button class="nav-link active" type="button">
                   Subordinate Travel Requests
                </button>
                </a> 
            </li>
         
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">TravelRequests</h3> -->
                        </div>
                        <div class="card-toolbar">
                        <div class="col-3">
                        <select class="form-control" id="FilterByEmployees" name="FilterByEmployees">
                            <option value="">Select Employees</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable subOrdinateTravelRequestList" style="font-size:small !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                            <th class="text-center">Sr No</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Travel Type</th>
                                    <th class="text-center">Purpose</th>
                                    <th class="text-center">From</th>
                                    <th class="text-center">To</th>
                                    <th class="text-center">Travel Date</th>
                                    <th class="text-center">Status</th>
                                    <!-- <th class="text-center">Actions</th> -->
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Edit TravelRequest Modal -->
        <div class="modal fade" id="editSubOrdinateTravelRequestModal" tabindex="-1" aria-labelledby="editSubOrdinateTravelRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSubOrdinateTravelRequestModalLabel">Travel Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editSubOrdinateTravelRequestForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="SubOrdinate_travel_recordId">

                            <div class="form-group">
                            <label for="editEmployeeId"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                            <select class="form-control" id="editEmployeeId" name="employee_id" required>
                            <option value="">Select Employees</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                           </select>
                           </div>
                            <div class="form-group">
                            <label for="editType"><span class="mandatory_input" style="color:red;">*</span> Means of Transportation: </label>
                                <select class="form-control" id="editType" name="type">
                                    <option value="">Select Travel Type</option>
                                   <option value="Plane">Plane</option>
                                   <option value="Train">Train</option>
                                   <option value="Taxi">Taxi</option>
                                   <option value="Own Vehicle">Own Vehicle</option>
                                   <option value="Rented Vehicle">Rented Vehicle</option>
                                   <option value="Other">Other</option>
                                </select>
                                <small class="text-danger" id="type_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editPurpose"><span class="mandatory_input" style="color:red;">*</span> Purpose of Travel:</label>
                                <textarea class="form-control" id="editPurpose" rows="3" name="purpose"></textarea>
                                <small class="text-danger " id="purpose_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editTravelFrom"><span class="mandatory_input" style="color:red;">*</span> Travel From:</label>
                                <input type="text" class="form-control" id="editTravelFrom" name="travel_from">
                                <small class="text-danger " id="travel_from_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editTravelTo"><span class="mandatory_input" style="color:red;">*</span> Travel To:</label>
                                <input type="text" class="form-control" id="editTravelTo" name="travel_to">
                                <small class="text-danger " id="travel_to_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editTravelDate"><span class="mandatory_input" style="color:red;">*</span> Travel Date:</label>
                                <input type="date" class="form-control" id="editTravelDate" name="travel_date">
                                <small class="text-danger " id="travel_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editReturnDate"><span class="mandatory_input" style="color:red;">*</span> Return Date:</label>
                                <input type="date" class="form-control" id="editReturnDate" name="return_date">
                                <small class="text-danger " id="return_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editNotes">Notes:</label>
                                <textarea class="form-control" id="editNotes" rows="3" name="notes"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="editCurrency"><span class="mandatory_input" style="color:red;">*</span> Currency: </label>
                                <select class="form-control" id="editCurrency" name="currency_id">
                                    <option value="">Select Currency</option>
                                    @foreach($currencies as $currency)
                                   <option value="{{$currency->id}}">{{$currency->code}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger " id="currency_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editFunding"><span class="mandatory_input" style="color:red;">*</span> Total Funding Proposed:</label>
                                <input type="text" class="form-control" id="editFunding" name="funding">
                                <small class="text-danger" id="funding_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editStatus"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="editStatus" name="status">
                                    <option value="">Select Status</option>
                                   <option value="Approved">Approved</option>
                                   <option value="Pending">Pending</option>
                                   <option value="Rejected">Rejected</option>
                                   <option value="Cancellation Requested">Cancellation Requested</option>
                                   <option value="Cancelled">Cancelled</option>
                                   <option value="Processing">Processing</option>
                                </select>
                                <small class="text-danger " id="status_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editAttachment"> Attachment:</label>
                                <input type="file" class="form-control" id="editAttachment" name="attachment">&nbsp;
                                <small class="text-danger " id="attachment_error"></small>
                                <p id="showAttachment"></p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editSubOrdinateTravelRequestBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

  </div>

<!-- Script Code -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>

<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>

<!-- button -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.subOrdinateTravelRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
                url: "{{ route('subordinate_travel_requests.list') }}",
                data: function (d) {
                    d.employee_id = $('#FilterByEmployees').val();
                }
            },
        columns: [
            {
            data: null, 
            className: "text-center",
            render: function (data, type, row, meta) {
                return meta.row + 1;
            }
            },
            {
                data: 'employee_id',
                className: "text-center"
            },
            {
                data: 'type',
                className: "text-center"
            },

            {
                data: 'purpose',
                className: "text-center"
            },
            {
                data: 'travel_from',
                className: "text-center"
            },
            {
                data: 'travel_to',
                className: "text-center"
            },
            {
                data: 'travel_date',
                className: "text-center"
            },
        
            {
                data: 'status',
                className: "text-center"
            },
            
            // {
            //     data: 'action',
            //     className: "text-center",
            // },

        ],
    });

    $('#FilterByEmployees').on('change', function () {
       table.ajax.reload();
    });

    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/travel_records_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#SubOrdinate_travel_recordId').val(data.id);
                $('#editEmployeeId').val(data.employee_id);
                $('#editType').val(data.type);
                $('#editPurpose').val(data.purpose);
                $('#editTravelFrom').val(data.travel_from);
                $('#editTravelTo').val(data.travel_to);
                $('#editTravelDate').val(data.travel_date);
                $('#editReturnDate').val(data.return_date);
                $('#editNotes').val(data.notes);
                $('#editCurrency').val(data.currency_id);
                $('#editFunding').val(data.funding);
                $('#editStatus').val(data.status);
                $('#showAttachment').html(`<a href="${data.attachment}" target="_blank" title="Open File">${data.attachment.split('/').pop()}</a>
                <a href="${data.attachment}" download="${data.attachment.split('/').pop()}" target="_blank"><i class="la la-download" title="Download File"></i></a>`);
                $('#editSubOrdinateTravelRequestModal').modal('show');
                
            }
        });
    });

    $('#editSubOrdinateTravelRequestBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#SubOrdinate_travel_recordId').val();
        var formData = new FormData($('#editSubOrdinateTravelRequestForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/travel_records_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editSubOrdinateTravelRequestModal').modal('hide');
                    table.ajax.reload();
                } else if (response.result === 'error') {
                    console.log()
                    for (let key in response.msg) {
                        if (response.msg.hasOwnProperty(key)) {
                            $(`#${key}_error`).html(response.msg[key][0]);
                            // $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                        }
                    }
                }
                
            },
            error: function (error) {
                $('.pre-loader').hide();
            }
        });
    });
</script>


@endsection