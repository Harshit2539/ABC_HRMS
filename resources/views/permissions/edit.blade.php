@extends('layouts.master')
@section('content')

<section class="">
    <div class="content p-4">
        <div class="row pt-3">
            <div class="col-md-6">
                <h3 class=""><?php echo trans('lang.edit_permission');?></h3>
            </div>
          
        </div>
       
    
    </div>


   
    <div class="card-body">
         <form method="post" action="{{url('update/permission',$permission->id)}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="card">
               <div class="card-body ">
                  <div class="row">
                     <label class="col-sm-2 col-form-label"><?php echo trans('lang.add_permission_name');?></label>
                     <div class="col-sm-7">
                        <div class="form-group bmd-form-group is-filled">
                           <input class="form-control" name="name" type="text" value="{{$permission->name}}" placeholder="permission" value="" required="">
                           @error('name')
                           {{$message}}
                           @enderror
                        </div>
                     </div>
                  </div> <div class="row">
                     <label class="col-sm-2 col-form-label"><?php echo trans('lang.add_module_name');?></label>
                     <div class="col-sm-7">
                        <div class="form-group bmd-form-group is-filled">
                           <input class="form-control" name="module_name" type="text" value="{{$permission->module_name}}" placeholder="Module name" value="" required="">
                           @error('name')
                           {{$message}}
                           @enderror
                        </div>
                     </div>
                  </div>


                  <div class="row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        <?php echo trans('lang.update');?>
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
        
      
      </div>




  </div>






     
</section>


@endsection