@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href=" https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">


<style>
     .pagination{
        float:right;
    }
    .dt-search{
        float:right;
    }
    .dt-length{
        display:none;
    }
    .card-header{
        display:flex;
        justify-content:space-between;
    }
    
    .button-container button{
      color: #24a7f8;
    border-color: #24a7f8;
    background: #fff;
}
    
    .modal-header{
        background-color: #a3b2c726;
    }


.heading span{

     color: #757575;
    font-size: 16px;
    font-weight: 500;
    display: block;
    margin-top: .15px;
}

    #noDataBox img{
        width: 31%;
    }


.input-group{

   outline: none;
  border: none; 
  box-shadow: none;
      width: 75%;
}


#goalDetailsButton{
        background: #3ec9d6 !important;
    color: #ffff !important;
    border:none;
}



.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
    margin: 10px 15px 4px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}


.rate input[type="radio"] {
  position: absolute;
  left: -9999px;
  visibility: hidden;
}

.progress-container{
    width: 90%;
    margin: 22px 38px 54px;
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
                                    <h3 class="main-heading heading">Performance<span>Goal Tracking</span> </h3>
                                </div>
                                
                                <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newGoalModal" >Create New Goal</button>
                                </div>

                            </div>
                            <div class="card">
                                    
                                                <!-- Create New Goal Modal -->

                        <div class="modal" id="newGoalModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New Goal Tracking</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body">


                                  <form id="createNewGoal">



                                           <div class="row">

                                    <div class="form-group col-6">
                                            <label>Select Department</label><span class="text-danger">*</span>
                                            <select class="form-control" id="department_dropdown" name="department" required>
                                                <option value="" disabled selected >--Select Department-- </option>
                                                 @foreach ($departments as $department)
                                            <option value="{{  $department->id  }}">{{ $department->department }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                           <div class="form-group col-6">
                                            <label>Select Designation</label><span class="text-danger">*</span>
                                            <select class="form-control" id="designation" name="designation" required>
                                                <option value="" disabled >--Select Designation-- </option>
                                                {{-- options are appended dynamically --}}
                                            </select>
                                        </div>
                                         
                                         </div>




                                         <div class="row">
                                         


                                    <div class="form-group col-12">
                                            <label>Goal Types</label><span class="text-danger">*</span>
                                            <select class="form-control" id="goalType" name="goal_type" required>

                                                <option value="" disabled >Select Category</option>

                                                <option value="0">Long term Goal</option>
                                                <option value="1">Invoice Goal</option>
                                                <option value="2">Short Term</option>

                                            </select>
                                        </div>
                                         
                                         </div>


                                         <div class="row">
                                            <div class="form-group col-md-6">
                                        <label>Start Date</label> <span class="text-danger">*</span>
                                        <input class="form-control" id="startDate" name="start_date"  type='date' min="{{ date('Y-m-d')}}" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label>End Date</label> <span class="text-danger">*</span>
                                        <input class="form-control" id="endDate" name="end_date" type='date'  min="{{ date('Y-m-d')}}" required/>
                                    </div>
                                         </div>

                                    
                                            <div class="row">
                                     <div class="form-group col-md-12">
                                        <label>Subject</label> <span class="text-danger">*</span>
                                       <textarea class="form-control" id="subject" name="subject" rows="2" required></textarea>
                                    </div>
                                     </div>


                                      <div class="row">
                                     <div class="form-group col-md-12">
                                        <label>Target Achievement</label> <span class="text-danger">*</span>
                                       <input class="form-control" id="targetAchievement" name="target_achievement" type="number" required>
                                    </div>
                                      </div>

                                          <div class="row">

                                         <div class="form-group col-md-12">
                                        <label>Description</label>
                                       <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                    </div>
                                          
                                          </div>

                                                                      
                                    <div class="form-group text-center mt-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>

                                 </form>          
                               </div>

                            </div>
                       </div>
                 </div>
                </div>

                              
                              {{-- Update Goal Details Modal --}}

                                      <div>
                                 <div class="modal fade goalDetailsModal" id="goalDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" >
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                <h4 class="modal-title">Title</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body  goalDetailsBody">

                                    {{-- dynamically appended in modal --}}

                                    </div>
                                </div>
                        </div>
                        </div>   
                                      
                  </div>


            

                <div class="container-fluid shadow-lg p-3">
                                   
                          
                                  <div class="card-body table-responsive">

                            <table class="table custom-table datatable display compact goalList mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">Goal Type</th>
                                        <th class="text-center">Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Subject</th>
                                        <th class="text-center">Rating</th>
                                        <th class="text-center">Progress</th>
                                        <th class="text-center">Target Achievement</th>
                                       <th class="text-center">Action</th>
                                    </tr>
                                </thead>
 
                            </table>
                        </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    </div>

</div>



<!-- Script Code -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

  $(document).ready(function () {

   $('.goalList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('goal.tracking.list') }}",
                type: "GET",

       //         dataSrc:function (response) {
       //        if (response.data.length === 0) {
       //            $('.table-responsive').hide();  
       //            $('#noDataBox').show(); 
       //        } else {
       //            $('.table-responsive').show(); 
       //            $('#noDataBox').hide();  
       //        }
       //        return response.data;
       //    }
     
        },
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'goal_type',
                    className: "text-center"
                },
                  {
                    data: 'start_date',
                    className: "text-center"
                },
               
                {
                    data: 'end_date',
                    className: "text-center"
                },
                  {
                    data: 'subject',
                    className: "text-center"
                },
                 {
                    data: 'rating',
                    className: "text-center"
                },
                 {
                    data: 'progress',
                    className: "text-center"
                },
                 {
                    data: 'target_achievement',
                    className: "text-center"
                },
                {
                    data: 'action',
                    className: "text-center"
                }
             
            ],

                columnDefs: [
        { targets: 0, width: '3%' },   // Sr. No.
        { targets: 1, width: '13.501%' },  //Goal Type
        { targets: 2, width: '10.345%' },  // Start Date
        { targets: 3, width: '10.345%' },  // End Date
        { targets: 4, width: '8%' },   //subject
        { targets: 5, width: '11.15%' },  // Rating
        { targets: 8, width: '11%' }   // Action
    ]

     //        language: {
     //      emptyTable: "No active requests found. Please check back later."
     //  }
 
        });

    
  }) 




        $(document).on('change','#department_dropdown', function(e){
            e.preventDefault();
            departmentID = $(this).val();
    
             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('get.designation') }}",
                    type: 'GET',
                    data: {department_id :departmentID },
                    success: function (response) {
                       
                    if(response.status == true){

                                $('#designation').empty();
                             response.designation.forEach(el => {
                        const newOption = document.createElement('option');
                        newOption.value = el.id;
                       
                        newOption.textContent = el.name;
                        document.getElementById('designation').appendChild(newOption);
                        });

                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });

})





  $(document).on('change','#update_department_dropdown', function(e){
    e.preventDefault();
   var  departmentID = $(this).val();

 

             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('update.get.designation') }}",
                    type: 'GET',
                    data: {department_id :departmentID },
                    success: function (response) {
                       
                    if(response.status == true){

                              $('#updateDesignation').empty();  
                           response.designation.forEach(el => {
                      const newOption = document.createElement('option');
                      newOption.value = el.id;
                     
                      newOption.textContent = el.name;
                      document.getElementById('updateDesignation').appendChild(newOption);
                      });

                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });

})





         $(document).on('submit', '#createNewGoal', function(e) {
            e.preventDefault(); 

                let formData = new FormData(this);

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.new.goal') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= '{{ route('goal.tracking.list') }}';

                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });
       
    });




                       $(document).on('submit', '#updateGoals', function(e) {

                        e.preventDefault(); 

                            let formData = new FormData(this);
                                    
                             let  id = $('#submitUpdateGoals').data('id');
                              formData.append('id', id);

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.updated.goal') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= '{{ route('goal.tracking.list') }}';

                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });
       
    });


    
                       $(document).on('click', '#deleteGoalBtn', function(e) {
                                     
                                     e.preventDefault();
                                  let   id = $(this).data('id');

                                           $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });


                           $.ajax({
                                url: `/delete_goal/${id}`,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                       
                                if(response.status == true){
                                            toastr.success(response.message);
                                            window.location.href= '{{ route('goal.tracking.list') }}';

                                };
                                },
                                error: function(xhr, status, error) {
                                console.log('AJAX Error:', error);        
                                console.log('Status:', status); 
                                console.log('Response Text:', xhr.responseText); 
                                alert('An error occurred');

                }
                            });
                                                      

                       })

       
               $(document).on('click', '#goalDetailsButton', function() {

                  $("#goalDetailsModal").modal('show');
                var goalId = $(this).data('id'); 
              
                $.ajax({
                    url: `/update_goal_details/${goalId}`,
                    type: 'GET',
                    success: function(response) {

                   if(response.status == true){

                            let unitHtml =   
                             `<form id="updateGoals">
                                         <div class="row">

                                    <div class="form-group col-6">
                                            <label>Select Department</label><span class="text-danger">*</span>
                                            <select data-id="${goalId}"" class="form-control" id="update_department_dropdown" name="department" required>
                                                <option value="" disabled selected >--Select Department-- </option>`;

                                                       response.departments.forEach((el)=>{

                                        const selected = (el.id === response.goalDetails.department_id )? 'selected' : '';
                                unitHtml += `<option value="${el.id}" ${selected}>${el.department}</option>`;
                                                                            
                                                
                                               })

                                    unitHtml +=` </select>
                                                   </div>
                                                      <div class="form-group col-6">
                                            <label>Select Designation</label><span class="text-danger">*</span>
                                            <select class="form-control" id="updateDesignation" name="designation" required>
                                                <option value="${response.goalDetails.job_title.id}"  >${response.goalDetails.job_title.name}</option>
                                                {{-- options are appended dynamically --}}
                                            </select>
                                        </div>
                                         
                                         </div>`   

                                         unitHtml += 

                                       `  <div class="row">
                                         
                                    <div class="form-group col-12">
                                            <label>Goal Types</label><span class="text-danger">*</span>
                                            <select class="form-control" id="goalType" name="goal_type" required>

                                                <option value="" disabled >Select Category</option>

                                                <option value="0" ${response.goalDetails.goal_type == "0" ? 'selected' : '' } >Long term Goal</option>
                                                <option value="1"  ${response.goalDetails.goal_type == "1" ? 'selected' : '' } >Invoice Goal</option>
                                                <option value="2"  ${response.goalDetails.goal_type == "2" ? 'selected' : '' } >Short Term Goal</option>

                                            </select>
                                        </div>
                                         </div>
                                         <div class="row">
                                            <div class="form-group col-md-6">
                                        <label>Start Date</label> <span class="text-danger">*</span>
                                        <input class="form-control" id="startDate" name="start_date"  type='date' min="{{ date('Y-m-d')}}" value="${response.goalDetails.start_date}" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label>End Date</label> <span class="text-danger">*</span>
                                        <input class="form-control" id="endDate" name="end_date" type='date'  min="{{ date('Y-m-d')}}" value="${response.goalDetails.end_date}" required/>
                                    </div>
                                         </div>

                                    
                                            <div class="row">
                                     <div class="form-group col-md-12">
                                        <label>Subject</label> <span class="text-danger">*</span>
                                       <textarea class="form-control" id="subject" name="subject" rows="2" required>${response.goalDetails.subject}</textarea>
                                    </div>
                                     </div>


                                      <div class="row">
                                     <div class="form-group col-md-12">
                                        <label>Target Achievement</label> <span class="text-danger">*</span>
                                       <input class="form-control" id="targetAchievement" name="target_achievement" type="number" value="${response.goalDetails.target_achievement}" required>
                                    </div>
                                      </div>

                                          <div class="row">

                                         <div class="form-group col-md-12">
                                        <label>Description</label>
                                       <textarea class="form-control" id="description" name="description" rows="2">${response.goalDetails.description}</textarea>
                                    </div>
                                          </div>
                                                 <div class="row">
                                         
                                    <div class="form-group col-12">
                                            <label>Status </label><span class="text-danger">*</span>
                                            <select class="form-control" id="status" name="status" required>

                                                <option value="" disabled >Select Status</option>

                                                <option value="0" ${response.goalDetails.status == "0" ? 'selected' : '' } >Not Started</option>
                                                <option value="1"  ${response.goalDetails.status == "1" ? 'selected' : '' } >In Progress</option>
                                                <option value="2"  ${response.goalDetails.status == "2" ? 'selected' : '' } >Completed</option>

                                            </select>
                                        </div>
                                         </div>

                                                 <div class="row">
                                                   
                                                        <div class="rate">
                                                <input type="radio" id="star5" name="rating" value="5" ${response.goalDetails.rating == 5 ? 'checked' : ''} />
                                                <label for="star5" title="5 stars">5 stars</label>
                                                <input type="radio" id="star4" name="rating" value="4" ${response.goalDetails.rating == 4 ? 'checked' : ''} />
                                                <label for="star4" title="4 stars">4 stars</label>
                                                <input type="radio" id="star3" name="rating" value="3" ${response.goalDetails.rating == 3 ? 'checked' : ''} />
                                                <label for="star3" title="3 stars">3 stars</label>
                                                <input type="radio" id="star2" name="rating" value="2" ${response.goalDetails.rating == 2 ? 'checked' : ''} />
                                                <label for="star2" title="2 stars">2 stars</label>
                                                <input type="radio" id="star1" name="rating" value="1" ${response.goalDetails.rating == 1 ? 'checked' : ''} />
                                                <label for="star1" title="1 star">1 star</label>
                                            </div>
             

                                            </div>
 

                                             <div class="row">
                                                      
                                                      <div class= progress-container>
                                            <input type="range" class="slider w-100 mb-0 " id="myRange" name="progress" value="${response.goalDetails.progress}" min="1" max="100" oninput="ageOutputId.value = myRange.value + '%' " />
                                            <output name="ageOutputName" id="ageOutputId"></output>
                                                  </div>

                                            </div> 
                                                                      
                                    <div class="form-group text-center mt-3">
                                        <button data-id=${response.goalDetails.id} id="submitUpdateGoals" type="submit" class="btn btn-success">Submit</button>
                                    </div>

                                 </form> `;  


                                                

                        $('.goalDetailsBody').html(unitHtml) ;


              document.querySelector('#ageOutputId').value = document.querySelector('#myRange').value + '%';
                                   
                   }

                   },
                    
                });
        });

      </script>

    @endsection 


