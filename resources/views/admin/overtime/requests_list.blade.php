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
               <a href="{{ route('overtime_categories.list') }}"> 
                <button class="nav-link" type="button"  >
                    Overtime Categories
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
               <a href="{{ route('overtime_requests.list') }}"> 
                <button class="nav-link active" type="button"  >
                    Overtime Requests
                </button>
                </a> 
            </li>
           
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">Overtime Categories</h3> -->
                        </div>
                        <div class="card-toolbar">
                            <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                data-target="#addNewModal">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable OvertimeRequestList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Start Time</th>
                                    <th class="text-center">End Time</th>
                                    <th class="text-center">Project</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
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

        <!-- Add OvertimeRequest Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Overtime Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addOvertimeRequestForm">
                            @csrf
                            <div class="form-group">
                            <label for="employee_id"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger employee_id_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="category_id"><span class="mandatory_input" style="color:red;">*</span> Category: </label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                   <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger category_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="start_time"><span class="mandatory_input" style="color:red;">*</span> Start Time:</label>
                                <input type="datetime-local" class="form-control" id="start_time" name="start_time">
                                <small class="text-danger start_time_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="end_time"><span class="mandatory_input" style="color:red;">*</span> End Time:</label>
                                <input type="datetime-local" class="form-control" id="end_time" name="end_time">
                                <small class="text-danger end_time_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="project_id"> Project: </label>
                                <select class="form-control" id="project_id" name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                   <option value="{{$project->id}}">{{$project->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes:</label>
                                <textarea class="form-control" id="notes" rows="3" name="notes"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="status"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                   <option value="Approved">Approved</option>
                                   <option value="Pending">Pending</option>
                                   <option value="Rejected">Rejected</option>
                                   <option value="Cancellation Requested">Cancellation Requested</option>
                                   <option value="Cancelled">Cancelled</option>
                                   <option value="Processing">Processing</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveOvertimeRequestBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit OvertimeRequest Modal -->
        <div class="modal fade" id="editOvertimeRequestModal" tabindex="-1" aria-labelledby="editOvertimeRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOvertimeRequestModalLabel">Overtime Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editOvertimeRequestForm">
                            @csrf
                            <input type="hidden" name="id" id="overtimeRequestId">

                            <div class="form-group">
                            <label for="editEmployeeId"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                                <select class="form-control" id="editEmployeeId" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger" id="employee_id_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editCategoryId"><span class="mandatory_input" style="color:red;">*</span> Category: </label>
                                <select class="form-control" id="editCategoryId" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                   <option value="{{$category->id}}">{{$category->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger" id="category_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editStartTime"><span class="mandatory_input" style="color:red;">*</span> Start Time:</label>
                                <input type="datetime-local" class="form-control" id="editStartTime" name="start_time">
                                <small class="text-danger" id="start_time_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editEndTime"><span class="mandatory_input" style="color:red;">*</span> End Time:</label>
                                <input type="datetime-local" class="form-control" id="editEndTime" name="end_time">
                                <small class="text-danger" id="end_time_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editProjecId"> Project: </label>
                                <select class="form-control" id="editProjecId" name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project)
                                   <option value="{{$project->id}}">{{$project->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editNotes">Notes:</label>
                                <textarea class="form-control" id="editNotes" rows="3" name="notes"></textarea>
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
                                <small class="text-danger" id="status_error"></small>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editOvertimeRequestBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Overtime Request?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
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
    $('#saveOvertimeRequestBtn').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#addOvertimeRequestForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: "{{ route('overtime_requests.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#addOvertimeRequestForm')[0].reset();
                    $('#addNewModal').modal('hide');
                    table.ajax.reload();

                } else if (response.result === 'error') {
                    for (let key in response.msg) {
                        if (response.msg.hasOwnProperty(key)) {
                            $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                        }
                    }
                }
            },
            error: function (error) {
                $('.pre-loader').hide();
            }
        });
    });
    var table = $('.OvertimeRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('overtime_requests.list') }}",
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
                data: 'category_id',
                className: "text-center"
            },
            {
                data: 'start_time',
                className: "text-center"
            },
            {
                data: 'end_time',
                className: "text-center"
            },
            {
                data: 'project_id',
                className: "text-center"
            },
            {
                data: 'status',
                className: "text-center"
            },
            {
                data: 'action',
                className: "text-center",
            },

        ],
    });

    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/overtime_requests_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#overtimeRequestId').val(data.id);
                $('#editEmployeeId').val(data.employee_id);
                $('#editCategoryId').val(data.category_id);
                $('#editStartTime').val(data.start_time);
                $('#editEndTime').val(data.end_time);
                $('#editProjecId').val(data.project_id);
                $('#editNotes').val(data.notes);
                $('#editStatus').val(data.status);
                $('#editOvertimeRequestModal').modal('show');
            }
        });
    });

    $('#editOvertimeRequestBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#overtimeRequestId').val();
        var formData = new FormData($('#editOvertimeRequestForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/overtime_requests_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editOvertimeRequestModal').modal('hide');
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

    $(document).on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        $('#confirmDelete').data('id', id);
        $('#deleteModal').modal('show');
    });

    $(document).on('click', '#confirmDelete', function () {
        var id = $(this).data('id');

        $.ajax({
            url: `/overtime_requests_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Overtime Request. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

</script>


@endsection