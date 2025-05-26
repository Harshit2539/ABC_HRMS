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
        <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable LoanRequestList">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Loan Type</th>
                                    <th class="text-center">Currency</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">Loan Period</th>
                                    <th class="text-center">Loan Amount</th>
                                    <th class="text-center">Monthly Installment</th>
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


        <!-- View Modal -->

        <div class="modal fade" id="travelRequestModal" tabindex="-1" aria-labelledby="travelRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="travelRequestModalLabel">Loan Request Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Details will be dynamically loaded here -->
                        <div id="loanRequestDetails">
                            Loading details...
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Rejection Modal -->
        <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectionModalLabel">Rejection Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control" id="rejectionReason" placeholder="Enter rejection reason"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-confirm-reject" data-id="">Reject</button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var table = $('.LoanRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('loan.request.listing') }}",
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
                data: 'employee_name',
                className: "text-center"
            },
            {
                data: 'loan_type',
                className: "text-center"
            },
            {
                data: 'currency',
                className: "text-center"
            },
            {
                data: 'start_date',
                className: "text-center"
            },
            {
                data: 'loan_period',
                className: "text-center"
            },
            {
                data: 'loan_amount',
                className: "text-center"
            },
            {
                data: 'monthly_installment',
                className: "text-center"
            },
            {
                data: 'Status',
                className: "text-center"
            },
            {
                data: 'action',
                className: "text-center",
            },

        ],
    });


//--------------------------- Approve
    $(document).on('click', '.btn-approve', function () {
        let laonId = $(this).data('id');
        let button = $(this);

        // Show confirmation alert
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this Loan request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to approve
                $.ajax({
                    url: "{{ route('loan-request.approve') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: laonId
                    },
                    success: function (response) {
                        if (response.success) {
                            // Disable the button and change its text
                            button.replaceWith('<button class="btn btn-success" disabled>Approved</button>');

                            // Show success message
                            toastr.success('Loan request approved successfully!');
                        } else {
                            toastr.error(response.error);
                        }
                    },
                    error: function () {
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            }
        });
    });

//------------------------------ View
    $(document).on('click', '.btn-view', function () {
    var leaveRequestId = $(this).data('id'); // Get the ID of the travel request

        // Make an AJAX request to fetch details
        $.ajax({
            url: '/loan-request/details/' + leaveRequestId, // Define the endpoint
            type: 'GET',
            success: function (response) {
                // Determine the status based on the conditions
                    let leaveStatus = '';
                    if(response.is_reject == 0){
                        if (response.approver1 && response.approve1 == null) {
                        leaveStatus = 'Pending (Awaiting Approver 1)';
                    } else if (response.approver2 && response.approve2 == null) {
                        leaveStatus = 'Pending (Awaiting Approver 2)';
                    } else if (response.approver3 && response.approve3 == null) {
                        leaveStatus = 'Pending (Awaiting Approver 3)';
                    } else if (
                        response.approve1 == 1 &&
                        response.approve2 == 1 &&
                        response.approve3 == 1
                    ) {
                        leaveStatus = 'Approved';
                    } else {
                        leaveStatus = 'Rejected';
                    }
                    }else{
                        leaveStatus = 'Rejected';

                    }
                   
    // Generate the HTML dynamically
                $('#loanRequestDetails').html(`
                    <div class="row">
                        <div class="col-6">
                        <p><strong>Employee Name:</strong> ${response.user.name}</p>
                        </div>
                        <div class="col-6 d-flex" style="justify-content:end;">
                            <p class="btn btn-primary" style="display: inline-block;">Status: ${leaveStatus}</p>
                        </div>
                    </div>
                    <p><strong>Loan Type:</strong> ${response.loan.name}</p>
                    <p style="background-color: ${response.approver1 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                        <strong>Approver 1:</strong> ${response.approver1 == null ? 'Approver 1 not assigned' : response.approver1.name}

                    </p>
                    <p style="background-color: ${response.approver2 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                        <strong>Approver 2:</strong> ${response.approver2 == null ? 'Approver 2 not assigned' : response.approver2.name}
                    </p>
                    <p style="background-color: ${response.approver3 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                        <strong>Approver 3:</strong> ${response.approver3 == null ? 'Approver 3 not assigned' : response.approver3.name}
                    </p>
                    <p><strong>Created At:</strong> ${response.created_at}</p>
                `);
            },
            error: function () {
                $('#loanRequestDetails').html('<p class="text-danger">Unable to fetch details.</p>');
            }
        });
    });

//-----------------------------Reject

$(document).on('click', '.btn-reject', function () {
    let travelId = $(this).data('id');
    $('.btn-confirm-reject').data('id', travelId); // Pass travel ID to modal button
    $('#rejectionModal').modal('show'); // Show the rejection modal
});

$(document).on('click', '.btn-confirm-reject', function () {
    let travelId = $(this).data('id');
    let reason = $('#rejectionReason').val();

    if (!reason.trim()) {
        toastr.error('Rejection reason is required.');
        return;
    }
    // Send AJAX request for rejection
    $.ajax({
        url: "{{ route('loan-request.reject') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: travelId,
            reason: reason
        },
        success: function (response) {
            if (response.success) {
                toastr.success(response.success);

               // Disable the reject button and change its text to "Rejected"
               $('.btn-reject[data-id="' + travelId + '"]').prop('disabled', true).text('Rejected').addClass('btn-danger').removeClass('btn-primary');
                // Optionally, remove the approve button
                $('.btn-approve[data-id="' + travelId + '"]').remove();

                $('#rejectionModal').modal('hide'); // Close the modal
            } else {
                toastr.error(response.error);
            }
        },
        error: function () {
            toastr.error('Something went wrong. Please try again.');
        }
    });
});

</script>


@endsection