@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')
{{-- message --}}
{!! Toastr::message() !!}

  

<!-- Main content -->
    <div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          
            <li class="nav-item" role="presentation">
               <a href="{{ route('loan_types.list') }}"> 
                <button class="nav-link " type="button"  >
                   Loan Types
                </button>
                </a> 
            </li>
            <li class="nav-item" role="presentation">
               <a href="{{ route('employee_loans.list') }}"> 
                <button class="nav-link active" type="button"  >
                    Employee Loans
                </button>
                </a> 
            </li>
           
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <!-- <h3 class="card-label">Overtime Categories</h3> -->
                        </div>
                        <div class="card-toolbar">
                            <div class="row">
                            <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                data-target="#addNewModal">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New
                            </button>
                            <div class="col-2">
                            <select class="form-control" id="FilterByEmployees" name="FilterByEmployees">
                                <option value="">All Employees</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="col-2">
                            <select class="form-control" id="FilterByLoans" name="FilterByLoans">
                                <option value="">All Loan Types</option>
                                @foreach($loans as $loan)
                                <option value="{{$loan->id}}">{{$loan->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable empLoanList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">employee</th>
                                    <th class="text-center">Loan Type</th>
                                    <th class="text-center">Loan Start Date</th>
                                    <th class="text-center">Loan Period (Months)</th>
                                    <th class="text-center">Currency</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
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

        <!-- Add OvertimeCategory Modal -->
        <div class="modal fade" id="addNewModal" id="addmethod" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Employee Loan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addEmpLoanForm">
                            @csrf
                            <div class="form-group">
                            <label for="employee_id"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger employee_id_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="loan_id"><span class="mandatory_input" style="color:red;">*</span> Loan Type: </label>
                                <select class="form-control" id="loan_id" name="loan_id">
                                    <option value="">Select Loan Type</option>
                                    @foreach($loans as $loan)
                                   <option value="{{$loan->id}}">{{$loan->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger loan_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="start_date"><span class="mandatory_input" style="color:red;">*</span> Loan Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                                <small class="text-danger start_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="last_installment_date"><span class="mandatory_input" style="color:red;">*</span> Last Installment Date:</label>
                                <input type="date" class="form-control" id="last_installment_date" name="last_installment_date">
                                <small class="text-danger last_installment_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="period_months"><span class="mandatory_input" style="color:red;">*</span> Loan Period (Months):</label>
                                <input type="number" class="form-control" id="period_months" name="period_months">
                                <small class="text-danger period_months_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="currency_id"><span class="mandatory_input" style="color:red;">*</span> Currency: </label>
                                <select class="form-control" id="currency_id" name="currency_id">
                                    <option value="">Select Currency</option>
                                    @foreach($currencies as $currency)
                                   <option value="{{$currency->id}}">{{$currency->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger currency_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="amount"><span class="mandatory_input" style="color:red;">*</span> Loan Amount:</label>
                                <input type="number" class="form-control" id="amount" name="amount">
                                <small class="text-danger amount_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="monthly_installment"><span class="mandatory_input" style="color:red;">*</span> Monthly Installment:</label>
                                <input type="number" class="form-control" id="monthly_installment" name="monthly_installment">
                                <small class="text-danger monthly_installment_error"></small>
                            </div>


                            <div class="form-group">
                                <label for="approver1" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>(HR) Approver 1</label>
                                <select name="approver1" id="approver1" class="form-control" required>
                                <option value="">Approver 1</option>
                                @foreach($approve1 as $approves1)
                                <option value="{{$approves1->id}}">{{$approves1->name}}</option>
                                @endforeach
                                </select>
                                <small class="text-danger approver1_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="approver2" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>(Direct Superior)Approver 2</label>
                                <select name="approver2" id="approver2" class="form-control" required>
                                <option value="">Approver 2</option>
                                @foreach($approve2 as $approves2)
                                <option value="{{$approves2->id}}">{{$approves2->name}}</option>
                                @endforeach
                                </select>
                                <small class="text-danger approver2_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="approver3" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>Either DGA or DG</label>
                                <select name="approver3" id="approver3" class="form-control" required>
                                    <option value="">Approver 3</option>
                                     @foreach($approve3 as $approves3)
                                    <option value="{{$approves3->id}}">{{$approves3->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger approver3_error"></small>

                                
                            </div>
                            <div class="form-group">
                            <label for="status"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="status" name="status">
                                   <option value="">Select Status</option>
                                   <option value="Approved">Approved</option>
                                   <option value="Repayment">Repayment</option>
                                   <option value="Paid">Paid</option>
                                   <option value="Suspended">Suspended</option>
                                </select>
                                <small class="text-danger status_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="details"> Details:</label>
                                <textarea class="form-control" id="details" rows="3" name="details"></textarea>
                            </div>
                           
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveEmpLoanBtn" class="btn btn-primary"  >Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit OvertimeCategory Modal -->
        <div class="modal fade" id="editEmpLoanModal" tabindex="-1" aria-labelledby="editEmpLoanModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmpLoanModalLabel">Employee Loan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editEmpLoanForm">
                            @csrf
                            <input type="hidden" name="id" id="loanTypeId">
                           
                            <div class="form-group">
                            <label for="editEmployeeId"><span class="mandatory_input" style="color:red;">*</span> Employee: </label>
                                <select class="form-control" id="editEmployeeId" name="employee_id">
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger" id="employee_id_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editLoanId"><span class="mandatory_input" style="color:red;">*</span> Loan Type: </label>
                                <select class="form-control" id="editLoanId" name="loan_id">
                                    <option value="">Select Loan Type</option>
                                    @foreach($loans as $loan)
                                   <option value="{{$loan->id}}">{{$loan->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger" id="loan_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editStartDate"><span class="mandatory_input" style="color:red;">*</span> Loan Start Date:</label>
                                <input type="date" class="form-control" id="editStartDate" name="start_date">
                                <small class="text-danger" id="start_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editLastInstallmentDate"><span class="mandatory_input" style="color:red;">*</span> Last Installment Date:</label>
                                <input type="date" class="form-control" id="editLastInstallmentDate" name="last_installment_date">
                                <small class="text-danger" id="last_installment_date_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editPeriodMonths"><span class="mandatory_input" style="color:red;">*</span> Loan Period (Months):</label>
                                <input type="number" class="form-control" id="editPeriodMonths" name="period_months">
                                <small class="text-danger" id="period_months_error"></small>
                            </div>
                            <div class="form-group">
                            <label for="editCurrencyId"><span class="mandatory_input" style="color:red;">*</span> Currency: </label>
                                <select class="form-control" id="editCurrencyId" name="currency_id">
                                    <option value="">Select Currency</option>
                                    @foreach($currencies as $currency)
                                   <option value="{{$currency->id}}">{{$currency->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger" id="currency_id_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editAmount"><span class="mandatory_input" style="color:red;">*</span> Loan Amount:</label>
                                <input type="number" class="form-control" id="editAmount" name="amount">
                                <small class="text-danger" id="amount_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editMonthlyInstallment"><span class="mandatory_input" style="color:red;">*</span> Monthly Installment:</label>
                                <input type="number" class="form-control" id="editMonthlyInstallment" name="monthly_installment">
                                <small class="text-danger" id="monthly_installment_error"></small>
                            </div>


                            <div class="form-group">
                                <label for="approver1" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>(HR) Approver 1</label>
                                <select name="approver1" id="editapprover1" class="form-control" required>
                                <option value="">Approver 1</option>
                                @foreach($approve1 as $approves1)
                                <option value="{{$approves1->id}}">{{$approves1->name}}</option>
                                @endforeach
                                </select>
                                <small class="text-danger approver1_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="approver2" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>(Direct Superior)Approver 2</label>
                                <select name="approver2" id="editapprover2" class="form-control" required>
                                <option value="">Approver 2</option>
                                @foreach($approve2 as $approves2)
                                <option value="{{$approves2->id}}">{{$approves2->name}}</option>
                                @endforeach
                                </select>
                                <small class="text-danger approver2_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="approver3" class="form-label"> <span class="mandatory_input" style="color:red;">*</span>Either DGA or DG</label>
                                <select name="approver3" id="editapprover3" class="form-control" required>
                                    <option value="">Approver 3</option>
                                     @foreach($approve3 as $approves3)
                                    <option value="{{$approves3->id}}">{{$approves3->name}}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger approver3_error"></small>

                            <div class="form-group">
                            <label for="editStatus"><span class="mandatory_input" style="color:red;">*</span> Status: </label>
                                <select class="form-control" id="editStatus" name="status">
                                   <option value="">Select Status</option>
                                   <option value="Approved">Approved</option>
                                   <option value="Repayment">Repayment</option>
                                   <option value="Paid">Paid</option>
                                   <option value="Suspended">Suspended</option>
                                </select>
                                <small class="text-danger" id="status_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="editDetails"> Details:</label>
                                <textarea class="form-control" id="editDetails" rows="3" name="details"></textarea>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="editEmpLoanBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
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
                        Are you sure you want to delete this Employee Loan?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

<!-- Script Code -->
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#saveEmpLoanBtn').on('click', function (e) {
        e.preventDefault();
        alert('successfully data add');

        var formData = new FormData($('#addEmpLoanForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

// console.log(formData);
// debugger;
        $.ajax({
            url: "{{ route('employee_loans.store') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();


                if (response.result === 'success') {
                    $('#addEmpLoanForm')[0].reset();
                    $('#addNewModal').modal('hide');
                  
                    table.ajax.reload();

                } else if (response.result === 'error') {
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
    var table = $('.empLoanList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,

   
        ajax: {
            url: "{{ route('employee_loans.list') }}",
        },
        columns: [

            {
            data: null, 
            className: "text-center",
            render: function (data, type, row, meta) {
                return meta.row + 1;
            }
            },
            {
                data: 'employee',
                className: "text-center"
            },
            {
                data: 'loan',
                className: "text-center"
            },
            {
                data: 'start_date',
                className: "text-center"
            },
            {
                data: 'period_months',
                className: "text-center"
            },
            {
                data: 'currency',
                className: "text-center"
            },
            {
                data: 'amount',
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

    $('#FilterByEmployees, #FilterByLoans').on('change', function () {
    var employeeId = $('#FilterByEmployees').val();
    var loanId = $('#FilterByLoans').val();

    table.ajax.url("{{ route('employee_loans.list') }}" + `?employee_id=${employeeId}&loan_id=${loanId}`).load();
});

    $(document).on('click', '.btn-edit', function () {
        var id = $(this).data('id');
        $.ajax({
            url: `/employee_loans_edit/${id}`,
            type: 'GET',
            success: function (data) {
                $('#loanTypeId').val(data.id);
                $('#editEmployeeId').val(data.employee_id);
                $('#editLoanId').val(data.loan_id);
                $('#editStartDate').val(data.start_date);
                $('#editLastInstallmentDate').val(data.last_installment_date);
                $('#editPeriodMonths').val(data.period_months);
                $('#editCurrencyId').val(data.currency_id);
                $('#editAmount').val(data.amount);
                $('#editMonthlyInstallment').val(data.monthly_installment);
                $('#editapprover1').val(data.approver1);
                $('#editapprover2').val(data.approver2);
                $('#editapprover3').val(data.approver3);
                $('#editStatus').val(data.status);
                $('#editDetails').val(data.details);
                $('#editEmpLoanModal').modal('show');
            }
        });
    });

    $('#editEmpLoanBtn').on('click', function (e) {
        e.preventDefault();
        var id = $('#loanTypeId').val();
        var formData = new FormData($('#editEmpLoanForm')[0]);
        $('.text-danger').empty();
        $('.pre-loader').show();

        $.ajax({
            url: `/employee_loans_update/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('.pre-loader').hide();

                if (response.result === 'success') {
                    $('#editEmpLoanModal').modal('hide');
                    table.ajax.reload();
                } else if (response.result === 'error') {
                    console.log()
                    for (let key in response.msg) {
                        if (response.msg.hasOwnProperty(key)) {
                            $(`#${key}_error`).html(response.msg[key][0]);
                            // $(`#${key}`).siblings('.text-danger').html(response.msg[key][0]);
                        }
                    }
                }
            },
            error: function (error) {
                $('.pre-loader').hide();
            }
        });
    });

    $(document).on('click', '.btn-delete', function () {
        var id = $(this).data('id');
        $('#confirmDelete').data('id', id);
        $('#deleteModal').modal('show');
    });

    $(document).on('click', '#confirmDelete', function () {
        var id = $(this).data('id');

        $.ajax({
            url: `/employee_loans_delete/${id}`,
            type: 'GET',
            success: function (response) {
                if (response.result === 'success') {
                    $('#deleteModal').modal('hide');
                    table.ajax.reload();
                } else {
                    alert('Failed to delete the Employee Loan. Please try again.');
                }
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });

</script>


@endsection