@extends('layouts.master')
@section('content')

<div class="page-wrapper">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
          
                    <div class="card-header d-flex" style="justify-content:space-between;">
                        <div class="card-title">
                            <h3 class="main-heading">Manage<span>Roles</span></h3>
                        </div>
                        <div class="card-toolbar" style="align-content:center;">
                        <a href="{{route('create.role')}}" type="button"  class="btn btn-sm btn-fill btn-primary"><i class="fa fa-plus"></i>Add Role</a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable ProjectList" style="font-size:0.9em !important;"> 
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $roles)
                            <tr>
                                <td class="text-center" scope="row">{{$key + 1}}</td>
                                <td class="text-center">{{ $roles->name }}</td>
                                <td class="text-center">
                                <a href="{{url('edit/role')}}/{{$roles->id}}"   class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    
    </div>

</div>
@endsection