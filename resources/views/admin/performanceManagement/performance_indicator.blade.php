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

#indicatorDetailsBtn{
 background: #3ec9d6 !important;
    color: #ffff !important;
    border: none;
}

</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}




<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">

            @if ($message)
    <div>{{ $message }}</div>


@elseif (!$message)
            
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="card-title">
                                    <h3 class="main-heading heading">Performance<span>Indicator</span> </h3>
                                </div>

                                                        
                                <div class="card-title  button-container">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#indicatorModal" >Create New Indicator</button>
                                </div>

                            </div>
                            <div class="card">
                                    
                                                <!-- Creae new Indicator Modal -->

                        <div class="modal" id="indicatorModal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New Indicator</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body">


                                  <form id="createNewIndicator">

                                         <div class="row">

                                    <div class="form-group col-6">
                                            <label>Department</label>
                                             <input type="text" class="form-control" value="{{ $department->department }}" readonly>
                                                <input type="hidden" name="department" value="{{ $department->id }}">
                                        </div>


                                           <div class="form-group col-6">
                                            <label>Designation</label>
                                            <input type="text" class="form-control" value="{{ $designation->name }}" readonly>
                                              <input type="hidden" name="designation" value="{{ $designation->id }}">
                                        </div>

                                         
                                         </div>


                                           <div class="row">
                                                   <div class="form-group col-12">
                                    <h6 for="" class="form-label">Enter Year*</h6>
                                    {{-- <input type="month" name="appraisal_year" id="appraisal_year" class="form-control"  required /> --}}
                                <input type="number" min="1900" max="2099" step="1"  name="appraisal_year" id="appraisal_year" class="form-control"  required />

                                    </div>

                                         
                                         </div>
                                         

                                                               @foreach ($titles as $title)

                                                   <div class="row align-items-center mb-4 mt-4 "> 
                                                 <div class="col-12">
                                                    <h3>{{ $title->title }}</h3>
                                                </div>
                                                
                                                   <hr class="mt-0 w-100">
                                                     @foreach ( $subTitles as $subTitle )
                                                       @if ($title->id == $subTitle->title_id)
                                                
                                                  <div class="col-xl-6 col-lg-6 col-md-7 col-12 mb-1 subTitleContainer">
                                                        <label for="{{ Str::slug($subTitle->sub_title) }}">{{ $subTitle->sub_title }}</label>


                                                            {{-- <input type="hidden" name="subTitleId_{{ Str::slug($subTitle->sub_title) }}" value="{{ $subTitle->id }}">
                                                         <input type="hidden" name="titleId_{{ Str::slug($subTitle->sub_title) }}" value="{{ $title->id }}"> --}}

                                                         <input type="hidden" name="data[{{ Str::slug($subTitle->sub_title) }}][subTitleId]" value="{{ $subTitle->id }}">
                                                         <input type="hidden" name="data[{{ Str::slug($subTitle->sub_title) }}][titleId]" value="{{ $title->id }}">

                                                  </div>

                                                  
                                                  <div class="col-xl-6 col-lg-6 col-md-7 col-12 mb-1 ">

                                                   <div class="rate">

                                                    <input type="radio" id="star5_{{ $subTitle->id }}" name="data[{{ Str::slug($subTitle->sub_title) }}][rating]" value="5" />
                                                    <label for="star5_{{ $subTitle->id }}" title="5 stars">5 stars</label>
                                                    <input type="radio" id="star4_{{ $subTitle->id }}" name="data[{{ Str::slug($subTitle->sub_title) }}][rating]" value="4" />
                                                    <label for="star4_{{ $subTitle->id }}" title="4 stars">4 stars</label>
                                                    <input type="radio" id="star3_{{ $subTitle->id }}" name="data[{{ Str::slug($subTitle->sub_title) }}][rating]" value="3" />
                                                    <label for="star3_{{ $subTitle->id }}" title="3 stars">3 stars</label>
                                                    <input type="radio" id="star2_{{$subTitle->id }}" name="data[{{ Str::slug($subTitle->sub_title) }}][rating]" value="2" />
                                                    <label for="star2_{{ $subTitle->id }}" title="2 stars">2 stars</label>
                                                    <input type="radio" id="star1_{{ $subTitle->id }}" name="data[{{ Str::slug($subTitle->sub_title) }}][rating]" value="1" />
                                                    <label for="star1_{{ $subTitle->id }}" title="1 star">1 star</label>              

                                            </div>
                                                  </div>
                                                    @endif
                                                    @endforeach

                                                </div>

                                                           @endforeach
                                    
                                    <div class="form-group text-center mt-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>

                                 </form>          
                               </div>

                            </div>
                       </div>
                 </div>
                </div>


                              
                              {{-- Update Indicator Details Modal --}}


                                      <div>
                                 <div class="modal fade indicatorDetailsModal" id="indicatorDetailsModal"  tabindex="-1" aria-labelledby="modalLabel" >
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                <h4 class="modal-title">Title</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <div class="modal-body  indicatorDetailsBody">

                                    {{-- dynamically appended in modal --}}

                                    </div>
                                </div>
                        </div>
                        </div>   
                                      
                  </div>


            

                <div class="container-fluid shadow-lg p-3">
                        <div class="card-body table-responsive">
                            <table class="table custom-table datatable display compact indicatorList mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th class="text-center">DEPARTMENT</th>
                                        <th class="text-center">DESIGNATION</th>
                                        <th class="text-center">OVERALL RATING</th>
                                        <th class="text-center">ADDED BY</th>
                                        <th class="text-center">CREATED AT</th>
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

@endif

<!-- Script Code -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>


        function slugify(str) {
       
                    str = str.replace(/^\s+|\s+$/g, ''); // trim leading/trailing white space
                str = str.toLowerCase(); // convert string to lowercase
                str = str.replace(/[^a-z0-9 -]/g, '') // remove any non-alphanumeric characters
                        .replace(/\s+/g, '-') // replace spaces with hyphens
                        .replace(/-+/g, '-'); // remove consecutive hyphens
                return str;     // Replace multiple - with single -
}



    $(document).on('submit', '#createNewIndicator', function(e) {
            e.preventDefault(); 

                let formData = new FormData(this);

        //     for(var pair of formData.entries()) {
         //   console.log(pair[0]+ ':'+ pair[1]); 
         //    }
         
         
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.new.indicator') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                              window.location.href= '{{ route('indicator.list') }}';

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
 



   
  $(document).ready(function () {

   $('.indicatorList').DataTable( {
   
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ajax: {
                url: "{{ route('indicator.list') }}",
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
                    data: 'overall_rating',
                    className: "text-center"
                },
                  {
                    data: 'added_by',
                    className: "text-center"
                },
                 {
                    data: 'created_at',
                    className: "text-center"
                },
                 {
                    data: 'action',
                    className: "text-center"
                }
             
            ]
 
        });




       document.getElementById('appraisal_year').value = new Date().getFullYear();



    
  }) 

      
            $(document).on('click', '#indicatorDetailsBtn', function() {

                $("#indicatorDetailsModal").modal('show');
            var IndicatorId = $(this).data('id'); 
            
            $.ajax({
                url: `/update_indicator_details/${IndicatorId}`,
                type: 'GET',
                success: function(response) {

                if(response.status == true){
                            
                               let   unitHtml =`  <form id="updateIndicator">

                                         <div class="row">

                                    <div class="form-group col-6">
                                            <label> Department</label>
                                    <input type="text" class="form-control" value="${response.indicatorDetails.department.department}" readonly>
                                                  
                                                   </div>
                                                    <div class="form-group col-6">
                                            <label>Designation</label>
                                   <input type="text" class="form-control" value="${response.indicatorDetails.job_title.name}" readonly>

                                        </div>
                                         </div>
                                         <div class="row">
                                            <div class="form-group col-md-6">
                                            <label> Year</label>
                                    <input type="text" class="form-control" value="${response.indicatorDetails.appraisal_year}" readonly>
                                                  
                                                   </div>
                                         </div>`;

                                         response.titles.forEach((el)=>{
                                                       
                                              unitHtml += `   <div class="row align-items-center mb-4 mt-4 "> 
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

                                                       <span class=" ${ response.change_rating_allowed== 1?  'editable-stars' : ''  }">
                                                        <i class="fa-star  ${ item.rating >= 1 ? 'fas' : 'far' }  text-warning star" data-value="1"></i>
                                                            <i class="fa-star   ${ item.rating >= 2 ? 'fas' : 'far' }  text-warning star" data-value="2"></i>
                                                            <i class="fa-star  ${ item.rating >= 3 ? 'fas' : 'far' }  text-warning star" data-value="3"></i>
                                                            <i class="fa-star   ${ item.rating >= 4 ? 'fas' : 'far' } text-warning star" data-value="4"></i>
                                                            <i class="fa-star   ${ item.rating >= 5 ? 'fas' : 'far' } text-warning star" data-value="5"></i>

                                                        </span>
                                                    <input type="hidden" value=${ item.rating} name="data[${slugify(item.sub_title.sub_title)}][rating]" id="rating_${item.sub_title.id}">
       
                                            </div>
                                                  </div>`;

                                                        }
                                                    })

                             unitHtml += `</div>`;
                                        
                                         })

                           unitHtml += `  <div class="form-group text-center mt-3">
                                        <button data-id=${IndicatorId}  type="submit" id="submitUpdateIndicator" class="btn btn-success">Submit</button>
                                    </div>

                                 </form>    `;

                                   $('.indicatorDetailsBody').html(unitHtml ) ;
                                
                }

                },
                
            });
    });


                $(document).on('click', '.editable-stars .star', function () {
                    const rating = $(this).data('value');
                    const ratingInput = $(this).closest('div').find('input[type="hidden"]');

                    ratingInput.val(rating);

                    $(this).parent().find('.star').each(function () {
                        const value = $(this).data('value');
                        $(this).removeClass('fas far').addClass(value <= rating ? 'fas' : 'far');
                    });
                });


                       $(document).on('submit', '#updateIndicator', function(e) {

                        e.preventDefault(); 
                        let formData = new FormData(this);            
                          let  id = $('#submitUpdateIndicator').data('id');

                    formData.append('id', id);

                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.update.indicator') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                                window.location.href= '{{ route('indicator.list') }}';

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




       $(document).on('click', '#deleteIndicatorBtn', function(e) {
                                     
                                     e.preventDefault();
                                    let  id = $(this).data('id');

                                

                                           $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });


                           $.ajax({
                                url: `/delete_indicator/${id}`,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                success: function (response) {
                       
                                if(response.status == true){
                                            toastr.success(response.message);
                                            window.location.href= '{{ route('indicator.list') }}';

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