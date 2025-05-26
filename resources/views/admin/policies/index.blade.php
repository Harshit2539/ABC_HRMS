@extends('layouts.master')
 
@section('content')
    <div class="page-wrapper">
        <div class=" container-fluid mt-4 ">
            <!-- Header -->
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <div class="card-title mb-0">
                    <h4 id="all" class="main-heading">Company Policies<span>Check Out your Company Policies ?</span></h4>
                </div>
                <div class="d-flex align-items-center">
 
                </div>
            </div>
 
 
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="fw-bold">We've got it sorted for you!</h4>
 
                <div>
                    <p class="text-muted">
                        All Company Policies are now in one place. <br>
                        You can now create or manage policies with ease.
 
                        <img src="https://img.freepik.com/free-vector/business-policy-concept-illustration_114360-7853.jpg"
                            alt=""
                            style="width: 200px; height: auto; display: block; margin-left: auto; margin-right: 0;">
                    </p>
                </div>
            </div>
 
            <!-- Policies Section -->
            <h5 class="fw-bold">Policies</h5>
            <div class="row">
                <div class="col-md-5">
                    <div class="card text-center shadow-sm p-3">
                        <h6>Create New Policy</h6>
                        <a href="{{ route('policies.create') }}" class="text-primary">Create</a>
                    </div>
                </div>
                <!-- <div class="col-md-3">
                <div class="card text-center shadow-sm p-3">
                    <h6>Search Policies</h6>
                    <input class="border border-gray-300 rounded px-2 py-1 w-100" placeholder="Search Policies" type="text" name="search" />
                </div>
            </div> -->
            </div>
 
            <!-- Policy List -->
            <div class="mt-4">
                <h5 class="fw-bold">Policy Details</h5>
                <div class="bg-white shadow-sm rounded p-4">
                    <div class="row">
                        @foreach ($policies as $policy)
                            <div class="col-md-6">
                                <div class="border border-gray-300 rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-bold">{{ $policy->name }}</h6>
                                        <!-- <a href="{{ route('policies.download', $policy->id) }}" class="btn btn-info btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a> -->
 
                                        <a href="{{ asset($policy->upload_file) }}" download class="btn btn-info btn-sm"><i
                                                class="fa fa-download" aria-hidden="true"></i></a>
                                    </div>
                                    <p>Published for: <strong>{{ $policy->relative_to }}</strong></p>
                                    <p>Description: {{ $policy->description }}</p>
                                    <p>Last Modified on: <strong>{{ $policy->updated_at->format('d M, Y') }}</strong></p>
                                    <div class="mt-2 d-flex gap-2" style="justify-content:space-between;">
                                        <a href="{{ route('policies.edit', $policy->id) }}"
                                            class="btn btn-primary btn-sm">View/Edit</a>
                                        <form action="{{ route('policies.destroy', $policy->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"
                                                    aria-hidden="true"></i> </button>
                                        </form>
 
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection