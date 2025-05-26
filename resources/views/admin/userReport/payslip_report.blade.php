@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<style>
    .pagination {
        float: right;
    }

    .dt-search {
        float: right;
    }

    .dt-length {
        display: none;
    }

    /*  #filteredPayslip{
        margin-top:75px;
    }*/

    #customPayroll {
        display: none;
    }

    .customPayRoll-container {
        margin: 25px 56px 13px;
    }
</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="main-heading">Employee Payroll<span>Report</span></h3>
                        </div>
                    </div>

                    <div class="card">
                        <!-- /.card-header -->



                        <div class="col-sm-4 customPayRoll-container">
                            <button type="button" title="custom pay roll" class="btn btn-primary" id="showCustomPayroll">Monthly PayRoll</button></a>
                        </div>


                        <div class="card-body table-responsive">
                            <div class="row" id="payRoll">
                                <div class="col-sm-4">
                                    <input class="form-control" type="month" id="start" name="start" min="2018-03" value="{{ now()->format('Y-m') }}">
                                </div>
                                <div class="col-sm-4">
                                    <a href="javascript:void(0)" id="exportBtn"><button type="button" class="btn btn-primary">Export</button></a>
                                </div>

                            </div>



                            {{-- filtered payslip report  --}}

                            <div class="container" id="customPayroll">

                                <div class="row">
                                    <h4>Accumulated PayRoll</h4>
                                </div>

                                <div class="row" id="filteredPayslip">
                                    <div class="col-sm-4">
                                        <input class="form-control" type="month" id="startMonth" name="startMonth" min="2018-03" value="{{ now()->format('Y-m') }}">
                                    </div>

                                    <div class="col-sm-4">
                                        <input class="form-control" type="month" id="endMonth" name="endMonth" min="2018-03">
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="javascript:void(0)" id="accExportBtn"><button type="button" class="btn btn-primary">Export</button></a>
                                    </div>
                                </div>

                            </div>


                            <table class="table table-striped custom-table datatable subOrdinateTravelRequestList" style="font-size:0.9em !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center">SN.</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Functions</th>
                                        <th class="text-center">Agencies</th>
                                        <th class="text-center">Basic Salary</th>
                                        <th class="text-center">Over Payment</th>
                                        <th class="text-center">Good separation bonus</th>
                                        <th class="text-center">PES separation allowance</th>
                                        <th class="text-center">Absence</th>
                                        <th class="text-center">Responsibility Bonus</th>
                                        <th class="text-center">Seniority Bonus</th>
                                        <th class="text-center">Attendance Bonus</th>
                                        <th class="text-center">Performance Bonus</th>

                                        <th class="text-center">Cash Bonus</th>
                                        <th class="text-center">Housing Allowance</th>
                                        <th class="text-center">Transport Allowance</th>
                                        <th class="text-center">Electricity</th>
                                        <th class="text-center">Water</th>
                                        <th class="text-center">Cost Of Representation</th>
                                        <th class="text-center">Milk Bonus</th>
                                        <th class="text-center">Dirt Premium</th>
                                        <th class="text-center">Domestic</th>
                                        <th class="text-center">Benefit Water</th>



                                        <th class="text-center">Food</th>
                                        <th class="text-center">Month</th>
                                        <th class="text-center">Leave</th>
                                        <th class="text-center">Mutual</th>
                                        <th class="text-center">Salary Advance</th>
                                        <th class="text-center">School Credit</th>
                                        <th class="text-center">Emergency Loan</th>
                                        <th class="text-center">Ordinary P Loan</th>
                                        <th class="text-center">Car Loan</th>
                                        <th class="text-center">Ascoma</th>
                                        <th class="text-center">Rolling Equipment Credit</th>
                                        <th class="text-center">Salary Education</th>


                                        <th class="text-center">Notice Due By Employee</th>
                                        <th class="text-center">Regul Irpp 2017</th>
                                        <th class="text-center">Regul Cac 2017</th>
                                        <th class="text-center">Gross Salary</th>
                                        <th class="text-center">Contributable Salary Np</th>
                                        <th class="text-center">Extra 1</th>
                                        <th class="text-center">CAC Calculated</th>
                                        <th class="text-center">CFC Calculated</th>
                                        <th class="text-center">Social</th>
                                        <th class="text-center">FNE</th>
                                        <th class="text-center">Alloc</th>
                                        <th class="text-center">Extra </th>


                                        <th class="text-center">Taxable Salary</th>
                                        <th class="text-center">Capped Contributory Salary</th>
                                        <th class="text-center">IRPP Calculated</th>
                                        <th class="text-center">TDL Calculated</th>
                                        <th class="text-center">RAV Calculated</th>
                                        <th class="text-center">CFC</th>
                                        <th class="text-center">PVI</th>
                                        <th class="text-center">At</th>
                                        <th class="text-center">Net To Pay</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </div>
</div>

<!-- Script Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    var table = $('.subOrdinateTravelRequestList').DataTable({
        responsive: true,
        processing: true,
        serverSide: false,
        searching: true,
        scrollX: true,
        ajax: {
            url: "{{ route('payslip.report') }}",
            data: function(d) {
                d.start = $('#start').val(); // Get the selected month
            }
        },
        columns: [{
                data: null,
                className: "text-center",
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                data: 'employee_id',
                className: "text-center"
            },
            {
                data: 'functions',
                className: "text-center"
            },

            {
                data: 'agencies',
                className: "text-center"
            },
            {
                data: 'basic_salary',
                className: "text-center"
            },
            {
                data: 'overpayment',
                className: "text-center"
            },
            {
                data: 'good_seperation_bonus',
                className: "text-center"
            },
            {
                data: 'pes_seperation_allowance',
                className: "text-center"
            },
            {
                data: 'absence',
                className: "text-center"
            },
            {
                data: 'responsibility_bonus',
                className: "text-center"
            },
            {
                data: 'seniority_bonus',
                className: "text-center"
            },
            {
                data: 'attendance_bonus',
                className: "text-center"
            },
            {
                data: 'performance_bonus',
                className: "text-center"
            },
            {
                data: 'cash_bonus',
                className: "text-center"
            },
            {
                data: 'housing_allowance',
                className: "text-center"
            },
            {
                data: 'transport_allowance',
                className: "text-center"
            },
            {
                data: 'electricity',
                className: "text-center"
            },
            {
                data: 'water',
                className: "text-center"
            },
            {
                data: 'cost_of_representation',
                className: "text-center"
            },
            {
                data: 'milk_bonus',
                className: "text-center"
            },
            {
                data: 'dirt_premium',
                className: "text-center"
            },
            {
                data: 'domestic',
                className: "text-center"
            },
            {
                data: 'benefit_water',
                className: "text-center"
            },
            {
                data: 'food',
                className: "text-center"
            },
            {
                data: 'month',
                className: "text-center"
            },
            {
                data: 'hrms_leave',
                className: "text-center"
            },
            {
                data: 'mutual',
                className: "text-center"
            },
            {
                data: 'salary_advance',
                className: "text-center"
            },
            {
                data: 'school_credit',
                className: "text-center"
            },
            {
                data: 'emergency_loan',
                className: "text-center"
            },
            {
                data: 'ordinary_p_loan',
                className: "text-center"
            },
            {
                data: 'car_loan',
                className: "text-center"
            },
            {
                data: 'ascoma',
                className: "text-center"
            },
            {
                data: 'rolling_equipment_credit',
                className: "text-center"
            },
            {
                data: 'salary_deduction',
                className: "text-center"
            },
            {
                data: 'notice_due_by_the_employee',
                className: "text-center"
            },
            {
                data: 'regul_irpp_2017',
                className: "text-center"
            },
            {
                data: 'regul_cac_2017',
                className: "text-center"
            },
            {
                data: 'gross_salary',
                className: "text-center"
            },
            {
                data: 'contributable_salary_np',
                className: "text-center"
            },
            {
                data: 'extra1',
                className: "text-center"
            },
            {
                data: 'cac_calculated',
                className: "text-center"
            },
            {
                data: 'cfc_calculated',
                className: "text-center"
            },
            {
                data: 'social',
                className: "text-center"
            },
            {
                data: 'fne',
                className: "text-center"
            },
            {
                data: 'alloc',
                className: "text-center"
            },
            {
                data: 'extra2',
                className: "text-center"
            },
            {
                data: 'taxable_salary',
                className: "text-center"
            },
            {
                data: 'capped_contributory_salary',
                className: "text-center"
            },
            {
                data: 'irpp_calculated',
                className: "text-center"
            },
            {
                data: 'tdl_calculated',
                className: "text-center"
            },
            {
                data: 'rav_calculated',
                className: "text-center"
            },
            {
                data: 'cfc',
                className: "text-center"
            },
            {
                data: 'pvi',
                className: "text-center"
            },
            {
                data: 'at',
                className: "text-center"
            },
            {
                data: 'net_to_pay',
                className: "text-center"
            },

        ],
    });


    $('#start').on('change', function() {
        table.ajax.reload();
    });
</script>

<script>
    $('#exportBtn').on('click', function() {
        let selectedMonth = $('#start').val();

        if (!selectedMonth) {
            let currentDate = new Date();
            selectedMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }

        $.ajax({
            url: "{{ route('payslip.export') }}",
            type: "GET",
            data: {
                month: selectedMonth
            },
            xhrFields: {
                responseType: 'blob' // Ensures proper handling of file downloads
            },
            success: function(response) {

                let blob = new Blob([response], {
                    type: 'application/vnd.ms-excel'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "payslip_" + selectedMonth + ".xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                console.error("Error exporting payslip:", error);
                alert("Failed to export payslip. Please try again OR May be data not found");
            }
        });
    });
</script>


<script>
    let PayRollVisibilityStatus = true;

    $(document).on('click', '#showCustomPayroll', function(e) {

        PayRollVisibilityStatus = !PayRollVisibilityStatus;
        if (PayRollVisibilityStatus == false) {

            document.querySelector('#payRoll').style.display = 'none';
            document.querySelector('#customPayRoll').style.display = 'block';
        } else {
            document.querySelector('#payRoll').style.display = 'flex';
            document.querySelector('#customPayRoll').style.display = 'none';
        }

        $(this).text(PayRollVisibilityStatus ? "Monthly Payroll" : "Payroll Between Selective Month");


    })


    $(document).on('click', '#accExportBtn', function(e) {

        let startMonth = $('#startMonth').val();
        let endMonth = $('#endMonth').val();


        if (!startMonth) {
            let currentDate = new Date();
            startMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }

        if (!endMonth) {
            let currentDate = new Date();
            endMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }



        $.ajax({
            url: "{{ route('accumulated.payslip.export') }}",
            type: "GET",
            data: {
                startMonth: startMonth,
                endMonth: endMonth
            },
            xhrFields: {
                responseType: 'blob' // Ensures proper handling of file downloads
            },
            success: function(response) {

                let blob = new Blob([response], {
                    type: 'application/vnd.ms-excel'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "payslip_" + startMonth + "-" + endMonth + ".xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                console.error("Error exporting payslip:", error);
                alert("Failed to export payslip. Please try again OR May be data not found");
            }
        });
    });
</script>




@endsection