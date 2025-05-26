@extends('layouts.master')
 
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
 
 
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
                    <h3 id="all" class="main-heading">Reimbursement<span>Apply For Your Reimburs Amount ?</span></h3>
                </div>
            </div>
            <div class="mt-4 card shadow-sm p-3">
                <p>Fill the form to get Your reimburs amount !...</p>
 
 
                <form action="{{ route('reimburs.store') }}" method="POST">
                    @csrf
 
                    @php
                        use Illuminate\Support\Facades\Auth;
                        use App\Models\Employee;
 
                        $user = Auth::user();
                        $isAdmin = $user->role_name === 'Admin';
                        $employee = Employee::where('employee_id', $user->id)->first();
                    @endphp
 
                    <div class="form-group">
                        <label for="employee_id">For Employee:</label>
 
                        @if ($isAdmin)
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="">-- Select Employee --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <select name="employee_id" id="employee_id" class="form-control" disabled>
                                <option value="{{ $employee->id }}" selected >
                                    {{ $employee->first_name .' '. $employee->last_name }}
                                </option>
                            </select>
                            <input type="hidden" name="employee_id" value="{{ $employee->id }} " >
                        @endif
                    </div>
 
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="from_location">From Location:</label>
                            <input type="text" name="from_location" id="from_location" class="form-control" required>
                        </div>
 
 
                        <div class="form-group col-md-6">
                            <label for="to_location">To Location:</label>
                            <input type="text" name="to_location" id="to_location" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_of_visit">Date of Visit:</label>
                            <input type="date" name="date_of_visit" id="date_of_visit" class="form-control" required>
                        </div>
 
 
                        <div class="form-group col-md-6">
                            <label for="amount">Amount:</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="0.01"
                                required>
                        </div>
                    </div>
 
 
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
 
 
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('reimburs.index') }}" class="btn btn-secondary">Cancel</a>
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
@endsection
 
 