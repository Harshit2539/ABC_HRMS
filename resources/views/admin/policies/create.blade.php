@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Create Company Policy</h4>
                </div>
 
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Please fix the errors below.<br><br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
 
                    <div class="row">
                        <!-- Form Section (6 columns) -->
                        <div class="col-lg-6 col-md-12">
                            <form action="{{ route('policies.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Policy Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="policy_name" class="form-control"
                                        value="{{ old('policy_name') }}" required>
                                </div>
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description <span
                                            class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                                </div>
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Serial No <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="serial_no" class="form-control"
                                        value="{{ old('serial_no') }}" required>
                                </div>
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Company Policy Category <span
                                            class="text-danger">*</span></label>
                                    <select name="policy_category" class="form-select form-control" required>
                                        <option value="">Select Category</option>
                                        <option value="General Policy"
                                            {{ old('policy_category') == 'General Policy' ? 'selected' : '' }}>General
                                            Policy</option>
                                        <option value="Internal Policy"
                                            {{ old('policy_category') == 'Internal Policy' ? 'selected' : '' }}>Internal
                                            Policy</option>
                                    </select>
                                </div>
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload File</label>
                                    <input type="file" name="upload_file" class="form-control">
                                </div>
 
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="release_to_ess"
                                        id="release_to_ess" value="1" {{ old('release_to_ess') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="release_to_ess">Release to employee self service
                                        portal</label>
                                </div>
 
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Employee Filter</label>
                                    <select name="employee_filter" class="form-select form-control">
                                        <option value="All Current Employees"
                                            {{ old('employee_filter') == 'All Current Employees' ? 'selected' : '' }}>All
                                            Current Employees</option>
                                    </select>
                                </div>
 
                                <div class="mb-3">
                                    <p><strong>Note:</strong> Enforcing the policy ensures that employees read and
                                        acknowledge the policy before using ESS.</p>
                                    <a href="#">Enforce this policy</a>
                                </div>
                                {{-- <div class="d-flex justify-content-end"> --}}
                                    <a href="{{ route('policies.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                {{-- </div> --}}
                            </form>
                        </div>
 
                        <!-- Help Section (6 columns) -->
                        <div class="col-lg-6 col-md-6 w-100">
                            <div style="background-color: #fff9db" class="p-4 rounded w-100">
                                <h5 class="fw-bold mb-4">What is Company Policy?</h5>
                                <ul class="mb-0 ps-4 small">
                                    <li>Policies outline the benefits and opportunities your company provides to employees.
                                    </li>
                                    <li>They define rules/regulations for accountability, health, safety, and customer
                                        interaction.</li>
                                    <li>Create HR documents like Employee Handbook, Leave Policy, or IT Policy based on
                                        needs.</li>
                                    <li>Release HR policies to employees using the filter.</li>
                                    <li class="text-danger">Note: Cancel any enforced policy to enable the “Release to ESS”
                                        option.</li>
                                </ul>
                            </div>
                        </div>
 
                    </div>
 
                </div>
            </div>
        </div>
    </div>
@endsection