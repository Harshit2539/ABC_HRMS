@extends('layouts.master')
 
@section('content')
    <style>
        .percentage_container {
            display: none;
        }
    </style>
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Salary Component</h4>
                </div>
 
                {{-- @dump( json_encode($salary_component_list,JSON_PRETTY_PRINT)) --}}
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('update.salary.component', $salary_component_list->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Component Name <span class="text-danger">*</span></label>
                            <input type="text" name="component_name"
                                value="{{ old('component_name', $salary_component_list->component_name) }}"
                                class="form-control @error('component_name') is-invalid @enderror" required>
 
                            @error('component_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
 
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Component Type<span class="text-danger">*</span></label>
                                <select name="component_type" class="form-control" required>
                                    <option value="earning"
                                        {{ $salary_component_list->component_type == 'earning' ? 'selected' : '' }}>Earning
                                    </option>
                                    <option value="deduction"
                                        {{ $salary_component_list->component_type == 'deduction' ? 'selected' : '' }}>
                                        Deduction</option>
                                </select>
                            </div>
 
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Component Value Type<span class="text-danger">*</span></label>
                                <select name="component_value_type" id="component_value_type" class="form-control" required>
                                    <option value="1"
                                        {{ $salary_component_list->component_value_type == '1' ? 'selected' : '' }}>Fixed
                                    </option>
                                    <option value="2"
                                        {{ $salary_component_list->component_value_type == '2' ? 'selected' : '' }}>Variable
                                    </option>
                                    <option value="3"
                                        {{ $salary_component_list->component_value_type == '3' ? 'selected' : '' }}>Basic
                                        Percent</option>
                                    <option value="4"
                                        {{ $salary_component_list->component_value_type == '4' ? 'selected' : '' }}>CTC
                                        Percent</option>
                                </select>
                            </div>
                        </div>
 
                        <div class="mb-3 ">
                            <div class="percentage_container" >
 
                                <label for="monthly_percentage" class="form-label">Monthly Percentage</label>
                                <input type="number" name="monthly_percentage"  id="monthly_percentage"
                                    value="{{ old('monthly_percentage', $salary_component_list->monthly_percentage) }}"
                                    class="form-control" min="0" max="100"/>
                            </div>
 
                            <div class="amount_container" >
                                <label for="monthly_amount" class="form-label">Monthly Amount</label>
                                <input type="number" name="monthly_amount" id="monthly_amount"
                                    value="{{ old('monthly_amount', $salary_component_list->monthly_amount) }}"
                                    class="form-control" />
                            </div>
                        </div>
 
                        <button type="submit" class="btn btn-danger">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
    <script>
          $(document).ready(function() {
            $('#component_value_type').trigger('change');
        });
        $(document).on('change', '#component_value_type', function(e) {
 
            let valueType = $(this).val();
 
            if (valueType == 1 || valueType == 2) {
                $('.percentage_container').hide();
                $('.amount_container').show();
                $('#monthly_percentage').removeAttr('required');
                $('#monthly_amount').prop('required', true);
            } else if (valueType == 3 || valueType == 4) {
                $('.amount_container').hide();
                $('.percentage_container').show();
                $('#monthly_amount').removeAttr('required');
                $('#monthly_percentage').prop('required', true);
            }
        })
 
    </script>
@endsection
 
 
 