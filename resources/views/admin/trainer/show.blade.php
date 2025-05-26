@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Trainer Details</h5>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">← Back</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th>First Name</th>
                            <td>{{ $trainer->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $trainer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $trainer->contact_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $trainer->email }}</td>
                        </tr>
                        <tr>
                            <th>Expertise</th>
                            <td>{{ $trainer->expertise ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $trainer->address ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
 
 