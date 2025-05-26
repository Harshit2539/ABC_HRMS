@extends('layouts.master')
 
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
 
 
    <div class="page-wrapper">
        <div class="container-fluid mt-4 ">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading"> Trainer<span>Ready for Trainer ?</span></h3>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#trainerModal">
                        + Create New Trainer
                    </button>
                </div>
            </div>
 
            <div class="mt-4 card shadow-sm p-3">
                <div id="trainerTable" style="overflow-x: auto;">
                    <table class="table trainer-table table-striped table-bordered" style="min-width: 1100px;">
                        <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th class="text-center">S No.</th>
                                <th class="text-center">FULL NAME</th>
                                <th class="text-center">CONTACT</th>
                                <th class="text-center">EMAIL</th>
                                <th class="text-center">EXPERTISE</th>
                                <th class="text-center">ADDRESS</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
 
                    </table>
                </div>
            </div>
 
        </div>
 
 
        <!--create Modal -->
        <div class="modal fade" id="trainerModal" tabindex="-1" aria-labelledby="trainerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('trainer.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create New Trainer</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
 
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name *</label>
                                    <input type="text" name="first_name" class="form-control"
                                        placeholder="Enter First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name *</label>
                                    <input type="text" name="last_name" class="form-control"
                                        placeholder="Enter Last Name" required>
                                </div>
                            </div>
 
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="contact_number" class="form-label">Contact Number *</label>
                                    <input type="text" name="contact_number" class="form-control"
                                        placeholder="Enter Contact Number" required>
                                    <small class="text-danger">Please use with country code. (ex. +91)</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                        required>
                                </div>
                            </div>
 
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="expertise" class="form-label">Expertise</label>
                                    <textarea name="expertise" class="form-control" placeholder="Expertise"></textarea>
                                </div>
                            </div>
 
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
 
 
 
    <script>
        // ksjdhfg
        $(document).ready(function() {
            $('#openTrainerModal').on('click', function() {
                var trainerModal = new bootstrap.Modal(document.getElementById('trainerModal'));
                trainerModal.show();
            });
        });
 
        // stores the data on db
        $(document).ready(function() {
            $('#trainerForm').on('submit', function(e) {
                e.preventDefault();
 
                $.ajax({
                    url: "{{ route('trainer.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#trainerModal').modal('hide');
                        $('#trainerForm')[0].reset();
                        table.ajax.reload(null, false);
                        alert('Trainer added successfully.');
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let message = "Validation failed:\n";
                        for (let field in errors) {
                            message += `- ${errors[field][0]}\n`;
                        }
                        alert(message);
                    }
                });
            });
        });
 
        // Delete Trainer
        $(document).on('click', '.deleteTrainer', function() {
            if (!confirm('Are you sure you want to delete this trainer?')) return;
 
            let id = $(this).data('id');
            $.ajax({
                url: "{{ url('/trainer') }}/" + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    trainerTable.ajax.reload(null, false);
                    alert('Trainer deleted successfully.');
                }
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
        var table = $('.trainer-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            scrollbars: true,
            ajax: {
                url: "{{ route('trainer.index') }}",
            },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                // {
                //     data: 'id',
                //     className: "text-center"
                // },
                {
                    data: 'first_name',
                    className: "text-center"
                },
                {
                    data: 'contact_number',
                    className: "text-center"
                },
                {
                    data: 'email',
                    className: "text-center"
                },
                {
                    data: 'expertise',
                    className: "text-center"
                },
                {
                    data: 'address',
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
 
 