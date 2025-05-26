@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.css" integrity="sha512-HLz+b0Pyj+6RnAjTwAajDUOJfhEIfdLy91cHSph3ydMYt3UN6kp7h+b2ofodXNflk4CNyZe9HP8YAj8hYBiNSA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

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
{!! Toastr::message() !!}


<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
           {{-- <li class="nav-item" role="presentation">
                <a href="{{ route('leave.index') }}">
                    <button class="nav-link Active" type="button">
                        Pending
                    </button>
                </a>
            </li>  --}}
            <li class="nav-item" role="presentation">
                <a href="{{ route('leave.history') }}">
                    <button class="nav-link Active" type="button">
                        History
                    </button>
                </a>
            </li>

        </ul>





        <!-- Add Edit Modal -->


        <div class="container-fluid mt-4" id='add_asset'>
                <div class="row pt-3">
                    <div class="col-md-6 pb-md-0">
                        <button type="button" @click="openModal" class="btn btn-sm btn-fill btn-primary"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 col-12 text-md-right pb-md-0 pb-3">
                    <div class="overlayy" v-if="showModal" @click="showModal = false"></div>
                </div>


                <!-- modal -->
                <div class="modall form-background" v-if="showModal">
                    <div class="d-flex" style="margin-bottom:2rem;">
                        <div class="col-12">
                            <button class="closee btn btn-sm btn-fill btn-primary" @click="showModal = false">x</button>
                        </div>
                    </div>

                    <div>

                    @if (Auth::user()->role_name == 'Admin')

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                    <label>For Employee</label>
                                    <input type="checkbox" name="for_employee" v-model="for_employee">
                            </div>

                            <div class="form-group col-md-7" v-if="for_employee">
                                <div class="row ">
                                    <div class="col-4 d-flex" style="justify-content:end;"> 
                                        <label >Search Employee</label>
                                    </div>
                                    <div class="col-8">
                                        <v-select label="name" :options="employees"
                                                        v-model="employee_object"
                                                        @@search="searchEmployees">
                                        </v-select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @endif

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Leave Type:</label>
                                <select class="form-control" id="leave_type" name="leave_type" v-model="leave_type">
                                    <option value="">Select Type</option>
                                    <option value="Comp Off">Comp Off</option>
                                    <option value="Loss Off Pay">Loss Off Pay</option>
                                    <option value="Annual Leave">Annual Leave</option>
                                    <option value="Work From Home">Work From Home</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                </select>
                                <span v-if="errors.leave_type" class="text-danger">@{{ errors.leave_type }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contact Number:</label>
                                <input type="phone" class="form-control" id="contact_no" name="contact_no" v-model.number="contact_no">
                                <span v-if="errors.contact_no" class="text-danger">@{{ errors.contact_no }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>From Date:</label>
                                <input type="datetime-local" class="form-control" id="from_date" name="from_date" v-model="from_date"  min="{{ date('Y-m-d\TH:i') }}" >
                                <!-- <input type="datetime-local" class="form-control" id="from_date" name="from_date" v-model="from_date"> -->
                                <span v-if="errors.contact_no" class="text-danger">@{{ errors.from_date }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>To Date:</label>
                                <input type="datetime-local" class="form-control" id="to_date" name="to_date" v-model="to_date"   min="{{ date('Y-m-d\TH:i')}}" >
                                <!-- <input type="datetime-local" class="form-control" id="to_date" name="to_date" v-model="to_date"> -->
                                <span v-if="errors.contact_no" class="text-danger">@{{ errors.to_date }}</span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Reporting Manager</label>
                                <v-select class="vselectfield" v-model="first_level_approver_id" :options="hrList" :reduce="hrList => hrList.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                            </div>
                            <!-- <div class="form-group col-md-4">
                                <label>(Direct Superior)Approver 2</label>
                                <v-select class="vselectfield" v-model="second_level_approver_id" :options="directSuperiorList" :reduce="directSuperiorList => directSuperiorList.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Either DGA or DG</label>
                                <v-select class="vselectfield" v-model="third_level_approver_id" :options="dgaList" :reduce="dgaList => dgaList.id" key="id" label="name" placeholder="Search...">
                                </v-select>
                            </div> -->
                            <div class="form-group col-md-12">
                                    <label for="reason"> Reason:</label>
                                    <textarea class="form-control" id="reason" rows="3" v-model="leave_reason" name="reason"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <span v-if="is_edit">
                                <button @click="updateLeaveData" type="submit" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;">Update</button>
                            </span>
                            <span v-if="!is_edit">
                                <button @click="saveLeaveData" type="submit" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;">Submit</button>
                            </span>
                        </div>   
                    </div>

                </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable leaveList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Leave Type</th>
                                    <th class="text-center">Leave Status</th>
                                    <th class="text-center">Actions</th>
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

           <!-- View Modal -->

           <div class="modal fade" id="travelRequestModal" tabindex="-1" aria-labelledby="travelRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="travelRequestModalLabel">Leave Request Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Details will be dynamically loaded here -->
                        <div id="travelRequestDetails">
                            Loading details...
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/axios@1.8.1/dist/axios.min.js"></script>


    <script>
        Vue.component("v-select", VueSelect.VueSelect);

        var app = new Vue({
            el: '#add_asset',
            components: {
                vuejsDatepicker
            },
            data: {
                showModal: false,
                errors: {},
                edited_data: "",
                is_edit: 0,  
                leave_type : null,
                contact_no : null,
                from_date : null,
                to_date : null,
                employee_object : null,
                employees: [],
                for_employee : false,
                hrList : @json($hr),
                // directSuperiorList : @json($direct_superior),
                // dgaList : @json($dga),
                first_level_approver_id : @json($employeeDetails),
                // second_level_approver_id : @json($employeeDetails->approver2),
                // third_level_approver_id : @json($employeeDetails->approver3),
                leave_reason : null,
                table: null
            },

            methods: {
                validateForm() {
                    this.errors = {}; // Clear errors
                    if (!this.leave_type) this.errors.leave_type = 'Please select leave type.';
                    if (!this.contact_no) this.errors.contact_no = 'Contact number is required.';
                    if (!this.from_date) this.errors.from_date = 'Select from date';
                    if (!this.to_date) this.errors.to_date = 'Select To date';
                    return Object.keys(this.errors).length == 0;
                },
                getCurrency() {
                    vm = this;
                    $.ajax({
                        type: "GET",
                        url: "{{ url('listcurrency')}}",
                        dataType: "JSON",
                        success: function(html) {
                            var objs = html.message;
                            vm.currency_list = objs;

                        }
                    });
                },
                openModal() {
                    vm = this;
                    vm.is_edit = 0;
                    vm.showModal = true;
                    vm.errors = {};
                    vm.edited_data = "";
                    vm.leave_type = null;
                    vm.contact_no = null;
                    vm.from_date = null;
                    vm.to_date = null;
                    vm.employee_object = null;
                    vm.employees = [];
                    vm.leave_reason = null;
                    vm.for_employee = false;
                },
                saveLeaveData() {
                    vm = this;
                
                    if(vm.for_employee){
                        if(vm.employee_object == null){
                            toastr.error('Please Select Employee', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,  // Duration the toast will be visible (in milliseconds)
                            extendedTimeOut: 1000  // Duration it will stay open after hover
                        });
                        }
                    }

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
                    formData.append('leave_type', vm.leave_type);
                    formData.append('contact_no', vm.contact_no);
                    formData.append('from_date', vm.from_date);
                    formData.append('to_date', vm.to_date);
                    formData.append('first_level_approver_id', vm.first_level_approver_id);
                    // formData.append('second_level_approver_id', vm.second_level_approver_id);
                    // formData.append('third_level_approver_id', vm.third_level_approver_id);
                    formData.append('leave_reason', vm.leave_reason);
                    formData.append('employee_object', JSON.stringify(vm.employee_object));
                    formData.append('for_employee', vm.for_employee);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('leave.store') }}",
                        data: formData,
                        contentType: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            
                            if (data.message == 'success') {
                                vm.table.ajax.reload();  // Reload the DataTable
                                vm.showModal = false;
                                toastr.success(data.msg, {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 3000,  // Duration the toast will be visible (in milliseconds)
                                    extendedTimeOut: 1000  // Duration it will stay open after hover
                                });
                            }
                            if (data.message == 'failed') {

                                return toastr.error(data.msg, {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 3000,  // Duration the toast will be visible (in milliseconds)
                                    extendedTimeOut: 1000  // Duration it will stay open after hover
                                });
                                vm.showModal = false;
                            
                            }
                        }
                    });

                }, 
                editTravelRequest(data) {
                    vm = this;
                    vm.showModal = true;
                    vm.errors = {};
                    vm.is_edit = 1;
                    vm.edited_data = data;
                    vm.travel_id = vm.edited_data.id;
                    vm.transportation = vm.edited_data.type;
                    vm.currency_id = vm.edited_data.currency_id;
                    vm.total_funding_proposed = vm.edited_data.funding;
                    vm.purpose = vm.edited_data.purpose;
                    vm.notes = vm.edited_data.notes;
                    vm.travel_from = vm.edited_data.travel_from;
                    vm.travel_to = vm.edited_data.travel_to;
                    vm.travel_date = vm.edited_data.travel_date;
                    vm.return_date = vm.edited_data.return_date;
                    vm.first_level_approver_id = vm.edited_data.approver1;
                    // vm.second_level_approver_id = vm.edited_data.approver2;
                    // vm.third_level_approver_id = vm.edited_data.approver3;
                    vm.for_employee = vm.edited_data.for_employee == 'false' ? false : true;

                },
                updateLeaveData() {
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
                    formData.append('transportation', vm.transportation);
                    formData.append('currency_id', vm.currency_id);
                    formData.append('total_funding_proposed', vm.total_funding_proposed);
                    formData.append('purpose', vm.purpose);
                    formData.append('notes', vm.notes);
                    formData.append('travel_from', vm.travel_from);
                    formData.append('travel_to', vm.travel_to);
                    formData.append('travel_date', vm.travel_date);
                    formData.append('return_date', vm.return_date);
                    formData.append('first_level_approver_id', vm.first_level_approver_id);
                    // formData.append('second_level_approver_id', vm.second_level_approver_id);
                    // formData.append('third_level_approver_id', vm.third_level_approver_id);
                    formData.append('travel_id', vm.travel_id);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('travel_records.update') }}",
                        data: formData,
                        contentType: 'multipart/form-data',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.message == 'success') {
                                vm.table.ajax.reload();  // Reload the DataTable
                                vm.showModal = false;
                            }
                            if (data.message == 'failed') {
                                vm.showModal = false;
                            }
                        }
                    });

                },
                searchEmployees(search, loading){
                if (search.length < 1) {
                    return ;
                }
                    vm=this;
                    axios.get(`{{ url('/getSearchEmployee') }}/${search}`).then(res => {
                    vm.employees = res.data.data;
                    });
                }, 

                isNumber: function(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                        evt.preventDefault();;
                    } else {
                        return true;
                    }
                },
            },
        
            mounted() {
                this.$nextTick(function() {
                    this.table = $('.leaveList').DataTable({
                        responsive: true,
                        processing: true,
                        serverSide: false,
                        searching: true,
                        ajax: {
                            url: "{{ route('leave.index.new') }}",
                        },
                        columns: [
                            {
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
                                data: 'leave_status',
                                className: "text-center"
                            },
                            {
                                data: 'action',
                                className: "text-center",
                            },
                        ],
                    });
                });
            },
            watch: {
                
            }
        })
    </script>

    <script>

        $(document).on('click', '.btn-view', function() {
                var leaveRequestId = $(this).data('id'); // Get the ID of the travel request

                // Make an AJAX request to fetch details
                $.ajax({
                    url: '/leave-request/details/' + leaveRequestId, // Define the endpoint
                    type: 'GET',
                    success: function(response) {

                        // Determine the status based on the conditions
                        let leaveStatus = '';
                        if (response.is_reject == 0) {
                            if (response.approver1 && response.approve1 == null) {
                                leaveStatus = 'Pending';
                            }else if (
                                response.approve1 == 1
                            ) {
                                leaveStatus = 'Approved';
                            }
                        } else {
                            leaveStatus = 'Rejected';
                        }
                        // Populate the modal with the response data
                        $('#travelRequestDetails').html(`
                        <div class="row">
                            <div class="col-5">
                            <p><strong>Employee Name:</strong> ${response.user.name}</p>
                            </div>
                            <div class="col-7 d-flex" style="justify-content:end;">
                                <p class="btn ${leaveStatus == 'Approved' ? 'btn-success' : 'btn-danger'}" style="display: inline-block;">Leave Status: ${leaveStatus}</p>
                            </div>
                        </div>
                        <p><strong>Leave Type:</strong> ${response.leave_type}</p>
                        <p style="background-color: ${response.approver1 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                            <strong>Reporting Manager:</strong>  ${response.approver1 == null ? 'Approver 1 not assigned' : response.approver1.name}

                        </p>
                        
                        <p><strong>Created At:</strong> ${response.created_at}</p>
                    `);
                    },
                    error: function() {
                        $('#travelRequestDetails').html('<p class="text-danger">Unable to fetch details.</p>');
                    }
                });
        });

    </script>

  

    


    @endsection