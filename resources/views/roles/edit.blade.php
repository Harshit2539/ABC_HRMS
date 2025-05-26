@extends('layouts.master')
@section('content')

<div class="page-wrapper">
   <div class="container-fluid mt-4">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-body">
                  <h3 class="mb-4">Edit Role</h3>

                  {{-- Update Role Form --}}
                  <form method="post" action="{{ url('update/role', $role->id) }}" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Role Name</label>
                        <div class="col-sm-7">
                           <input class="form-control" name="name" type="text" value="{{ $role->name }}" placeholder="Role Name" required>
                           @error('name')
                              <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-md-6 offset-md-2">
                           <button type="submit" class="btn btn-primary">Update Role</button>
                        </div>
                     </div>
                  </form>

                  {{-- Success Message --}}
                  @if(Session::has('message'))
                  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                     {{ Session::get('message') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  @endif

                  {{-- Assign Permissions --}}
                  <form method="post" action="{{ route('admin.roles.permissions', $role->id) }}" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <h4 class="mt-4 mb-3">Assign Permissions</h4>

                     @foreach($modules as $module)
                     <div class="card mb-3">
                        <div class="card-header font-weight-bold bg-light text-center" >
                           {{ $module['module_name'] }}
                        </div>
                        <div class="card-body">
                           <div class="row">
                              @foreach (\Spatie\Permission\Models\Permission::where('module_name', $module['module_name'])->get() as $perm)
                              <div class="col-md-3 mb-2">
                                 <div class="form-check">
                                    <input type="checkbox" name="permission[]" value="{{ $perm->id }}" class="form-check-input" id="perm{{ $perm->id }}" {{ $role->hasPermissionTo($perm->name) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perm{{ $perm->id }}">{{ $perm->name }}</label>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     @endforeach

                     <div class="form-group row">
                        <div class="col-md-12 45 ">
                           <button type="submit" class="btn btn-success">Assign Permissions</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
