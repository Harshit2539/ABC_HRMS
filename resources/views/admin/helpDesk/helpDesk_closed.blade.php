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
    
    .button-container button{
      color: #24a7f8;
    border-color: #24a7f8;
    background: #fff;
}
    
    .modal-header{
        background-color: #a3b2c726;
    }

.drop-down{
    height: 50px;
   overflow: auto;
}

.sub-heading-container p{
     margin: 26px 70px 0px;
           
}
.downloadFile{
        border: none;
    background-color: white;
    color: blue;
}

.details-data{
    font-weight:normal;
}

.active button{
         color: white !important;
    background-color: royalblue !important;
}

.closedRequest thead tr{
    background-color:cornsilk;
    }

       #noDataBox img{
        width: 31%;
    }

</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">

    {{-- new code --}}

            <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
        <li class="nav-item" role="presentation">
            <a  class="{{ request()->routeIs('active.help_request') ? 'active' : '' }}" href="{{ route('active.help_request') }}"> 
            <button class="nav-link Active" type="button">
                Active Requests
            </button>
            </a> 
        </li>
        <li class="nav-item" role="presentation">
            <a  class="{{ request()->routeIs('closed.help_request') ? 'active' : '' }}" href="{{ route('closed.help_request') }}"> 
            <button class="nav-link Active" type="button">
                Closed Requests
            </button>
            </a> 
        </li>
        
    </ul>

        {{-- new code end --}}
            
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="card-title">
                                    <h3 class="main-heading">Help Desk<span>Closed Requests</span></h3>
                                </div>
                                
                          
                            </div>


                             {{-- Request Details Modal --}}
                                      <div>
                                 <div class="modal fade requestDetailsModal" id="requestDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" >
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                <h4 class="modal-title">Request Details</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body requestDetailsBody">
                                    {{-- dynamically appended in modal --}}

                                    </div>
                                </div>
                        </div>
                        </div>   
                                      
                  </div>

                <div class="container-fluid shadow-lg p-3">

                     <div id="noDataBox" class="shadow-lg border rounded p-5 text-center" style="display: none;">
                    <h3>No Closed Requests</h3>
                    <img src="{{ asset('images/no_data.jpg') }}" alt="No Data" class="img-fluid" >
                    <h4>There are currently no closed help requests. Please check back later.</h4>
                </div>
                          
                                  <div class="card-body table-responsive">
                            <table class="table custom-table datatable display compact closedRequest mt-3" style="font-size:0.9em !important;">
                                <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Priority</th>
                                        <th class="text-center">Status</th>
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


<script >

     $(document).ready(function () {

       $('.closedRequest').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('closed.help_request') }}",
                type: "GET",
                  dataSrc:function (response) {
                if (response.data.length === 0) {
                    $('.table-responsive').hide();  
                    $('#noDataBox').show(); 
                } else {
                    $('.table-responsive').show(); 
                    $('#noDataBox').hide();  
                }
                return response.data;
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
                    data: 'request_category',
                    className: "text-center"
                },
                  {
                    data: 'request_subject',
                    className: "text-center"
                },
               
                {
                    data: 'request_priority',
                    className: "text-center"
                },
                 {
                    data: 'request_status',
                    className: "text-center"
                },
                 {
                    data: 'action',
                    className: "text-center"
                }
             
            ],
             language: {
            emptyTable: "No active requests found. Please check back later."
        }
 
        });

     })

        
    
        $(document).on('click', '#requestDetailsButton', function() {
                                  
                             
                  $("#requestDetailsModal").modal('show');
                          
                var helpRequestId = $(this).data('id'); 
              
                $.ajax({
                    url: `/help_request_details/${helpRequestId}`,
                    type: 'GET',
                    success: function(response) {
                                     
                                     console.log(response);
                                          

                                                    var unitHtml = ` <div class="row">
                                   <div class="col-6">
                                   <p><strong>Employee Name:</strong><span class="details-data"> ${response.employeeName}</span></p>
                                   </div>
                                   <div class="col-6" >
                                       <p class="btn" > <strong> Request category:</strong> <span class="details-data">${response.requestCategory}</span></p>
                                   </div>
                                  </div>
                                   <div class="row">
                                    <div class="col-6">
                                    <p><strong>File:</strong> <button  data-id="${response.id}"  class="downloadFile">
                                       Download File <i class="fa-solid fa-download"></i>
                                       </button></p>
                                      </div>
                                      <div class="col-6">
                                      <p><strong>Request Priority :</strong> `;
                                    
                                          if(response.requestPriority == 'Medium')
                                          {
                                                   unitHtml +=  `<span class= "badge bg-warning text-dark">  ${response.requestPriority}</span>`  ; 
                                          }

                                          else if(response.requestPriority == 'High')
                                          {
                                                       unitHtml +=  `<span class= "badge bg-inverse-danger">  ${response.requestPriority}</span>`  ;
                                          }

                                            else if(response.requestPriority == 'Low')
                                          {
                                                       unitHtml +=  `<span class= "badge bg-inverse-success">  ${response.requestPriority}</span>`  ;
                                          }

                                          unitHtml += `</p>
                                                            </div>
                                                            </div>
                                                        <p> <strong>Subject:</strong><span class="details-data"> ${response.requestSubject} </span></p>
                                                        <p><strong>Description:</strong><span class="details-data"> ${response.requestDescription} </span></p>
                                                          <p><strong>CC:</strong><span class="details-data" style="color:grey"> ${response.cc_names.toString()} </></p>
                                                        <p><strong>Created At:</strong> <span class="details-data">${response.createdAt}</sapn></p> ` ;

                                                        $('.requestDetailsBody').html(unitHtml);


                         
                                      },
                    error: function() {
                    }
                });
        });





           $(document).on('click', '.downloadFile', function(e) {;
            
            e.preventDefault(); 

            var id = $(this).data('id');
            console.log(id);
          
        

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('download.file') }}",
                    type: 'GET',
                    data:{ 'id' :id} ,
                    xhrFields: {
                    responseType: 'blob' 
                  },
                    success: function(response, status, xhr) {
            var filename = "downloaded_file"; 
            var disposition = xhr.getResponseHeader('Content-Disposition');
            if (disposition && disposition.indexOf('filename=') !== -1) {
                filename = disposition.split('filename=')[1].trim().replace(/['"]/g, '');
            }

            var mimeType = xhr.getResponseHeader('Content-Type');
            var blob = new Blob([response], { type: mimeType });

            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
                    error: function(xhr) {
                        
                    }
                }); 
        

     
       
    });



      </script>

 

    @endsection  