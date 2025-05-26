@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
 
            <div class="card card-header d-flex justify-content-between text-sm mb-3"
                style="background-color: #f0f2f5; border-radius: 0.75rem; border: none;">
                <div class="card-title mb-0">
                    <h4 id="all" class="main-heading" style="font-size: 1.5rem; font-weight: 600;">
                        Employee Information
                        <span style="display: block; font-size: 0.85rem; color: #777;">Ready to dive in ?</span>
                    </h4>
                </div>
            </div>
 
            <div style="font-family: 'Segoe UI', sans-serif; font-size: 14px; background-color: #f8f9fa; padding: 1rem;">
                <div class="row">
                    <div class="col-md-2 d-none d-md-block" style="position: sticky; top: 100px; height: fit-content;">
                        <div style="padding-top: 20px;">
                            <a href="#Personal" class="text-primary" style="text-decoration: none;">
                                <p><strong>Personal</strong></p>
                            </a>
                            <a href="#Accounts" class="text-primary" style="text-decoration: none;">
                                <p><strong>Accounts & Statutory</strong></p>
                            </a>
                            <a href="#Family" class="text-primary" style="text-decoration: none;">
                                <p><strong>Family</strong></p>
                            </a>
                            <a href="#Employment" class="text-primary" style="text-decoration: none;">
                                <p><strong>Employment & Job</strong></p>
                            </a>
                        </div>
                    </div>
 
                    <div class="col-md-10">
                        <!-- Profile -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Profile" style="background-color: #f0f2f5; font-weight: bold;">
                                PROFILE</div>
                            <div class="card-body d-flex" style="background-color: #ffffff;">
                                <div class="me-4">
                                    <img src="https://storage.googleapis.com/a1aa/image/e40b9db7-8cc9-4f02-23bf-e2c7b449ab53.jpg"
                                        class="rounded-circle" style="border: 2px solid #dee2e6;" width="180"
                                        height="180" alt="Profile">
                                </div>
                                <div style="padding: inherit">
                                    <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
                                    <p><strong>Employee ID:</strong> {{ $employee->olm_id }}</p>
                                    <p><strong>Company Email:</strong> <a href="mailto:{{ $employee->work_email }}"
                                            class="text-primary">{{ $employee->work_email }}</a></p>
                                    <p><strong>Location:</strong> {{ $employee->city ?? '—' }}</p>
                                    <p><strong>Primary Contact No.:</strong> {{ $employee->mobile_phone ?? '—' }}</p>
                                    <p><strong>Extension:</strong> —</p>
                                </div>
                            </div>
                        </div>
 
                        <!-- Personal -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Personal" style="background-color: #f0f2f5; font-weight: bold;">
                                PERSONAL</div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <div class="row">
                                    @php
                                        $personalInfo = [
                                            ['label' => 'Blood Group', 'value' => 'A +iv'],
                                            [
                                                'label' => 'Date of Birth',
                                                'value' => $employee->birthday
                                                    ? Carbon\Carbon::parse($employee->birthday)->format('d M, Y')
                                                    : '—',
                                            ],
                                            ['label' => 'Nationality', 'value' => $nationality->name ?? '—'],
                                            ['label' => 'Marital Status', 'value' => $employee->marital_status ?? '—'],
                                            ['label' => 'Marriage Date', 'value' => '—'],
                                            ['label' => 'Spouse', 'value' => '—'],
                                            ['label' => 'Place of Birth', 'value' => $employee->city ?? '—'],
                                            ['label' => 'Residential Status', 'value' => $country->namecap ?? '—'],
                                            ['label' => 'Gender', 'value' => $employee->gender ?? '—'],
                                            ['label' => 'Religion', 'value' => '—'],
                                            ['label' => 'Physically Challenged', 'value' => 'No'],
                                            ['label' => 'International Employee', 'value' => 'No'],
                                            ['label' => 'Height', 'value' => '—'],
                                            ['label' => 'Weight', 'value' => '—'],
                                            ['label' => 'Private Email', 'value' => $employee->private_email ?? '—'],
                                        ];
                                    @endphp
 
                                    @foreach ($personalInfo as $info)
                                        <div class="col-md-4 mb-2">
                                            <strong
                                                style="min-width: 130px; display: inline-block; color: #333;">{{ $info['label'] }}:</strong>
                                            {{ $info['value'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
 
                        <!-- Address -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header d-flex justify-content-between align-items-center" id="Address"
                                style="background-color: #f0f2f5; font-weight: bold;">
                                <span>ADDRESS</span>
                            </div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <div class="row">
                                    @php
                                        $addressInfo = [
                                            [
                                                'label' => 'Address',
                                                'value' =>
                                                    trim(
                                                        $employee->address1 .
                                                            ' ' .
                                                            $employee->address2 .
                                                            ' ' .
                                                            $employee->city,
                                                    ) ?:
                                                    '—',
                                            ],
                                            ['label' => 'Postal Code', 'value' => $employee->postal_code ?? '—'],
                                            [
                                                'label' => 'Name',
                                                'value' => $employee->first_name . ' ' . $employee->last_name ?? '—',
                                            ],
                                            ['label' => 'Phone 1', 'value' => $employee->work_phone ?? '—'],
                                            ['label' => 'Phone 2', 'value' => $employee->home_phone ?? '—'],
                                            ['label' => 'Mobile', 'value' => $employee->mobile_phone ?? '—'],
                                            [
                                                'label' => 'Email',
                                                'value' => $employee->work_email
                                                    ? '<a href="mailto:' .
                                                        e($employee->work_email) .
                                                        '" class="text-primary">' .
                                                        e($employee->work_email) .
                                                        '</a>'
                                                    : '—',
                                            ],
                                        ];
                                    @endphp
 
                                    @foreach ($addressInfo as $info)
                                        <div class="col-md-4 mb-2">
                                            <strong
                                                style="min-width: 130px; display: inline-block; color: #333;">{{ $info['label'] }}:</strong>
                                            {!! $info['value'] !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
 
                        <!-- Education -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Education" style="background-color: #f0f2f5; font-weight: bold;">
                                EDUCATION</div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <p><strong>Degree:</strong> —</p>
                                <p><strong>Institute:</strong> —</p>
                                <p><strong>Duration:</strong> —</p>
                                <p><strong>Grade:</strong> —</p>
                            </div>
                        </div>
 
                        <!-- Accounts -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Accounts" style="background-color: #f0f2f5; font-weight: bold;">
                                Accounts</div>
                            {{-- BANK ACCOUNT --}}
                            <div class="card-body d-flex justify-content-between">
                                <div>
                                    <h6>Bank Name</h6>
                                    <p>—</p>
                                </div>
                                <div>
                                    <h6>Bank Account Number</h6>
                                    <p>—</p>
                                </div>
                                <div>
                                    <h6>Bank Branch</h6>
                                    <p>—</p>
                                </div>
                                <div style="color: #0096ff; cursor: pointer;">More</div>
                            </div>
 
 
 
                            <div class="card-body d-flex justify-content-between flex-wrap">
                                <div>
                                    <h6>PF Number</h6>
                                    <p>—</p>
                                </div>
                                <div>
                                    <h6>UAN</h6>
                                    <p>—</p>
                                </div>
                                <div>
                                    <h6>PF Join Date</h6>
                                    <p>—</p>
                                </div>
                                <div>
                                    <h6>Eligibility</h6>
                                    <span class="badge bg-success">ELIGIBLE</span>
                                </div>
                                <div>
                                    <h6>KYC Status</h6>
                                    <p><input type="checkbox" disabled> —</p>
                                </div>
                                <div>
                                    <h6>KYC Document</h6>
                                    <p>—</p>
                                </div>
                                <div style="color: #0096ff; cursor: pointer;">More</div>
                            </div>
 
 
 
                            <div class="card-body">
                                <h6>AADHAAR</h6>
                                <p>************** <span class="ms-4">Verified</span></p>
 
                                <hr>
 
                                <h6>Permanent Account Number</h6>
                                <p class="mb-0">— <span class="text-danger ms-4">—</span></p>
 
                                <div class="mt-2" style="color: #0096ff; cursor: pointer;">More</div>
                            </div>
                        </div>
 
                        <!-- Family -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Family" style="background-color: #f0f2f5; font-weight: bold;">
                                Family
                            </div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <h5 class="text-muted">Father</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Name</strong><br>
                                        —
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Date of Birth</strong><br>
                                        —
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Blood Group</strong><br>
                                        —
                                    </div>
 
 
                                    <div class="col-md-4">
                                        <strong>Gender</strong><br>
                                        —
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Nationality</strong><br>
                                        {{$nationality->name ?? '—'}}
                                    </div>
 
                                </div>
                            </div>
                        </div>
 
                        <!-- Employment -->
                        <div class="card mt-3"
                            style="border-radius: 0.75rem; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); border: none;">
                            <div class="card-header" id="Employment"
                                style="background-color: #f0f2f5; font-weight: bold;">
                                Employment
                            </div>
 
                            <div class="card-body" style="background-color: #ffffff;">
                                <!-- Current Position -->
                                <div class="card mb-4">
                                    <div
                                        class="card-header bg-warning-subtle d-flex justify-content-between align-items-center" style="background-color: #fffbe1">
                                        <span>Current Position</span>
                                        <div>
                                            <button class="btn btn-link" style="color: #259df3">Resign</button>
                                            <button class="btn btn-primary btn-sm">View Timeline</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <strong>Department</strong><br>
                                                {{ $department->department ?? '—' }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Designation</strong><br>
                                                 {{ $job->name ?? '—' }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Location</strong><br>
                                                {{ $employee->city ?? '—' }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Manager</strong><br>
                                                 {{ $approver->name ?? '—' }}
                                            </div>
                                            <div class="col-md-4">
                                                <strong>Work Location</strong><br>
                                                —
                                            </div>
                                        </div>
                                    </div>
                                </div>
 
                                <!-- Previous Employment -->
                                <div class="card">
                                    <div class="card-header">Previous Employment</div>
                                    <div class="card-body">
                                        <div class="row align-items-center mb-2">
                                            <div class="col-md-1">
                                                <img src="https://images.unsplash.com/photo-1620288627223-53302f4e8c74?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                                    alt="Company Logo" width="32" height="32" class="rounded">
                                            </div>
                                            <div class="col-md-5">
                                                <strong>IT Service</strong><br>
                                                 {{ $job->name ?? '—' }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Duration</strong><br>
                                               — To —
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
 