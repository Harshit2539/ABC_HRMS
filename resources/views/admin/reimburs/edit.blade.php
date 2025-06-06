@extends('layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="page-wrapper">
        <div class="container-fluid mt-4">
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
                    <h3 id="all" class="main-heading">Edit Reimbursement<span>Update your reimbursement request</span>
                    </h3>
                </div>
            </div>

            <div class="mt-4 card shadow-sm p-3">
                <form action="{{ route('reimburs.update', $reimburs->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        use Illuminate\Support\Facades\Auth;

                        $user = Auth::user();
                        $isAdmin = $user->role_name === 'Admin';
                        $employee = App\Models\Employee::where('employee_id', $user->id)->first();
                    @endphp

                    <div class="form-group">
                        <label for="employee_id">For Employee</label><span style="color: red"> *</span>

                        @if ($isAdmin)
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="">-- Select Employee --</option>
                                @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}"
                                        {{ $reimburs->employee_id == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->first_name . ' ' . $emp->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="employee_id" id="employee_id" class="form-control" disabled>
                                <option value="{{ $employee->id }}" selected>
                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                </option>
                            </select>
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="from_location">From Location</label><span style="color: red"> *</span>
                            <input type="text" name="from_location" id="from_location" class="form-control"
                                value="{{ old('from_location', $reimburs->from_location) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="to_location">To Location</label><span style="color: red"> *</span>
                            <input type="text" name="to_location" id="to_location" class="form-control"
                                value="{{ old('to_location', $reimburs->to_location) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_of_visit">Date of Visit</label><span style="color: red"> *</span>
                            <input type="date" name="date_of_visit" id="date_of_visit" class="form-control"
                                value="{{ old('date_of_visit', $reimburs->date_of_visit) }}" max="{{ date('Y-m-d') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label><span style="color: red"> *</span>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                                value="{{ old('amount', $reimburs->amount) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $reimburs->description) }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('reimburs.details') }}" class="btn btn-secondary">Cancel</a>
                    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const fieldsToValidate = [
            { id: 'employee_id', message: 'Please select an employee' },
            { id: 'from_location', message: 'From Location is required' },
            { id: 'to_location', message: 'To Location is required' },
            { id: 'date_of_visit', message: 'Date of Visit is required' },
            { id: 'amount', message: 'Amount is required' }
        ];

        form.addEventListener('submit', function (e) {
            let isValid = true;

            fieldsToValidate.forEach(({ id, message }) => {
                const field = document.getElementById(id);
                const errorId = `${id}-error`;

           
                const existingError = document.getElementById(errorId);
                if (existingError) existingError.remove();
                field.style.border = '';

                if (!field.disabled && (!field.value || field.value.trim() === '')) {
                    isValid = false;
                    field.style.border = '1px solid red';

                    const errorSpan = document.createElement('span');
                    errorSpan.id = errorId;
                    errorSpan.style.color = 'red';
                    errorSpan.style.fontSize = 'small';
                    errorSpan.textContent = message;
                    field.parentNode.appendChild(errorSpan);
                }
            });


            const amountField = document.getElementById('amount');
            const negativeErrorId = 'amount-negative-error';
            const existingNegative = document.getElementById(negativeErrorId);
            if (existingNegative) existingNegative.remove();
            amountField.style.border = '';

            if (!amountField.disabled && parseFloat(amountField.value) < 0) {
                isValid = false;
                amountField.style.border = '1px solid red';

                const errorSpan = document.createElement('span');
                errorSpan.id = negativeErrorId;
                errorSpan.style.color = 'red';
                errorSpan.style.fontSize = 'small';
                errorSpan.textContent = 'Amount cannot be negative.';
                amountField.parentNode.appendChild(errorSpan);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

      
        fieldsToValidate.forEach(({ id }) => {
            const field = document.getElementById(id);
            field.addEventListener('input', () => {
                const errorId = `${id}-error`;
                const error = document.getElementById(errorId);
                if (field.value.trim() !== '') {
                    if (error) error.remove();
                    field.style.border = '';
                }
            });
        });


        const amountField = document.getElementById('amount');
        amountField.addEventListener('input', () => {
            const negativeError = document.getElementById('amount-negative-error');
            if (parseFloat(amountField.value) >= 0) {
                if (negativeError) negativeError.remove();
                amountField.style.border = '';
            }
        });
    });
</script>

@endsection
