@extends('layouts.master')
 
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 
 
    <div class="page-wrapper">
        <div class="container-fluid mt-4 ">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Training<span>Ready for Training ?</span></h3>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#trainingModal">
                        + Create New Training
                    </button>
                </div>
            </div>
            <div class="mt-4 card shadow-sm p-3">
                <div id="trainingTable" style="overflow-x: auto;">
                    <table class="table training-table table-striped table-bordered" style="min-width: 1200px;" style="font-size:0.9em !important;">
                        <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th class="text-center">S No.</th>
                                <th class="text-center">TRAINER</th>
                                <th class="text-center">DEPARTMENT</th>
                                <th class="text-center">TRAINING TYPE</th>
                                <th class="text-center">Employees</th>

                                <th class="text-center">STATUS</th>
                                <th class="text-center">TRAINING DURATION</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
 
    <!-- Training Modal -->
    <div class="modal fade" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingModalLabel">Create Training</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('traininglist.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Training Type*</label>
                                <select name="training_type" class="form-control" required>
                                    <option value="Internal">Internal</option>
                                    <option value="External">External</option>
                                </select>
                            </div>
 
                            <div class="form-group col-md-6">
                                <label>Trainer*</label>
                                <select name="trainer_id" class="form-control" required>
                                    <option value="">Select Trainer</option>
                                    @foreach ($trainers as $trainer)
                                        <option value="{{ $trainer->id }}">{{ $trainer->first_name }}
                                            {{ $trainer->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <!-- Department Dropdown -->
                                <label>Select Department</label>
                                <select class="form-control" id="department_dropdown" name="department_id" required>
                                    <option value="" selected>Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Multi-Select Employee Dropdown -->
                            <div class="form-group col-md-6">
                                <label>Select Employees</label>
                                <select  style="width: 75%" class="form-control employeedropdown" id="employee_id" name="employee_id[]" multiple required>
                                    {{-- Options are dynamically appended --}}
 
 
                                </select>
                            </div>
 
 
                            <div class="form-group col-md-6">
                                <label>Start Date*</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
 
                            <div class="form-group col-md-6">
                                <label>End Date*</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status*</label>
                                <select name="status" class="form-control" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Started">Started</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Terminated">Terminated</option>
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label>Remarks*</label>
                                <textarea name="remarks" class="form-control" rows="2"></textarea>
 
                            </div> --}}
                            <div class="col-md-12 mt-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Create Training</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
 
 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.employeedropdown').select2({
    width: 'resolve' // need to override the changed default
});
 
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('.training-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            scrollbars: true,
            ajax: {
                url: "{{ route('traininglist.index') }}",
            },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                
                {
                    data: 'first_name',
                    className: "text-center"
                },
                {
                    data: 'department',
                    className: "text-center"
                },
                
                {
                    data: 'training_type',
                    className: "text-center"
                },

                {
                    data: 'employees',
                    className: "text-center"
                },
                {
                    data: 'status',
                    className: "text-center"
                },
                {
                    data: 'start_date',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center",
                },
            ],
        });
 
        $(document).on('change', '#department_dropdown', function(e) {
            e.preventDefault();
 
            const departmentID = $(this).val();
 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 
            $.ajax({
                url: "{{ route('get.employees') }}",
                type: 'GET',
                data: {
                    department_id: departmentID
                },
                success: function(response) {
                    const employeeDropdown = document.getElementById('employee_id');
                    employeeDropdown.innerHTML = '';
 
                    if (response.status === true) {
                        response.employees.forEach(employee => {
                            const option = document.createElement('option');
                            option.value = employee.id;
                            option.textContent = `${employee.first_name} ${employee.last_name}`;
                            employeeDropdown.appendChild(option);
                        });
 
                    } else {
                        const option = document.createElement('option');
                        option.textContent = 'No employees available';
                        option.disabled = true;
                        employeeDropdown.appendChild(option);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while fetching employees.');
                }
            });
        });
    </script>
    <script>
        let timeout;
 
        $(document).on('keyup', '#searchEmployees', function(e) {
 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 
            e.preventDefault();
            if (timeout) {
                clearTimeout(timeout);
 
            }
 
            timeout = setTimeout(function() {
                stringadd = $("input[name=search_employees]").val();
 
                if (stringadd.length == 0) {
 
                    let total_employees = <?php echo json_encode($employees); ?>;
 
                    let searchBarLI = document.querySelector(".drop-down-menu").querySelector(
                        "li:first-child");
                    let existingLIs = document.querySelector(".drop-down-menu").querySelectorAll(
                        "li:not(:first-child)");
 
                    existingLIs.forEach(li => li.remove());
 
                    total_employees.forEach(employee => {
                        let newLI = document.createElement("li");
                        newLI.innerHTML = `
    <div class="user-item">
        <input type="checkbox" name="CC_to[]" value="${employee.id}" id="employee_${employee.id}" />
        <div class="user-image">
            <p><i class="fa-solid fa-user"></i></p>
        </div>
        <div class="user-info">
            <h4>${employee.name}</h4>
        </div>
    </div>
`;
 
                        document.querySelector(".drop-down-menu").appendChild(newLI);
                    });
 
 
                }
 
 
                if (stringadd.length >= 3) {
 
                    $.ajax({
 
                        url: "{{ route('traininglist.index') }}",
                        type: 'POST',
                        data: {
                            "employee_name": stringadd
                        },
                        success: function(response) {
 
 
 
                            if (response.status == true) {
 
                                let searchBarLI = document.querySelector(".drop-down-menu")
                                    .querySelector("li:first-child");
 
                                let existingLIs = document.querySelector(".drop-down-menu")
                                    .querySelectorAll("li:not(:first-child)");
 
 
                                existingLIs.forEach(li => li.remove());
 
                                response.employees.forEach(employee => {
                                    let newLI = document.createElement("li");
                                    newLI.innerHTML = `
    <div class="user-item">
        <input type="checkbox" name="CC_to[]" value="${employee.id}" id="employee_${employee.id}" />
        <div class="user-image">
            <p><i class="fa-solid fa-user"></i></p>
        </div>
        <div class="user-info">
            <h4>${employee.name}</h4>
        </div>
    </div>
`;
 
                                    document.querySelector(".drop-down-menu")
                                        .appendChild(newLI);
                                });
 
                            } else if (response.status == false) {
 
                                let searchBarLI = document.querySelector(".drop-down-menu")
                                    .querySelector("li:first-child");
 
                                let existingLIs = document.querySelector(".drop-down-menu")
                                    .querySelectorAll("li:not(:first-child)");
 
 
                                existingLIs.forEach(li => li.remove());
 
                                let newLI = document.createElement("li");
                                newLI.innerHTML = `
  <div>${response.message}</div>
`;
 
                                document.querySelector(".drop-down-menu").appendChild(newLI);
 
                            }
 
                        }
                    });
 
                }
            }, 600)
 
        });
    </script>
@endsection
 
 
 