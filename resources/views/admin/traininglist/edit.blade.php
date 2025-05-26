@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <h3>Update Training Details</h3>
            <hr>
            <form action="{{ route('traininglist.update', $training->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6"> <label>Training Type*</label>
                        <select name="training_type" class="form-control" required>
                            <option value="Internal" {{ $training->training_type == 'Internal' ? 'selected' : '' }}>Internal
                            </option>
                            <option value="External" {{ $training->training_type == 'External' ? 'selected' : '' }}>External
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6"> <label>Trainer*</label>
                        <select name="trainer_id" class="form-control" required>
                            @foreach ($trainers as $id => $name)
                                <option value="{{ $id }}" {{ $training->trainer_id == $id ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6"> <label>Status*</label>
                        <select name="status" class="form-control" required>
                            <option value="Pending" {{ $training->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Started" {{ $training->status == 'Started' ? 'selected' : '' }}>Started</option>
                            <option value="Completed" {{ $training->status == 'Completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="Terminated" {{ $training->status == 'Terminated' ? 'selected' : '' }}>Terminated
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Select Department*</label>
                        <select class="form-control" id="department_dropdown" name="department_id" required>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}"
                                {{ $training->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->department }}
                            </option>
                        @endforeach
 
                        </select>
                    </div>
 
 
                    <div class="form-group col-md-6"> <label>Employee*</label>
                        <select id="employee_id" name="employee_id" class="form-control" required>
                            @foreach ($employees as $id => $name)
                                <option value="{{ $id }}" {{ $training->employee_id == $id ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6"> <label>Start Date*</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $training->start_date }}"
                            required>
                    </div>
                    <div class="form-group col-md-6"> <label>End Date*</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $training->end_date }}"
                            required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Performance</label>
                        <select class="form-control" name="performance">
                            <option value="Not Concluded"
                                {{ $training->performance == 'Not Concluded' ? 'selected' : '' }}>Not
                                Concluded
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
                    <div class="form-group col-md-6"> <label>Remarks</label>
                        <textarea name="remarks" class="form-control">{{ $training->remarks }}</textarea>
                    </div>
                    <div class="form-group col-md-6"> <label>Description</label>
                        <textarea name="description" class="form-control">{{ $training->description }}</textarea>
                    </div>
                </div>
                    <button type="submit" class="btn btn-danger">Update</button>
                    <a href="{{ route('traininglist.index') }}" class="btn btn-danger ">Cancel</a>
            </form>
        </div>
    </div>
    <Script>
       $(document).on('change', '#department_dropdown', function(e) {
            e.preventDefault();
            departmentID = $(this).val();
 
 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
 
            $.ajax({
                url: "{{ route('get.employees') }}",
                type: 'GET',
                data: {
                    department_id: departmentID
                },
                success: function(response) {
 
                    if (response.status == true) {
 
                        $('#employee_id').empty();
 
                        response.employees.forEach(el => {
                            const newOption = document.createElement('option');
                            newOption.value = el.id;
 
                            newOption.textContent = el.first_name +' '+ el.last_name;
                            document.getElementById('employee_id').appendChild(newOption);
                        });
 
                    };
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                    console.log('Status:', status);
                    console.log('Response Text:', xhr.responseText);
                    alert('An error occurred');
 
                }
            });
 
        })
    </Script>
@endsection
 
 