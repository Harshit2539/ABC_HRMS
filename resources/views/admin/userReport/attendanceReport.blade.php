@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<style>
    .pagination {
        float: right;
    }

    .dt-search {
        float: right;
    }

    .dt-length {
        display: none;
    }
</style>

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}


    <!-- Main content -->
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Attendance Request <span>Report </span></h3>
                </div>
            </div>



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
                                            <label for="in_time"><span class="mandatory_input" style="color:red;">*</span>
                                                Start Date:</label>
                                            <input type="date" class="form-control" id="in_time" name="in_time">
                                            <!-- <small class="text-danger " id="travel_date_error"></small> -->
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="out_time"><span class="mandatory_input" style="color:red;">*</span>
                                                End Date:</label>
                                            <input type="date" class="form-control" id="out_time" name="out_time">
                                            <!-- <small class="text-danger " id="return_date_error"></small> -->
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="employee"><span class="mandatory_input" style="color:red;">*</span>
                                                Employee: </label>
                                            <select class="form-control" id="employee" name="employee">
                                                <option value="">Select Employee</option>
                                                @foreach ($attendance as $attendances)
                                                    <option value="{{ $attendances->name }}">{{ $attendances->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <!-- <small class="text-danger " id="status_error"></small> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-12">
                                        <button type="button" id="searchBtn" class="btn btn-primary">Search</button>
                                        {{-- <a href="{{ route('userReports.list') }}"> --}}
                                           <button type="button" class="btn btn-secondary" onclick="location.reload();">
                                            Clear
                                        </button>
                                        {{-- </a> --}}

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
                                        <th class="text-center">in_time</th>
                                        <th class="text-center">out_time</th>
                                        <th class="text-center">note</th>
                                        <th class="text-center">image_in</th>
                                        <th class="text-center">image_out</th>
                                        <th class="text-center">map_lat</th>
                                        <th class="text-center">map_lng</th>
                                        <th class="text-center">map_snapshot</th>
                                        <th class="text-center">in_ip</th>
                                        <th class="text-center">out_ip</th>
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
            buttons: [{
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
                url: "{{ route('attendance_request.report') }}",
                data: function(d) {
                    d.in_time = $('#in_time').val();
                    d.out_time = $('#out_time').val();
                    d.employee = $('#employee').val();
                    console.log('Filters:', d.in_time, d.out_time, d.employee);
                }
            },



            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'employee',
                    className: "text-center"
                },
                {
                    data: 'in_time',
                    className: "text-center"
                },

                {
                    data: 'out_time',
                    className: "text-center"
                },
                {
                    data: 'note',
                    className: "text-center"
                },
                {
                    data: 'map_lat',
                    className: "text-center"
                },
                {
                    data: 'map_lng',
                    className: "text-center"
                },
                {
                    data: 'map_snapshot',
                    className: "text-center"
                },
                {
                    data: 'map_out_lat',
                    className: "text-center"
                },
                {
                    data: 'map_out_lng',
                    className: "text-center"
                },
                {
                    data: 'map_out_snapshot',
                    className: "text-center"
                },
                {
                    data: 'in_ip',
                    className: "text-center"
                },
                {
                    data: 'out_ip',
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

        $('#searchBtn').on('click', function() {
            table.ajax.reload();
        });
    </script>
@endsection
