@extends('layouts.master') {{-- Use your main layout --}}
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Edit Trainer</h4>
                </div>
                <form action="{{ route('trainer.update', $trainer->id) }}" method="POST">
                    @csrf
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $trainer->first_name) }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $trainer->last_name) }}"
                                class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number"
                                value="{{ old('contact_number', $trainer->contact_number) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $trainer->email) }}"
                                class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Expertise</label>
                            <textarea name="expertise" class="form-control" rows="2">{{ old('expertise', $trainer->expertise) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $trainer->address) }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-end mt-3">
                        <a href="{{ route('trainer.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Trainer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection