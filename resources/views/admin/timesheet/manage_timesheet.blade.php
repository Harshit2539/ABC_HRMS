@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">

@section('content')
   <!-- Sidebar -->
    
	<!-- /Sidebar -->

    <div class="page-wrapper">
    <div class="container-fluid mt-4">

       
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex" style="justify-content:space-between;">
                        <div class="card-title">
                            <h3 class="main-heading">Manage<span>Timesheet</span></h3>
                        </div>
                        <div class="card-toolbar" style="align-content:center;">
                            <button class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                data-target="#addNewModal">
                                <i class="fa fa-plus-circle mr-1"></i>
                                Add New
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped custom-table datatable SkillList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th class="text-center">Sr No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Actions</th>
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

        <!-- Add Timesheet Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewModalLabel">Division</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                            <form id="addSkillForm"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <label>Month:</label>
                                <input class="form-control" type="text" name="month" required>
                                
                                <label>Year:</label>
                                <input class="form-control" type="number" name="year" required>
                                
                                <label>Timesheet File:</label>
                                <input class="form-control" type="file" name="timesheet" accept=".xlsx,.xls" required>

                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="saveSkillBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
       

    </div>
    </div>

<!-- Script Code -->
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js"></script>

<script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>

<!-- button -->
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  



    
    $('#saveSkillBtn').click(function (e) {
        e.preventDefault();

        var form = $('#addSkillForm')[0];
        var formData = new FormData(form);

        $.ajax({
            url: "{{ route('upload.timesheet') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                console.log(response);
                toastr.success("File uploaded!");
                $('#addSkillForm')[0].reset();
                $('#addNewModal').modal('hide');
            },
            error: function (xhr) {
                toastr.error("Something went wrong!");
            }
        });
    });

</script>

    

    

 
</script>


@endsection