@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
 
<style>
    .overlayy {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }
 
    .modall {
        position: relative;
        width: 900px;
        z-index: 9999;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 20px;
    }
 
    .closee {
        position: absolute;
        right: 10px;
    }
 
   
 
</style>
 
@section('content')
{{-- message --}}
 
 
<!-- Main content -->
    <div class="page-wrapper">
 
   
 
        <!-- Table Content -->
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                     <div class="card-header">
                        <div class="card-title">
                             <h3 class="card-label">Travel Request Status</h3>
                        </div>
                       
                    </div>
 
                   
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped custom-table datatable TravelRequestList">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">Sr No</th> -->
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Travel Type</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Request Status</th>
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
 
     $(document).ready(function () {
         
 
              let travelStatus = "<?php echo"$travel_status"?>";
              let date = "<?php echo"$date"?>";

 
      $('.TravelRequestList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('travel.status') }}",
                data: {'status': travelStatus, 'date' : date },
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
                    data: 'type',
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
                    data: 'status',
                    className: "text-center"
                },
             
            ],
 
        });
 
 
 });
           
 
 
 
 
</script>
 
 
     
 
 
 
 
@endsection
 