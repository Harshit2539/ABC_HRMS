@extends('layouts.master')
@section('content')

<style>
  <style>.container-first {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 10px;
  }

  .container-first h3 {
    font-size: 24px;
    color: #394657;
  }

  .container-first .p1 {
    font-size: 17px;
    color: #beb2b2;
  }

  .container-first .p2 {
    font-size: 17px;
    color: #000000;
  }

  .main-container {
    width: 80%;
    margin: auto;
  }

  .main-container .container-img {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50%;
    margin-right: 30px;
  }

  .main-container {
    display: flex;
    align-items: center;
    padding: 5px;
    border: 1px solid lightgray;
    border-radius: 10px;
    background-color: #f7f7f7;
    justify-content: space-evenly;
    flex-wrap: wrap;
  }

  .main-container .main-container-content {
    display: flex;
    align-items: center;
    border: 1px solid lightgray;
    border-radius: 5px;
    background-color: #ffffff;
    padding: 15px;
  }

  .main-container .main-container-content h4 {
    font-size: 17px;
    margin-bottom: 0px;
  }

  .main-container .main-container-content p {
    font-size: 14px;
    margin-bottom: 0px;
  }

  .main-container .main-container-content a {
    text-decoration: none;
    font-weight: 600;
  }

  .main-container span {
    font-weight: 600;
    color: gray;
  }

  /* Leave Balance Card */
  .leave-balance .buttons {
    display: flex;
    justify-content: end;
    gap: 10px;
  }

  .leave-balance .buttons .btn {
    border-radius: 4px;
    font-size: 14px;
  }

  .leave-balance .card {
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    padding: 12px 15px 0;
    background-color: #fff;
    min-height: 243px;
  }

  .leave-balance .card .card-header {
    background-color: inherit;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
  }

  .leave-balance .card .card-header h4 {
    color: #7f8fa4;
    font-size: 14px;
    font-weight: 600;
  }

  .leave-balance .card .card-header p {
    color: #7f8fa4;
    font-size: 14px;
    font-weight: 400;
  }

  .leave-balance .card .card-header p span {
    font-weight: 500;
  }

  .leave-balance .card .card-body h1 {
    font-size: 24px;
    text-align: center;
    font-weight: 400;
  }

  .leave-balance .card .card-body p {
    font-size: 12px;
    text-align: center;
    font-weight: 400;
    color: #7f8fa4;
  }

  .leave-balance .card .card-body a {
    color: #24a7f8;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    display: block;
  }

  .leave-balance .card .card-footer {
    background-color: inherit;
    border: none;
    padding: 5px;
  }

  .leave-balance .card .card-footer label {
    color: #7f8fa4;
    font-size: 10px;
  }

  .leave-balance .card .card-footer progress {
    width: 100%;
  }
</style>

</style>

<!-- Main content -->
<div class="page-wrapper">
  <div class="container-fluid mt-4" id='add_asset'>




    <div class="container leave-balance mt-5">
      <div class="row">
        <!-- <div class="col-12 buttons mb-2">
          <button class="btn btn-outline-primary">Apply</button>
          <button class="btn btn-primary">Download</button>
          <div class="dropdown">
            <button
              class="btn btn-outline-primary dropdown-toggle"
              type="button"
              id="dropdownMenuButton1"
              data-bs-toggle="dropdown"
              aria-expanded="false">
              2025
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">2025</a></li>
              <li><a class="dropdown-item" href="#">2024</a></li>
              <li><a class="dropdown-item" href="#">2023</a></li>
              <li><a class="dropdown-item" href="#">2022</a></li>
              <li><a class="dropdown-item" href="#">2021</a></li>
              <li><a class="dropdown-item" href="#">2020</a></li>
              <li><a class="dropdown-item" href="#">2019</a></li>
              <li><a class="dropdown-item" href="#">2018</a></li>
            </ul>
          </div>
        </div> -->

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <h4>Loss Of Pay</h4>
              <!-- <p>Granted: <span>0</span></p> -->
            </div>

            <div class="card-body">
              <h1>{{$employee_leaves->loss_of_pay ?? 0}}</h1>
              <p>Balance</p>
              <!-- <a href="">View Details</a> -->
            </div>

            <!-- <div class="card-footer">
              <label for="file">1 of 10 Consumed</label> <br />
              <progress id="file" value="32" max="100">32%</progress>
            </div> -->
          </div>
        </div>


        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <h4>Comp - Off</h4>
              <!-- <p>Granted: <span>0</span></p> -->
            </div>

            <div class="card-body">
              <h1>{{$employee_leaves->comp_off ?? 0}}</h1>
              <p>Balance</p>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <h4>Annual Leave</h4>
              <!-- <p>Granted: <span>10</span></p> -->
            </div>
            <div class="card-body">
              <h1>{{$annual_leaves->annual_leave - $employee_leaves->annual_leave}} </h1>
              <p>Balance</p>
              <a href="{{route('leaves.type.details',['type'=>'annual_leave'])}}">View Details</a>
            </div>
            <div class="card-footer">
              <label for="file">{{$employee_leaves->annual_leave}} of {{$annual_leaves->annual_leave}} Consumed</label> <br />
              <progress id="file" value="{{$employee_leaves->annual_leave}}" max="{{$annual_leaves->annual_leave}}">1</progress>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <h4>Work From Home</h4>
              <!-- <p>Granted: <span>4</span></p> -->
            </div>

            <div class="card-body">
              <h1>{{$annual_leaves->work_from_home - $employee_leaves->work_from_home}}</h1>
              <p>Balance</p>
              <a href="{{route('leaves.type.details',['type'=>'work_from_home'])}}">View Details</a>
            </div>

            <div class="card-footer">
              <label for="file">{{$employee_leaves->work_from_home}} of {{$annual_leaves->work_from_home}} Consumed</label> <br />
              <progress id="file" value="{{$employee_leaves->work_from_home}}" max="{{$annual_leaves->work_from_home}}">1</progress>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mb-2">
          <div class="card">
            <div class="card-header">
              <h4>Sick Leave</h4>
              <!-- <p>Granted: <span>0.5</span></p> -->
            </div>

            <div class="card-body">
              <h1>{{$annual_leaves->sick_leave - $employee_leaves->sick_leave}}</h1>
              <p>Balance</p>
              <a href="{{route('leaves.type.details',['type'=>'sick_leave'])}}">View Details</a>
            </div>

            <div class="card-footer">
              <label for="file">{{$employee_leaves->sick_leave}} of {{$annual_leaves->sick_leave}} Consumed</label> <br />
              <progress id="file" value="{{$employee_leaves->sick_leave}}" max="{{$annual_leaves->sick_leave}}">1</progress>
            </div>
          </div>
        </div>

      </div>
    </div>




  </div>
</div>
@endsection