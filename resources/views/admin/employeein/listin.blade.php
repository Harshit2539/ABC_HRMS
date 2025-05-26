@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.css" integrity="sha512-HLz+b0Pyj+6RnAjTwAajDUOJfhEIfdLy91cHSph3ydMYt3UN6kp7h+b2ofodXNflk4CNyZe9HP8YAj8hYBiNSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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


    .tablink{
            border: none;
    background: transparent;
    }


    .modal-nav{

     background-color: rgba(221, 99, 99, 0.32) !important;
    justify-content: space-around;
    height: 2rem;
    align-items: center;
    border-radius: 20px;
    display: flex;
    justify-content: space-evenly;
    }

    .nav-links{
     font-weight: 1000;
    cursor: pointer;
    color: darkred !important;
    }

   .salary-container {
    width: 100%;
}

.salary-header,
.salary-row {
    display: flex;
    justify-content: space-between;
    text-align: center;
}

.salary-header div,
.salary-row div {
    flex: 1; 
    padding: 10px;
    box-sizing: border-box;
}

.field-container{


}


</style>


@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
    <div class="page-wrapper">

 


    <div class="container-fluid mt-4" id='add_asset'>
            <div class="row pt-3">
                <div class="col-md-6 pb-md-0">
                    <button type="button" id="addEmployeeBtn"  data-toggle="modal" data-target="#addEmployeeModal"  class="btn btn-sm btn-fill btn-primary"><i class="fa fa-plus"></i> Add New</button>
                </div>
            </div>




            

                       <div class="card">                                 
                                                <!-- Creae new Employee Modal -->

                        <div class="modal" id="addEmployeeModal">
                            <div class="modal-dialog modal-xl">
                              <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h4 class="modal-title">Personal Details</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    
                                </div>


                                   <div class=" modal-nav">
                                    <button class="tablink w3-bar-item w3-button" onclick="openInfo(event, 'personal')" ><span class="nav-links">personal</span> </button> {{--  --}}
                                    <button class="tablink w3-bar-item w3-button" onclick="openInfo(event, 'work')" ><span class="nav-links">work</span> </button> {{--  --}}
                                  <button class="tablink w3-bar-item w3-button"  onclick="openInfo(event, 'contact')"  ><span class="nav-links">contact</span> </button> {{----}}
                                    <button class="tablink w3-bar-item w3-button" onclick="openInfo(event, 'salary')"  ><span class="nav-links">salary</span></button> {{-- --}}
                                    </div>


                                     <div class="modal-body">

                                    

                                     <form id="addEmployeeForm">

                                            {{-- personal tab --}}

                                                <div id="personal" class="w3-container info-link">

                                          <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="employee_number" >Employee No.</label>
                            <input name="employee_number"  type="text" id="employee_no" class=" form-control"  placeholder="Employee Number" />
                            <span  class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="aadhaar_number" >Adhaar No.</label>
                            <input name="aadhaar_number"  type="number" id="aadhaar_number" class=" form-control"  placeholder="Aadhaar Number"/>
                            <span  class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label  for="first_name" >First Name</label>
                            <input name="first_name"  name="first_name" type="text" id="name" class=" form-control"  placeholder="First Name" />
                            <span  class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="middle_name" >Middle Name</label>
                            <input name="middle_name"   type="text" id="name" class=" form-control"  placeholder="Middle Name" />
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="last_name" >Last Name</label>
                            <input name="last_name"  name="last_name" type="text"  class=" form-control"  placeholder="Last Name" />
                            <span  class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="date_of_birth" >Date of Birth</label>
                          <input name='date_of_birth' class="form-control" type="date" />
                            <span  class="text-danger"></span>
                        </div>

                     

                        <div class="form-group col-md-6">
                            <label for="gender" >Gender</label>
                            <select id="gender" name="gender" class="form-control">
                            <option disabled selected>--select Gender--</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="non_binary">non binary</option>
                            <option value="pns">prefer not say</option>
                            </select>
                            <span  class="text-danger"></span>
                        </div>

               
                            
                        <div class="form-group col-md-12">
                         
                            <div class="row">

                       <div class="form-group col-md-4">
                            <h5 class="section-heading">Father's Name</h5>
                            <input class="form-control" type="text" name="fathers_name" />
                            <span  class="text-danger"></span>
                        </div>


                                 
                         <div class="form-group col-md-4">
                            <h5 class="section-heading">Mother's Name</h5>
                            <input class="form-control" type="text" name="mothers_name" />
                            <span  class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <h5 class="section-heading">Spouse's Name</h5>
                            <input type="text"  class="form-control" name="spouse_name" >
                        </div>
                               
                            </div>
                        </div>
                    
                            </div>
                            
                            </div>

                                  {{-- work tab --}}

                             <div id="work" class="w3-container info-link">

                             <div class="row">
                             
                                         <div class="form-group col-md-4">
                            <label for="supervisor_id" >Reporting manager</label>
                            <select class="form-control" name="supervisor_id" id="supervisor_id" >
                            <option value="" disabled selected >--Select Reporting Manager--</option>
                            @foreach ( $users as $user )
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                         
                            </select>
                            <span  class="text-danger"></span>
                        </div>


                              <div class="form-group col-md-4">
                            <label for="status" >Status</label>
                            <select class="form-control" id="status" name="status"  >
                              <option  value="" disabled >--Select Status--</option>
                            </select>
                            <span class="text-danger"> </span>
                        </div>



                          <div class="form-group col-md-4">
                            <label for="joined_date" >Date of Joining</label>
                            <input class="form-control" type="date" name="joined_date" />
                            <span  class="text-danger"></span>
                        </div>
                             
                             </div>
                               

                           <div class="row">
                           
                                <div class="form-group col-md-4">
                            <label for="reffered_by" >Referred By</label>
                           <select class="form-control" name="reffered_by" >
                              <option value="" disabled selected >--Select Referral Employee--</option>
                                   @foreach ( $users as $user )
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                            @endforeach
                            </select>
                        </div>


                           <div class="form-group col-md-4">
                            <label>Select Department</label><span class="text-danger">*</span>
                            <select class="form-control" id="department_dropdown" name="department" required>
                                <option value="" disabled selected >--Select Department-- </option>
                                    @foreach ($departments as $department)
                            <option value="{{  $department->id  }}">{{ $department->department }}</option>
                                @endforeach
                            </select>
                        </div>


                                <div class="form-group col-md-4">
                                <label>Select Designation</label><span class="text-danger">*</span>
                                <select class="form-control" id="designation" name="designation"   required>
                                    <option value="" disabled >--Select Designation-- </option>
                                    {{-- options are appended dynamically --}}
                                </select>
                            </div>

                           </div>

                           <div class="row">
                           
                              <div class="form-group col-md-4">
                                    <label for="role_name" >Role </label>
                                 
                                  <select class="form-control" name="role_id" >
                              <option value="" disabled selected >--Select Role --</option>
                                   @foreach ( $roles as $role )
                        <option value="{{ $role->id }}" >{{ $role->name }} </option>
                            @endforeach
                            </select>

                            <span  class="text-danger"></span>
                        </div>

                            <div class="form-group col-md-4">
                            <label for="probation_period" >Probation Period(Number of Days)</label>
                           <input type="number" name="probation_period" id="probation_period" class="form-control" >
                            </div>

                        <div class="form-group col-md-4">
                            <label for="confirmation_date" >Confirmation Date</label>
                          <input class="form-control" type="date" name="confirmation_date" />

                        </div>
                           
                           </div>                      

                   
                            


                                </div>

                                {{-- contact tab --}}

                                <div id="contact" class="w3-container info-link">



                                  <div class="form-group col-md-4">
                                    <label for="mobile_phone" >Mobile Number</label>
                                    <input class="form-control" type="number" name="mobile_phone" />
                                </div>


                                 <div class="form-group col-md-4">
                                    <label for="mobile_phone" >Home Phone</label>
                                    <input class="form-control" type="number" name="home_phone" />
                                </div>


                                     <div class="form-group col-md-4">
                            <label for="work_email" >Work Email</label>
                              <input class="form-control" type="email" name="work_email" />
                            </div>

                               <div class="form-group col-md-4">
                            <label for="private_email" >Private Email</label>
                              <input class="form-control" type="email" name="private_email" />
                            </div>


                                 <div class="form-group col-md-4">
                                    <label for="emergency_contact_name" >Emergency Contact Name</label>
                                   <input class="form-control" type="text" name="emergency_contact_name" />
                                    <span  class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="emergency_contact_number" >Emergency Contact Number</label>
                                   <input class="form-control" type="number" name="emergency_contact_number" />
                                    <span  class="text-danger"></span>
                                </div>

                                </div>


                                  {{-- salary tab --}}

                                 <div id="salary" class="w3-container info-link">

                                 <div class="form-row">
                                 
                                           <div class="form-group col-md-6">
                            <h5 class="section-heading">Select Salary Group</h5>
                             <select class="form-control" id="salary_group_id" name="salary_group_id" >
                            <option value="" disabled selected>--select salary group--</option>
                                 @foreach ( $salaryGroups as $salaryGroup )
                        <option value="{{ $salaryGroup->id }}" >{{ $salaryGroup->salary_group_name }}</option>
                            @endforeach
                            </select>
                            <span  class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <h5 class="section-heading">Enter Employee CTC</h5>
                            <input type="number"  class="form-control" name="employee_ctc" id="employee_ctc"  required>
                        </div>

                                 </div>


                        <div class="form-row d-flex justify-content-center" > 
                        <button id="calculateCtcSplit" class="btn-primary" style=" border-radius: 15px;">
                        Calculate
                        </button>
                        </div>

                              <div class="salary-container">
                        <div class="salary-header">
                            <div>Salary Component</div>
                            <div>Calculation Type</div>
                            <div>Monthly Amount</div>
                            <div>Annual Amount</div>
                        </div>

                        <hr>

                        <div id="salaryInfoContainer">



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




          
    </div>


    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                   
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable EmployeeList">
                            <thead>
                                <tr>
                                    <th class="text-center">Employee ID</th>
                                    <th class="text-center">Workstation ID</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
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

<!-- Script Code -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.js" integrity="sha512-T3FxfGZozDaMebkyEail/ou+a9U7Q+9P1VzG3QphdjjEJVmJdyvgGszLzK1bk8UBeZHh0iyRMHHZxH6XUtY8xQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    var table = $('.EmployeeList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        ajax: {
            url: "{{ route('employeesin.list') }}",
        },
        columns: [
          
            {
                data: 'olm_id',
                className: "text-center"
            },
            {
                data: 'workstation_id',
                className: "text-center"
            },
            {
                data: 'name',
                className: "text-center"
            },
            
            {
                data: 'department',
                className: "text-center"
            },
            {
                data: 'status',
                className: "text-center"
            },
           
            {
                data: 'action',
                className: "text-center",
            },

        ],
    });
</script>




<script>





$(document).on('click', '.btn-view', function () {
    let userId = $(this).data('id');

    $.ajax({
        url: `/view-exit-questions/${userId}`,
        method: "GET",
        success: function (data) {
            let html = '<ul class="list-group">';
            data.forEach(function (item) {
                html += `
                    <li class="list-group-item">
                        <strong>Question:</strong> ${item.question}<br>
                        <strong>Answer:</strong> ${item.answer}
                    </li>`;
            });
            html += '</ul>';

            // Insert the data into the modal and show it
            $('#questionsAnswers').html(html);
            $('#viewQuestionsModal').modal('show');
        },
        error: function (error) {
            alert('Unable to fetch data!');
        }
    });
});


</script>


<script>




    document.getElementsByClassName("tablink")[0].click();

        function openInfo(evt, link) {
        var i, x, tablinks;
        x = document.getElementsByClassName("info-link");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].classList.remove("w3-light-grey");
        }
        document.getElementById(link).style.display = "block";
        evt.currentTarget.classList.add("w3-light-grey");
        }





    $(document).on('submit', '#addEmployeeForm', function(e) {
            e.preventDefault(); 
                let formData = new FormData(this);

                for (var pair of formData.entries()) {
                console.log(pair[0]+ ':' + pair[1]); 
            }

            //debugger;

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.new.employee') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        toastr.success(response.message);
                     window.location.href= '{{ url('/employeein') }}';
                 
                    },
                     error: function(xhr, status, error) {

                                if(xhr.status === 422){
                            let errors = xhr.responseJSON.errors;
                            if(errors.work_email){
                                alert(errors.work_email[0]);
                            }
                        }
                        else{
                                    console.log('AJAX Error:', error);        
                                console.log('Status:', status); 
                                console.log('Response Text:', xhr.responseText); 
                                alert('An error occurred');

                        }

                        

                }
                            });
       
    });

     $(document).on('click', '#calculateCtcSplit', function(e) {
            e.preventDefault(); 
          let salaryGroupId = $("#salary_group_id").val();
          let employeeCtc =  $("#employee_ctc").val();

           if (salaryGroupId == null){
                alert('Select Salary group ');
              return false;
          }
         
        else if(employeeCtc == ''){
              alert('enter CTC Amount');
              return false;
          }
         

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('show.ctc.split') }}",
                    type: 'GET',
                    data: { salaryGroupId:salaryGroupId,
                               employeeCtc:employeeCtc
                    },
                 
                    success: function (response) {
                       
                    if(response.status == true){
                        let index = 0;
                    
                   let unitHtml = `   <div>
                               <h4>Earnings</h4>
                               </div>`;

                              response.earningComponent.forEach((el)=>{

                                          
                                     unitHtml +=        `    <div class="salary-row">
                                                    <div>${el.component_name}</div>
                                                       <input type="hidden" name="salary_details[${index}][component_name]" value="${el.component_name}">
                                                        <input type="hidden" name="salary_details[${index}][component_id]" value="${el.id}">
                                                      <input type="hidden" name="salary_details[${index}][component_type]" value="earning">`
                                                                
                                                                if(el.component_value_type == 3 || el.component_value_type == 4){
                                                                             
                                                          unitHtml +=  ` <div class="field-container">
                                                        <span> ${el.component_value_type_label} (${el.monthly_percentage}%) </span> 
                                                         <input type="hidden" name="salary_details[${index}][monthly_percentage]" value="${el.monthly_percentage}">
                                                         <input type="hidden" name="salary_details[${index}][component_value_type]" value="${el.component_value_type}">
                                                          <input type="hidden" name="salary_details[${index}][component_value_type_label]" value="${el.component_value_type_label}">
                                                         
                                                    </div>
                                                    <div class="field-container" >
                                                        <span>Rs ${ (employeeCtc / 1200) * el.monthly_percentage}</span>   
                                                           <input type="hidden" name="salary_details[${index}][monthly_amount]" value="${(employeeCtc / 1200) * el.monthly_percentage}">                
                                                    </div>
                                                    <div class="field-container">
                                                        <span>Rs ${ (employeeCtc / 100) * el.monthly_percentage}</span> 
                                                                <input type="hidden" name="salary_details[${index}][yearly_amount]" value="${(employeeCtc / 100) * el.monthly_percentage}">

                                                    </div>
                                                </div>`;

                                              }

                                              else if(el.component_value_type == 1 || el.component_value_type == 2){
                                                                             
                                                                      unitHtml +=  ` <div class="field-container">
                                                        <span> ${el.component_value_type_label}  </span> 
                                                        <input type="hidden" name="salary_details[${index}][component_value_type]" value="${el.component_value_type}">
                                                         <input type="hidden" name="salary_details[${index}][component_value_type_label]" value="${el.component_value_type_label}">
                                                         
                                                    </div>
                                                    <div class="field-container" >
                                                        <span>Rs ${el.monthly_amount}</span>   
                                                           <input type="hidden" name="salary_details[${index}][monthly_amount]" value="${el.monthly_amount}">                
                                                    </div>
                                                    <div class="field-container">
                                                        <span>Rs ${ el.monthly_amount * 12}</span> 
                                                                <input type="hidden" name="salary_details[${index}][yearly_amount]" value="${ el.monthly_amount * 12}">

                                                    </div>
                                                </div>`;

                                              }
                                                       
                                              
                                                  index++; 

                              });


                        unitHtml += `   <div>
                               <h4>Deductions</h4>
                               </div>`;

                                    response.deductionComponent.forEach((el)=>{

                                          
                                     unitHtml +=        `    <div class="salary-row">
                                                    <div>${el.component_name}</div>
                                                      <input type="hidden" name="salary_details[${index}][component_name]" value="${el.component_name}">
                                                        <input type="hidden" name="salary_details[${index}][component_id]" value="${el.id}">
                                                        <input type="hidden" name="salary_details[${index}][component_type]" value="deduction">`

                                                            if(el.component_value_type == 3 || el.component_value_type == 4){

                                                                  unitHtml +=  `  <div class="field-container">
                                                        <span>${el.monthly_percentage} % of CTC</span> 
                                                         <input type="hidden" name="salary_details[${index}][monthly_percentage]" value="${el.monthly_percentage}">
                                                         <input type="hidden" name="salary_details[${index}][component_value_type]" value="${el.component_value_type}">
                                                          <input type="hidden" name="salary_details[${index}][component_value_type_label]" value="${el.component_value_type_label}">
                                                    </div>
                                                    <div class="field-container" >
                                                        <span>Rs ${ (employeeCtc / 1200) * el.monthly_percentage}</span>   
                                                             <input type="hidden" name="salary_details[${index}][monthly_amount]" value="${(employeeCtc / 1200) * el.monthly_percentage}">              
                                                    </div>
                                                    <div class="field-container">
                                                        <span>Rs ${ (employeeCtc / 100) * el.monthly_percentage}</span> 
                                                     <input type="hidden" name="salary_details[${index}][yearly_amount]" value="${(employeeCtc / 1200) * el.monthly_percentage}">

                                                    </div>
                                                </div>`;

                                                            }

                                                                else if(el.component_value_type == 1 || el.component_value_type == 2){

                                                                 unitHtml +=  ` <div class="field-container">
                                                        <span> ${el.component_value_type_label}  </span> 
                                                        <input type="hidden" name="salary_details[${index}][component_value_type]" value="${el.component_value_type}">
                                                         <input type="hidden" name="salary_details[${index}][component_value_type_label]" value="${el.component_value_type_label}">
                                                    </div>
                                                    <div class="field-container" >
                                                        <span>Rs ${el.monthly_amount}</span>   
                                                           <input type="hidden" name="salary_details[${index}][monthly_amount]" value="${el.monthly_amount}">                
                                                    </div>
                                                    <div class="field-container">
                                                        <span>Rs ${ el.monthly_amount * 12}</span> 
                                                                <input type="hidden" name="salary_details[${index}][yearly_amount]" value="${ el.monthly_amount * 12}">

                                                    </div>
                                                </div>`;

                                                         }

                                                  index++; 

                              });


                              $('#salaryInfoContainer').html(unitHtml);

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




      $(document).on('change','#department_dropdown', function(e){
            e.preventDefault();
            departmentID = $(this).val();
    
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ url('form/get_designation') }}",
                    type: 'GET',
                    data: {department_id :departmentID },
                    success: function (response) {
                       
                    if(response.status == true){

                                         $('#designation').empty(); 
                                         $('#designation').removeAttr('required') ;
                      var unitHtml = document.createElement('option');
                          unitHtml.innerHTML ='--Select Designation-- ';
                          unitHtml.value='';
                              document.getElementById('designation').appendChild(unitHtml);

                           response.designation.forEach(el => {
                      const newOption = document.createElement('option');
                      newOption.value = el.id;                     
                      newOption.textContent = el.name;
                      document.getElementById('designation').appendChild(newOption);
                      });

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