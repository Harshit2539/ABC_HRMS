@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <h3 class="fw-bold">Training Details</h3>
            <div class="row">
                <!-- Training Information Card -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Training Type:</strong> {{ $training->training_type }}</p>
                            <hr>
                            <p><strong>Trainer:</strong>
                                {{ $training->trainer ? $training->trainer->first_name . ' ' . $training->trainer->last_name : 'No Trainer Assigned' }}
                            </p>
                            <hr>
                            <p><strong>Start Date:</strong>
                                {{ \Carbon\Carbon::parse($training->start_date)->format('M d, Y') }}
                            </p>
                            <hr>
                            <p><strong>End Date:</strong>
                                {{ \Carbon\Carbon::parse($training->end_date)->format('M d, Y') }}
                            </p>
                            <hr>
                            <p><strong>Date:</strong>
                                {{ \Carbon\Carbon::parse($training->created_at)->format('M d, Y') }}
                            </p>
                            <hr>
                            <p><strong>Department:</strong> {{ $training->department ? $training->department->department : 'No Department Assigned' }}</p>
                            <hr>
                            <p>{{ $training->description }}</p>
                        </div>
                    </div>
                </div>
 
                <!-- Training Employee & Status Form Card -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Training Employees</div>
                        <div class="card-body">
                            <!-- Single Image and Comma-Separated Names -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://plus.unsplash.com/premium_vector-1682269287900-d96e9a6c188b?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-circle" width="100">
                                <strong class="ml-2">
                                    @if ($employee->isNotEmpty())
                                        {{ $employee->pluck('first_name')->zip($employee->pluck('last_name'))->map(fn($name) => $name[0] . ' ' . $name[1])->join(', ') }}
                                    @else
                                        No Employees Assigned
                                    @endif
                                </strong>
                            </div>
 
                            <h4>Update Performance/Status</h4>
                            <hr>
                            <br>
 
                            <form method="POST" action="{{ route('traininglist.updateStatus', $training->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Performance</label>
                                        <select class="form-control" name="performance">
                                            <option value="Not Concluded" {{ $training->performance == 'Not Concluded' ? 'selected' : '' }}>
                                                Not Concluded
                                            </option>
                                            <option value="Satisfactory" {{ $training->performance == 'Satisfactory' ? 'selected' : '' }}>
                                                Satisfactory
                                            </option>
                                            <option value="Average" {{ $training->performance == 'Average' ? 'selected' : '' }}>
                                                Average
                                            </option>
                                            <option value="Poor" {{ $training->performance == 'Poor' ? 'selected' : '' }}>
                                                Poor
                                            </option>
                                            <option value="Excellent" {{ $training->performance == 'Excellent' ? 'selected' : '' }}>
                                                Excellent
                                            </option>
                                        </select>
                                    </div>
 
                                    <div class="form-group col-md-6">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="Pending" {{ $training->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="Started" {{ $training->status == 'Started' ? 'selected' : '' }}>
                                                Started
                                            </option>
                                            <option value="Completed" {{ $training->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                            <option value="Terminated" {{ $training->status == 'Terminated' ? 'selected' : '' }}>
                                                Terminated
                                            </option>
                                        </select>
                                    </div>
 
                                    <div class="form-group col-md-12">
                                        <label>Remarks</label>
                                        <textarea class="form-control" name="remarks">{{ $training->remarks }}</textarea>
                                    </div>
                                </div>
 
                                <button type="submit" class="btn btn-danger">Save</button>
                                <a href="{{ route('traininglist.index') }}" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
 