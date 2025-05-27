
@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<style>
      .tabs {
    display: flex;
    align-items: center;
    border-radius: 0.5rem;
    padding: 0.15rem 0.5rem;
    background: linear-gradient(120deg, #8adcdcc4, #2e6a88);
    position: relative;
    z-index: 1;
    margin-bottom: 0.75rem;

    &:has(:focus-visible) {
      outline: 3px solid rgb(17 21 36 / 50%);
    }
  }

  .tabs-marker {
    position: absolute;
    z-index: -1;
    background: rgb(17 21 36 / 70%);
    top: 0.4rem;
    bottom: 0.4rem;
    left: 0;
    border-radius: 0.4rem;
    transition: 0.15s;
  }

  .tabs-tab {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    appearance: none;
    transition: all 150ms;
    outline-width: 2px;
    outline-offset: 2px;
    padding: 0px;
    border-width: 0;
    color: inherit;
    font-weight: 500;
    padding: 1rem;
    color: white;
    background: transparent;
    cursor: pointer;
    outline: none;
    font-family: inherit;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.8rem;

    &:hover {
      color: rgba(255, 255, 255, 1);
    }

    &.ui-active {
      pointer-events: none;
      color: rgba(255, 255, 255, 1);
    }
  }


  .tabs-tab {
    /* Default tab styles */
    font-weight: 700;
    color: black;
    text-decoration: none;
  }

  .active-tab {
    padding: 0.7em;
    color: #fbfbfb;
    font-weight: bold;
    background: #10c4ad;
    border-radius: 15px;
  }

  .tabpanels {
    background-color: white;
    border-radius: 0.5rem;
    width: 100%;
  }

  .tabpanel {
    padding: 1rem 1.25rem;
    text-align: center;
    min-height: 5rem;
    display: grid;
    place-content: center;
    border-radius: 0.5rem;

    &:focus-visible {
      outline: 3px solid rgb(17 21 36 / 50%);
    }

    &.ui-enter-active {
      transition: all 200ms;
      transform-origin: center top;
    }

    &.ui-enter-from {
      opacity: 0;
      transform: scale(0.98);
    }
  }
</style>

    {{-- message --}}
    {!! Toastr::message() !!}


    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->


        

        <div class="content container-fluid">
            <!-- Page Header -->


            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ route('admin.job.details.setup') }}"> 
                    <button class="nav-link " type="button">
                    Job Titles
                    </button>
                    </a> 
                </li>
           
                <li class="nav-item" role="presentation">
                    <a href="{{ route('admin.employment.setup') }}"> 
                    <button class="nav-link active" type="button">
                    Employment Status
                    </button>
                    </a> 
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{ route('admin.departments.setup') }}">
                    <button class="nav-link " type="button">
                    Departments
                    </button>
                    </a>
                </li>
            </ul>


            <button style="margin-top:1rem;" type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEmploymentModal" onclick="openEmployment()">
                Add New
            </button>

            <!-- JOB TITLe TABLE -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable employmentList" style="font-size:0.9em !important;">
                            <thead>
                            <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                    <th>Employment Status</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                        </table>
                    </div>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="editEmploymentModal" tabindex="-1" aria-labelledby="editEmploymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmploymentModalLabel">Edit Job Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="editEmploymentForm">
                                @csrf
                                <input type="hidden" name="id" id="employmentId">
                                <div class="mb-3">
                                    <label for="editEmploymentStatus" class="form-label">Employment Status</label>
                                    <input type="text" class="form-control" id="editEmploymentStatus" name="employmentstatus" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editDescription" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="editDescription" name="description" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Add Modal -->

            <div class="modal fade" id="addEmploymentModal" tabindex="-1" aria-labelledby="addEmploymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEmploymentModalLabel">Employment Status</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <form id="addEmploymentForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="addEmploymentStatus" class="form-label">Employment Status</label>
                                    <input type="text" class="form-control" id="addEmploymentStatus" name="employmentstatus" required>
                                </div>
                                <div class="mb-3">
                                    <label for="addDescription" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="addDescription" name="description" required>
                                </div>
                               
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>


 

        </div>
    
     
    </div>
    <!-- /Page Wrapper -->


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




        var table = $('.employmentList').DataTable({
                responsive: true,
                processing: true,
                serverSide: false,
                searching: true,
                ajax: {
                    url: '{{ route("admin.employment.setup") }}',
                },
                    columns: [
                        {
                            "data": "name"
                        },
                        {
                            "data": "description"
                        },
                        {
                            "data": "action",
                        },
                    
                    ],
        });

        // Handle Edit Button Click
        $(document).on('click', '.btn-edit', function () {
            var id = $(this).data('id');
            $.ajax({
                url: `/admin/paygrade-setup/${id}/edit`,
                type: 'GET',
                success: function (data) {
                    $('#employmentId').val(data.id);
                    $('#editEmploymentStatus').val(data.name);
                    $('#editDescription').val(data.description);

                    $('#editEmploymentModal').modal('show');
                }
            });
        });


        // Handle Edit Form Submission
            $('#editEmploymentForm').on('submit', function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: `/admin/paygrade-setup/${$('#employmentId').val()}`,
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        $('#editEmploymentModal').modal('hide');
                        table.ajax.reload();
                        alert(response.message); // Use toastr or SweetAlert for better UX
                    }
                });
            });

        // Handle Delete Button Click
            $(document).on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this employment details?')) {
                    $.ajax({
                        url: `/admin/employment-details/${id}`,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                        },
                        type: 'post',
                        success: function (response) {
                            table.ajax.reload();
                        }
                    });
                }
            });


            function openEmployment(){
                $('#addEmploymentForm')[0].reset();
                $('#addEmploymentModal').modal('show');
            }

            // Handle Add Form Submission
            $('#addEmploymentForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/admin/employment-details',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $(this).serialize(),
                    success: function (response) {
                        alert(response.message);
                        $('#addEmploymentModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        alert('Failed to add employment details!');
                    }
                });
            });

      
    </script>
       

@endsection
