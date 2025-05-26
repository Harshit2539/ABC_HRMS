@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href=" https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
 
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    <!-- icons links -->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
 
   
 
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
   
   
    .modal-header{
        background-color: #a3b2c726;
    }
 
 
.heading span{
 
     color: #757575;
    font-size: 16px;
    font-weight: 500;
    display: block;
    margin-top: .15px;
}
 
 
.input-group{
 
   outline: none;
  border: none;
  box-shadow: none;
      width: 75%;
}
 
.percentage_container{
    display:none;
}
 
</style>
 
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
 
 
<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">
 
           
           
           
  <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
       <li class="nav-item" role="presentation">
           <a href="{{ route('salary.component.list') }}">
           <button class="nav-link {{ request()->routeIs('salary.component.list') ? 'active' : '' }} " type="button">
              Salary Component
           </button>
           </a>
       </li>
       <li class="nav-item" role="presentation">
           <a href="{{ route('salary.group.list') }}">
           <button class="nav-link {{ request()->routeIs('salary.group.list') ? 'active' : '' }} " type="button">
           Salary Group
           </button>
           </a>
       </li>
   
   </ul>
 
 
           
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="card-title">
                                    <h3 class="main-heading heading">Salary<span>component</span></h3>
                                </div>
                             
                                    <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appraisalModal" >Add New Salary Component </button>
                                </div>
                            </div>
 
 
 
                            <div class="card">                                
                                                <!-- Creae new Component Modal -->
 
                        <div class="modal" id="appraisalModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Salary Component</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
 
 
                                     <div class="modal-body">
                                     <form id="createComponent">
 
                 
                    <div class="row">
 
              <div class="col-xl-12 col-lg-6 col-md-6 col-12 mb-4">
                <div>
                  <label  class="form-label">Name</label><span class="text-danger">*</span>
             <input type="text" placeholder="Please enter name" name="component_name" id="component_name" class="form-control" required />
                </div>
              </div>
              </div>
 
 
 
 
            <div class="row">
             
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                  <label  class="form-label">Type</label><span class="text-danger">*</span>
                  <select id="component_type" name="component_type" class="form-select">
                   
                  <option disabled >--Select Component Type--</option>
                  <option value="earning">Earning</option>
                  <option value="deduction">Deduction</option>
 
                  </select>
                </div>
              </div>
 
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                    <label  class="form-label">Value Type</label><span class="text-danger">*</span>
                  <select id="component_value_type"  name="component_value_type" class="form-select">
                 
                    <option disabled >--Select Value Type--</option>
                  <option value="1">Fixed</option>
                  <option value="2">Variable</option>
                    <option value="3">Basic percent</option>
                      <option value="4">CTC percent</option>
 
                  </select>
                </div>
              </div>
 
            </div>
 
               <div class="row">
             
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2 mt-2">
 
                <div class="percentage_container">
 
                  <label for="monthly_percentage" class="form-label">Monthly Percentage</label>
            <input type="text"  name="monthly_percentage" id="monthly_percentage" min="0" max="100"  class="form-control"   />
                </div>
 
                    <div class="amount_container">
                  <label for="monthly_amount" class="form-label">Monthly Amount</label>
            <input type="text"  name="monthly_amount" id="monthly_amount"   class="form-control"  required />
                </div>
 
              </div>
 
          </div>
              <div clas="row">
            <button id="submitComponentBtn" type="submit" class="btn btn-primary">Submit</button>
            </div>
 
                  </form>
 
                               </div>
                            </div>
                       </div>
                 </div>
                </div>
 
                <div class="container-fluid shadow-lg p-3">
                                   
                                  <div class="card-body table-responsive" style="overflow-x: auto;">
                            <table class="table custom-table datatable display compact componentList mt-3"  style="font-size:0.9em !important;">
                                <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Value Type</th>
                                        <th class="text-center">Monthly</th>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
 
 
<script>
 
  $(document).ready(function () {
 
 $('.componentList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('salary.component.list') }}",
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
                    data: 'name',
                    className: "text-center"
                },
                  {
                    data: 'type',
                    className: "text-center"
                },
       
                 {
                    data: 'value_type',
                    className: "text-center"
                },
                {
                    data: 'monthly_percentage',
                    className: "text-center"
                },
                  {
                    data: 'action',
                    className: "text-center"
                }
             
            ]
 
        });
 
   
  })
 
 
    $(document).on('submit', '#createComponent', function(e) {
            e.preventDefault();
 
                let formData = new FormData(this);
 
                for (var pair of formData.entries()) {
                        console.log(pair[0]+ ':' + pair[1]);
 
 
                    }
                    debugger;
 
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
                    $.ajax({
                    url: "{{ route('store.salary.component') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= '{{ route('salary.component.list') }}';
 
                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status);
                      console.log('Response Text:', xhr.responseText);
                    alert('An error occurred');
 
    }
                });
       
    });
 
 
     $(document).on('change', '#component_value_type', function(e) {
                   
                   let valueType  = $(this).val();
               
                   if(valueType == 1 || valueType == 2  ){
                       $('.percentage_container').hide();
                          $('.amount_container').show();
 
                            $('#monthly_percentage').removeAttr('required');
                          $('#monthly_amount').prop('required',true);
 
                   }
 
                   else if(  valueType == 3 || valueType == 4){
                        $('.amount_container').hide();
                          $('.percentage_container').show();
                                $('#monthly_percentage').prop('required',true);
                          $('#monthly_amount').removeAttr('required');
                         
                               
                   }
 
     })
 
 
 
 
     $(document).on('click', '#deleteComponentBtn', function(e) {
 
                e.preventDefault();
                let id = $(this).data('id');
 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
 
                $.ajax({
                    url: `/delete_salary_component/${id}`,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    success: function(response) {
 
                        if (response.status == true) {
                            toastr.success(response.message);
                            window.location.href = '{{ route('salary.component.list') }}';
 
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
 