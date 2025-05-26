@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<style>
    .bold-green {
  font-weight: bold;
  color: green; 
  font-size: 1.3em;
}
</style>

<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
       
            <!-- <li class="nav-item" role="presentation">
                <a href="{{ route('userReports.list') }}"> 
                <button class="nav-link active" type="button">
                   Reports
                </button>
                </a> 
            </li> -->
         
        </ul>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        <h3 class="main-heading">Manage<span>Reports</span></h3>
                        </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable userReportList" >
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th width="5%"></th>
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><i class="la la-file-excel bold-green" ></i></td>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Travel Request Report</td>
                                    <td class="text-center">View travel requests for a specified period</td>
                                    <td class="text-center"><a href="{{route('travel_request.report')}}"><i class="la la-download bold-green"></i></a></td>
                                </tr>

                                <tr>
                                    <td><i class="la la-file-excel bold-green" ></i></td>
                                    <td class="text-center">2</td>
                                    <td class="text-center">Attendance Request Report</td>
                                    <td class="text-center">View Attendance requests for a specified period</td>
                                    <td class="text-center"><a href="{{route('attendance_request.report')}}"><i class="la la-download bold-green"></i></a></td>
                                </tr>

                                <tr>
                                    <td><i class="la la-file-excel bold-green" ></i></td>
                                    <td class="text-center">3</td>
                                    <td class="text-center">Leave Request Report</td>
                                    <td class="text-center">View Leave requests for a specified period</td>
                                    <td class="text-center"><a href="{{route('employee_loan_report')}}"><i class="la la-download bold-green"></i></a></td>
                                </tr>

                                <tr>    
                                    <td><i class="la la-file-excel bold-green" ></i></td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">Employee Payroll Report</td>
                                    <td class="text-center">View payroll for a specified period</td>
                                    <td class="text-center"><a href="{{route('payslip.report')}}"><i class="la la-download bold-green"></i></a></td>
                                </tr>


                                <tr>    
                                    <td><i class="la la-file-excel bold-green" ></i></td>
                                    <td class="text-center">4</td>
                                    <td class="text-center">Employee Payslip Report</td>
                                    <td class="text-center">View payslip for a specified period</td>
                                    <td class="text-center"><a href="{{route('employees-payslip.report')}}"><i class="la la-download bold-green"></i></a></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
        <!-- /.col -->
</div>

       
@endsection