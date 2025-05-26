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
 
 
.loader {
    margin-top:13px;
    margin-bottom:18px;
  width: 60px;
  aspect-ratio: 4;
  --_g: no-repeat radial-gradient(circle closest-side, #00bfff 90%, #0000);
  background:
    var(--_g) 0%   50%,
    var(--_g) 50%  50%,
    var(--_g) 100% 50%;
  background-size: calc(100%/3) 100%;
  animation: l7 1s infinite linear;
}
 
@keyframes l7 {
  33% { background-size: calc(100%/3) 0%,   calc(100%/3) 100%, calc(100%/3) 100%; }
  50% { background-size: calc(100%/3) 100%, calc(100%/3) 0%,   calc(100%/3) 100%; }
  66% { background-size: calc(100%/3) 100%, calc(100%/3) 100%, calc(100%/3) 0%; }
}
 
 
 
</style>
 
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
 
 
<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">
 
         
 
 
           
                <div class="row justify-content-center">
                    <div class="col-7 mt-5">
                            <div class="card p-3">
                            @php
        $selectedComponents = $salaryGroupDetails->components->pluck('salary_component_id')->toArray();
                                       @endphp    
 
                                    <form id="editGroupForm">
                                   <div class="form-row">
                                       <div class="form-group col-md-12 ">
                                          <label class="form-label fw-semibold text-danger">* Name</label>
                                <input type="hidden" class="form-control" name="group_id" value={{ $salaryGroupDetails->id }} >
                                          <input type="text" class="form-control" name="group_name" value={{ $salaryGroupDetails->salary_group_name }} required>
                                       </div>
 
                                       <div class="form-group col-md-12 ">
                                           <label class="form-label fw-semibold">Salary Component</label>
                                           <select name="salaryComponents[]" id="editComponentDropdown" class="border rounded p-2 d-flex flex-wrap form-select align-items-center" multiple  required >
                                 
                                         @foreach ( $salaryComponentList as $component )
                                            <option value={{ $component->id }}    
                                             @if (in_array($component->id, $selectedComponents)) selected @endif> {{ $component->component_name }}</option>
                                             
                                         @endforeach
 
                                          </select>
                                      </div>
 
 
                        <!-- Component Entry Rows -->
 
                        <div id="appendedComponentsRows">
 
                         
                          <div class="loader"></div>
 
 
 
 
 
                            </div>
 
 
                        <!-- Users -->
                        {{-- <div class="form-group col-md-12">
                            <label class="form-group">Users</label>
                            <select class="form-select col-md-12 mb-3" id="employeeDropdown"  name="groupEmployees[]" multiple required>
                             
                              @foreach ($employees as $employee )
                                 <option value="{{ $employee->id }}">{{ $employee->first_name }}{{ $employee->last_name }}</option>
                                 @endforeach
                            </select>
                        </div>--}}
 
                    </div>
 
              <div clas="row">
            <button id="updateGroupBtn"  data-id=" {{ $salaryGroupDetails->id }}"   type="submit" class="btn btn-primary">Submit</button>
 
            </div>
 
                  </form>
 
 
                </div>
 
 
               
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
 
    </div>
 
</div>
 
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
    <script>
 
        $('#editComponentDropdown').select2({
                width:'100%'
            });
 
 
  $(document).ready(function () {
    const selectedComponents = $('#editComponentDropdown').val() || [];
 
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 
            $('.loader').show();
 
 
  $.ajax({
            url: "{{ route('get.selected.components') }}",
            type: "GET",
            data: { ids: selectedComponents },
            success: function (response) {
                if (response.status === true) {
                       $('.loader').hide();
 
                 let unitHtml = '';
 
                response.selectedComponents.forEach((el)=>{
                           
                             unitHtml  += `
                        <div class="row mb-3 component-row" id="component-row-${el.id}">
                            <div class="col-md-3 mb-1">
                                <label class="form-label text-danger fw-semibold">* Name</label>
                                <input type="text" class="form-control" value="${el.component_name}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-danger fw-semibold">* Type</label>
                                <input type="text" class="form-control" value="${el.component_type}" disabled>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-danger fw-semibold">* Value Type</label>
                                <input type="text" class="form-control" value="${el.component_value_type_label}" disabled>
                            </div>`;
 
                            if(el.component_value_type == 3 || el.component_value_type == 4){
                                     
                                         unitHtml +=    ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly </label>
                                <input type="text" class="form-control" value="${el.monthly_percentage}%" disabled>
                            </div>`;
 
                            }
 
                           else if(el.component_value_type == 1 || el.component_value_type == 2){
                                     
                                         unitHtml +=    ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly </label>
                                <input type="text" class="form-control" value="Rs ${el.monthly_amount}" disabled>
                            </div>`;
 
                            }
 
                           unitHtml +=  ` <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger w-100 remove-component-btn" data-id="${el.id}">-</button>
                            </div>
                        </div>`;
                           
                })
 
                    $('#appendedComponentsRows').append(unitHtml);
                }
            }
        });
 
 
});
 
 
 
    $(document).on('submit', '#editGroupForm', function(e) {
            e.preventDefault();
 
                 let groupId = $('#updateGroupBtn').data('id');
                let formData = new FormData(this);
                   
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
 
                    $.ajax({
                    url: "{{ route('update.salary.group') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                   window.location.href= `/edit_salary_group/${groupId}`;
 
                               
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
 
 
 
       let previous = [];
 
            $(document).on('focus', '#editComponentDropdown', function () {
                previous = $(this).val() || [];
            }).on('change', '#editComponentDropdown', function (e) {
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
                               console.log(response);
                              // debugger;
                             
 
                         unitHtml =`  
                     
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
                            </div>`
 
                               if(response.salaryComponent.component_value_type == 3 || response.salaryComponent.component_value_type == 4 ){
 
                                   unitHtml +=    ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly</label>
                                <input type="text" class="form-control" value="${response.salaryComponent.monthly_percentage}%" disabled>
                            </div>`
 
                               }
 
                            if(response.salaryComponent.component_value_type == 1 || response.salaryComponent.component_value_type == 2 ){
 
                                     unitHtml +=  ` <div class="col-md-2">
                                <label class="form-label text-danger fw-semibold">* Monthly</label>
                                <input type="text" class="form-control" value="Rs ${response.salaryComponent.monthly_amount}" disabled>
                            </div>`
 
                               }
 
 
                            unitHtml +=  ` <div class="col-md-1">
                               <button class="btn btn-outline-danger w-100 remove-component-btn"  data-id="${response.salaryComponent.id}"  type="button" style="margin-top:32px;">-</button>
                          </div>
 
                            </div>
                            `;
 
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
                const selected = $('#editComponentDropdown').val();
                const updated = selected.filter(value => value !== id.toString());
                $('#editComponentDropdown').val(updated).trigger('change.select2');
            });
 
            </script>