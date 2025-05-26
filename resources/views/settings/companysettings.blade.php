@extends('layouts.master')
<style>
    form {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
    }
 
    label {
        font-weight: 600;
        color: #333;
    }
 
    input.form-control,
    select.form-control {
        border-radius: 8px;
        box-shadow: none;
        border-color: #ccc;
        transition: all 0.3s ease-in-out;
    }
 
    input.form-control:focus,
    select.form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.1rem rgba(0, 123, 255, 0.25);
    }
 
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        padding: 8px 20px;
        font-weight: bold;
    }
 
    .btn-primary:hover {
        background-color: #0056b3;
    }
 
    .submit-section {
        margin-top: 20px;
    }
 
    input[type="file"] {
        padding: 6px;
        background: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
</style>
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid mt-4 ">
            @if (session('success'))
                <div id="success-alert" class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div id="error-alert" class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
 
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">
                    <h3 id="all" class="main-heading">Company Settings<span>Edit Your Company Settings here ?</span>
                    </h3>
                </div>
            </div>
            <div id="validation-alert" class="alert alert-danger mt-3" style="display: none;">
                Please fill in all required fields marked with *
            </div>
 
            <div class="mt-4 card shadow-sm p-3">
                <p>Fill the form to update Your company settings !...</p>
 
                <form action="{{ route('company.store') }}" method="POST">
                    @csrf
 
                    <div class="row mb-3">
                        <div class="col">
                            <label>Company Name *</label>
                            <input type="text" name="company_name" class="form-control"
                                value="{{ old('company_name', $company->company_name ?? '') }}">
                        </div>
                        <div class="col">
                            <label>Contact Person *</label>
                            <input type="text" name="contact_person" class="form-control"
                                value="{{ old('contact_person', $company->contact_person ?? '') }}">
                        </div>
                    </div>
 
                    <div class="mb-3">
                        <label>Address *</label>
                        <input type="text" name="address" class="form-control"
                            value="{{ old('address', $company->address ?? '') }}">
                    </div>
 
                    <div class="row mb-3">
                        <div class="col">
                            <label>Country *</label>
                            <select name="country" class="form-control">
                                <option value="" class="text-muted">--Select Your Country--</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country', $company->country ?? '') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>City *</label>
                            <input type="text" name="city" class="form-control"
                                value="{{ old('city', $company->city ?? '') }}">
                        </div>
                        <div class="col">
                            <label>State/Province</label>
                            <input type="text" name="state_province" class="form-control"
                                value="{{ old('state_province', $company->state_province ?? '') }}">
                        </div>
                        <div class="col">
                            <label>Postal Code</label>
                            <input type="number" name="postal_code" class="form-control"
                                value="{{ old('postal_code', $company->postal_code ?? '') }}">
                        </div>
                    </div>
 
                    <div class="row mb-3">
                        <div class="col">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $company->email ?? '') }}">
                        </div>
                        <div class="col">
                            <label>Phone Number</label>
                            <input type="number" name="phone_number" class="form-control"
                                value="{{ old('phone_number', $company->phone_number ?? '') }}">
                        </div>
                    </div>
 
                    <div class="row mb-3">
                        <div class="col">
                            <label>Mobile Number *</label>
                            <input type="number" name="mobile_number" class="form-control"
                                value="{{ old('mobile_number', $company->mobile_number ?? '') }}">
                        </div>
                        <div class="col">
                            <label>Fax</label>
                            <input type="number" name="fax" class="form-control"
                                value="{{ old('fax', $company->fax ?? '') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="logoImage">Logo Image *</label>
                                <input id="logoImage" name="logo_image_url" class="form-control" type="file"
                                    accept="image/*" value="{{ old('logo_image_url', $company->logo_image_url ?? '') }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dashboardImage">Dashboard Image</label>
                                <input id="dashboardImage" name="dashboard_image_url" class="form-control" type="file"
                                    accept="image/*"
                                    value="{{ old('dashboard_image_url', $company->dashboard_image_url ?? '') }}">
                            </div>
                        </div>
                    </div>
 
                     <div class="mb-3">
                        <label>Website URL *</label>
                        <input type="url" name="website_url" class="form-control"
                            value="{{ old('website_url', $company->website_url ?? '') }}">
                    </div>
 
                    <button type="submit" class="btn btn-danger">Save</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-alert').fadeOut('slow');
            }, 1000);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const validationAlert = document.getElementById('validation-alert');
 
            form.addEventListener('submit', function(e) {
                let isValid = true;
                let requiredFields = [
                    'company_name',
                    'contact_person',
                    'address',
                    'country',
                    'city',
                    'email',
                    'mobile_number',
                    'logo_image_url',
                    'website_url'
                ];
 
                requiredFields.forEach(field => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (input) {
                        if (input.type === 'file') {
                            const existingLogo = '{{ $company->logo_image_url ?? '' }}';
                            if (!input.files.length && !existingLogo) {
                                isValid = false;
                                input.classList.add('is-invalid');
                            } else {
                                input.classList.remove('is-invalid');
                            }
                        } else {
                            if (!input.value.trim()) {
                                isValid = false;
                                input.classList.add('is-invalid');
                            } else {
                                input.classList.remove('is-invalid');
                            }
                        }
                    }
                });
 
                if (!isValid) {
                    e.preventDefault();
                    validationAlert.style.display = 'block';
 
                    validationAlert.scrollIntoView({
                        behavior: 'smooth'
                    });
                    setTimeout(() => {
                        validationAlert.style.display = 'none';
                    }, 10000);
                } else {
                    validationAlert.style.display = 'none';
                }
            });
        });
    </script>
@endsection