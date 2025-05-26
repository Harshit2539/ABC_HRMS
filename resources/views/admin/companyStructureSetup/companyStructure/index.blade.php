
@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@section('content')


    {!! Toastr::message() !!}


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->


        <div class="content container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <!-- <h3 class="card-label">Projects</h3> -->
                            </div>
                            <div class="card-toolbar">
                                <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                    data-target="#addNewModal">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                    Add New
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-striped custom-table datatable companyStructure" style="font-size:0.9em !important;">
                                <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                <th>Name</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Country</th>
                                        <th>Time Zone</th>
                                        <th>Parent Structure</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>




   <!-- Add Project Modal -->
   <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Company Structure</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <form id="addProjectForm">
                            @csrf
                            <div class="form-group">
                                <label for="name"><span class="mandatory_input" style="color:red;">*</span> Name: </label>
                                <input type="text" class="form-control" id="name" name="name">
                                <small class="text-danger name_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="detail"><span class="mandatory_input" style="color:red;">*</span> Details: </label>
                                <input type="text" class="form-control" id="detail" name="detail">
                                <small class="text-danger detail_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="details">Address: </label>
                                <textarea class="form-control" id="address" rows="3" name="address"></textarea>
                            </div>

                            <div class="form-group">
                            <label for="type"><span class="mandatory_input" style="color:red;">*</span> Type: </label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select Type</option>
                                   <option value="company">Company</option>
                                   <option value="head office">Head Office</option>
                                   <option value="regional office">Regional Office</option>
                                   <option value="department">Department</option>

                                </select>
                                <small class="text-danger type_error"></small>
                            </div>

                            <div class="form-group">
                            <label for="country_id"><span class="mandatory_input" style="color:red;">*</span> Country: </label>
                                <select class="form-control" id="country_id" name="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                   <option value="{{$country->id}}">{{$country->name}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger country_id_error"></small>
                            </div>

                            <div class="form-group">
                            <label for="timezone_id"><span class="mandatory_input" style="color:red;">*</span> Time Zone: </label>
                                <select class="form-control" id="timezone_id" name="timezone_id">
                                    <option value="">Select Timezone</option>
                                    @foreach($timezones as $timezone)
                                   <option value="{{$timezone->id}}">{{$timezone->details}}</option>
                                   @endforeach
                                </select>
                                <small class="text-danger timezone_id_error"></small>
                            </div>

                            <div class="form-group">
                            <label for="parent_id"><span class="mandatory_input" style="color:red;">*</span> Parent Structure: </label>
                                <select class="form-control" id="timezone_id" name="parent_id">
                                    <option value="">Select Parent</option>
                                    @foreach($companies as $company)
                                   <option value="{{$company->id}}">{{$company->title}}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                            <label for="head_id"><span class="mandatory_input" style="color:red;">*</span>Head: </label>
                                <select class="form-control " id=" multiple" name="head_id" >
                                    <option value="">Select Head</option>
                                    @foreach($employees as $employee)
                                   <option value="{{$employee->id}}">{{$employee->name}}</option>
                                   @endforeach
                                </select>
                            </div>

                          
                         
                           
                            
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveProjectBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>



           


 

        </div>
    
     
    </div>
    <!-- /Page Wrapper -->

<!-- Script Code -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>


<!-- button -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#multiple").select2({
          placeholder: "Select a programming language",
          allowClear: true
      });
        });
    </script>

    <script>

        var table = $('.companyStructure').DataTable({
                responsive: true,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: {
                    url: '{{ route("company-structure.setup") }}',
                },
                    columns: [
                        {
                            "data": "title"
                        },
                        {
                            "data": "address"
                        },
                        {
                            "data": "type"
                        },
                        {
                            "data": "country"
                        },
                        {
                            "data": "timezone"
                        },
                        {
                            "data": "parent"
                        },
                        {
                            "data": "action",
                        },
                    
                    ],
        });


        

        

      
    </script>

    <script>

$(document).ready(function () {
    $('#saveProjectBtn').on('click', function () {
        let formData = $('#addProjectForm').serialize();

        // Disable the button to prevent multiple submissions
        $('#saveProjectBtn').prop('disabled', true).text('Saving...');

        $.ajax({
            url: "{{ route('company-structure.setup.store') }}", // Adjust the route as needed
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message, 'Success');
                    $('#addNewModal').modal('hide'); // Close the modal
                    $('.companyStructure').DataTable().ajax.reload(); // Reload the DataTable
                } else {
                    // toastr.error(response.message, 'Error');
                }
                $('#saveProjectBtn').prop('disabled', false).text('Save');
            },
            // error: function (xhr) {
            //     let errors = xhr.responseJSON.errors;
            //     for (let key in errors) {
            //         $(`.${key}_error`).text(errors[key][0]);
            //     }
            //     toastr.error('Please fix the errors and try again.', 'Validation Error');
            //     $('#saveProjectBtn').prop('disabled', false).text('Save');
            // }
        });
    });
});








    </script>
  


@endsection
