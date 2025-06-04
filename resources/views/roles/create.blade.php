@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="container">
                            <section id="basic-input">
                                <div class="card-body">
                                    <form method="post" action="{{ route('role.store') }}" autocomplete="off"
                                        class="form-horizontal" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">Role Name *</label>
                                                    <div class="col-sm-7">
                                                        <div class="form-group bmd-form-group is-filled">
                                                            <input class="form-control" name="name" type="text"
                                                                value="">
                                                            @error('name')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Submit') }}
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>


        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form'); 
            const roleNameInput = document.querySelector('input[name="name"]');

            form.addEventListener('submit', function(e) {
                const existingError = roleNameInput.parentElement.querySelector('.js-error');
                if (existingError) existingError.remove();
                if (!roleNameInput.value.trim()) {
                    e.preventDefault();
                    const error = document.createElement('div');
                    error.classList.add('js-error');
                    error.style.color = 'red';
                    error.style.fontSize = '0.875rem';
                    error.style.marginTop = '4px';
                    error.innerText = 'The role name field is required.';
                    roleNameInput.parentElement.appendChild(error);
                    roleNameInput.classList.add('is-invalid');
                } else {
                    roleNameInput.classList.remove('is-invalid');
                }
            });
        });
    </script>
@endsection
