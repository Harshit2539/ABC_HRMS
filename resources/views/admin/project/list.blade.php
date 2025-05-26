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
                <a href="{{ route('projects.list') }}"> 
                <button class="nav-link active" type="button">
                   Projects
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('emp_projects.list') }}"> 
                <button class="nav-link" type="button">
                   Employee Projects
                </button>
                </a> 
            </li>
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">Projects</h3> -->
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
                        <table class="table table-striped custom-table datatable ProjectList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Client</th>
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

        <!-- Add Project Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addProjectForm">
                            @csrf
                            <div class="form-group">
                                <label for="name"><span class="mandatory_input" style="color:red;">*</span> Name: </label>
                                <input type="text" class="form-control" id="name" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="client_id"><span class="mandatory_input" style="color:red;">*</span> Client: </label>
                                <select class="form-control" id="client_id" name="client_id">
                                    <option value="">Select Client</option>
                                    @foreach($users as $user)
                                   <option value="{{$user->id}}">{{$user->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger client_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="details">Details: </label>
                                <textarea class="form-control" id="details" rows="3" name="details"></textarea>
                            </div>
                           
                            <div class="form-group">
                            <label for="status"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select Status</option>
                                   <option value="Active">Active</option>
                                   <option value="On Hold">On Hold</option>
                                   <option value="Completed">Completed</option>
                                   <option value="Dropped">Dropped</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveProjectBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Project Modal -->
        <div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProjectModalLabel">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProjectForm">
                            @csrf
                            <input type="hidden" name="id" id="projectId">
                            <div class="form-group">
                                <label for="editName"><span class="mandatory_input" style="color:red;">*</span> Name: </label>
                                <input type="text" class="form-control" id="editName" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editClient"><span class="mandatory_input" style="color:red;">*</span> Client: </label>
                                <select class="form-control" id="editClient" name="client_id">
                                    <option value="">Select Client</option>
                                    @foreach($users as $user)
                                   <option value="{{$user->id}}">{{$user->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger client_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editDetails">Details: </label>
                                <textarea class="form-control" id="editDetails" rows="3" name="details"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="editStatus"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="editStatus" name="status">
                                 <option value="">Select Status</option>
                                   <option value="Active">Active</option>
                                   <option value="On Hold">On Hold</option>
                                   <option value="Completed">Completed</option>
                                   <option value="Dropped">Dropped</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editProjectBtn" class="btn btn-primary">Save</button>
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
                        Are you sure you want to delete this Project?
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
    $('#saveProjectBtn').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#addProjectForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: "{{ route('projects.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#addProjectForm')[0].reset();
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

    
    var table = $('.ProjectList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('projects.list') }}",
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
                data: 'name',
                className: "text-center"
            },
            {
                data: 'user',
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
            url: `/projects_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#projectId').val(data.id);
                $('#editName').val(data.name);
                $('#editDetails').val(data.details);
                $('#editClient').val(data.client_id);
                $('#editStatus').val(data.status);
                $('#editProjectModal').modal('show');
                
            }
        });
    });

    $('#editProjectBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#projectId').val();
        var formData = new FormData($('#editProjectForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/projects_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editProjectModal').modal('hide');
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
            url: `/projects_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Project. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

</script>


@endsection