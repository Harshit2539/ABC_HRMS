@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

    <style>
        .tabs {
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            padding: 0.15rem 0.5rem;
            background: linear-gradient(120deg, #8adcdcc4, #2e6a88);
            position: relative;
            z-index: 1;
            margin-bottom: 0.75rem;
        }

        .tabs-marker {
            position: absolute;
            z-index: -1;
            background: rgb(17 21 36 / 70%);
            top: 0.4rem;
            bottom: 0.4rem;
            left: 0;
            border-radius: 0.4rem;
            transition: 0.15s;
        }

        .tabs-tab {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            appearance: none;
            transition: all 150ms;
            padding: 1rem;
            border: none;
            background: transparent;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .tabs-tab:hover {
            color: rgba(255, 255, 255, 1);
        }

        .tabs-tab.ui-active {
            pointer-events: none;
            color: rgba(255, 255, 255, 1);
        }

        .active-tab {
            padding: 0.7em;
            color: #fbfbfb;
            font-weight: bold;
            background: #10c4ad;
            border-radius: 15px;
        }

        .tabpanels {
            background-color: white;
            border-radius: 0.5rem;
            width: 100%;
        }

        .tabpanel {
            padding: 1rem 1.25rem;
            text-align: center;
            min-height: 5rem;
            display: grid;
            place-content: center;
            border-radius: 0.5rem;
        }
    </style>

    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a href="{{ route('admin.job.details.setup') }}"><button class="nav-link">Job
                            Titles</button></a></li>
                {{-- <li class="nav-item"><a href="{{ route('admin.paygrade.setup') }}"><button class="nav-link">Pay Grades</button></a></li> --}}
                <li class="nav-item"><a href="{{ route('admin.employment.setup') }}"><button class="nav-link">Employment
                            Status</button></a></li>
                <li class="nav-item"><a href="{{ route('admin.departments.setup') }}"><button
                            class="nav-link active">Departments</button></a></li>
            </ul>

            <button type="button" class="btn btn-primary mb-3 mt-3" data-bs-toggle="modal"
                data-bs-target="#addDepartmentModal" onclick="openDepartment()">Add New</button>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable departmentList"
                            style="font-size:0.9em !important;">
                            <thead>
                                <tr
                                    style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    {{-- <th class="text-center">S No.</th> --}}
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editDepartmentModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body">
                            <form id="editDepartmentForm">
                                @csrf
                                <input type="hidden" name="id" id="departmentId">
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" id="editDepartmentStatus"
                                        name="departmentstatus" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addDepartmentModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body">
                            <form id="addDepartmentForm">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" id="addDepartmentStatus"
                                        name="departmentstatus" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <script>
        var table = $('.departmentList').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
                url: '{{ route('admin.departments.setup') }}'
            },
            columns: [{
                    data: 'department'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            $.get(`/admin/departments-setup/${id}/edit`, function(data) {
                $('#departmentId').val(data.id);
                $('#editDepartmentStatus').val(data.department);
                $('#editDepartmentModal').modal('show');
            });
        });

        $('#editDepartmentForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: `/admin/departments-setup/${$('#departmentId').val()}`,
                type: 'PUT',
                data: $(this).serialize(),
                success: function(res) {
                    $('#editDepartmentModal').modal('hide');
                    table.ajax.reload();
                    alert(res.message);
                }
            });
        });
        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');

            if (confirm('Are you sure you want to delete this department?')) {
                $.ajax({
                    url: `/admin/departments-details/${id}`,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'DELETE'
                    },
                    success: function(res) {
                        table.ajax.reload();
                        alert(res.message);
                    },
                    error: function(xhr) {
                        alert('Failed to delete department!');
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        function openDepartment() {
            $('#addDepartmentForm')[0].reset();
            $('#addDepartmentModal').modal('show');
        }

        $('#addDepartmentForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/departments-details',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
                success: function(res) {
                    $('#addDepartmentModal').modal('hide');
                    table.ajax.reload();
                    alert(res.message);
                },
                error: function(xhr) {
                    alert('Failed to add department!');
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
