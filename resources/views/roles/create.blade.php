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
                                <form method="post" action="{{route('role.store')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body ">
                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Role Name</label>
                                                <div class="col-sm-7">
                                                    <div class="form-group bmd-form-group is-filled">
                                                        <input class="form-control" name="name" type="text" value="" required="">
                                                        @error('name')
                                                        {{$message}}
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


@endsection