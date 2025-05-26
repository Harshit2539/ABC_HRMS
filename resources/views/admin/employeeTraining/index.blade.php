@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.css"
    integrity="sha512-HLz+b0Pyj+6RnAjTwAajDUOJfhEIfdLy91cHSph3ydMYt3UN6kp7h+b2ofodXNflk4CNyZe9HP8YAj8hYBiNSA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .training-table, 
        .training-table th, 
        .training-table td {
            font-size: 12px; 
            width: 10px;
        }

        .training-table .badge {
            font-size: 10px;
            padding: 2px 5px;
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
                        <h3 class="main-heading">Training</span></h3>
                    </div>
                    {{-- <button type="button" @click="openModal" class="btn btn-sm btn-fill btn-primary">
                        <i class="fa fa-plus"></i> Add New
                    </button> --}}
                </div>
            </div>
 
            <div class="row" style="margin-top:1rem;">
                <div class="col-sm-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Training Calendar</h5>
                        </div>
                        <div class="card-body p-3">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
 
                <div class="col-sm-6">
                  <div id="trainingTable" style="overflow-x: auto;">
                 <table class="training-table table table-striped table-bordered compact" style="width:100%">
                        <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th class="text-center">S No.</th>
                                <th class="text-center">TRAINER</th>
                                <th class="text-center">DEPARTMENT</th>
                                <th class="text-center">DESCRIPTION</th>
                                <th class="text-center">STATUS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
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
         
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuejs-datepicker@1.6.2/dist/vuejs-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-select/3.10.0/vue-select.js"
    integrity="sha512-T3FxfGZozDaMebkyEail/ou+a9U7Q+9P1VzG3QphdjjEJVmJdyvgGszLzK1bk8UBeZHh0iyRMHHZxH6XUtY8xQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.8.4/axios.min.js"
    integrity="sha512-2A1+/TAny5loNGk3RBbk11FwoKXYOMfAK6R7r4CpQH7Luz4pezqEGcfphoNzB7SM4dixUoJsKkBsB6kg+dNE2g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.min.js" 
    integrity="sha512-PneTXNl1XRcU6n5B1PGTDe3rBXY04Ht+Eddn/NESwvyc+uV903kiyuXCWgL/OfSUgnr8HLSGqotxe6L8/fOvwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
        // Initialize DataTable
        $('.training-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
             autoWidth: false,
            ajax: {
                url: "{{ route('employee-training') }}"
            },
            columns: [
                {
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'trainer', className: "text-center" },
                { data: 'department_name', className: "text-center" },
                { data: 'description', className: "text-center" },
                { data: 'status', className: "text-center" }
            ],
             createdRow: function(row, data, dataIndex) {
        $(row).css('font-size', '12px'); // smaller font size for rows
    }
        });
    </script>

<script>
    $(document).ready(function () {
        // Initialize FullCalendar
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
                return {
                    html: `<i class="fa fa-thumb-tack text-primary me-1"></i> ${arg.event.title}`
                };
            },
            eventClick: function(info) {
                info.jsEvent.preventDefault();
                $('#modalEventTitle').text(info.event.title);
                $('#modalEventStart').text(info.event.start.toLocaleString());
                $('#modalEventEnd').text(info.event.end ? info.event.end.toLocaleString() : 'Ended...');
                $('#modalEventDescription').text(info.event.extendedProps.event_description);
                let eventModal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                eventModal.show();
            },
            eventDidMount: function(info) {
                new bootstrap.Tooltip(info.el, {
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
 
 