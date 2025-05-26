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
                <a href="{{ route('attendance.list') }}"> 
                <button class="nav-link Active" type="button">
                   Attendance
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
                            <div class="row">
                            <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                data-target="#addNewModal">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New
                            </button>
                        
                        <div class="col-3">
                        <select class="form-control" id="FilterByEmployees" name="FilterByEmployees">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable attendanceList">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Time-In</th>
                                    <th class="text-center">Time-Out</th>
                                    <th class="text-center">Hours</th>
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
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addAttendanceForm">
                            @csrf
                            <div class="form-group">
                            <label for="employee"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                            <select class="form-control" id="employee" name="employee">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                           </select>
                           <small class="text-danger employee_error"></small>
                           </div>
                            <div class="form-group">
                                <label for="in_time"><span class="mandatory_input" style="color:red;">*</span> Time-In:</label>
                                <input type="datetime-local" class="form-control" id="in_time" name="in_time">
                                <small class="text-danger in_time_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="out_time"> Time-Out:</label>
                                <input type="datetime-local" class="form-control" id="out_time" name="out_time">
                            </div>
                            <div class="form-group">
                                <label for="note">Note:</label>
                                <textarea class="form-control" id="note" rows="3" name="note"></textarea>
                            </div>
                           
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveAttendanceBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit TravelRequest Modal -->
        <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAttendanceModalLabel">Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editAttendanceForm">
                            @csrf
                            <input type="hidden" name="id" id="attendanceID">

                            <div class="form-group">
                            <label for="editEmployee"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                            <select class="form-control" id="editEmployee" name="employee">
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                           </select>
                           <small class="text-danger " id="employee_error"></small>
                           </div>
                            <div class="form-group">
                                <label for="editInTime"><span class="mandatory_input" style="color:red;">*</span> Time-In:</label>
                                <input type="datetime-local" class="form-control" id="editInTime" name="in_time">
                                <small class="text-danger " id="in_time_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editOutTime"> Time-Out:</label>
                                <input type="datetime-local" class="form-control" id="editOutTime" name="out_time">
                            </div>
                            <div class="form-group">
                                <label for="editNote">Note:</label>
                                <textarea class="form-control" id="editNote" rows="3" name="note"></textarea>
                            </div>
                           
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editAttendanceBtn" class="btn btn-primary">Save</button>
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
                        Are you sure you want to delete this Attendance?
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

    $('#saveAttendanceBtn').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#addAttendanceForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: "{{ route('attendance.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#addAttendanceForm')[0].reset();
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
    var table = $('.attendanceList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
                url: "{{ route('attendance.list') }}",
                data: function (d) {
                    d.employee = $('#FilterByEmployees').val();
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
                data: 'employee',
                className: "text-center"
            },
            {
                data: 'in_time',
                className: "text-center",
                render: function (data, type, row) {
                    if (row.in_time) {
                        return `<span  style="color: rgba(0, 0, 0, .85); overflow-wrap: break-word; box-sizing: border-box;">
                    <code style="margin: 0 .2em;padding: .2em .4em .1em;font-size: 85%;background: rgba(150, 150, 150, .1);border: 1px solid rgba(100, 100, 100, .2);border-radius: 3px;"> 
                        ${row.in_time}
                        </code>
                        </span>`;
                    }
                    return '';
                }
            },

            {
                data: 'out_time',
                className: "text-center",
                render: function (data, type, row) {
                    if (row.out_time) {
                        return `<span  style="color: rgba(0, 0, 0, .85); overflow-wrap: break-word; box-sizing: border-box;">
                    <code style="margin: 0 .2em;padding: .2em .4em .1em;font-size: 85%;background: rgba(150, 150, 150, .1);border: 1px solid rgba(100, 100, 100, .2);border-radius: 3px;"> 
                        ${row.out_time}
                        </code>
                        </span>`;
                    }
                    return '';
                }
            },
       
            {
                data: 'hours',
                className: 'text-center',
                render: function (data, type, row) {
                    if (row.in_time && row.out_time) {
                        let inTime = new Date(row.in_time);
                        let outTime = new Date(row.out_time);
                        let hoursWorked = ((outTime - inTime) / 3600000).toFixed(2);
                        let requiredHours = 8;
                        let percentage = Math.min((hoursWorked / requiredHours) * 100, 100);

                        let color = hoursWorked >= requiredHours ? 'green' : 'red';

                        return `
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 100px; height: 10px; background: #ddd; border-radius: 5px; overflow: hidden;">
                                    <div style="width: ${percentage}%; height: 100%; background: ${color};"></div>
                                </div>
                                <span style="color: ${color};">${hoursWorked}h / ${requiredHours}h</span>
                            </div>`;
                    } else {
                        return `
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 100px; height: 10px; background: #ddd; border-radius: 5px; overflow: hidden;">
                                    <div style="width: 0%; height: 100%; background: red;"></div>
                                </div>
                                <span style="color: red;">0h / 8h</span>
                            </div>`;
                    }
                }
            },
            
            {
                data: 'action',
                className: "text-center",
            },

        ],
       
    });

    $('#FilterByEmployees').on('change', function () {
       table.ajax.reload();
    });

    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/attendance_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#attendanceID').val(data.id);
                $('#editEmployee').val(data.employee);
                $('#editInTime').val(data.in_time);
                $('#editOutTime').val(data.out_time);
                $('#editNote').val(data.note);
                $('#editAttendanceModal').modal('show');
                
            }
        });
    });

    $('#editAttendanceBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#attendanceID').val();
        var formData = new FormData($('#editAttendanceForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/attendance_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editAttendanceModal').modal('hide');
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
            url: `/attendance_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Attendance. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });
</script>


@endsection