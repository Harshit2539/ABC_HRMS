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
                <h3 class="seven"><?php echo trans('lang.permission');?></h3>
            </div>
            <div class="col-md-6 text-md-right pb-md-0 pb-3">
            <a href="{{route('create.permission')}}" type="button"  class="btn btn-sm btn-fill btn-primary"><i class="fa fa-plus"></i> <?php echo trans('lang.add_permission');?></a>
            </div>
        </div>
       
    
    </div>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


          <div class="card">



              <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th><?php echo trans('lang.permission');?></th>
                                <th><?php echo trans('lang.module_name');?></th>
                                <th><?php echo trans('lang.action');?></th>

                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($data as $key => $permission)
                            <tr>
                                <td scope="row">{{$key + 1}}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->module_name }}</td>
                                <td>
                                <a href="{{url('edit/permission')}}/{{$permission->id}}"   class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                                <!-- <td>{{ $permission->module_name }}</td> -->

                            </tr>
                            @endforeach
                         
                        </tbody>
                    </table>
                </div>

            </div>

            
             
            </div>
            
          </div>
        </div>
      </div>
    </section>






     
</section>


@endsection