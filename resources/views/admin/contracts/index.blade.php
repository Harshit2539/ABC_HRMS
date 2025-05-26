@extends('layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
    <style>
        .content-fixed-wrapper {
            margin-left: 250px;
            margin-top: 70px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .content-fixed-wrapper {
                margin-left: 0;
                margin-top: 70px;
            }
        }

        /* .table.custom-table>tbody>tr>td:last-child,
            .table.custom-table>thead>tr>th:last-child {
                /* padding-right: 25px; */
        /* display: flex; */
        /* }  */
    </style>
    <div class="content-fixed-wrapper">


        <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h3 class="main-heading">Manage <span>Contract</span></h3>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#contractModal">
                        Add
                    </button>
        </div>

        <div class="mt-4 card shadow-sm p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Contracts List</h5>
            </div>
            <div id="trainingTable" style="overflow-x: auto;">
                <table class="table table-striped custom-table datatable contract-table DataTable table-bordered"  style="font-size:0.9em !important;">
                    <thead>
                    <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                            <th class="text-center">Vendor ID</th>
                            <th class="text-center">Vendor Name</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-right">Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
             
                </table>
            </div>
        </div>
    </div>
    <!-- Contract Creation Modal -->
    <div class="modal fade" id="contractModal" tabindex="-1" aria-labelledby="contractModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="contractModalLabel">Create New Contract</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="contractForm" action="{{ route('contracts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Employee Name -->
                            <div class="col-md-6">
                                <label class="form-label">Vendor Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="Vendor_name"
                                    placeholder="Enter Vendor Name" required>

                            </div>
                            <!-- Subject -->
                            <div class="col-md-6">
                                <label class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter Subject"
                                    required>
                            </div>
                            <!-- Value -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="value" placeholder="Enter Value"
                                    value="0" required>
                            </div>
                            <!-- Type -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="type"
                                    placeholder="Enter Type of Contract" required>
                            </div>
                            <!-- Start Date -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <!-- Due Date -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label">Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="due_date" required>
                            </div>
                            <!-- Description -->
                            <div class="col-md-12 mt-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter Description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="contractForm" class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Contract Modal -->
    <div class="modal fade" id="editContractModal" tabindex="-1" aria-labelledby="editContractModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editContractModalLabel">Edit Contract</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editContractForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="contract_id">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="Vendor_name" class="form-label">Vendor Name*</label>
                                <input type="text" class="form-control" id="Vendor_name" name="Vendor_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject*</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="value" class="form-label">Value*</label>
                                <input type="number" step="0.01" class="form-control" id="value" name="value"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="type" class="form-label">Type*</label>
                                <input type="text" class="form-control" id="type" name="type" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date*</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="due_date" class="form-label">End Date*</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // edit logic
        $(document).ready(function() {
            $('.editContractBtn').click(function() {
                var contractId = $(this).data('id');
                $.ajax({
                    url: '/contracts/' + contractId + '/edit',
                    type: 'GET',
                    success: function(response) {
                        $('#contract_id').val(response.id);
                        $('#Vendor_name').val(response.Vendor_name);
                        $('#subject').val(response.subject);
                        $('#value').val(response.value);
                        $('#type').val(response.type);
                        $('#start_date').val(response.start_date);
                        $('#due_date').val(response.due_date);
                        $('#description').val(response.description);

                        // Update form action dynamically
                        $('#editContractForm').attr('action', '/contracts/' + response.id);

                        // Show the modal
                        $('#editContractModal').modal('show');
                    }
                });
            });

            // Submit the form via AJAX
            $('#editContractForm').submit(function(e) {
                e.preventDefault();
                var contractId = $('#contract_id').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '/contracts/' + contractId,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        location.reload(); // Refresh the page on success
                    },
                    error: function(xhr) {
                        alert("Error updating contract");
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.contract-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            scrollbars: true,
            ajax: {
                url: "{{ route('contracts.index') }}",
            },
            columns: [
               
                {
                    data: 'id',
                    className: "text-center"
                },
                {
                    data: 'Vendor_name',
                    className: "text-center"
                },
                {
                    data: 'subject',
                    className: "text-center"
                },
                {
                    data: 'type',
                    className: "text-center"
                },
                {
                    data: 'start_date',
                    className: "text-center"
                },
                {
                    data: 'due_date',
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
    </script>
@endsection
