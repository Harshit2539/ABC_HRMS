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
        @if (session('success'))
                <div id="success-alert" class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Reimbursement Details<span>Check Your Form Details ?</span></h3>
                </div>
            </div>
            <div class="mt-4 card shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Reimburs List</h5>
                </div>
                <div id="reimbursTable" style="overflow-x: auto;">
                    <table class="table table-striped custom-table datatable details-table DataTable table-bordered"
                        style="font-size:0.9em !important;">
                        <thead>
                            <tr
                                style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th class="text-center">S No.</th>
                                <th class="text-center">Employee Id</th>
                                <th class="text-center">From Location</th>
                                <th class="text-center">To Location</th>
                                <th class="text-center">Date Of Visit</th>
                                <th class="text-center">Amount</th>
                                <th class="text-right">Description</th>
                                <th class="text-center">Date on Apply </th>
                                <th class="text-center">Action </th>

                            </tr>
                        </thead>
 
                    </table>
                </div>
            </div>
        </div>
    </div>
     <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
     <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.details-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            scrollbars: true,
            ajax: {
                url: "{{ route('reimburs.details') }}",
            },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'employee_id',
                    className: "text-center"
                },
                {
                    data: 'from_location',
                    className: "text-center"
                },
                {
                    data: 'to_location',
                    className: "text-center"
                },
                {
                    data: 'date_of_visit',
                    className: "text-center"
                },
                {
                    data: 'amount',
                    className: "text-center"
                },
                {
                    data: 'description',
                    className: "text-center"
                },
                {
                    data: 'apply',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center"
                }
            ],
        });

        $(document).ready(function() {
            setTimeout(function() {
                $('#success-alert').fadeOut('slow');
            }, 1000);
        });
 

 
    </script>
@endsection
 
 