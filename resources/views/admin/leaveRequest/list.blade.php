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
        <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading"> Leave Request<span>Check Your Request status ?</span></h3>
                </div>
            </div>
        <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
       
            <!-- <li class="nav-item" role="presentation">
                <a href="{{ route('leave.request.listing') }}"> 
                <button class="nav-link Active" type="button">
                   Leave Request
                </button>
                </a> 
            </li> -->
         
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">TravelRequests</h3> -->
                        </div>
                     
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable LeaveRequestList">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Leave Type</th>
                                    <th class="text-center">From Date</th>
                                    <th class="text-center">To Date</th>
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


        <!-- View Modal -->

        <div class="modal fade" id="travelRequestModal" tabindex="-1" aria-labelledby="travelRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="travelRequestModalLabel">Leave Request Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Details will be dynamically loaded here -->
                        <div id="travelRequestDetails">
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


    var table = $('.LeaveRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('leave.request.listing') }}",
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
                data: 'type',
                className: "text-center"
            },
            {
                data: 'from_date',
                className: "text-center"
            },
            {
                data: 'to_date',
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


//--------------------------- Approve
    $(document).on('click', '.btn-approve', function () {
        let travelId = $(this).data('id');
        let button = $(this);

        // Show confirmation alert
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this travel request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to approve
                $.ajax({
                    url: "{{ route('leave-request.approve') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: travelId
                    },
                    success: function (response) {
                        if (response.success) {
                            // Disable the button and change its text
                            button.replaceWith('<button class="btn btn-success" disabled>Approved</button>');
                            $('.btn-reject[data-id="' + travelId + '"]').hide();
                            // Show success message
                            toastr.success('Leave request approved successfully!');
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
            url: '/leave-request/details/' + leaveRequestId, // Define the endpoint
            type: 'GET',
            success: function (response) {
                // Determine the status based on the conditions
                    let leaveStatus = '';
                    if(response.is_reject == 0){
                        if (response.approver1 && response.approve1 == null) {
                        leaveStatus = 'Pending (Awaiting Approver)';
                    } else if (
                        response.approve1 == 1
                    ) {
                        leaveStatus = 'Approved';
                    }
                    }
                    else{
                        leaveStatus = 'Rejected';
 
                    }

    // Generate the HTML dynamically
                $('#travelRequestDetails').html(`
                    <div class="row">
                        <div class="col-6">
                        <p><strong>Employee Name:</strong> ${response.user.name}</p>
                        </div>
                        <div class="col-6 d-flex" style="justify-content:end;">
                            <p class="btn btn-primary" style="display: inline-block;">Leave Status: ${leaveStatus}</p>
                        </div>
                    </div>
                    <p><strong>Leave Type:</strong> ${response.leave_type}</p>
                    <p style="background-color: ${response.approver1 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                        <strong>Approver 1:</strong> ${response.approver1 == null ? 'Approver 1 not assigned' : response.approver1.name}

                    </p>
                  
                    <p><strong>Created At:</strong> ${response.created_at}</p>
                `);
            },
            error: function () {
                $('#travelRequestDetails').html('<p class="text-danger">Unable to fetch details.</p>');
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
        url: "{{ route('leave-request.reject') }}",
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