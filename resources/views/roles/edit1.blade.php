@extends('layouts.master')
@section('content')

<div class="page-wrapper">
   <div class="container-fluid mt-4">
      <div class="row">
         <div class="col-12">
            <div class="card">

               <div class="card-header">
                  <div class="card-title">
                     <!-- <h3 class="card-label">Projects</h3> -->
                  </div>
                  <div class="card-toolbar">
                     <h3>Edit Role</h3>

                  </div>
               </div>


               <div class="container">



                  <div class="card-body">
                     <form method="post" action="{{url('update/role',$role->id)}}" autocomplete="off" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                           <div class="card-body">
                              <div class="row">
                                 <label class="col-sm-2 col-form-label">Role Name</label>
                                 <div class="col-sm-7">
                                    <div class="form-group bmd-form-group is-filled">
                                       <input class="form-control" name="name" type="text" value="{{$role->name}}"
                                          placeholder="role" value="" required="">
                                       @error('name')
                                       {{$message}}
                                       @enderror
                                    </div>
                                 </div>
                              </div>
                              <div class="row mb-0">
                                 <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Update
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                     <div class="row">
                        @if(Session::has('message'))
                        <div class="demo-spacing-0">
                           <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                              <div class="alert-body">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-info mr-50 align-middle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                 </svg>
                                 <span>{{Session::get('message')}}</span>
                              </div>
                           </div>
                        </div>
                        @endif

                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <form method="post" action="{{route('admin.roles.permissions',$role->id)}}" autocomplete="off"
                              class="form-horizontal" enctype="multipart/form-data">
                              @csrf
                        </div>
                        <!-- User Permissions Starts -->







                        <div class="col-md-12">
                           @foreach($modules as $module)
                           <!-- User Permissions -->
                           <div class="card">
                              <table class="table table-striped table-borderless">
                                 <tbody>
                                    <tr>
                                       <td style="text-align: center; color:black; font-weight:500; " class="module_name">{{ $module['module_name'] }}</td>
                                    <tr style="display:flex; flex-wrap:wrap;">
                                       @foreach (\Spatie\Permission\Models\Permission::where('module_name', $module['module_name'])->get() as $perm)
                                       <td>
                                          <div class="custom-control custom-checkbox">
                                             <!-- {{ $perm->name }}
                                       {{ trans('$perm->name') }}  -->
                                             {{$perm->name}}
                                             <input type="checkbox" name="permission[]" value="{{ $perm->id }}" class="pl-1 custom-control-input" id="admin-read{{ $perm->id }}" {{ $role->hasPermissionTo($perm->name) ? 'checked' : null }} />
                                             <label class="custom-control-label" style="margin-left:25px;" for="admin-read{{ $perm->id }}"></label>
                                          </div>
                                       </td>
                                       @endforeach
                                    </tr>

                                    </tr>
                                 </tbody>
                              </table>

                           </div>
                           @endforeach
                        </div>

                        <div class="col-md-12 offset-md-4">
                           <button type="submit" class="btn btn-primary">
                              Assign_permission
                           </button>
                        </div>
                        </form>
                     </div>
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