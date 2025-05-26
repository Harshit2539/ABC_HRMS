@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h4 id="all" class="main-heading">Document Center <span>Check Out your documents ?</span></h4>
                </div>
                <div class="d-flex align-items-center">
 
                </div>
            </div>
 
 
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="fw-bold">We've got it sorted for you!</h4>
 
                <div>
                    <p class="text-muted">
                        All Documents are now in one place. <br>
                        You can now request a new letter if you don’t find the one you were looking for.
 
                        <img src="https://img.freepik.com/free-vector/bill-analysis-concept-illustration_114360-22918.jpg?t=st=1742882681~exp=1742886281~hmac=aed445050afe4ba234e6888166349f3c5d50ee6b40f382c7de2041282bf68f71&w=740"
                            alt=""
                            style="width: 180px; height: auto; display: block; margin-left: auto; margin-right: 0;">
                    </p>
                </div>
 
            </div>
 
            <!-- Documents Section -->
            <h5 class="fw-bold">Documents</h5>
            <div class="row">
 
                <!-- <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Documents</h6>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Payslips</h6>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Form 16</h6>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                </div> -->
                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Company Policies</h6>
                        <a href="{{ route('document.policies') }}" class="text-primary">View All</a>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Payslips</h6>
                        <a href="{{ route('document.payslip') }}" class="text-primary">View All</a>
                    </div>
                </div>
                <!-- <div class="col-md-3 mt-3">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Forms</h6>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                </div> -->
            </div>
 
            <!-- Requests Section -->
            <!-- <div class="mt-4">
                <h5 class="fw-bold">Request</h5>
                <div class="card shadow-sm p-3">
                    <h6>Letters</h6>
                    <span class="text-muted">Pending: 0 | Closed: 0</span>
                    <a href="#" class="text-primary mt-2 d-block">View All</a>
                </div>
            </div> -->
        </div>
 
 
    </div>
@endsection