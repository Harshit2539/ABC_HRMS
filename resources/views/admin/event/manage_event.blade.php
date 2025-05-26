@extends('layouts.master')
 
 
 
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.css"
        integrity="sha512-HLz+b0Pyj+6RnAjTwAajDUOJfhEIfdLy91cHSph3ydMYt3UN6kp7h+b2ofodXNflk4CNyZe9HP8YAj8hYBiNSA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
 
 
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
 
 
    <style>
        .home-list {
            list-style: none;
            width: 100%;
            background: #ecf5ff;
            padding: 20px;
            border-radius: 8px;
        }
 
        .home-list li {
            margin-bottom: 15px;
        }
 
        .event-card {
            background-color: white;
            border-radius: 8px;
            padding: 12px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.2s ease;
        }
 
        .event-card:hover {
            transform: scale(1.02);
        }
 
        .event-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 16px;
        }
 
        .event-dates {
            font-size: 14px;
            color: #333;
        }
 
        .home-list li:nth-child(odd) .event-card {
            border-left: 6px solid #1488F3;
        }
 
        .home-list li:nth-child(even) .event-card {
            border-right: 6px solid #1488F3;
        }
    </style>
 
    <div class="page-wrapper">
 
 
        <div class="content container-fluid" id="manage_event">
 
 
            <div id='add_asset'>
 
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h3 class="main-heading">Manage <span>Events</span></h3>
                    </div>
                    <button type="button" @click="openModal" class="btn btn-sm btn-fill btn-primary">
                        <i class="fa fa-plus"></i> Add New
                    </button>
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
                        <div class="form-row">
 
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <v-select class="vselectfield" v-model="department_id" :options="departmentList"
                                    :reduce="departmentList => departmentList.id" key="id" label="department"
                                    placeholder="Search..." @@input="filterEmployees">
                                </v-select>
                                <span v-if="errors.department_id" class="text-danger">@{{ errors.department_id }}</span>
 
                            </div>
 
                            <div class="form-group col-md-6">
                                <label>Employee Name</label>
                                <v-select multiple class="vselectfield" v-model="employee_id" :options="employeeList"
                                    :reduce="employeeList => employeeList.employee_id" key="employee_id" label="first_name"
                                    placeholder="Search...">
                                </v-select>
                                <span v-if="errors.employee_id" class="text-danger">@{{ errors.employee_id }}</span>
                            </div>
 
 
                            <div class="form-group col-md-6">
                                <label>From Date:</label>
                                <input type="datetime-local" class="form-control" id="event_start_date"
                                    name="event_start_date" v-model="event_start_date" min="{{ date('Y-m-d\TH:i') }}">
                                <span v-if="errors.event_start_date" class="text-danger">@{{ errors.event_start_date }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>To Date:</label>
                                <input type="datetime-local" class="form-control" id="event_end_date" name="event_end_date"
                                    v-model="event_end_date" min="{{ date('Y-m-d\TH:i') }}">
                                <span v-if="errors.event_end_date" class="text-danger">@{{ errors.event_end_date }}</span>
                            </div>
 
 
                            <div class="form-group col-md-6">
                                <label>Title:</label>
                                <input type="text" class="form-control" id="event_title" name="event_title"
                                    v-model.number="event_title">
                                <span v-if="errors.event_title" class="text-danger">@{{ errors.event_title }}</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Description:</label>
                                <input type="text" class="form-control" id="event_description" name="event_description"
                                    v-model.number="event_description">
                                <span v-if="errors.event_description" class="text-danger">@{{ errors.event_description }}</span>
                            </div>
 
 
 
                            <div class="form-group col-md-6">
                                <label>Choose Color:</label>
                                <input type="color" id="head" v-model="event_color" name="head" value="" />
                            </div>
 
 
                            <div class="d-flex justify-content-between">
                                <span v-if="is_edit">
                                    <button type="submit" class="btn btn-sm btn-fill btn-primary "
                                        @click = "updateEventData" style="font-weight:600;" id="save">Update</button>
                                </span>
                                <span v-if="!is_edit">
                                    <button type="submit" @click="saveEventData"
                                        class="btn btn-sm btn-fill btn-primary mt-4" id="save"
                                        style="font-weight:600; ">Save</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            <div class="row" style="margin-top:1rem;">
                <div class="col-sm-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Event Calendar</h5>
                        </div>
                        <div class="card-body p-3">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
 
                <div class="col-sm-4">
                    <ul class="home-list">
                        @forelse ($events as $appointment)
                            <li>
                                <div class="event-card">
                                    <div class="event-title" style="color: {{ $appointment['backgroundColor'] }}">
                                        {{ $appointment['title'] }}</div>
                                    <div class="event-dates">
                                        <span><strong>Start:</strong>
                                            {{ \Carbon\Carbon::parse($appointment['start'])->format('d/m/Y h:i A') }}</span><br>
                                        <span><strong>End:</strong>
                                            {{ \Carbon\Carbon::parse($appointment['end'])->format('d/m/Y h:i A') }}</span>
                                    </div>
                                </div>
                            </li>
 
                        @empty
                            <li>
                                <div class="event-card">
                                    <div class="event-dates">
                                        <span><strong>No Events Found</strong></span><br>
 
                                    </div>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
 
        <!-- Event Details Modal -->
        <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventDetailsLabel">Event Details</h5>
                        <button type="button" class="btn btn-sm btn-fill btn-primary" data-bs-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Title:</strong> <span id="modalEventTitle"></span></p>
                        <p><strong>Start:</strong> <span id="modalEventStart"></span></p>
                        <p><strong>End:</strong> <span id="modalEventEnd"></span></p>
                        <p><strong>Description:</strong> <span id="modalEventDescription"></span></p>
                    </div>
                </div>
            </div>
        </div>
 
 
 
 
        <script src="https://cdn.jsdelivr.net/npm/vuejs-datepicker@1.6.2/dist/vuejs-datepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.js"
            integrity="sha512-T3FxfGZozDaMebkyEail/ou+a9U7Q+9P1VzG3QphdjjEJVmJdyvgGszLzK1bk8UBeZHh0iyRMHHZxH6XUtY8xQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.8.4/axios.min.js"
            integrity="sha512-2A1+/TAny5loNGk3RBbk11FwoKXYOMfAK6R7r4CpQH7Luz4pezqEGcfphoNzB7SM4dixUoJsKkBsB6kg+dNE2g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.min.js" integrity="sha512-PneTXNl1XRcU6n5B1PGTDe3rBXY04Ht+Eddn/NESwvyc+uV903kiyuXCWgL/OfSUgnr8HLSGqotxe6L8/fOvwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
        <script>
            Vue.component("v-select", VueSelect.VueSelect);
 
            var app = new Vue({
                el: '#manage_event',
                components: {
                    vuejsDatepicker
                },
                data: {
                    showModal: false,
                    errors: {},
                    edited_data: "",
                    is_edit: 0,
                    departmentList: [],
                    employeeList: [],
                    department_id: null,
                    employee_id: [],
                    event_start_date: null,
                    event_end_date: null,
                    event_title: null,
                    event_color: null,
                    event_description: null,
                },
 
                methods: {
                    validateForm() {
                        this.errors = {}; // Clear errors
                        if (!this.department_id) this.errors.department_id = 'Please select department.';
                        if (!this.employee_id) this.errors.employee_id = 'Please select employee.';
                        if (!this.event_start_date) this.errors.event_start_date = 'Event start date is required.';
                        if (!this.event_end_date) this.errors.event_end_date = 'Event end date is required.';
                        if (!this.event_title) this.errors.event_title = 'Event title required.';
                        if (!this.event_description) this.errors.event_description = 'Event Description is required.';
                        return Object.keys(this.errors).length == 0;
                    },
 
                    openModal() {
                        vm = this;
                        vm.is_edit = 0;
                        vm.showModal = true;
                        vm.errors = {};
                        vm.edited_data = "";
 
                    },
 
                    getDepartment() {
                        vm = this;
                        $.ajax({
                            type: "GET",
                            url: "{{ url('listdepartment') }}",
                            dataType: "JSON",
                            success: function(html) {
                                var objs = html.message;
                                vm.departmentList = objs;
                            }
                        });
                    },
 
                    filterEmployees() {
                        vm = this;
                        var department_id = vm.department_id;
 
                        axios.get(`{{ url('/getEmployeeDataByDepartmentId') }}/${department_id}`).then(res => {
                            vm.employeeList = res.data.data;
                        }).catch(error => {
                            $('#product_id').html(producthtmll);
                        });
                    },
 
                    saveEventData() {
                        vm = this;
 
                        if (!this.validateForm()) {
                            // Show Toastr notification if validation fails
                            toastr.error('Oops, please fill all the details.', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000, // Duration the toast will be visible (in milliseconds)
                                extendedTimeOut: 1000 // Duration it will stay open after hover
                            });
                            return;
                        }
 
                        var formData = new FormData();
                        formData.append('department_id', vm.department_id);
                        vm.employee_id.forEach(id => {
                            formData.append('employee_id[]',
                                id); // Brackets [] lagane se Laravel isko array samjhega
                        });
                        formData.append('event_start_date', vm.event_start_date);
                        formData.append('event_end_date', vm.event_end_date);
                        formData.append('event_title', vm.event_title);
                        formData.append('event_color', vm.event_color);
                        formData.append('event_description', vm.event_description);
 
                        $.ajax({
                            type: "POST",
                            url: "{{ url('form/saveevent') }}",
                            data: formData,
                            contentType: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.message == 'success') {
                                    toastr.success(data.message, {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000, // Duration the toast will be visible (in milliseconds)
                                        extendedTimeOut: 1000 // Duration it will stay open after hover
                                    });
                                    vm.showModal = false;
                                    window.setTimeout(function() {
                                        location.reload()
                                    }, 1000);
                                } else {
                                    toastr.error(data.message, {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000, // Duration the toast will be visible (in milliseconds)
                                        extendedTimeOut: 1000 // Duration it will stay open after hover
                                    });
                                    return;
                                }
 
                            }
                        });
 
                    },
 
                    updateEventData() {
 
                    }
 
 
 
 
                },
 
                mounted() {
                    this.getDepartment();
                },
                watch: {
 
                }
            })
        </script>
 
     
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: @json($events),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            eventContent: function(arg) {
                // Custom event rendering with thumb-tack icon
                return { 
                    html: `<i class="fa fa-thumb-tack text-primary me-1"></i> ${arg.event.title}`
                }
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                document.getElementById('modalEventTitle').textContent = info.event.title;
                document.getElementById('modalEventStart').textContent = info.event.start.toLocaleString();
                document.getElementById('modalEventEnd').textContent = info.event.end ? info.event.end.toLocaleString() : 'Ended...';
                document.getElementById('modalEventDescription').textContent = info.event.extendedProps.event_description;
                var eventModal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                eventModal.show();
            },
            eventDidMount: function(info) {
                var tooltip = new bootstrap.Tooltip(info.el, {
                    title: info.event.title,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            },
            dayMaxEventRows: true,
            eventDisplay: 'block',
            eventColor: '#0d6efd',
            eventTextColor: '#ffffff',
            selectable: true,
            nowIndicator: true,
            aspectRatio: 1.5,
        });
        calendar.render();
    });
</script>


 
    @endsection
 
 