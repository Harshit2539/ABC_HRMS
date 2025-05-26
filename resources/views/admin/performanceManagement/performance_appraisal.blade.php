@extends('layouts.master')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href=" https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
    <!-- icons links -->
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
 
    

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

.subTitleContainer{
    color:grey;
}



.rate {
    float: left;

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

#appraisalDetailsBtn{
 background: #3ec9d6 !important;
    color: #ffff !important;
    border: none;
}

.searchBtn-container{

      margin-left: 44%;
    margin-top: 23px;
        border: black solid 1px;
    width: auto;
    background-color: aliceblue;
}

.searchBtn-container>button{
  border:none;
      background-color: aliceblue;



}



   .fill {
        color: yellowgreen;
      }
 
      .outline {
        color: lightgray;
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
                                    <h3 class="main-heading heading">Performance<span>Appraisal</span> </h3>
                                </div>

                                @if ($loggedIn_employee->role_id == 1)

                                    <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#appraisalModal" >Create Appraisal</button>
                                </div>
                                @endif
                            </div>


                            <div class="card">                                 
                                                <!-- Creae new Appraisal Modal -->

                        <div class="modal" id="appraisalModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h4 class="modal-title">Create Appraisal</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>


                                     <div class="modal-body">
                                     <form id="createAppraisal">

            <div class="row">
             
 
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                  <h6  class="form-label">Department</h6>
                  <select id="departmentName" name="department_id" class="form-select">
                    <option value ="" disabled selected >--Select Department--</option>
                    @foreach ($departments as $department )
                             <option value ="{{ $department->id }}" >{{ $department->department }}</option>
                    @endforeach
                  
                  </select>
                </div>
              </div>
 
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                    <h6  class="form-label">Designation</h6>
                  <select id="designationName"  name="designation_id" class="form-select">
                    <option value ="" disabled >--Select Designation--</option>

                  {{-- dropdownm appended dhynamically --}}
                  </select>
                </div>
              </div>
 
          
            </div>


               <div class="row">
             
 
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                  <h6  class="form-label">Employee*</h6>
                  <select id="employeeName" class="form-select"  name="employee_id">
                    <option value ="" disabled >--Select Employee--</option>
                          {{-- employee name appended dynamically --}}
                    
                  </select>
                </div>
              </div>
 
              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                <div>
                  <h6 for="" class="form-label">Enter Year*</h6>
                 {{-- <input type="month" name="appraisal_year" id="appraisal_year" class="form-control" required /> --}}
                 
            <input type="number" min="1900" max="2099" step="1"  name="appraisal_year" id="appraisal_year" class="form-control"  required />


                </div>
              </div>

              <div class='searchBtn-container'>
              <button>Search </button>
          <span class="input-group-addon ng-star-inserted" ><i class="fa-solid fa-magnifying-glass"></i></span>
              </div>
 
              <div class="col-12 mb-2">
                <div>
                  <h6 for="" class="form-label">Remarks</h6>
                  <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter Remarks"></textarea>
                </div>
              </div>
            </div>


            <div id="employeeRatingDetails">
                     {{-- dynamically appended here --}}
                     
             </div>

          </div>

                  </form>


                               </div>
                            </div>
                       </div>
                 </div>
                </div>


                              
                              {{-- Update Aprraisal Details Modal --}}


                                      <div>
                                 <div class="modal fade appraisalDetailsModal" id="appraisalDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" >
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                <h4 class="modal-title">Edit Appraisal Rating</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >&times;</button>
                                </div>
                                
                                <div class="modal-body  appraisalDetailsBody">

                                    {{-- dynamically appended in modal --}}

                                    </div>
                                </div>
                        </div>
                        </div>          
                  </div>


            

                        <div class="container-fluid shadow-lg p-3">
                                  <div class="card-body table-responsive" >
                            <table class="table custom-table datatable display compact appraisalList mt-3" style="font-size:0.9em !important;">
                                <thead>
                                <tr style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">DEPARTMENT</th>
                                        <th class="text-center">DESIGNATION</th>
                                        <th class="text-center">EMPLOYEE</th>
                                        <th class="text-center">TARGET RATING</th>
                                        <th class="text-center">OVERALL RATING</th>
                                        <th class="text-center">APPRAISAL YEAR</th>
                                        <th class="text-center">ACTION</th>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

  
  $(document).ready(function () {

   $('.appraisalList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('appraisal.list') }}",
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
                    data: 'department',
                    className: "text-center"
                },
                  {
                    data: 'designation',
                    className: "text-center"
                },
               
                {
                    data: 'employee',
                    className: "text-center"
                },
                  {
                    data: 'target_rating',
                    className: "text-center"
                },
                 {
                    data: 'overall_rating',
                    className: "text-center"
                },
                  {
                    data: 'appraisal_year',
                    className: "text-center"
                },
                 {
                    data: 'action',
                    className: "text-center"
                }
             
            ],

      
 
        });

    
  }) 



      document.getElementById('appraisal_year').value = new Date().getFullYear();


        function slugify(str) {
         
                    str = str.replace(/^\s+|\s+$/g, ''); // trim leading/trailing white space
                str = str.toLowerCase(); // convert string to lowercase
                str = str.replace(/[^a-z0-9 -]/g, '') // remove any non-alphanumeric characters
                        .replace(/\s+/g, '-') // replace spaces with hyphens
                        .replace(/-+/g, '-'); // remove consecutive hyphens
                return str;     // Replace multiple - with single -
}





  $(document).on('change','#departmentName', function(e){
    e.preventDefault();
   var  departmentID = $(this).val();


             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('get.designation') }}",
                    type: 'GET',
                    data: {department_id :departmentID  },
                    success: function (response) {
                      
                    if(response.status == true){


                          $('#designationName').empty(); 
                      var unitHtml = document.createElement('option');
                          unitHtml.innerHTML ='--Select Designation-- ';
                              document.getElementById('designationName').appendChild(unitHtml);

                           response.designation.forEach(el => {
                      const newOption = document.createElement('option');
                      newOption.value = el.id;                     
                      newOption.textContent = el.name;
                      document.getElementById('designationName').appendChild(newOption);
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
  
          $(document).on('change','#designationName', function(e){
            e.preventDefault();
          var  designationID = $(this).val();

                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    $.ajax({
                    url: "{{ route('get.employee') }}",
                    type: 'GET',
                    data: {designationt_id :designationID  },
                    success: function (response) {

                     //   console.log(response);
                      //  debugger;
                      
                    if(response.status == true){

                              $('#employeeName').empty();  
                             var unitHtml = document.createElement('option');
                          unitHtml.innerHTML ='--Select Employee-- ';
                              document.getElementById('employeeName').appendChild(unitHtml);

                           response.employees.forEach(el => {
                       const newOption = document.createElement('option');
                      newOption.value = el.id;
                      newOption.textContent = el.first_name + ' ' + el.last_name;
                     document.getElementById('employeeName').appendChild(newOption);

                      });


                    };
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');searchBtn

    }
                });

})


            $(document).on('click','.searchBtn-container button', function(e){
                e.preventDefault();

              var desgn =$('#designationName').val();
                var department =$('#departmentName').val();

                if(!department){
                alert('Choose a Department');
                return false;
                }
                else if(!desgn){
                    alert('Choose a Designation');
                    return false;

                }

              var  year = $('#appraisal_year').val();
              var employeeId = $('#employeeName').val();

            if (employeeId == null || employeeId === '') {
                alert('Choose an employee');
                    return false;; 
                }

                else if(!year){
                    alert('Choose a Year');
                    return false;

                }


             $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('get.rating.data') }}",
                    type: 'GET',
                    data: {appraisal_year :year , employee_id:employeeId },
                    success: function (response) {

                      
                    if(response.status == true){

                          var unitHtml =   `  
                          <div class="row mt-3">
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1"></div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <h6>Indicator</h6>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <h6>Appraisal</h6>
              </div>`;


              response.titles.forEach((el)=>{

                    
           unitHtml +=  `     <div class="col-12">
                    <h6 style="margin-bottom: 0px">${el.title}</h6>
                    <hr style="margin-top: 5px" />
                  </div>`;

                      response.data.forEach((item)=>{

                        if(item.title_id.id == el.id){

                                  unitHtml   +=  ` <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                                <p> ${item.sub_title.sub_title}</p>
                            </div> 

                            <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][subTitleId]" value="${item.sub_title.id}">
                             <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][titleId]" value="${item.title_id.id}">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <span>
                      <i class="fa-star ${ item.rating >= 1 ? 'fas' : 'far' } text-warning star" data-value="1"></i>
                    <i class="fa-star ${ item.rating >= 2 ? 'fas' : 'far' } text-warning star" data-value="2"></i>
                    <i class="fa-star ${ item.rating >= 3 ? 'fas' : 'far' } text-warning star" data-value="3"></i>
                    <i class="fa-star ${ item.rating >= 4 ? 'fas' : 'far' } text-warning star" data-value="4"></i>
                    <i class="fa-star ${ item.rating >= 5 ? 'fas' : 'far' } text-warning star" data-value="5"></i>

                </span>
              </div>
 
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <span class="editable-stars">
                 <i class="fa-star far text-warning star" data-value="1"></i>
                    <i class="fa-star far  text-warning star" data-value="2"></i>
                    <i class="fa-star far text-warning star" data-value="3"></i>
                    <i class="fa-star far text-warning star" data-value="4"></i>
                    <i class="fa-star far text-warning star" data-value="5"></i>

                </span>
              <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][rating]" id="rating_${item.sub_title.id}">
              </div>  ` ;


                           }
                    })

                });

                  unitHtml += ` 
                                  </div>
                   <div class="form-group text-center mt-3">
                                        <button data-id="${response.indicatorId}" type="submit" id="submitAppraisalRating" class="btn btn-success">Submit</button>
                                    </div>

                                   `;

            $('#employeeRatingDetails').html(unitHtml); 

                    }

                    else if (response.status == false){
                                     toastr.error(response.message);

                    }

                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });

})




         $(document).on('submit', '#createAppraisal', function(e) {

                        e.preventDefault(); 

                     let id =  $('#submitAppraisalRating').data('id');
                            let formData = new FormData(this);
                            formData.append('indicatorId', id);


                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.appraisal.rating') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                               window.location.href= '{{ route('appraisal.list') }}';

                    }
                       else if(response.status == false){
                                 toastr.error(response.message);

                    }
                    },
                     error: function(xhr, status, error) {
                     console.log('AJAX Error:', error);        
                       console.log('Status:', status); 
                      console.log('Response Text:', xhr.responseText); 
                    alert('An error occurred');

    }
                });
       
    });

  $(document).on('click', '#appraisalDetailsBtn', function() {

                $("#appraisalDetailsModal").modal('show');
            var appraisalId = $(this).data('id'); 
            
            $.ajax({
                url: `/edit_appraisal_details/${appraisalId}`,
                type: 'GET',
                success: function(response) {

                if(response.status == true && response.indicatorRatingDeleted == false ){

                  

              let unitHtml =       ` <form id="editAppraisal">

                                                          <div class="row">

                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6  class="form-label">Department</h6>
                                             <input type="text" class="form-control" value="${response.appraisalDetails.department.department}" readonly>

                                                              </div>
                                                            </div>
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                  <h6  class="form-label">Designation</h6>                                                                    
                                                  <input type="text" class="form-control" value="${response.appraisalDetails.job_title.name}" readonly>
                                                              </div>
                                                            </div>
                                              
                                                          </div>
                                                            <div class="row">
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6  class="form-label">Employee*</h6>
                                                  <input type="text" class="form-control" value="${response.rated_emp.first_name} ${response.rated_emp.last_name} " readonly>
                                                               
                                                              </div>
                                                            </div>
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6 for="" class="form-label">Enter Year*</h6>
                                                              <input type="text" value="${response.appraisalDetails.appraisal_year}"  id="appraisal_year" class="form-control" readonly />

                                                                {{-- <input type="number" name="appraisal_year" id="appraisal_year" class="form-control" min="1900" max="2099" step="1" placeholder="Enter year" /> --}}
                                                              </div>
                                                            </div>`

                                                            let remarks = response.appraisalDetails.remarks == null? '': response.appraisalDetails.remarks ;
                                               
                                                      unitHtml +=    `  <div class="col-12 mb-2">
                                                              <div>
                                                                <h6 for="" class="form-label">Remarks</h6>
                                                                <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter Remarks">${remarks}</textarea>
                                                              </div>
                                                            </div>
                                                          </div>

                                                          <div id="editRatingDetails">   
                                                          
                                                            <div class="row mt-3">
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1"></div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <h4>Indicator</h4>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <h4>Appraisal</h4>
              </div>   `
                                                                 
                                                                 

              response.titles.forEach((el)=>{

                    
           unitHtml +=  `     <div class="col-12">
                    <h4 style="margin-bottom: 0px">${el.title}</h4>
                    <hr style="margin-top: 5px" />
                  </div>`;

                      response.data.forEach((item)=>{

                        if(item.title_id == el.id){

                                  unitHtml   +=  ` <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                                <p style="color:gray;"> ${item.sub_title.sub_title}</p>
                            </div> 

                            <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][subTitleId]" value="${item.sub_title.id}">
                             <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][titleId]" value="${item.title_id}">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <span>
                      <i class="fa-star ${ item.emp_indicator_rating >= 1 ? 'fas' : 'far' }  text-warning star" data-value="1"></i>
                    <i class="fa-star  ${ item.emp_indicator_rating >= 2 ? 'fas' : 'far' }   text-warning star" data-value="2"></i>
                    <i class="fa-star  ${ item.emp_indicator_rating >= 3 ? 'fas' : 'far' }  text-warning star" data-value="3"></i>
                    <i class="fa-star  ${ item.emp_indicator_rating >= 4 ? 'fas' : 'far' }   text-warning star" data-value="4"></i>
                    <i class="fa-star   ${ item.emp_indicator_rating >= 5 ? 'fas' : 'far' }   text-warning star" data-value="5"></i>

                </span>
              </div>
 
              <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                <span class=" ${ response.giveAppraisalStatus== 1?  'editable-stars' : ''  } ">
                 <i class="fa-star  ${ item.rating >= 1 ? 'fas' : 'far' }  text-warning star" data-value="1"></i>
                    <i class="fa-star   ${ item.rating >= 2 ? 'fas' : 'far' }  text-warning star" data-value="2"></i>
                    <i class="fa-star  ${ item.rating >= 3 ? 'fas' : 'far' }  text-warning star" data-value="3"></i>
                    <i class="fa-star   ${ item.rating >= 4 ? 'fas' : 'far' } text-warning star" data-value="4"></i>
                    <i class="fa-star   ${ item.rating >= 5 ? 'fas' : 'far' } text-warning star" data-value="5"></i>

                </span>
              <input type="hidden" value=${ item.rating} name="data[${slugify(item.sub_title.sub_title)}][rating]" id="rating_${item.sub_title.id}">
              </div>  ` ;


                           }
                    })

                });

                  unitHtml += ` 
                                  </div>
                   <div class="form-group text-center mt-3">
                                        <button data-id="${response.appraisalDetails.id}" type="submit" id="submitAppraisalRating" class="btn btn-success">Submit</button>
                                    </div>
                                      </div>
                                       </div>
                                                          
                                      </form>

                                   `;
                                         
                            $('.appraisalDetailsBody').html(unitHtml);
                            
                                
                }

                    if(response.status == true && response.indicatorRatingDeleted == true ){
                             
                 
                 let unitHtml = `  <form id="editAppraisal">

                                                          <div class="row">

                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6  class="form-label">Department</h6>
                                             <input type="text" class="form-control" value="${response.appraisalDetails.department.department}" readonly>

                                                              </div>
                                                            </div>
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                  <h6  class="form-label">Designation</h6>                                                                    
                                                  <input type="text" class="form-control"  value="${response.appraisalDetails.job_title.name}" readonly>
                                                              </div>
                                                            </div>
                                              
                                                          </div>
                                                            <div class="row">
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6  class="form-label">Employee*</h6>
                                                  <input type="text" class="form-control" value="${response.rated_emp.first_name} ${response.rated_emp.last_name}" readonly>
                                                               
                                                              </div>
                                                            </div>
                                              
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">
                                                              <div>
                                                                <h6 for="" class="form-label">Enter Year*</h6>
                                                              <input type="text" value="${response.appraisalDetails.appraisal_year}"  id="appraisal_year" class="form-control" readonly />

                                                              </div>
                                                            </div>`;

                                                                let remarks = response.appraisalDetails.remarks == null? '': response.appraisalDetails.remarks ;

                                              unitHtml +=        ` <div class="col-12 mb-2">
                                                              <div>
                                                                <h6 for="" class="form-label">Remarks</h6>
                                                                <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter Remarks">${remarks}</textarea>
                                                              </div>
                                                            </div>
                                                          </div>

                                                          <div id="editRatingDetails">   
                                                          
                                                            <div class="row mt-3">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1"></div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-1">
                                          <h4>Appraisal</h4>
                                        </div>`;


                                        response.titles.forEach((el)=>{
                                         
                                         unitHtml += `<div class="row align-items-center mb-4 mt-4 "> 
                                                 <div class="col-12">
                                                  <h3>${el.title}</h3>
                                                </div>
                                                   <hr class="mt-0 w-100">`;


                                                     response.data.forEach((item)=>{
                                                        if(el.id == item.title_id){

                                                   
                                                    unitHtml += `<div class="col-xl-6 col-lg-6 col-md-7 col-12 mb-1 subTitleContainer">
                                                              <label for="${slugify(item.sub_title.sub_title)}">${item.sub_title.sub_title }</label>
                                                              
                                                         <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][subTitleId]" value="${item.sub_title.id}">
                                                         <input type="hidden" name="data[${slugify(item.sub_title.sub_title)}][titleId]" value="${item.title_id}">

                                                  </div>
                                                  
                                                   <div class="col-xl-6 col-lg-6 col-md-7 col-12 mb-1 ">
                                                   <div class="rate"> 

                                                       <span class=" ${response.giveAppraisalStatus== 1?  'editable-stars' : ''  }">
                                                        <i class="fa-star  ${ item.rating >= 1 ? 'fas' : 'far' }  text-warning star" data-value="1"></i>
                                                            <i class="fa-star   ${ item.rating >= 2 ? 'fas' : 'far' }  text-warning star" data-value="2"></i>
                                                            <i class="fa-star  ${ item.rating >= 3 ? 'fas' : 'far' }  text-warning star" data-value="3"></i>
                                                            <i class="fa-star   ${ item.rating >= 4 ? 'fas' : 'far' } text-warning star" data-value="4"></i>
                                                            <i class="fa-star   ${ item.rating >= 5 ? 'fas' : 'far' } text-warning star" data-value="5"></i>

                                                        </span>
                                                    <input type="hidden" value=${ item.rating} name="data[${slugify(item.sub_title.sub_title)}][rating]" id="rating_${item.sub_title.id}">
       
                                            </div>
                                                  </div>`


                                                        }})

                                                           unitHtml += `</div>`;


                                        })



                                          unitHtml += `  <div class="form-group text-center mt-3">
                                        <button data-id="${response.appraisalDetails.id}" type="submit" id="submitAppraisalRating" class="btn btn-success">Submit</button>
                                    </div>

                                 </form>    `;
                                                       
                                    
                              $('.appraisalDetailsBody').html(unitHtml);


                    }


                },
                
            });
    });


                
 
                       $(document).on('submit', '#editAppraisal', function(e) {

                        e.preventDefault(); 
                            let formData = new FormData(this);    
                             let  id = $('#submitAppraisalRating').data('id');

                    formData.append('id', id);

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('update.appraisal.details') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= '{{ route('appraisal.list') }}';

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



</script>


<script>

$(document).on('click', '.editable-stars .star', function () {
    const rating = $(this).data('value');
    const ratingInput = $(this).closest('div').find('input[type="hidden"]');

    ratingInput.val(rating);

    $(this).parent().find('.star').each(function () {
        const value = $(this).data('value');
        $(this).removeClass('fas far').addClass(value <= rating ? 'fas' : 'far');
    });
});


       $(document).on('click', '#deleteAppraisalBtn', function(e) {
                                     
                                     e.preventDefault();
                                    let  id = $(this).data('id');

                                           $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });


                           $.ajax({
                                url: `/delete_appraisal/${id}`,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                       
                                if(response.status == true){
                                            toastr.success(response.message);
                                            window.location.href= '{{ route('appraisal.list') }}';

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


</script>

