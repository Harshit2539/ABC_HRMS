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

    

</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
    <div class="page-wrapper">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="{{ route('travel_records.list') }}"> 
            <button class="nav-link active" type="button">
                Travel Requests
            </button>
            </a> 
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('subordinate_travel_requests.list') }}"> 
            <button class="nav-link" type="button">
                Subordinate Travel Requests
            </button>
            </a> 
        </li>
    </ul>

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
                                                   @@search="searchEmployees"
                                                   @input="onEmployeeSelect">
                                </v-select>
                            </div>
                            </div>
                            
                               
                        </div>
                    </div>
                    
                @endif


                    <div class="form-row" style="font-size:smaller">
                        <div class="form-group col-md-4">
                            <label>Means Of Transportation</label>
                            <v-select class="vselectfield" v-model="transportation" :options="transportations" :reduce="transportations => transportations.name" key="id" label="name" placeholder="Search ...">
                            </v-select>
                            <span v-if="errors.transportation" class="text-danger">@{{ errors.transportation }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Currency</label>
                            <v-select class="vselectfield" v-model="currency_id" :options="currency_list" :reduce="currency_list => currency_list.id" key="id" label="code" placeholder="Search...">
                            </v-select>
                            <span v-if="errors.currency_id" class="text-danger">@{{ errors.currency_id }}</span>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Total Funding Proposed</label>
                            <input style="height:2rem;" name="total funding proposed" @keypress="isNumber($event)"  v-model.number="total_funding_proposed" type="text" id="name" class=" form-control" required placeholder="Total Funding Proposed" />
                            <span v-if="errors.total_funding_proposed" class="text-danger">@{{ errors.total_funding_proposed }}</span>
                        </div>

                        <div class="form-group col-md-12" >
                            <table class="table table-bordered" id="travel_allowance_table" style="font-size:smaller">
                                <thead>
                                    <tr>
                                    <th>Allowance Type</th>
                                    <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(c, k) in travel_allowance" :key="k">
                                    <td>@{{ c.travel_allowance.name }}</td>
                                    <td>@{{ c.amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                       
                        <div class="form-group col-md-6">
                            <label>Travel Date</label>
                            <input type="date" class="form-control" v-model="travel_date" id="travel_date" name="travel_date" min="{{ date('Y-m-d')}}" >
                            <!-- <input type="date" class="form-control" v-model="travel_date" id="travel_date" name="travel_date"> -->
                            <span v-if="errors.travel_date" class="text-danger">@{{ errors.travel_date }}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Return Date</label>
                            <input type="date" class="form-control" v-model="return_date" id="return_date" name="return_date" min="{{ date('Y-m-d')}}" @input=checkDays>
                            <span v-if="errors.return_date" class="text-danger">@{{ errors.return_date }}</span>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Travel From</label>
                            <input name="travel from"  v-model="travel_from" type="text" id="name" class=" form-control" required placeholder="Travel From" />
                            <span v-if="errors.travel_from" class="text-danger">@{{ errors.travel_from }}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Travel To</label>
                            <input name="travel to"  v-model="travel_to" type="text" id="name" class=" form-control" required placeholder="Travel To" />
                            <span v-if="errors.travel_to" class="text-danger">@{{ errors.travel_to }}</span>
                        </div>

                      


                        <div class="form-group col-md-6">
                            <label>Purpose Of Travel</label>
                            <textarea class="form-control" v-model="purpose" id="purpose" rows="3" name="purpose"></textarea>
                            <span v-if="errors.purpose" class="text-danger">@{{ errors.purpose }}</span>

                        </div>

                        <div class="form-group col-md-6">
                            <label>Notes</label>
                            <textarea class="form-control" v-model="notes" id="notes" rows="3" name="notes"></textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label>(HR) Approver 1</label>
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

                      
                    </div>

                            <div class="d-flex justify-content-center">
                            
                                <span v-if="is_edit">
                                    <button @click="updateTravelData" type="submit" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;">Update</button>
                                </span>
                                <span v-if="!is_edit">
                                    <button @click="saveTravelData" type="submit" class="btn " style="font-weight:600; background-color:rgba(221, 99, 99, 0.32) !important; color : darkred !important;">Submit</button>
                                </span>

                            </div>   
                </div>

            </div>
    </div>


        <!-- Table Content -->
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped custom-table datatable TravelRequestList" style="font-size:small !important;">
                                <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <!-- <th class="text-center">Sr No</th> -->
                                        <th class="text-center">Travel Type</th>
                                        <th class="text-center">Purpose</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Travel Date</th>
                                        <th class="text-center">Return Date</th>
                                        <th class="text-center">Request Status</th>
                                        <th class="text-center">Approver Status</th>
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
        </div>


        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Travel Request?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>



          <!-- View Modal -->

          <div class="modal fade" id="travelRequestModal" tabindex="-1" aria-labelledby="travelRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="travelRequestModalLabel">Travel Request Details</h5>
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

<!-- Script Code -->

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
            showModal: false,
            errors: {},
            edited_data: "",
            is_edit: 0,  
            transportations : [{"name":"Plane","id":1},{"name":"Train","id":2},{"name":"Taxi","id":3},{"name":"Own Vehicle","id":4},{"name":"Rented Vehicle","id":5}, {"name":"Other", "id":6},],
            transportation: null,
            currency_id : null,
            total_funding_proposed : null,
            purpose : null,
            notes : null,
            travel_from : null,
            travel_to : null,
            travel_date : null,
            return_date : null,
            currency_list : [],
            hrList : @json($hr),
            directSuperiorList : @json($direct_superior),
            dgaList : @json($dga),
            first_level_approver_id : @json($employeeDetails->approver1),
            // second_level_approver_id : @json($employeeDetails->approver2),
            // third_level_approver_id : @json($employeeDetails->approver3),
            travel_id : "",
            travel_allowance : @json($travel_allowance),
            employee_object : null,
            employees: [],
            for_employee : false,
            totalamount: 0,

        },

        methods: {
            validateForm() {
                this.errors = {}; // Clear errors
                if (!this.transportation) this.errors.transportation = 'Please select transportation mode.';
                if (!this.total_funding_proposed) this.errors.total_funding_proposed = 'Amount is required.';
                if (!this.purpose) this.errors.purpose = 'Required travel purpose field';
                if (!this.travel_from) this.errors.travel_from = 'Required travel from field.';
                if (!this.travel_to) this.errors.travel_to = 'Required travel to field.';
                if (!this.travel_date) this.errors.travel_date = 'Required travel date.';
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
                vm.travel_id = null;
                vm.transportation = null;
                vm.currency_id = null;
                vm.purpose = null;
                vm.notes = vm.edited_data.notes;
                vm.travel_from = null;
                vm.travel_to = null;
                vm.travel_date = null;
                vm.return_date = null;
                this.calculateTotalAmount();

            },
            saveTravelData() {
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
                formData.append('employee_object', JSON.stringify(vm.employee_object));
                formData.append('for_employee', vm.for_employee);
                $.ajax({
                    type: "POST",
                    url: "{{ route('travel_records.store') }}",
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
                 
                if(vm.for_employee){
                    axios.get(`{{ url('/getEmployee') }}/${vm.edited_data.employee_id}`).then(res => {
                    console.log(res);
                    vm.employee_object = res.data.data;
                    });
                }
            },
            updateTravelData() {
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
        
            onEmployeeSelect(data){
                vm=this;
                axios.get(`{{ url('/getEmployeeTravelAllowance') }}/${data.id}`).then(res => {

                    vm.travel_allowance = res.data.data;
                    vm.total_funding_proposed = res.data.data.reduce((sum, item) => {
                    return sum + (Number(item.amount) || 0);
                }, 0);
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

            calculateTotalAmount() {
                this.total_funding_proposed = this.travel_allowance.reduce((sum, item) => {
                    return sum + (Number(item.amount) || 0);
                }, 0);
            },

            checkDays(){
                this.calculateTotalAmount();
                const date1 = new Date(vm.travel_date);
                const date2 = new Date(vm.return_date);

                // Calculate the difference in milliseconds
                const diffInMs = date2 - date1;

                // Convert milliseconds to days
                const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                vm.total_funding_proposed  *= diffInDays;

            }
        },
     
        mounted() {

            this.getCurrency();

            this.$nextTick(function() {
                vm.table = $('.TravelRequestList').DataTable({
                responsive: true,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: {
                    url: "{{ route('travel_records.list') }}",
                },
                columns: [
                    // {
                    //     data: null,
                    //     className: "text-center",
                    //     render: function (data, type, row, meta) {
                    //         return meta.row + 1;
                    //     }
                    // },
                    {
                        data: 'type',
                        className: "text-center"
                    },
                    {
                        data: 'purpose',
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
                        data: 'travel_date',
                        className: "text-center"
                    },
                    {
                        data: 'return_date',
                        className: "text-center"
                    },
                    {
                        data: 'request_status',
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
            });
        },
        watch: {
           
        },
       
    })
</script>


<script>
   


    $(document).on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        $('#confirmDelete').data('id', id);
        $('#deleteModal').modal('show');
    });

    $(document).on('click', '#confirmDelete', function () {
        var id = $(this).data('id');

        $.ajax({
            url: `/travel_records_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Travel Request. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });


    $(document).on('click', '.btn-view', function() {
        
            var travelRequestId = $(this).data('id'); // Get the ID of the travel request
         
            // Make an AJAX request to fetch details
            $.ajax({
                url: '/travel-request/details/' + travelRequestId, // Define the endpoint
                type: 'GET',
                success: function(response) {

                    // Determine the status based on the conditions
                    let leaveStatus = '';
                    if (response.is_reject == 0) {
                        if (response.approver1 && response.approve1 == null) {
                            leaveStatus = 'Pending';
                        }  else if (
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
                        <div class="col-6">
                        <p><strong>Employee Name:</strong> ${response.employee.name}</p>
                        </div>
                        <div class="col-6 d-flex" style="justify-content:end;">
                            <p class="btn ${leaveStatus == 'Approved' ? 'btn-success' : 'btn-danger'}" style="display: inline-block;">Leave Status: ${leaveStatus}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                        <p><strong>Means of transportation:</strong> ${response.type}</p>
                        </div>
                          <div class="col-6">
                        <p><strong>${response.travel_from}</strong>&nbsp;------------> &nbsp;<strong>${response.travel_to}</strong></p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                        <p><strong>Travel Date:</strong> ${response.travel_date}</p>
                        </div>
                          <div class="col-6">
                        <p><strong>Return Date:</strong> ${response.return_date}</p>
                        </div>
                    </div>

                    <p style="background-color: ${response.approver1 == null ? 'red' : 'green'}; color: white; padding: 5px;">
                        <strong>Approver 1:</strong>  ${response.approver1 == null ? 'Approver 1 not assigned' : response.approver1.name}
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