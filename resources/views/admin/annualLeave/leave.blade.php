@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')



<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    





                    <div class="card-header d-flex" style="justify-content:space-between;">
                        <div class="card-title">
                            <h3 class="main-heading">Manage<span>Annual Leaves</span></h3>
                        </div>
                        <div class="card-toolbar" style="align-content:center;">
                            <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                data-target="#addModal">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New
                            </button>
                        </div>
                    </div>













                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable annualLeave" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Annual Leave</th>
                                    <th class="text-center">Work From Home</th>
                                    <th class="text-center">Sick Leave</th>
                                    <th class="text-center">Restrict Leave</th>

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








        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Leave Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="leaveForm">
                            @csrf
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="year" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                 
                                    <div class="col-3">
                                        <label for="annual_leave" class="form-label">Annual Leave</label>
                                        <input type="number" class="form-control" id="annual_leave" value="0" name="annual_leave" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="work_from_home" class="form-label">Work From Home</label>
                                        <input type="number" class="form-control" id="work_from_home" value="0" name="work_from_home" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="sick_leave" class="form-label">Sick Leave</label>
                                        <input type="number" class="form-control" id="sick_leave" value="0" name="sick_leave" required>
                                    </div>
                                    <div class="col-3">
                                        <label for="restrict_leave" class="form-label">Restrict Leave</label>
                                        <input type="number" class="form-control" id="restrict_leave" value="0" name="restrict_leave" required>
                                    </div>

                                </div>
                            </div>
                            <!-- Checkboxes for Availability -->
                          
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="annual_leave_available" name="annual_leave_available">
                                <label class="form-check-label" for="annual_leave_available">Annual Leave Enable</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="work_from_home_available" name="work_from_home_available">
                                <label class="form-check-label" for="work_from_home_available">Work from Home Enable</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="sick_leave_available" name="sick_leave_available">
                                <label class="form-check-label" for="sick_leave_available">Sick Leave Enable</label>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="restrict_leave_available" name="restrict_leave_available">
                                <label class="form-check-label" for="restrict_leave_available">Restrict Leave Enable</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    $('#saveButton').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#leaveForm')[0]);

        $.ajax({
            url: "{{ route('save.annualleaves') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.message === 'success') {
                    $('#leaveForm')[0].reset();
                    $('#addModal').modal('hide');
                    // table.ajax.reload();

                } else if (response.message === 'error') {
                    for (let key in response.msg) {
                        if (response.msg.hasOwnProperty(key)) {
                            $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                        }
                    }
                }
            },
            error: function(xhr) {
                var response = xhr.responseJSON;
                if (response && response.message) {
                    Swal.fire({
                                title: "Already Exists!",
                                text: response.message,
                                icon: "warning",
                                timer: 2000,
                                showConfirmButton: false
                            });
                }
            }
        });
    });

    var table = $('.annualLeave').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
                url: "{{ route('annualleave.list') }}",
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
                data: 'year',
                className: "text-center"
            },
            {
                data: 'annual_leave',
                className: "text-center"
            }, 
            {
                data: 'work_from_home',
                className: "text-center"
            }, 
            {
                data: 'sick_leave',
                className: "text-center"
            }, 
            {
                data: 'restrict_leave',
                className: "text-center"
            }, 
            // {
            //     data: 'action',
            //     className: "text-center",
            // },

        ],
       
    });

</script>

@endsection

