@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')


<!-- Main content -->
    <div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="{{ route('skills.list') }}"> 
                <button class="nav-link" type="button">
                   Skills
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
               <a href="{{ route('educations.list') }}"> 
                <button class="nav-link" type="button"  >
                    Education
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
            <a href="{{ route('certifications.list') }}"> 
                <button class="nav-link active" type="button">
                    Certifications
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
            <a href="{{ route('languages.list') }}"> 
                <button class="nav-link" type="button">
                    Languages
                </button>
                </a> 
            </li>
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">Certifications</h3> -->
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
                        <table class="table table-striped custom-table datatable CertificationList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
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

        <!-- Add Certification Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Certification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addCertificationForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                <small class="text-danger description_error"></small>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveCertificationBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Certification Modal -->
        <div class="modal fade" id="editCertificationModal" tabindex="-1" aria-labelledby="editCertificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCertificationModalLabel">Certification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCertificationForm">
                            @csrf
                            <input type="hidden" name="id" id="certificationId">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="editDescription" rows="3" name="description"></textarea>
                                <small class="text-danger description_error"></small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editCertificationBtn" class="btn btn-primary">Save</button>
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
                        Are you sure you want to delete this Certification?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
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
    $('#saveCertificationBtn').on('click', function (e) {
        e.preventDefault();

        var formData = new FormData($('#addCertificationForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: "{{ route('certifications.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#addCertificationForm')[0].reset();
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
    var table = $('.CertificationList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('certifications.list') }}",
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
                data: 'description',
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
            url: `/certifications_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#certificationId').val(data.id);
                $('#editName').val(data.name);
                $('#editDescription').val(data.description);
                $('#editCertificationModal').modal('show');
            }
        });
    });

    $('#editCertificationBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#certificationId').val();
        var formData = new FormData($('#editCertificationForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/certifications_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editCertificationModal').modal('hide');
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
            url: `/certifications_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the certification. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

</script>


@endsection