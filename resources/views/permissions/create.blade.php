@extends('layouts.master')
@section('content')
<style>
.seven:after{
  background-color: #2df0cf;
  height: 2px;
  width: 70px;
  position: relative;
  content: "";
  display: block;
}
</style>
<section class="">
    <div class="content p-4">
        <div class="row pt-3">
            <div class="col-md-6">
                <h3 class="seven"><?php echo trans('lang.add_permission');?></h3>
            </div>
          
        </div>
       
    
    </div>


   
    <div class="container">
    <section id="basic-input">
      
        <div class="card-body">
            <form method="post" action="{{route('permission.store')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

                @csrf

               <div class="card">
                  <div class="card-body ">
                     <div class="row">
                        <label class="col-sm-2 col-form-label"><?php echo trans('lang.add_permission_name');?></label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="permission" value="" required="">
                              @error('name')
                                  {{$message}}
                              @enderror
                           </div>
                        </div>   
                     </div>

                     <div class="row">
                        <label class="col-sm-2 col-form-label"><?php echo trans('lang.add_module_name');?></label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="module_name"  type="text" placeholder="Module name" value="" required="">
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
    </section>
    </div>






     
</section>


@endsection