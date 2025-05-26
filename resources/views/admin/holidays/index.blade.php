@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')
        <div class="page-wrapper">
             <div class="content container-fluid">
                {{-- <h3 class="mb-3">Holidays</h3> --}}


                <div class="card-body">
                        <div class="card-header d-flex" style="justify-content:space-between;">
                            <div class="card-title">
                                <h3 class="main-heading">Manage<span>Holidays</span></h3>
                            </div>
                            <div class="card-toolbar" style="align-content:center;">

                                <button class="btn btn-success font-weight-bolder mb-3" data-toggle="modal"
                                    data-target="#addNewModal">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                    Add New Holiday
                                </button>


                                <button class="btn btn-primary mb-3 me-2" id="quickAddBtn">+ Quick Add</button>

                            </div>
                        </div>






                    <!-- Quick Add Form (Initially Hidden) -->
                    <div id="quickAddForm" class="card p-3 shadow-sm" style="display: none;">
                        <h4>Quick Add Holidays</h4>
                        <form action="{{ route('holiday.quickStore') }}" method="POST" id="quickHolidayForm">
                            @csrf
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="w-50 me-2">
                                    <label for="import_from" class="form-label">Import Holiday From:</label>
                                    <input type="number" name="import_from" id="import_from" class="form-control" min="2000" max="2100" value="2022">
                                </div>
                                <div class="w-50">
                                    <label for="import_to" class="form-label">Import Holiday To:</label>
                                    <input type="number" name="import_to" id="import_to" class="form-control" min="2000" max="2100" value="2023">
                                </div>
                            </div>

                            <!-- Additional Holiday Fields -->
                            <div id="additionalFields">
                                <div class="mb-3 d-flex align-items-center">
                                    <input type="text" name="holiday_name[]" class="form-control me-2" placeholder="Holiday Name" required>
                                    <input type="date" name="holiday_date[]" class="form-control me-2" required>
                                </div>
                            </div>

                            <button type="button" id="addFieldButton" class="btn btn-secondary mb-0.5">Add Another Holiday</button>
                            <button type="submit" class="btn btn-primary">Save Holidays</button>

                            <!-- Cancel Button for Quick Add Form -->
                            <button type="button" id="cancelQuickAddBtn" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>




                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable SkillList" style="font-size:0.9em !important;">
                            <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Holiday Name</th>
                                    <th class="text-center">Holiday Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Add Skill Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Add Holiday</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addSkillForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Holiday Name</label>
                                <input type="text" class="form-control" id="holidayName" name="holidayName" required>
                                <small class="text-danger name_error"></small>

                            </div>

                            <div class="mb-3">
                                <label for="holidayDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="holidayDate" name="holidayDate" required>
                                <small class="text-danger name_error"></small>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveSkillBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Edit Skill Modal -->
        <div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSkillModalLabel">Skill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editSkillForm">
                            @csrf
                            <input type="hidden" name="id" id="divisionId">



                            <div class="form-group">
                                <label for="name">Holiday Name</label>
                                <input type="text" class="form-control" id="editholidayName" name="holidayName" required>
                                <small class="text-danger name_error"></small>

                            </div>

                            <div class="mb-3">
                                <label for="holidayDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="editholidayDate" name="holidayDate" required>
                                <small class="text-danger name_error"></small>

                            </div>


                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editSkillBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>




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


    <script>
        var table = $('.SkillList').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            searching: true,
            ajax: {
                url: "{{ route('holiday.index') }}",
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
                    data: 'name_holiday',
                    className: "text-center"
                },
                {
                    data: 'date_holiday',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center",
                },

            ],
        });



        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
                $.ajax({
                    url: `/holiday_edit/${id}`,
                    type: 'GET',
                    success: function (data) {
                        $('#divisionId').val(data.id);
                        $('#editholidayName').val(data.name_holiday);
                        $('#editholidayDate').val(data.date_holiday);
                        $('#editSkillModal').modal('show');
                    }
                });
        });


        $('#editSkillBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#divisionId').val();
        var formData = new FormData($('#editSkillForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/holidays_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editSkillModal').modal('hide');
                    table.ajax.reload();
                } else if (response.result === 'error') {
                    console.log()
                    for (let key in response.msg) {
                        if (response.msg.hasOwnProperty(key)) {
                            $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                        }
                    }
                }
            },
            error: function (error) {
                $('.pre-loader').hide();
            }
        });
    });


    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.getElementById('import_from').addEventListener('change', function() {
            var selectedYear = this.value; // Get the selected year (e.g., 2022)
            var holidayDates = document.querySelectorAll('input[name="holiday_date[]"]');

            holidayDates.forEach(function(input) {
                input.value = selectedYear + '-01-01'; // Set date to January 1st of the selected year
            });
        });

        document.getElementById('addFieldButton').addEventListener('click', function() {
            var newField = document.createElement('div');
            newField.classList.add('mb-3', 'd-flex', 'justify-content-between');

            newField.innerHTML = `
                            <div class="w-75">
                                <label for="holiday_name" class="form-label">Holiday Name:</label>
                                <input type="text" name="holiday_name[]" class="form-control" placeholder="Enter Holiday Name" required>
                            </div>
                            <div class="w-75">
                                <label for="holiday_date" class="form-label">Holiday Date:</label>
                                <input type="date" name="holiday_date[]" class="form-control" required>
                            </div>
                        `;

            document.getElementById('additionalFields').appendChild(newField);

            var holidayDateInputs = newField.querySelectorAll('input[name="holiday_date[]"]');
            holidayDateInputs.forEach(function(input) {
                input.value = document.getElementById('import_from').value + '-01-01';
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var holidayDateInputs = document.querySelectorAll('input[name="holiday_date[]"]');
            holidayDateInputs.forEach(function(input) {
                input.value = document.getElementById('import_from').value + '-01-01';
            });
        });
    </script>
</div>




    <script>
        $(document).ready(function() {
            function updateYear() {
                let fromYear = $("#import_from").val();
                let toYear = $("#import_to").val();

                let currentDate = $("#holiday_date").val() || new Date().toISOString().split("T")[0];
                let dateParts = currentDate.split("-");

                let newYear = fromYear;

                let newDate = newYear + "-" + dateParts[1] + "-" + dateParts[2];
                $("#holiday_date").val(newDate);
            }

            $("#import_from, #import_to").on("change", function() {
                updateYear();
            });

            updateYear();
        });
    </script>


    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $("#cancelQuickAddBtn").click(function() {
                    $("#quickAddForm").slideUp();
                });

                // Toggle Quick Add Form when Quick Add button is clicked
                $("#quickAddBtn").click(function() {
                    $("#quickAddForm").slideToggle();
                });

            });

            $(document).ready(function() {

                $("#yearSelect").change(function() {
                    let selectedYear = $(this).val();

                    if (selectedYear) {
                        $("#holidayTable tr").each(function() {
                            let holidayDate = $(this).find("td:nth-child(2)").text();
                            let holidayYear = new Date(holidayDate).getFullYear();
                            if (holidayYear == selectedYear) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    } else {
                        $("#holidayTable tr").show();
                    }
                });

                $(document).ready(function() {
                    // Show all data initially
                    $("tbody tr").show();

                    // Year selection filtering
                    $("#yearSelect").change(function() {
                        let selectedYear = $(this).val();

                        if (selectedYear) {
                            $("tbody tr").each(function() {
                                let holidayDate = $(this).find("td:nth-child(2)").text().trim();
                                let dateObj = new Date(holidayDate);

                                if (!isNaN(dateObj)) {
                                    let holidayYear = dateObj.getFullYear();
                                    if (holidayYear == selectedYear) {
                                        $(this).show();
                                    } else {
                                        $(this).hide();
                                    }
                                }
                            });
                        } else {
                            $("tbody tr").show();
                        }
                    });


                    // Automatically add classes for weekends
                    $("tbody tr").each(function() {
                        let holidayDate = $(this).find("td:nth-child(2)").text().trim();
                        let dateObj = new Date(holidayDate);

                        if (!isNaN(dateObj)) {
                            let day = dateObj.getDay();
                            if (day === 0 || day === 6) { // 0 = Sunday, 6 = Saturday
                                $(this).addClass("weekend");
                            }
                        }
                    });
                });


                // Your existing code for handling search by name...
                $("input[type='text'][placeholder='Search By Name']").on("input", function() {
                    let searchTerm = $(this).val().toLowerCase(); // Get the search term
                    $("#holidayTable tr").each(function() {
                        let holidayName = $(this).find("td:first").text().toLowerCase();
                        if (holidayName.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });

            });

        });
    </script>


    <script>
        $('#saveSkillBtn').on('click', function(e) {
            e.preventDefault();

            var formData = new FormData($('#addSkillForm')[0]);
            $('.text-danger').empty();
            $('.pre-loader').show();

            $.ajax({
                url: "{{ route('holiday.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.pre-loader').hide();

                    if (response.result === 'success') {
                        $('#addSkillForm')[0].reset();
                        $('#addNewModal').modal('hide');

                    } else if (response.result === 'error') {
                        for (let key in response.msg) {
                            if (response.msg.hasOwnProperty(key)) {
                                $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                            }
                        }
                    }
                },
                error: function(error) {
                    $('.pre-loader').hide();
                }
            });
        });
    </script>

@endsection