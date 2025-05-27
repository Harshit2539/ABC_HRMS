 @extends('layouts.master')

 <link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">


 @section('content')
     <style>
         .tabs {
             display: flex;
             align-items: center;
             border-radius: 0.5rem;
             padding: 0.15rem 0.5rem;
             background: linear-gradient(120deg, #f6babac4, #e59595);
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
                         <button class="nav-link active" type="button">
                             Job Titles
                         </button>
                     </a>
                 </li>

                 <li class="nav-item" role="presentation">
                     <a href="{{ route('admin.employment.setup') }}">
                         <button class="nav-link" type="button">
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

             <button style="margin-top:1rem;" type="button" class="btn btn-primary mb-2 " data-bs-toggle="modal"
                 data-bs-target="#addJobTitleModal" onclick="openJobTitle()">
                 Add New
             </button>

             <!-- JOB TITLe TABLE -->

             <div class="row">
                 <div class="col-md-12">
                     <div class="table-responsive">
                         <table class="table table-striped custom-table datatable jobTitleList">
                             <thead>
                                 <tr>
                                     <th>Job Title Code</th>
                                     <th>Job Title</th>
                                     <th>Actions</th>
                                 </tr>
                             </thead>

                         </table>
                     </div>
                 </div>
             </div>


             <!-- Edit Modal -->
             <div class="modal fade" id="editJobTitleModal" tabindex="-1" aria-labelledby="editJobTitleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="editJobTitleModalLabel">Edit Job Title</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                         </div>
                         <div class="modal-body">
                             <form id="editJobTitleForm">
                                 @csrf
                                 {{-- sarthak change --}}
                                 <div class="mb-3">
                                     <label>Select Department</label><span class="text-danger">*</span>
                                     <select class="form-control" id="edit_department_dropdown" name="department" required>
                                         {{-- dropdown appended dynamically --}}
                                     </select>
                                 </div>
                                 {{-- sarthak change --}}
                                 <input type="hidden" name="id" id="jobTitleId">
                                 <div class="mb-3">
                                     <label for="jobTitleCode" class="form-label">Job Title Code</label>
                                     <input type="text" class="form-control" id="jobTitleCode" name="code" required>
                                 </div>
                                 <div class="mb-3">
                                     <label for="jobTitleName" class="form-label">Job Title Name</label>
                                     <input type="text" class="form-control" id="jobTitleName" name="name" required>
                                 </div>

                                 <div class="mb-3">
                                     <label for="jobDescription" class="form-label">Job Description</label>
                                     <input type="text" class="form-control" id="jobDescription" name="description"
                                         required>
                                 </div>

                                 <div class="mb-3">
                                     <label for="jobSpecification" class="form-label">Job Specification</label>
                                     <input type="text" class="form-control" id="jobSpecification" name="specification"
                                         required>
                                 </div>
                                 <button type="submit" class="btn btn-primary">Save Changes</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>


             <!-- Add Modal -->

             <div class="modal fade" id="addJobTitleModal" tabindex="-1" aria-labelledby="addJobTitleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="addJobTitleModalLabel">Add Job Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                         </div>
                         <div class="modal-body">
                             <form id="addJobTitleForm">
                                 @csrf
                                 {{-- sarthak change --}}
                                 <div class="mb-3">
                                     <label>Select Department</label><span class="text-danger">*</span>
                                     <select class="form-control" id="department_dropdown" name="department" required>
                                         <option value="" disabled selected>--Select Department-- </option>
                                         @foreach ($departments as $department)
                                             <option value="{{ $department->id }}">{{ $department->department }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                                 {{-- sarthak change --}}
                                 <div class="mb-3">
                                     <label for="addJobTitleCode" class="form-label">Job Title Code</label>
                                     <input type="text" class="form-control" id="addJobTitleCode" name="code"
                                         required>
                                 </div>
                                 <div class="mb-3">
                                     <label for="addJobTitleName" class="form-label">Job Title Name</label>
                                     <input type="text" class="form-control" id="addJobTitleName" name="name"
                                         required>
                                 </div>
                                 <div class="mb-3">
                                     <label for="addJobDescription" class="form-label">Job Description</label>
                                     <input type="text" class="form-control" id="addJobDescription"
                                         name="description" required>
                                 </div>
                                 <div class="mb-3">
                                     <label for="addJobSpecification" class="form-label">Job Specification</label>
                                     <input type="text" class="form-control" id="addJobSpecification"
                                         name="specification" required>
                                 </div>
                                 <button type="submit" class="btn btn-primary">Add Job Title</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>




         </div>


     </div>
     <!-- /Page Wrapper -->


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
         var table = $('.jobTitleList').DataTable({
             responsive: true,
             processing: true,
             serverSide: false,
             searching: true,
             ajax: {
                 url: '{{ route('admin.job.details.setup') }}',
             },
             columns: [{
                     "data": "code"
                 },
                 {
                     "data": "name"
                 },
                 {
                     "data": "action",
                 },

             ],
         });

         // Handle Edit Button Click
         $(document).on('click', '.btn-edit', function() {
             var id = $(this).data('id');
             $.ajax({
                 url: `/admin/job-details/${id}/edit`,
                 type: 'GET',
                 success: function(data) {
                 
                     $('#jobTitleId').val(data.jobTitle.id);
                     $('#jobTitleCode').val(data.jobTitle.code);
                     $('#jobTitleName').val(data.jobTitle.name);
                     $('#jobDescription').val(data.jobTitle.description);
                     $('#jobSpecification').val(data.jobTitle.specification);
                     $('#editJobTitleModal').modal('hide');
                     $('#edit_department_dropdown').empty();
                     selectedDepartmentId = data.jobTitle.department_id;
                     data.departments.forEach(el => {
                         const newOption = document.createElement('option');
                         newOption.value = el.id;
                         newOption.textContent = el.department;
                         if (el.id === selectedDepartmentId) {
                             newOption.selected = true;
                         }
                         document.getElementById('edit_department_dropdown').appendChild(
                             newOption);
                     });


                     $('#editJobTitleModal').modal('show');
                 }
             });
         });


         // Handle Edit Form Submission
         $('#editJobTitleForm').on('submit', function(e) {
             e.preventDefault();
             var formData = $(this).serialize();
             $.ajax({
                 url: `/admin/job-details/${$('#jobTitleId').val()}`,
                 type: 'PUT',
                 data: formData,
                 success: function(response) {
                     $('#editJobTitleModal').modal('hide');
                     table.ajax.reload();
                     alert(response.message); // Use toastr or SweetAlert for better UX
                 }
             });
         });

         // Handle Delete Button Click
         $(document).on('click', '.btn-delete', function() {
             var id = $(this).data('id');
             if (confirm('Are you sure you want to delete this job title?')) {
                 $.ajax({
                     url: `/admin/job-details/${id}`,
                     data: {
                         _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                     },
                     type: 'post',
                     success: function(response) {
                         table.ajax.reload();
                     }
                 });
             }
         });


         function openJobTitle() {
             $('#addJobTitleForm')[0].reset();
             $('#addJobTitleModal').modal('show');
         }

         // Handle Add Form Submission
         $('#addJobTitleForm').on('submit', function(e) {
             e.preventDefault();
             $.ajax({
                 url: '/admin/job-details',
                 type: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 data: $(this).serialize(),
                 success: function(response) {
                     alert(response.message);
                     $('#addJobTitleModal').modal('hide');
                     table.ajax.reload();
                 },
                 error: function(xhr) {
                     console.log(xhr.responseText);
                     alert('Failed to add job title!');
                 }
             });
         });
     </script>
 @endsection
