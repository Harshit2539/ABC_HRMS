@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<style>
     .pagination{
        float:right;
    }
    .dt-search{
        float:right;
    }
    .dt-length{
        display:none;
    }
</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item" role="presentation">
                <a href="{{ route('userReports.list') }}">
                    <button class="nav-link active" type="button">
                        Report
                    </button>
                </a>
            </li>

        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">TravelRequests</h3> -->
                        </div>
                        <div class="card-toolbar">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="start_date"><span class="mandatory_input"
                                                style="color:red;">*</span> Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                        <!-- <small class="text-danger " id="travel_date_error"></small> -->
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="end_date"><span class="mandatory_input" style="color:red;">*</span>
                                            End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                        <!-- <small class="text-danger " id="return_date_error"></small> -->
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="status"><span class="mandatory_input" style="color:red;">*</span>
                                            Status: </label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Cancellation Requested">Cancellation Requested</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Processing">Processing</option>
                                        </select>
                                        <!-- <small class="text-danger " id="status_error"></small> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12">
                                    <button type="button" id="searchBtn" class="btn btn-primary">Search</button>
                                    <a href="{{ route('userReports.list') }}">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable subOrdinateTravelRequestList">
                            <thead>
                                <tr>
                                    <th class="text-center">SN.</th>
                                    <th class="text-center">Employee</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Purpose</th>
                                    <th class="text-center">From</th>
                                    <th class="text-center">To</th>
                                    <th class="text-center">Travel Date</th>
                                    <th class="text-center">Return Date</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Funding</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Updated</th>
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
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
    var table = $('.subOrdinateTravelRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        dom: 'lfBrtip',
            buttons: [
                   {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        title: 'Travel_Request_Report',
                        filename: 'Travel_Request_Report',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        title: 'Travel_Request_Report',
                        filename: 'Travel_Request_Report',
                        className: 'btn btn-info'
                    }
                ],
        ajax: {
            url: "{{ route('travel_request.report') }}",
            data: function (d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.status = $('#status').val();
                console.log(d.start_date,d.end_date);
            }
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
                data: 'employee_id',
                className: "text-center"
            },
            {
                data: 'type',
                className: "text-center"
            },

            {
                data: 'purpose',
                className: "text-center"
            },
            {
                data: 'travel_from',
                className: "text-center"
            },
            {
                data: 'travel_to',
                className: "text-center"
            },
            {
                data: 'travel_date',
                className: "text-center"
            },
            {
                data: 'return_date',
                className: "text-center"
            },
            {
                data: 'notes',
                className: "text-center"
            },
            {
                data: 'funding_with_currency',
                className: "text-center"
            },
            {
                data: 'status',
                className: "text-center"
            },
            {
                data: 'created_at',
                className: "text-center"
            },
            {
                data: 'updated_at',
                className: "text-center"
            },

        ],
    });

    $('#searchBtn').on('click', function () {
        table.ajax.reload();
    });


</script>


@endsection