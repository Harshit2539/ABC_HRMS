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


    .custom-gradient-event {
    background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%) !important;
    border: none !important;
    color: white !important;
}

</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
    <div class="page-wrapper">

    <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
       <li class="nav-item" role="presentation">
           <a href="{{ route('employees.list') }}"> 
           <button class="nav-link Active" type="button">
              Active Users
           </button>
           </a> 
       </li>
       <li class="nav-item" role="presentation">
           <a href="{{ route('employees.list.inactive') }}"> 
           <button class="nav-link Active" type="button">
              Exit Users
           </button>
           </a> 
       </li>
    
   </ul>



    <div class="container-fluid mt-4" id='add_asset'>
         


            <div class="card-header d-flex" style="justify-content:space-between;">
                        <div class="card-title">
                            <h3 class="main-heading">Manage<span>Employees</span></h3>
                        </div>
                        <div class="card-toolbar" style="align-content:center;">
                        <button type="button" @click="openModal" class="btn btn-sm btn-fill btn-primary"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>




            <div class="col-xl-12 col-md-12 col-12 text-md-right pb-md-0 pb-3">
                <div class="overlayy" v-if="showModal" @click="showModal = false"></div>
            </div>


            <!-- modal -->
            <div class="modall form-background" v-if="showModal">
               
                <div class="d-flex" style="margin-bottom:2rem;">
                    <div class="col-11  d-flex" style="background-color:rgb(221 99 99 / 32%) !important ; justify-content:space-around; height:2rem; align-items:center; border-radius:20px">
                        <span class="text-white text-white" :style="{ fontWeight: activate_tab === 'first_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}"  @click="tabChange('first_tab')">Personal</span>
                        <!-- <span class="text-white" :style="{ fontWeight: activate_tab === 'seventh_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}"  @click="tabChange('seventh_tab')">Required Onboard Details</span> -->
                        <span class="text-white" :style="{ fontWeight: activate_tab === 'second_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}"  @click="tabChange('second_tab')">Identification</span>
                        <span class="text-white" :style="{ fontWeight: activate_tab === 'third_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}"  @click="tabChange('third_tab')">Work</span>
                        <span class="text-white" :style="{ fontWeight: activate_tab === 'fourth_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}" @click="tabChange('fourth_tab')">Contact</span>
                        <!-- <span class="text-white"  @click="tabChange('fifth_tab')">Report</span> -->
                        <span class="text-white" :style="{ fontWeight: activate_tab === 'sixth_tab' ? '1000' : '400',  cursor: 'pointer', color : 'darkred !important'}"  @click="tabChange('sixth_tab')">Role</span>
                    </div>
                    <div class="col-1">
                        <button class="closee btn btn-sm btn-fill btn-primary" @click="showModal = false">x</button>
                    </div>

                </div>


                <div v-if="activate_tab == 'first_tab'">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Employee ID</label>
                            <input name="employee_number" v-model="employee_number" type="text" id="employee_number" class=" form-control" required placeholder="Employee ID" />
                            <span v-if="errors.employee_number" class="text-danger">@{{ errors.employee_number }}</span>
                        </div>

                    
                        <div class="form-group col-md-3">
                            <label>Registration No.</label>
                            <input name="registration_no" v-model="registration_no" type="text" id="registration_no" class=" form-control" required placeholder="Registration No" />
                            <span v-if="errors.registration_no" class="text-danger">@{{ errors.registration_no }}</span>
                        </div>

                        <div class="form-group col-md-3">
                            <label>CNPS No.</label>
                            <input name="cnps_no" v-model="cnps_no" type="text" id="cnps_no" class=" form-control" required placeholder="CNPS No" />
                            <span v-if="errors.cnps_no" class="text-danger">@{{ errors.cnps_no }}</span>
                        </div>

                        <div class="form-group col-md-3">
                            <label>NIU</label>
                            <input name="niu" v-model="niu" type="text" id="niu" class=" form-control" required placeholder="NIU" />
                            <span v-if="errors.niu" class="text-danger">@{{ errors.niu }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>First Name</label>
                            <input name="first name"  v-model="first_name" type="text" id="name" class=" form-control" required placeholder="First Name"   @input="first_name = first_name.replace(/[^a-zA-Z\s]/g, '')" />
                            <span v-if="errors.first_name" class="text-danger">@{{ errors.first_name }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Middle Name</label>
                            <input name="middle_name"  v-model="middle_name" type="text" id="name" class=" form-control" required placeholder="Middle Name" @input="middle_name = middle_name.replace(/[^a-zA-Z\s]/g, '')" />
                            <span v-if="errors.middle_name" class="text-danger">@{{ errors.middle_name }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Last Name</label>
                            <input name="last_name"  v-model="last_name" type="text" id="name" class=" form-control" required placeholder="Last Name" @input="last_name = last_name.replace(/[^a-zA-Z\s]/g, '')" />
                            <span v-if="errors.last_name" class="text-danger">@{{ errors.last_name }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Nationality</label>
                            <v-select class="vselectfield" v-model="nationality_id" :options="nationality_list" :reduce="nationality_list => nationality_list.id" key="id" label="name" placeholder="Search...">
                            </v-select>
                            <span v-if="errors.nationality_id" class="text-danger">@{{ errors.nationality_id }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Date of Birth</label>
                            <input name="date of birth"  v-model="date_of_birth" type="date" id="name" class=" form-control" required placeholder="Date of Birth" />
                            <span v-if="errors.date_of_birth" class="text-danger">@{{ errors.date_of_birth }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Gender</label>
                            <v-select class="vselectfield" v-model="gender" :options="genders" :reduce="genders => genders.name" key="id" label="name" placeholder="Search ...">
                            </v-select>
                            <span v-if="errors.gender" class="text-danger">@{{ errors.gender }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Marital Address</label>
                            <v-select class="vselectfield" v-model="marital" :options="maritals" :reduce="maritals => maritals.name" key="id" label="name" placeholder="Search ...">
                            </v-select>
                            <span v-if="errors.marital" class="text-danger">@{{ errors.marital }}</span>
                        </div>

                        

                        <div class="form-group col-md-4">
                            <label>Reporting Manager</label>
                            <v-select class="vselectfield" v-model="reporting_manager" :options="reportingManager" :reduce="reportingManager => reportingManager.id" key="id" label="name" placeholder="Search...">
                            </v-select>
                        </div>

                            </div>

                            <div class="d-flex justify-content-end">
                            

                                <span>
                                    <button type="submit" @click="tabChange('second_tab')"  class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Next</button>
                                </span>

                            </div>   
                </div>



                <div v-if="activate_tab == 'second_tab'">
                    <div class="form-row">
                            <div class="form-group col-md-4">
                                <label> Immigration Status</label>
                                <v-select class="vselectfield" v-model="immigration_id" :options="immigration_list" :reduce="immigration_list => immigration_list.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                                <span v-if="errors.immigration_id" class="text-danger">@{{ errors.immigration_id }}</span>
                            </div>

                        
                            <div class="form-group col-md-4">
                                <label>SSN/NRIC</label>
                                <input name="SSN/NRIC" v-model="ssn_nric" type="text" id="ssn_nric" class=" form-control" required placeholder="SSN/NRIC" />
                                <span v-if="errors.ssn_nric" class="text-danger">@{{ errors.ssn_nric }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>NIC</label>
                                <input name="NIC" v-model="nic" type="text" id="nic" class=" form-control" required placeholder="NIC" />
                                <span v-if="errors.nic" class="text-danger">@{{ errors.nic }}</span>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>OTHER ID</label>
                                <input name="other_id" v-model="other_id" type="text" id="other_id" class=" form-control" required placeholder="Other Id" />            
                                <span v-if="errors.other_id" class="text-danger">@{{ errors.other_id }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Driving License No</label>
                                <input name="driving_license_no" v-model="driving_license_no" type="text" id="driving_license_no" class=" form-control" required placeholder="Driving License Number ..." />            
                                <span v-if="errors.driving_license_no" class="text-danger">@{{ errors.driving_license_no }}</span>
                            </div>
                    </div>
                    <div class="d-flex justify-content-between">
                            <span><button type="submit" @click="tabChange('first_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Back</button></span>
                            <span><button type="submit" @click="tabChange('third_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Next</button></span>
                    </div>
                </div>

                <div v-if="activate_tab == 'third_tab'">
                    <div class="form-row">
                            <div class="form-group col-md-4">
                                <label> Employment Status</label>
                                <v-select class="vselectfield" v-model="employment_id" :options="employment_list" :reduce="employment_list => employment_list.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                                <span v-if="errors.employment_id" class="text-danger">@{{ errors.employment_id }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Department</label>
                                <v-select class="vselectfield" v-model="department_id" :options="department_list" :reduce="department_list => department_list.id" key="id" label="department" placeholder="Search...">
                                </v-select>
                                <span v-if="errors.department_id" class="text-danger">@{{ errors.department_id }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Jo Title</label>
                                <v-select class="vselectfield" v-model="jobtitle_id" :options="jobtitle_list" :reduce="jobtitle_list => jobtitle_list.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                                <span v-if="errors.jobtitle_id" class="text-danger">@{{ errors.jobtitle_id }}</span>
                            </div>

                            

                            <div class="form-group col-md-4">
                                <label>Hired Date</label>
                                <input name="joined date"  v-model="joined_date" type="date" id="name" class=" form-control" required placeholder="Joined Date" />
                                <span v-if="errors.joined_date" class="text-danger">@{{ errors.joined_date }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Confirmation Date</label>
                                <input name="confirmation date"  v-model="confirmation_date" type="date" id="name" class=" form-control" required placeholder="Confirmation Date" />
                                <span v-if="errors.confirmation_date" class="text-danger">@{{ errors.confirmation_date }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label> Termination Date </label>
                                <input name="Termination Date"  v-model="termination_date" type="date" id="name" class=" form-control" required placeholder="Termination Date" />
                                <span v-if="errors.termination_date" class="text-danger">@{{ errors.termination_date }}</span>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Contract Type</label>
                                <input name="contract_type"  v-model="contract_type" type="text" id="name" class=" form-control" required placeholder="Contract Type" @input="contract_type = contract_type.replace(/[^a-zA-Z\s]/g, '')" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>Probation Period</label>
                                <input name="probation_period"  v-model="probation_period" type="number" id="name" class=" form-control" required placeholder="Probation Period In Months" />
                            </div>

                            <div class="form-group col-md-4">
                                <label>Salary on Contract</label>
                                <input name="salary_on_contract"  v-model="salary_on_contract" type="text" id="name" class=" form-control" required placeholder="Salary On Contract"  @input="salary_on_contract = salary_on_contract.replace(/[^0-9]/g, '')" />
                            </div>
                    </div> 

                    <div class="d-flex justify-content-between">
                            <span><button type="submit" @click="tabChange('second_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Back</button></span>
                            <span><button type="submit" @click="tabChange('fourth_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Next</button></span>
                    </div>
                </div>

                <div v-if="activate_tab == 'fourth_tab'">
                        
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Address Line 1</label>
                            <input name="Address Line 1" v-model="address_line_1" type="text" id="address_line_1" class=" form-control" required placeholder="Address line 1" />
                        
                        </div>

                        <div class="form-group col-md-4">
                            <label>Address Line 2</label>
                            <input name="Address Line 2" v-model="address_line_2" type="text" id="address_line_2" class=" form-control" required placeholder="Address line 2" />
                        </div>


                        <div class="form-group col-md-4">
                            <label>City</label>
                            <input name="City" v-model="city" type="text" id="city" class=" form-control" required placeholder="city" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Country</label>
                            <v-select class="vselectfield" v-model="country_id" :options="country_list" :reduce="country_list => country_list.id" key="id" label="name" placeholder="Search...">
                            </v-select>
                            <span v-if="errors.country_id" class="text-danger">@{{ errors.country_id }}</span>
                        </div>

                       

                        <div class="form-group col-md-4">
                            <label>Postal/Zip Code</label>
                            <input name="Postal/Zip_code" v-model="postal_zip_code" type="text" id="postal/zip_code" class=" form-control" required placeholder="Postal/Zip Code"  @input="postal_zip_code = postal_zip_code.replace(/[^0-9]/g, '')" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Home Phone</label>
                            <input name="home_phone" v-model="home_phone" type="text" id="home_phone" class=" form-control" required placeholder="Home Phone" @input="home_phone = home_phone.replace(/[^0-9]/g, '')" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Mobile Phone</label>
                            <input name="mobile_phone" v-model="mobile_phone" type="text" id="mobile_phone" class=" form-control" required placeholder="Mobile Phone" @input="mobile_phone = mobile_phone.replace(/[^0-9]/g, '')" />
                        </div>

                        <div class="form-group col-md-4">
                            <label>Work Phone</label>
                            <input name="work_phone" v-model="work_phone" type="text" id="work_phone" class=" form-control" required placeholder="Work Phone" @input="work_phone = work_phone.replace(/[^0-9]/g, '')" />
                            <span v-if="errors.work_phone" class="text-danger">@{{ errors.work_phone }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Work Email</label>
                            <input name="work_email" v-model="work_email" type="text" id="work_email" class=" form-control" required placeholder="Work Email" />
                            <span v-if="errors.work_email" class="text-danger">@{{ errors.work_email }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Private Email</label>
                            <input name="private_email" v-model="private_email" type="text" id="private_email" class=" form-control" required placeholder="Private Email" />
                        </div>

                    </div> 
                    <div class="d-flex justify-content-between">
                            <span><button type="submit" @click="tabChange('third_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Back</button></span>
                            <span><button type="submit" @click="tabChange('sixth_tab')" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Next</button></span>
                    </div>
                </div>

              
                <div v-if="activate_tab == 'sixth_tab'">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Role</label>
                            <v-select :disabled="is_edit === 1" class="vselectfield" v-model="role_id" :options="role_list" :reduce="role_list => role_list.id" key="id" label="name" placeholder="Search...">
                            </v-select>
                            <span v-if="errors.role_id" class="text-danger">@{{ errors.role_id }}</span>

                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                    </div>


                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                                <span><button type="submit" @click="tabChange('fourth_tab')" class="btn btn-sm btn-fill mt-4 " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;" id="next">Back</button></span>
                        </div>
                            <span v-if="is_edit">
                                <button type="submit" class="btn btn-sm btn-fill btn-primary mt-4 " @click = "updateEmployeeData" style="font-weight:600;" id="save">Update</button>
                            </span>
                            <span v-if="!is_edit">
                                <button type="submit" @click="saveEmployeeData" class="btn btn-sm btn-fill btn-primary mt-4" id="save" style="font-weight:600; ">Save</button>
                            </span>
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
                        <table class="table table-striped custom-table datatable EmployeeList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Employee ID</th>
                                    <th class="text-center">Registration ID</th>
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


    <!-- Exit Question Answer Modal -->

    <div id="exitQuestionsModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Exit Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="exitQuestionsForm">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id">
                            <div class="form-group">
                                <label>Have you submitted your laptop?</label>
                                <input type="text" name="questions[]" value="Have you submitted your laptop?" hidden>
                                <textarea class="form-control" name="answers[]" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Have you submitted the project KT?</label>
                                <input type="text" name="questions[]" value="Have you submitted the project KT?" hidden>
                                <textarea class="form-control" name="answers[]" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Have you taken any loan from the company?</label>
                                <input type="text" name="questions[]" value="Have you taken any loan from the company?" hidden>
                                <textarea class="form-control" name="answers[]" required></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="saveExitQuestions" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
    </div>

    <!-- View Question Anser Modal -->

    <div id="viewQuestionsModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Exit Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="questionsAnswers">
                        <!-- Questions and Answers will be dynamically inserted here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/vuejs-datepicker@1.6.2/dist/vuejs-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
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
            url: "{{ route('employees.list') }}",
        },
        columns: [
          
            {
                data: 'olm_id',
                className: "text-center"
            },
            {
                data: 'registration_no',
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
    Vue.component("v-select", VueSelect.VueSelect);

    var app = new Vue({
        el: '#add_asset',
        components: {
            vuejsDatepicker
        },
        data: {
            activate_tab : "",
            first_tab: 1,
            second_tab: 0,
            third_tab : 0,
            showModal: false,
            employee_number: null,
            workstation_id: null,
            registration_no : null,
            cnps_no : null,
            niu : null,
            first_name: null,
            middle_name: null,
            last_name :null,
            nationality_id : null,
            date_of_birth : null,
            joined_date:null,
            confirmtion_date : null,
            termination_date : null,
            contract_type : null,
            probation_period : null,
            salary_on_contract : null,
            gender:null,
            marital : null,
            ethnicity_id : null,
            immigration_id : null,
            ssn_nric : null,
            nic : null,
            other_id : null, 
            driving_license_no : null,
            address_line_1 : null,
            address_line_2 : null,
            city : null,
            country_id : null,
            postal_zip_code : null,
            home_phone : null,
            mobile_phone : null,
            work_email : null,
            work_phone : null,
            private_email : null,
            genders : [{"name":"Male","id":1},{"name":"Female","id":2},{"name":"Non-binary","id":3},{"name":"Other","id":4},{"name":"Prefer not to say","id":5},],
            maritals : [{"name":"Married","id":1},{"name":"Single","id":2},{"name":"Divorced","id":3},{"name":"Widowed","id":4},{"name":"Other","id":5},],
            employment_id : null,
            department_id : null,
            jobtitle_id : null,
            group_id : null,
            reporting_manager : null,
            basic_salary : 0,
            role_id : null,
            errors: {},
            edited_data: "",
            is_edit: 0,  
            nationality_list: [],
            immigration_list : [],
            employment_list : [],
            department_list : [],
            jobtitle_list : [],
            country_list : [],
            reportingManager : [],
            role_list : [],
            employee_id : "",
        },

        methods: {
            tabChange(data) {
                vm = this;
                vm.activate_tab = data;
            },
            validateForm() {
                this.errors = {}; // Clear errors
                if (!this.employee_number) this.errors.employee_number = 'OLM ID is required.';
                // if (!this.workstation_id) this.errors.workstation_id = 'Workstation ID is required.';
                if (!this.registration_no) this.errors.registration_no = 'Registration number is required.';
                if (!this.cnps_no) this.errors.cnps_no = 'CNPS number is required.';
                if (!this.niu) this.errors.niu = 'NIU is required.';
                if (!this.first_name) this.errors.first_name = 'First Name is required.';
                if (!this.last_name) this.errors.last_name = 'Last Name is required.';
                if (!this.nationality_id) this.errors.nationality_id = 'Please Select Nationality';
                if (!this.date_of_birth) this.errors.date_of_birth = 'Choose Date of birth.';
                if (!this.gender) this.errors.gender = 'Please Select Gender';
                if (!this.marital) this.errors.marital = 'Please Select Marital';
                if (!this.immigration_id) this.errors.immigration_id = 'Please Select Immigration';                
                if (!this.employment_id) this.errors.employment_id = 'Please Select Employment Status';
                if (!this.department_id) this.errors.department_id = 'Please Select Department';
                if (!this.jobtitle_id) this.errors.jobtitle_id = 'Please Select Job Title';
                if (!this.joined_date) this.errors.joined_date = 'Fill Joined Date';
                if (!this.confirmation_date) this.errors.confirmation_date = 'Fill Confirmation Date ';
                if (!this.country_id) this.errors.country_id = 'Please Select Country';
                if (!this.work_phone) this.errors.work_phone = 'Working Mobile Must Be Fill';
                if (!this.work_email) this.errors.work_email = 'Working Email Must Be Fill';
                if (!this.role_id) this.errors.role_id = 'Select Role Of Employee';

                return Object.keys(this.errors).length == 0;
            },
            openModal() {
                vm = this;
                vm.is_edit = 0;
                vm.showModal = true;
                vm.errors = {};
                vm.first_tab = 1;
                vm.second_tab = 0;
                vm.activate_tab = "first_tab";

                //first tab 
                vm.employee_number = null;
                vm.workstation_id = null;
                vm.first_name = null;
                vm.middle_name = null;
                vm.last_name = null;
                vm.nationality_id = null;
                vm.date_of_birth = null;
                vm.gender = null;
                vm.marital = null;
                vm.ethnicity_id = null;
                vm.reporting_manager = null;
               
                 
               
                //Second Tab
                vm.immigration_id = null;
                vm.ssn_nric = null;
                vm.nic = null;
                vm.other_id = null;
                vm.driving_license_no = null;

                //Third Tab 
                vm.employment_id = null;
                vm.department_id = null;
                vm.jobtitle_id = null;
                vm.group_id = null;
                vm.joined_date =null;
                vm.confirmation_date = null;
                vm.termination_date = null;
                vm.contract_type = null;
                vm.probation_period = null;
                vm.salary_on_contract = null;

                //Fourth Tab
                vm.address_line_1 = null;
                vm.address_line_2 = null;
                vm.city = null;
                vm.country_id = null;
                vm.postal_zip_code = null;
                vm.home_phone = null;
                vm.mobile_phone = null;
                vm.work_phone = null;
                vm.work_email = null;
                vm.private_email = null;

                //Fifth Tab
                vm.role_id = null;
               
            },
            getNationality() {
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listnationality')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.nationality_list = objs;

                    }
                });
            },
           
            getImmigration(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listimmigration')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.immigration_list = objs;

                    }
                });
            },
            getEmployment(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listemployment')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.employment_list = objs;
                    }
                });
            },
            getDepartment(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listdepartment')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.department_list = objs;
                    }
                });
            },
            getJobtitle(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listjobtitle')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.jobtitle_list = objs;

                    }
                });
            },
          
            getCountry(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listcountry')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.country_list = objs;

                    }
                });
            },
            getEmployee(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listemployees')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.reportingManager = objs.hr;
                       


                    }
                });
            },
            getRole(){
                vm = this;
                $.ajax({
                    type: "GET",
                    url: "{{ url('listroles')}}",
                    dataType: "JSON",
                    success: function(html) {
                        var objs = html.message;
                        vm.role_list = objs;

                    }
                });
            },
        
          
          
            saveEmployeeData() {
                vm = this;
               

                if (!this.validateForm()) {
                    // Show Toastr notification if validation fails
                    toastr.error('Oops, please fill all the details.', {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Duration the toast will be visible (in milliseconds)
                        extendedTimeOut: 1000  // Duration it will stay open after hover
                    });
                    return;
                }
                var formData = new FormData();
                formData.append('employee_number', vm.employee_number);
                formData.append('workstation_id', vm.workstation_id);
                formData.append('registration_no', vm.registration_no);
                formData.append('cnps_no', vm.cnps_no);
                formData.append('niu', vm.niu);
                formData.append('first_name', vm.first_name);
                formData.append('middle_name', vm.middle_name);
                formData.append('last_name', vm.last_name);
                formData.append('nationality_id', vm.nationality_id);
                formData.append('date_of_birth', vm.date_of_birth);
                formData.append('joined_date', vm.joined_date);
                formData.append('confirmation_date', vm.confirmation_date);
                formData.append('termination_date', vm.termination_date);
                formData.append('contract_type', vm.contract_type);
                formData.append('probation_period', vm.probation_period);
                formData.append('salary_on_contract', vm.salary_on_contract);
                formData.append('gender', vm.gender);
                formData.append('marital', vm.marital);                
                formData.append('ethnicity_id', vm.ethnicity_id);
                formData.append('immigration_id', vm.immigration_id);
                formData.append('ssn_nric', vm.ssn_nric);
                formData.append('nic', vm.nic);
                formData.append('other_id', vm.other_id);
                formData.append('driving_license_no', vm.driving_license_no);
                formData.append('address_line_1', vm.address_line_1);
                formData.append('address_line_2', vm.address_line_2);
                formData.append('city', vm.city);
                formData.append('country_id', vm.country_id);
                formData.append('postal_zip_code', vm.postal_zip_code);
                formData.append('home_phone', vm.home_phone);
                formData.append('mobile_phone', vm.mobile_phone);
                formData.append('work_email', vm.work_email);
                formData.append('work_phone', vm.work_phone);
                formData.append('private_email', vm.private_email);
                formData.append('employment_id', vm.employment_id);
                formData.append('department_id', vm.department_id);
                formData.append('jobtitle_id', vm.jobtitle_id);
                formData.append('group_id', vm.group_id);
                formData.append('reporting_manager', vm.reporting_manager);
                formData.append('role_id', vm.role_id);

             
                $.ajax({
                    type: "POST",
                    url: "{{ url('form/saveemployee')}}",
                    data: formData,
                    contentType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.message == 'success') {
                            $("#messagesuccess").css({
                                'display': "block"
                            });
                            vm.showModal = false;
                            window.setTimeout(function() {
                                location.reload()
                            }, 1000);
                        }
                        if (data.message == 'failed') {
                            $("#messagefailed").css({
                                'display': "block"
                            });
                            vm.showModal = false;
                            window.setTimeout(function() {
                                location.reload()
                            }, 1000);
                        }
                    }
                });

            },
            editAsset(data) {
                vm = this;
                vm.showModal = true;
                vm.activate_tab =  'first_tab';
                vm.errors = {};
                vm.is_edit = 1;
                vm.edited_data = data;
                vm.employee_id = vm.edited_data.id;

                 //first tab 
                vm.employee_number = vm.edited_data.olm_id;
                vm.workstation_id = vm.edited_data.workstation_id;
                vm.registration_no = vm.edited_data.registration_no;
                vm.cnps_no = vm.edited_data.cnps_no;
                vm.niu = vm.edited_data.niu;
                vm.first_name = vm.edited_data.first_name;
                vm.middle_name = vm.edited_data.middle_name == 'null' ? null :  vm.edited_data.middle_name ;
                vm.last_name = vm.edited_data.last_name;
                vm.nationality_id = vm.edited_data.nationality;
                vm.date_of_birth = vm.edited_data.birthday;
                vm.gender = vm.edited_data.gender;
                vm.marital = vm.edited_data.marital_status;
                vm.ethnicity_id = vm.edited_data.ethnicity;

                vm.reporting_manager = vm.edited_data.approver1 == 'null' ? null :  vm.edited_data.approver1 ;


                // Seventh Tab
                // vm.vendor_name =vm.edited_data.vendor_name;
                // vm.partner_type = vm.edited_data.partner_type;
                // vm.registered_corporate_address = vm.edited_data.registered_corporate_address;
                // vm.current_location =vm.edited_data.current_location;
                // vm.airtel_partner_code =vm.edited_data.airtel_partner_code;
                // vm.circle_id = vm.edited_data.circle_id;
                // vm.function_id =vm.edited_data.function_id;
                // vm.name_of_airtel_employee =vm.edited_data.name_of_airtel_employee;
                // vm.airtel_employee_id =vm.edited_data.airtel_employee_id;
                // vm.airtel_employee_email_id = vm.edited_data.airtel_employee_email_id;
                // vm.airtel_employee_mobile_number = vm.edited_data.airtel_employee_mobile_number == 'null' ? null : vm.edited_data.airtel_employee_mobile_number;
                // vm.airtel_employee_circle = vm.edited_data.airtel_employee_circle;

                //Second Tab
                vm.immigration_id = vm.edited_data.immigration_status;
                vm.ssn_nric = vm.edited_data.ssn_num == 'null' ? null : vm.edited_data.ssn_num;
                vm.nic = vm.edited_data.nic_num == 'null' ? null : vm.edited_data.nic_num;
                vm.other_id = vm.edited_data.other_id == 'null' ? null : vm.edited_data.other_id;
                vm.driving_license_no = vm.edited_data.driving_license == 'null' ? null : vm.edited_data.driving_license;;

                //Third Tab 
                vm.employment_id = vm.edited_data.employment_status;
                vm.department_id = vm.edited_data.department;
                vm.jobtitle_id = vm.edited_data.job_title;
                vm.group_id = vm.edited_data.pay_grade;
                vm.joined_date = vm.edited_data.joined_date;
                vm.confirmation_date = vm.edited_data.confirmation_date;
                vm.termination_date = vm.edited_data.termination_date != 'null' ? vm.edited_data.termination_date : null;
                vm.contract_type = vm.edited_data.contract_type != 'null' ? vm.edited_data.contract_type : null ;
                vm.probation_period = vm.edited_data.probation_period != 'null' ? vm.edited_data.probation_period : null;
                vm.salary_on_contract = vm.edited_data.salary_on_contract != 'null' ?  vm.edited_data.salary_on_contract : null;

                //Fourth Tab
                vm.address_line_1 = vm.edited_data.address1 != 'null'  ? vm.edited_data.address1 :  null;
                vm.address_line_2 = vm.edited_data.address2 != 'null' ? vm.edited_data.address2 : null;
                vm.city = vm.edited_data.city != 'null' ? vm.edited_data.city : null;
                vm.country_id = vm.edited_data.country;
                vm.postal_zip_code = vm.edited_data.postal_code != 'null' ? vm.edited_data.postal_code : "";
                vm.home_phone = vm.edited_data.home_phone != 'null' ? vm.edited_data.home_phone : null;
                vm.mobile_phone = vm.edited_data.mobile_phone != 'null' ? vm.edited_data.mobile_phone : null;
                vm.work_phone = vm.edited_data.work_phone;
                vm.work_email = vm.edited_data.work_email != 'null' ? vm.edited_data.work_email : null;
                vm.private_email = vm.edited_data.private_email != 'null' ? vm.edited_data.private_email : null;

                //Fifth Tab
                vm.role_id = vm.edited_data.role_id;
            },
            updateEmployeeData() {
                vm = this;
                if (!this.validateForm()) return;

                var formData = new FormData();
                formData.append('employee_number', vm.employee_number);
                formData.append('workstation_id', vm.workstation_id);
                formData.append('registration_no', vm.registration_no);
                formData.append('cnps_no', vm.cnps_no);
                formData.append('niu', vm.niu);
                formData.append('first_name', vm.first_name);
                formData.append('middle_name', vm.middle_name);
                formData.append('last_name', vm.last_name);
                formData.append('nationality_id', vm.nationality_id);
                formData.append('date_of_birth', vm.date_of_birth);
                formData.append('joined_date', vm.joined_date);
                formData.append('confirmation_date', vm.confirmation_date);
                formData.append('termination_date', vm.termination_date);
                formData.append('contract_type', vm.contract_type);
                formData.append('probation_period', vm.probation_period);
                formData.append('salary_on_contract', vm.salary_on_contract);
                formData.append('gender', vm.gender);
                formData.append('marital', vm.marital);                
                formData.append('ethnicity_id', vm.ethnicity_id);
                formData.append('immigration_id', vm.immigration_id);
                formData.append('ssn_nric', vm.ssn_nric);
                formData.append('nic', vm.nic);
                formData.append('other_id', vm.other_id);
                formData.append('driving_license_no', vm.driving_license_no);
                formData.append('address_line_1', vm.address_line_1);
                formData.append('address_line_2', vm.address_line_2);
                formData.append('city', vm.city);
                formData.append('country_id', vm.country_id);
                formData.append('postal_zip_code', vm.postal_zip_code);
                formData.append('home_phone', vm.home_phone);
                formData.append('mobile_phone', vm.mobile_phone);
                formData.append('work_email', vm.work_email);
                formData.append('work_phone', vm.work_phone);
                formData.append('private_email', vm.private_email);
                formData.append('employment_id', vm.employment_id);
                formData.append('department_id', vm.department_id);
                formData.append('jobtitle_id', vm.jobtitle_id);
                formData.append('group_id', vm.group_id);
                formData.append('reporting_manager', vm.reporting_manager);

                formData.append('role_id', vm.role_id);

                //onboard Details start
                // formData.append('vendor_name', vm.vendor_name);
                // formData.append('partner_type', vm.partner_type);
                // formData.append('registered_corporate_address', vm.registered_corporate_address);
                // formData.append('current_location', vm.current_location);
                // formData.append('airtel_partner_code', vm.airtel_partner_code);
                // formData.append('circle_id', vm.circle_id);
                // formData.append('function_id', vm.function_id);
                // formData.append('name_of_airtel_employee', vm.name_of_airtel_employee);
                // formData.append('airtel_employee_id', vm.airtel_employee_id);
                formData.append('airtel_employee_email_id', vm.airtel_employee_email_id);
                // formData.append('airtel_employee_mobile_number', vm.airtel_employee_mobile_number);
                // formData.append('airtel_employee_circle', vm.airtel_employee_circle);
                formData.append('employee_id', vm.employee_id);

                //onboard Details start

                $.ajax({
                    type: "POST",
                    url: "{{ url('form/updateemployee')}}",
                    data: formData,
                    contentType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.message == 'success') {
                            $("#messagesuccess").css({
                                'display': "block"
                            });
                            vm.showModal = false;
                            window.setTimeout(function() {
                                location.reload()
                            }, 2000);
                        }
                    }
                });

            },
        },
     
        mounted() {
            this.getNationality();
            this.getDepartment();
            this.getJobtitle();
            this.getImmigration();
            this.getEmployment();
            this.getCountry();
            this.getEmployee();
            this.getRole();
        },
        watch: {
          
        }
    })
</script>

<script>

$(document).on('click', '.btn-remove', function () {
    let userId = $(this).data('id');
    $('#user_id').val(userId); // Set the user ID in the hidden input field
    $('#exitQuestionsModal').modal('show'); // Show the modal
});


// Save Exit Questions
$('#saveExitQuestions').on('click', function () {
    let formData = $('#exitQuestionsForm').serialize();

    $.ajax({
        url: "{{ route('employees.saveExitQuestions') }}",
        method: "POST",
        data: formData,
        success: function (response) {
            alert(response.success); // Notify the user
            $('#exitQuestionsModal').modal('hide'); // Hide the modal
            location.reload(); // Reload the page or update the DataTable
        },
        error: function (error) {
            alert('Something went wrong!');
        }
    });
});


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


@endsection