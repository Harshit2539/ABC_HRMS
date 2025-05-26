@extends('layouts.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<style>
    .pagination {
        float: right;
    }

    .dt-search {
        float: right;
    }

    .dt-length {
        display: none;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
    }



    .search-bar {
        display: flex;
        border: solid 2px black;
        width: 91%;
    }

    .search-bar input {
        width: 90%;
        border: none;
    }

    .search-bar span {
        margin-top: 7px;
    }

    #searchList {

        margin-top: 33px;
    }



    .drop-down {
        padding: 0px;
        margin: 0px;
    }

    .drop-down li {
        list-style: none;
        padding: 10px;
        margin: 5px 0px;

    }

    .drop-down li:hover {
        background: #f3faff;
    }

    .drop-down li img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-left: 10px
    }

    .li-id {
        color: #7f8fa4;
    }

    .information-field .span2 {
        font-weight: 400;
        font-size: 14px;
        color: grey;
    }

    .information-field .span1 {
        width: 100px;
    }

    .search-bar-container {
        margin-top: 19px;
    }
</style>



<style>
    #search-wrapper {
        display: flex;
        border: 1px solid rgba(0, 0, 0, 0.276);
        align-items: stretch;
        border-radius: 50px;
        background-color: #fff;
        overflow: hidden;
        max-width: 400px;
        box-shadow: 2px 1px 5px 1px rgba(0, 0, 0, 0.273);

    }

    #search {
        border: none;
        width: 350px;
        font-size: 15px;
    }

    #search:focus {
        outline: none;
    }

    .search-icon {
        margin: 10px;
        color: rgba(0, 0, 0, 0.564);
    }

    #search-button {
        border: none;
        cursor: pointer;
        color: #fff;
        background-color:rgb(215, 89, 54);
        padding: 0px 10px;
    }
</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="card-title">
                            <h3 class="main-heading heading">Search<span>Employee Here...</span> </h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 mb-1">
                            <div class="border shadow-lg  rounded p-5 search-bar-container ml-3" >

                                <div id="search-wrapper">
                                    <i class="search-icon fas fa-search"></i>
                                    <input type="text" id="search" placeholder="Search Here" class="input-group" name="search_employees" id="searchEmployees" value="" autocomplete="off">
                                    <button id="search-button">Search</button>
                                </div>

                                <div class="" id="searchList">
                                </div>

                            </div>

                        </div>

                        <div class="col-xl-7 col-lg-7 col-md-7 col-12 mb-1 employeeDetails">
                        <div style="justify-self :center;">
                        <img style = "height: 400px; width:400px;" src="{{ asset('assets/img/searchimage.jpg') }}" alt="No Data" id="imagedefault" class="img-fluid">
                        </div>

                        </div>

                    </div>


                </div>

                <div class="container-fluid shadow-lg p-3">


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}">

        </div>

    </div>

    <!-- Script Code -->

    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @endsection

    <script>
        $(document).ready(function() {


            let timeout;

            $(document).on('keyup', '#search', function(e) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                e.preventDefault();

                if (timeout) {
                    clearTimeout(timeout);

                }

                timeout = setTimeout(function() {
                    stringadd = $("input[name=search_employees]").val();



                    if (stringadd.length == 0) {

                        $('#searchList').empty();


                    }

                    if (stringadd.length >= 3) {
                        $.ajax({

                            url: "{{ route('search.employee.list')}}",
                            type: 'POST',
                            data: {
                                "employee_name": stringadd
                            },
                            success: function(response) {
                                console.log(response);

                                if (response.status == true) {

                                    var unitHtml = ` <ul class="drop-down" style="height: 300px; overflow-y: scroll;">`;

                                    response.employees.forEach((el) => {

                                        unitHtml += ` <li style="cursor:pointer" class="user-item" data-id="${el.id}">
                                                   <img src="{{ asset('assets/img/redianlogo.jpeg') }}" alt="No Data" class="img-fluid">
                                                   <span class="li-name">${el.name}</span>
                                                   <span class="li-id">#${el.olm_id}</span>
                                                </li>`;

                                    });

                                    unitHtml += `</ul>`;

                                    $('#searchList').html(unitHtml);

                                } else if (response.status == false) {
                                    $('#imagedefault').show();
                                    $('#searchList').html(`<p style="margin-left:74px">${response.message}</p>`)
                                }

                            }
                        });

                    }
                }, 500)


            });

        })


        $(document).on('click', '.user-item', function(e) {
            let id = $(this).data('id');
            $.ajax({

                url: "{{ route('get.employee.details')}}",
                type: 'GET',
                data: {
                    "id": id
                },
                success: function(response) {
                    if (response.status == true) {
                        for (var key of Object.keys(response.employeeDetails)) {

                            if (response.employeeDetails[key] == 'null') {
                                response.employeeDetails[key] = '';

                            }
                        }
                        $('.employeeDetails').html(` <div class="card p-5">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                                               <img src="{{ asset('assets/img/redianlogo.jpeg') }}" alt="No Data" style="width:100px; height:100px; border-radius:50%; display:block; margin:auto;">
                                        </div>
                                         <div class="col-xl-8 col-lg-8 col-md-8 col-12 mb-1 information-field">
                                                  <p> <span class="span1">Name :-</span>   <span class="span2"> ${response.employeeDetails.first_name} ${response.employeeDetails.middle_name} ${response.employeeDetails.last_name}</span></p>
                                                   <p><span class="span1">Employee ID :-</span>  <span class="span2"> ${response.employeeDetails.olm_id}</span></p>
                                                   <p><span class="span1">Mobile Number :-</span>  <span class="span2">${response.employeeDetails.mobile_phone}</span> </p>
                                                   <p><span class="span1">Birthday :-</span>  <span class="span2">${response.employeeDetails.birthday}</span> </p>
                                                   <p><span class="span1">City :-</span>  <span class="span2">${response.employeeDetails.city}</span></p>
                                                   <p><span class="span1">Email :-</span>  <span class="span2">${response.employeeDetails.work_email}</span></p>
                                       
                                        </div>
                                    </div>
                                  </div>`);

                    }
                }
            });
        })
    </script>
    @endsection