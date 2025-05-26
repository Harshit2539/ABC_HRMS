@extends('layouts.master')
 
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 
 <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
 
 
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css"> --}}
 
<style>
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
 
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
 
    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }
</style>
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
 
 
<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
     
 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                             <h3 class="card-label">Leave Request Status</h3>
                        </div>
                       
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable leaveStatus" id="leaveStatus">
                            <thead>
                                <tr>
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Leave Type</th>
                                    <th class="text-center">From Date</th>
                                    <th class="text-center">To Date</th>
                                    <th class="text-center">Leave Status</th>
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
 
 
       
 
 
    </div>
   
 
   
 
 
 
 
 
   <script src="https://code.jquery.com/jquery-3.7.1.js" defer></script>
 
 
<!-- Script Code -->
 
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
 
 
 
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 
   //$.noConflict();
 
        $(document).ready(function () {
 
              let leaveStatus = "<?php echo"$leave_status"?>";
              let date = "<?php echo"$date"?>";

           
         
      $('#leaveStatus').DataTable({
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
              url: "{{ route('leave.status') }}",
              data: {'status': leaveStatus, 'date' : date },
              type: "GET",
        },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'leave_type',
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
                    data: 'leave_status',
                    className: "text-center"
                },
             
            ],
 
        });
 
 
 });
           
 
 
     
 
</script>
 
  @endsection