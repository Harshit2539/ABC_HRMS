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
                <a href="{{ route('clients.list') }}"> 
                <button class="nav-link active" type="button">
                   Clients
                </button>
                </a> 
            </li>
         
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">Clients</h3> -->
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
                        <table class="table table-striped custom-table datatable ClientList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Contact Number</th>
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

        <!-- Add Client Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addClientForm">
                            @csrf
                            <div class="form-group">
                                <label for="name"><span class="mandatory_input" style="color:red;">*</span> Name: </label>
                                <input type="text" class="form-control" id="name" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="details">Details: </label>
                                <textarea class="form-control" id="details" rows="3" name="details"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Address: </label>
                                <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Contact Number: </label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="email"><span class="mandatory_input" style="color:red;">*</span> Contact Email: </label>
                                <input type="email" class="form-control" id="email" name="email">
                                <small class="text-danger email_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="url">Company URL: </label>
                                <input type="text" class="form-control" id="url" name="url">
                            </div>
                            <div class="form-group">
                            <label for="status"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                   <option value="Active">Active</option>
                                   <option value="Inactive">Inactive</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="first_contact_date">First Contact Date:</label>
                                <input type="date" class="form-control" id="first_contact_date" name="first_contact_date">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveClientBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Client Modal -->
        <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editClientModalLabel">Client</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editClientForm">
                            @csrf
                            <input type="hidden" name="id" id="clientId">
                            <div class="form-group">
                                <label for="editName"><span class="mandatory_input" style="color:red;">*</span> Name: </label>
                                <input type="text" class="form-control" id="editName" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editDetails">Details: </label>
                                <textarea class="form-control" id="editDetails" rows="3" name="details"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editAddress">Address: </label>
                                <textarea class="form-control" id="editAddress" rows="3" name="address"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editPhone">Contact Number: </label>
                                <input type="number" class="form-control" id="editPhone" name="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="editEmail"><span class="mandatory_input" style="color:red;">*</span> Contact Email: </label>
                                <input type="email" class="form-control" id="editEmail" name="email">
                                <small class="text-danger email_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editURL">Company URL: </label>
                                <input type="text" class="form-control" id="editURL" name="url">
                            </div>
                            <div class="form-group">
                            <label for="editStatus"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="editStatus" name="status">
                                    <option value="">Select Status</option>
                                   <option value="Active">Active</option>
                                   <option value="Inactive">Inactive</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editFirstContactDate">First Contact Date:</label>
                                <input type="date" class="form-control" id="editFirstContactDate" name="first_contact_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editClientBtn" class="btn btn-primary">Save</button>
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
                        Are you sure you want to delete this Client?
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
    $('#saveClientBtn').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#addClientForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: "{{ route('clients.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#addClientForm')[0].reset();
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
    var table = $('.ClientList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('clients.list') }}",
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
                data: 'userName',
                className: "text-center"
            },
            {
                data: 'details',
                className: "text-center"
            },
            {
                data: 'address',
                className: "text-center"
            },
            {
                data: 'userMbl',
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
            url: `/clients_edit/${id}`,
            type: 'GET',
            success: function (data) {
                console.log(data.user);
                $('#clientId').val(data.details.id);
                $('#editDetails').val(data.details.details);
                $('#editAddress').val(data.details.address);
                $('#editURL').val(data.details.url);
                $('#editFirstContactDate').val(data.details.first_contact_date);
                $('#editName').val(data.user.name);
                $('#editEmail').val(data.user.email);
                $('#editPhone').val(data.user.phone_number);
                $('#editStatus').val(data.user.status);
                $('#editClientModal').modal('show');
                
            }
        });
    });

    $('#editClientBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#clientId').val();
        var formData = new FormData($('#editClientForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/clients_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editClientModal').modal('hide');
                    table.ajax.reload();
                } else if (response.result === 'error') {
                    console.log()
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

    $(document).on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        $('#confirmDelete').data('id', id);
        $('#deleteModal').modal('show');
    });

    $(document).on('click', '#confirmDelete', function () {
        var id = $(this).data('id');

        $.ajax({
            url: `/clients_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Client. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

</script>


@endsection