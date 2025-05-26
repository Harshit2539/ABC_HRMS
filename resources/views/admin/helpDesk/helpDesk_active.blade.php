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
 
 
 
.downloadFile{
        border: none;
    background-color: white;
    color: blue;
}
.details-data{
    font-weight:normal;
}
 
.heading span{
 
     color: #757575;
    font-size: 16px;
    font-weight: 500;
    display: block;
    margin-top: .15px;
}
.active button{
        color: white !important;
    background-color: royalblue !important;
}
.activeRequest thead tr{
    background-color:cornsilk;
    }
 
    #noDataBox img{
        width: 31%;
    }
 
 
.input-group{
 
   outline: none;
  border: none;
  box-shadow: none;
      width: 75%;
}
 
.search-bar{
  border: black solid 1px;
 display: flex;
}
 
.search-bar input{
    width: 89%;
}
 
.search-bar span{
    margin-left: 2px;
    margin-top: 2px;
}
 
.search-bar span i{
 
    font-size: 1.2rem;
}
 
.user-item{
  display: flex;
  gap: 10px;
  margin-left:32px;
}
 
.add i{
    color: blue;
    font-size: 1.3rem;
     color: blue;
}
 
.drop-down-menu{
 
    border: 1px solid rgba(0, 0, 0, .15);
    border-radius: 4px;
    box-shadow:none;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    float: left;
    z-index: 1000;
    position: absolute;
    overflow-y: auto;
    max-height: 200px;
    padding: 12px 0;
    margin-top: 10px;
    min-width: 236px;
    max-width: 230px;
    right: 55px;
}
 
.last-row{
 
    display: flex;
    justify-content: space-between;
}
 
 
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
 
.menu li {
  float: left;
  font-size: 30px;
  height: 40px;
  line-height: 40px;
  width: 60px;
}
.add {
  display: block;
  font-weight: bold;
  height: 40px;
  transition: all .4s ease-in-out;
  cursor: pointer;
}
.plus {
  transition: all .4s ease-in-out;
}
 
.rotate{
  -webkit-transform: rotate(45deg);
 
}
 
 
.pop{
    display:none;
}
 
.pop li {
  height: 40px;
 
}
.pop li:last-of-type {
  border: 0;
}
 
.pop li:not(:first-child):hover {
  background-color: lightblue;
  border-radius: 5px;
}
.pop li:hover:nth-child(2n){
  border-radius: 0;
}
.drop-down-menu li:first-child {
margin-bottom: 12px;
}
 
 
.dynamic_list{
   
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
                                    <h3 class="main-heading heading">Help Desk<span>Active Requests</span> </h3>
                                </div>
                               
                                <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#helpRequestModal" >Add New Request</button>
                                </div>
 
                            </div>
                            <div class="card">
                                   
                                                <!-- Help Request Modal -->
 
                        <div class="modal" id="helpRequestModal">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title">New Request</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                               
                                <div class="modal-body">
                                  <form id="helpRequestForm" enctype="multipart/form-data">
                                    <div class="form-group col-6">
                                            <label>Category</label>
                                            <select class="form-control" id="requestCategory" name="request_category" required>
                                                <option value="" disabled >Select Category</option>
                                                <option value="Employee Information">Employee Information</option>
                                                <option value="Income Tax">Income tax</option>
                                                <option value="Loans">Loans</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
 
 
                                    <div class="form-group col-md-12">
                                        <label>Subject</label> <span class="text-danger">*</span>
                                        <input type="text" class="form-control" id="requestSubject" name="request_subject" required>
                                    </div>
 
                                    <div class="form-group col-md-12">
                                        <label>Description</label> <span class="text-danger">*</span>
                                        <textarea class="form-control" id="requestDescription" name="request_description" rows="4" required></textarea>
                                    </div>
 
                                    <div class="form-group col-md-12">
                                        <label>Attach File</label> <i class="fa fa-paperclip" aria-hidden="true"></i> <span class="text-danger">*</span>
                                        <input type="file" class="form-control" id="attachFile" name="attach_file" required>
                                    </div>
 
                                                        <div class="form-group col-12">
                                <div class=" last-row">
 
                                        <div class="menu">
 
                                <p class="plus"><span class="add">
                             <i class="fa-solid fa-circle-plus" ></i>
                                </span>
                                </p>
                           
                                    </div>
 
                                    <div class="col-md-6">
                                        <label>CC to</label> <span class="text-danger">*</span>
                                   
                                        <div class="pop">
 
                                            <ul class="drop-down-menu">
                                    <li>
                                    <div class="search-bar">
                                        <input placeholder="Search Here"  type="text" class="input-group" name="search_employees" id="searchEmployees" value=""  autocomplete="off"/>
                                        <span class="input-group-addon ng-star-inserted" ><i class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                    </li>
                                   
                                                                 
                                    @foreach ($employees as $employee)
                                    <li>
                                <div class="user-item ">
                                    <input type="checkbox" name="CC_to[]" value="{{ $employee->id }}" id="employee_{{ $employee->id }}"  style="height:17px;"/>
                                    <div class="user-image">
                                    <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div class="user-info ">
                                    <h4 style="margin-top:-2px;">{{ $employee->name }}</h4>
                                    </div>
                                </div>
                                    </li>
                                    @endforeach
 
                                </ul>
 
 
                                </div>
                                    </div>
 
                            <!-- Priority Section -->
                            <div class="col-md-6">
                                <label>Priority</label> <span class="text-danger">*</span>
                                <select class="form-control" id="requestPriority" name="request_priority" required>
                                    <option value="">Select Priority</option>
                                    <option value="High">High <span>🔴</span></option>
                                    <option value="Medium">Medium <span>🟡</span></option>
                                    <option value="Low">Low <span>🟢</span></option>
                                </select>
                            </div>
                        </div>
                    </div>
 
 
                                    <div class="form-group text-center mt-3">
                                        <button type="submit" class="btn btn-success">Submit Request</button>
                                    </div>
 
                                 </form>          
                               </div>
 
                            </div>
                       </div>
                 </div>
                </div>
 
 
                             {{-- Request Details Modal --}}
                                      <div>
                                 <div class="modal fade requestDetailsModal" id="requestDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <h3>No Active Requests</h3>
                            <img src="{{ asset('images/no_data.jpg') }}" alt="No Data" class="img-fluid" >
                            <h4>There are currently no active help requests. Please check back later.</h4>
                        </div>
                         
                                  <div class="card-body table-responsive">
 
                            <table class="table custom-table datatable display compact activeRequest mt-3" style="font-size:0.9em !important;">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
 
 
<script>
 
     $(document).ready(function () {
 
       $('.activeRequest').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('active.help_request') }}",
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
 
       
            $(document).on('submit', '#helpRequestForm', function(e) {
            e.preventDefault();
                let formData = new FormData(this);
 
            //  for(var pair of formData.entries()) {
            // console.log(pair[0]+ ':'+ pair[1]);
            // }
 
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
                    $.ajax({
                    url: "{{ route('store-request.data') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= 'http://127.0.0.1:8000/active_help_request';
 
                    };
                    },
                    error: function(xhr) {
                       
                    }
                });
       
    });
 
 
 
        $(document).on('click', '#requestDetailsButton', function() {
                                 
                             
                  $("#requestDetailsModal").modal('show');
                         
                var helpRequestId = $(this).data('id');
             
                $.ajax({
                    url: `/help_request_details/${helpRequestId}`,
                    type: 'GET',
                    success: function(response) {
 
                   
                                     
               var requestPriority;
 
               var unitHtml = ` <div class="row">
                                   <div class="col-6">
                                   <p><strong>Employee Name:</strong><span class="details-data" style="font-weight:normal"> ${response.employeeName} </span></p>
                                   </div>
                                   <div class="col-6" >
                                       <p class="btn" > <strong> Request category:</strong><span class="details-data"> ${response.requestCategory} <span></p>
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
                                                        <p> <strong>Subject:</strong> <span class="details-data">${response.requestSubject} </span></p>
                                                        <p><strong>Description:</strong><span class="details-data" > ${response.requestDescription} <span></p>
                                                        <p><strong>CC:</strong><span class="details-data"> ${response.cc_names.toString()} </span></p>
                                                        <p><strong>Created At:</strong> <span class="details-data">${response.createdAt} </span></p>`;
 
 
                                                        if(response.roleName == 'Admin'){
 
                                                            unitHtml  += `<p><button data-id="${response.id}" class="btn btn-info" id="closeRequestBtn" >Close Request</button> </p>`;
                                                        }
                                                         
                                                       
 
                                                        $('.requestDetailsBody').html(unitHtml);
                         
                                      },
                   
                });
        });
 
 
            $(document).on('click', '#closeRequestBtn', function(e) {
                             
                              e.preventDefault();
                              let id = $(this).data('id');
   
                        Swal.fire({
                            title: "Close  Request",
                            text: "Are you sure you want to proceed?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            allowOutsideClick: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "{{route('closed.request')}}",
                                    type: "post",
                                    dataType: "json",
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id": id
                                    },
                                    success: function(response) {
 
                                        if(response.status == true){
                                                       toastr.success(response.message);
                             window.location.href= 'http://127.0.0.1:8000/active_help_request';
 
                                        }
                                               
                                               else{
 
                                                     toastr.error(response.message);
                                               }
                                       
                                    }
                                });
                            }
                        });                                          
            }
            )
 
 
 
 
             
            $(document).on('click', '.downloadFile', function(e) {
           
            e.preventDefault();
 
            var id = $(this).data('id');
         
       
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
 
   
   
   let timeout;
 
       $(document).on('keyup', '#searchEmployees', function (e) {
 
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
         
          e.preventDefault();
               if (timeout) {
         clearTimeout(timeout);
 
     }
 
     timeout = setTimeout(function() {
 stringadd = $("input[name=search_employees]").val();
 
      if(stringadd.length == 0){
 
         let total_employees = <?php echo json_encode($employees); ?>;
 
        let searchBarLI = document.querySelector(".drop-down-menu").querySelector("li:first-child");
          let existingLIs = document.querySelector(".drop-down-menu").querySelectorAll("li:not(:first-child)");
 
        existingLIs.forEach(li => li.remove());
 
          total_employees.forEach(employee => {
            let newLI = document.createElement("li");
            newLI.innerHTML = `
                <div class="user-item">
                    <input type="checkbox" name="CC_to[]" value="${employee.id}" id="employee_${employee.id}" />
                    <div class="user-image">
                        <p><i class="fa-solid fa-user"></i></p>
                    </div>
                    <div class="user-info">
                        <h4>${employee.name}</h4>
                    </div>
                </div>
            `;
 
            document.querySelector(".drop-down-menu").appendChild(newLI);
        });
 
         
      }
 
       
    if(stringadd.length >= 3) {
         
                              $.ajax({
 
                   url:"{{ route('search.employees')}}",
                   type:'POST',
                   data:{"employee_name":stringadd},
                   success:function(response){
 
                   
                   
                    if(response.status == true){
                               
        let searchBarLI = document.querySelector(".drop-down-menu").querySelector("li:first-child");
 
          let existingLIs = document.querySelector(".drop-down-menu").querySelectorAll("li:not(:first-child)");
 
     
        existingLIs.forEach(li => li.remove());
 
          response.employees.forEach(employee => {
            let newLI = document.createElement("li");
            newLI.innerHTML = `
                <div class="user-item">
                    <input type="checkbox" name="CC_to[]" value="${employee.id}" id="employee_${employee.id}" />
                    <div class="user-image">
                        <p><i class="fa-solid fa-user"></i></p>
                    </div>
                    <div class="user-info">
                        <h4>${employee.name}</h4>
                    </div>
                </div>
            `;
 
            document.querySelector(".drop-down-menu").appendChild(newLI);
        });
 
          }
 
          else if(response.status == false){
                               
                                 let searchBarLI = document.querySelector(".drop-down-menu").querySelector("li:first-child");
 
          let existingLIs = document.querySelector(".drop-down-menu").querySelectorAll("li:not(:first-child)");
 
     
        existingLIs.forEach(li => li.remove());
 
            let newLI = document.createElement("li");
            newLI.innerHTML = `
              <div>${response.message}</div>
            `;
 
            document.querySelector(".drop-down-menu").appendChild(newLI);
           
          }
                                             
        }
    });
 
}  
     },600)
 
    });
 
 
            $(document).on('click','.plus', function(e){
 
                             $(".add").toggleClass("rotate");
                                $(".plus").toggleClass("open");
                                $(".pop").fadeToggle(600);
                       
            } )
 
   
      </script>
 
    @endsection
 

 
 
 