@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href=" https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
 
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
 
.active{
      color: blue !important;
}
 
#salaryGroupDetails{
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
           <button class="nav-link {{ request()->routeIs('salary.group.list') ? 'active' : '' }}  " type="button">
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
                                    <h3 class="main-heading heading">Salary<span>group</span></h3>
                                </div>
                             
                                    <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appraisalModal" >Add New Salary Group </button>
                                </div>
                            </div>
 
 
 
                            <div class="card">                                
                                                <!-- Create new Component Modal -->
 
                        <div class="modal" id="appraisalModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                           
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Salary Group</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
 
 
                                     <div class="modal-body">
                                     <form id="createGroup">
 
                                    <div class="form-row">
                        <div class="form-group col-md-12 ">
                            <label class="form-label fw-semibold text-danger">* Name</label>
                            <input type="text" class="form-control" name="group_name" required>
                        </div>
 
                        <div class="form-group col-md-12 ">
                            <label class="form-label fw-semibold">Salary Component</label>
                           
                            <select name="salaryComponents[]" id="componentDropdown" class="border rounded p-2 d-flex flex-wrap form-select align-items-center" multiple required >
                                 @foreach ($salaryComponentList as $component )
                                 <option value="{{ $component->id }}">{{ $component->component_name }}</option>
                                     
                                 @endforeach
                                    </select>
                        </div>
 
 
                        <!-- Component Entry Rows -->
 
                        <div id="appendedComponentsRows">
 
                              {{-- appended dynamically here --}}
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
 
 
                             
                              {{-- edit Group Details Modal --}}
 
 
                                      <div>
                                 <div class="modal fade groupDetailsModal" id="groupDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" >
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                           
                                <div class="modal-header">
                                <h4 class="modal-title">Edit Group Details</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >&times;</button>
                                </div>
                               
                                <div class="modal-body  editGroupBody">
 
                                    {{-- dynamically appended in modal --}}
 
                                    </div>
                                </div>
                        </div>
                        </div>          
                  </div>
           
 
                <div class="container-fluid shadow-lg p-3">
                                   
                                  <div class="card-body table-responsive" style="overflow-x: auto;">
                            <table class="table custom-table datatable display compact groupList mt-3" >
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Group Name</th>
                                        {{-- <th class="text-center">Total Users</th> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
 
<script>
 
        $('#componentDropdown').select2({
    width: '100%',
     placeholder: "Select Salary Components"
    });
 
    $('#employeeDropdown').select2({
         width:'100%'
    });
 
 
    </script>
 
<script>
 
  $(document).ready(function () {
 
 $('.groupList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('salary.group.list') }}",
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
                    data: 'group_name',
                    className: "text-center"
                },
 
          //        {
          //          data: 'total_users',
          //          className: "text-center"
          //      },
 
                  {
                    data: 'action',
                    className: "text-center"
                }
             
            ]
 
        });
 
   
  })
 
    $(document).on('submit', '#createGroup', function(e) {
            e.preventDefault();
 
                let formData = new FormData(this);
 
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
                    $.ajax({
                    url: "{{ route('store.salary.group') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                setTimeout(()=>{
                               window.location.href= '{{ route('salary.group.list') }}';
 
                                },500)
 
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
 
 
   $(document).on('click', '#deleteGroupBtn', function(e) {
                                     
                                     e.preventDefault();
                                    let  id = $(this).data('id');
 
                                           $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
 
 
                           $.ajax({
                                url: `/delete_salary_group/${id}`,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                       
                                if(response.status == true){
                                            toastr.success(response.message);
                                            window.location.href= '{{ route('salary.group.list') }}';
 
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
 
 
 
                       let previous = [];
 
            $(document).on('focus', '#componentDropdown', function () {
                previous = $(this).val() || [];
            }).on('change', '#componentDropdown', function (e) {
                e.preventDefault();
 
                let current = $(this).val() || [];
 
 
                let added = current.filter(value => !previous.includes(value));
                let removed = previous.filter(value => !current.includes(value));
 
                     previous = current;
 
              if (added.length) {
 
                  addedComponentId = added[0];
 
              }
 
               if (removed.length) {
 
                   removed.forEach(function (id) {
                        $(`#component-row-${id}`).remove();
                    });
                    previous = current;
                    return false;
               }
 
 
                        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
                    $.ajax({
                    url: "{{ route('get.component.details') }}",
                    type: 'GET',
                    data: {
                        id:addedComponentId
                        },
                    success: function (response) {
                       
                    if(response.status == true){
                             
                         unitHtml =`  
                         <div class="row mb-3 component-row" id="component-row-${response.salaryComponent.id}">
                          <div class="row mb-3">
                            <div class="col-md-3 mb-1">
                                <label class="form-label text-danger fw-semibold">* Name</label>
                                <input type="text" class="form-control" value="${response.salaryComponent.component_name}" disabled>
                            </div>
 
                            <div class="col-md-3">
                                <label class="form-label text-danger fw-semibold">* Type</label>
                                <input type="text"  class="form-control" value="${response.salaryComponent.component_type}" disabled>
                            </div>
 
                            <div class="col-md-3">
                                <label class="form-label text-danger fw-semibold">* Value Type</label>
                                <input type="text"  class="form-control" value="${response.salaryComponent.component_value_type_label}" disabled>
                            </div>`;
 
                            if(response.salaryComponent.component_value_type == 3 || response.salaryComponent.component_value_type == 4 ){
 
                                       unitHtml +=    ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly</label>
                                <input type="text" class="form-control" value="${response.salaryComponent.monthly_percentage}%" disabled>
                            </div>`;
 
                            }
 
                            else if(response.salaryComponent.component_value_type == 1 ||  response.salaryComponent.component_value_type == 2){
 
                                          unitHtml +=    ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly</label>
                                <input type="text" class="form-control" value=" Rs ${response.salaryComponent.monthly_amount}" disabled>
                            </div>`;
 
 
                            }
                           
 
                          unitHtml   +=  `  <div class="col-md-1" id="removeBtnContainer">
                               
                                         </div>
 
                           
                            </div>
                              </div>
                            `;
 
                            //<button class="btn btn-outline-danger w-100 remove-component-btn"  data-id="${response.salaryComponent.id}"  type="button" style="margin-top:32px;">-</button>
 
                            $('#appendedComponentsRows').append(unitHtml);
                           
                         
 
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
 
 
 
            $(document).on('click', '.remove-component-btn', function () {
       const id = $(this).data('id');
    $(`#component-row-${id}`).remove();
    const selected = $('#componentDropdown').val();
    console.log(selected);
    const updated = selected.filter(value => value !== id.toString());
    console.log(updated);
    $('#componentDropdown').val(updated).trigger('change.select2');
});
   
 
</script>
 