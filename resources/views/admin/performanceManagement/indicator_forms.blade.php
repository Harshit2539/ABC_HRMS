@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href=" https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">


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
    .card-header{
        display:flex;
        justify-content:space-between;
    }
    

    #editFormsBtn{
 background: #3ec9d6 !important;
    color: #ffff !important;
    border: none;
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
                            <div class="card-header ">
                                <div class="card-title">
                                    <h3 class="main-heading heading">Performance<span>Indicator  Forms</span> </h3>
                                </div>
                                
                                <div class="card-title  button-container">
                                    <a href="{{ route('create.indicator.form') }}" class="btn btn-primary"  >Create New indicator form</a>
                                </div>
                            </div>
            
                <div class="container-fluid shadow-lg p-3">
                                  <div class="card-body table-responsive">
                            <table class="table custom-table datatable display compact IndicatorFormList mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Designation</th>                                   
                                       <th class="text-center">Action</th>
                                    </tr>
                                </thead>
 
                            </table>
                        </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </div>

</div>



<!-- Script Code -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

  $(document).ready(function () {

 $('.IndicatorFormList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('indicator.form') }}",
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
                    data: 'department',
                    className: "text-center"
                },
                  {
                    data: 'designation',
                    className: "text-center"
                },
       
                 {
                    data: 'action',
                    className: "text-center"
                }
             
            ]
 
        });

    
  }) 


       $(document).on('click', '#deleteIndicatorForm', function(e) {
                                     
                                     e.preventDefault();
                                    let  id = $(this).data('id');

                                           $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });

                           $.ajax({
                                url: `/delete_indicator_form/${id}`,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                       
                                if(response.status == true){
                                            toastr.success(response.message);
                                            window.location.href= '{{ route('indicator.form') }}';

                                };
                                },
                                error: function(xhr, status, error) {
                                console.log('AJAX Error:', error);        
                                console.log('Status:', status); 
                                console.log('Response Text:', xhr.responseText); 
                                alert('An error occurred');

                }
                            });
                                                      

                       })

        
      </script>

    @endsection 
