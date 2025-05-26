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


 .graph-icon{
         margin-top: 22px;
      }
 
     #addTitleBox i{
         font-size: 45px;
     }
 
 

.title{
      border-radius: 0px;
    width: 400px;
    padding: 13px 5px;
    background-color: #edebeb;
    border-bottom: 4px solid gray !important;
    outline: none;
    border: none;
}

.sub-title{
      border-radius: 0px;
    width: 300px;
    padding: 13px 5px;
    background-color: white;
    border-bottom: 4px solid lightgray !important;
    outline: none;
    border: none;
}

#addTitleBox{
    border: none;
}

.add-sub-title{
    border-radius: 0px;
    width: 300px;
    padding: 13px 5px;
    background-color: white;
    outline: none;
    border: none;
    color: lightslategray;
    cursor:pointer;
    }


    .cross-icons{
  position:absolute;
right:-20px;
top:-10px;
font-weight:900;
    cursor: pointer;
}



</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}



<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">
            <form id='storeIndicatorForm'>   
                <div class="row justify-content-center">
                                                    

                    <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10 col-12">
                      <div class="row mb-2 mt-2">
                              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-1">
                               <label> Select Department</label>
                                      <select class="form-control" id="department_dropdown" name="department" required>
                                                <option value="" disabled selected >--Select Department-- </option>
                                                 @foreach ($departments as $department)
                                            <option value="{{  $department->id  }}">{{ $department->department }}</option>
                                                @endforeach
                                            </select>
                              </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-1">
                               <label> Select Designation</label>
                                <select class="form-control" id="designation" name="designation" required>
                                <option value="" disabled >--Select Designation-- </option>
                                {{-- options are appended dynamically --}}
                            </select>                            
                              </div>
                            </div>


                       <div class="card p-3"  id="newTitle"  style="background-color:rgb(255, 255, 255); border-left: 4px solid cornflowerblue;">
                         <a href="javascript:void(0)" class="cross-icons remove-title">&#10005;</a>
                    <div class="card-body">
                          <div class="title-box">
                            <input type="text" class="title mb-2" name="indicators[0][title]"  id="indicatorTitle" value=""  placeholder="Title" required> <br>
                        
                            {{-- <input type="text" class="sub-title mb-2" name="titles[0][subTitle][]"  id="indicatorSubTitle" value=""  placeholder="Sub-title" required> --}}
                            
                             <div id="subtitle_entries">
                                 <div id="newSubTitle">
                                     <input type="text" class="sub-title mb-2" name="indicators[0][subTitle][]"  id="indicatorSubTitle" value=""  placeholder="Sub-title" required>
                                    <span style="cursor:pointer" id="removeSubTitle" >&#10005;</span>
                                 
                                 </div>
                             {{-- dynamic entries --}}

                             </div>


                 <p type="text" class="add-sub-title mb-2" style=" color: lightskyblue;"   id="addSubTitle"  name=""  data-title-index="0"   >Add new Sub Title</p> 
                             
                    </div>

                    </div>

                                </div>

                                <div class="newIndicator_entries">
                            {{-- dynamcially appended here --}}
                            
                                </div>
                                
                  <div class="card-text text-center graph-icon">

                  <div><a href="javascript:void(0)" id="addTitleBox"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> </div>
                  <div style="margin-top: 8px; padding-bottom: 10px;">   <button id='submitIndicatorForm'  class="btn btn-primary">submit</button>  </div>
                          
                        </div>
            <!-- /.col -->
        </div>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
   

    </div>

    </form>

</div>



<!-- Script Code -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer ></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap4.js" defer ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>



     $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


        $(document).on('change','#department_dropdown', function(e){
            e.preventDefault();
            departmentID = $(this).val();
    

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


            let titleCount  = 1;

     $(document).on('click','#addTitleBox', function(){
    
    $('.newIndicator_entries').append(`
                       <div class="card shadow-lg p-3" id="newTitle" style="background-color:rgb(248, 249, 250); border-left: 4px solid cornflowerblue;">
                    <a href="javascript:void(0)" class="cross-icons remove-title">&#10005;</a>
                    <div class="card-body">
                          <div class="title-box">
                            <input type="text" class="title mb-2" name="indicators[${titleCount}][title]"  id="indicatorTitle" value=""  placeholder="Title" required> <br>
                            <input type="text" class="sub-title mb-2" name="indicators[${titleCount}][subTitle][]"  id="indicatorSubTitle" value=""  placeholder="Sub-title" required>
                            <span style="cursor:pointer" id="removeSubTitle" >&#10005;</span>
                               <div id="subtitle_entries">
                             {{-- dynamic entries --}}

                             </div>
                 <p type="text" style=" color: lightskyblue;" class="add-sub-title mb-2" name="" data-title-index="${titleCount}"   >Add new Sub Title</p>

                    </div>
                    </div>
                   </div>` );

                   titleCount++;

                           

    })

        $(document).on('click', '.add-sub-title', function () { 
        let titleIndex = $(this).data('title-index'); 
        let subtitleWrapper = $(this).siblings('#subtitle_entries');

        subtitleWrapper.append(`<div id="newSubTitle">
            <input type="text" class="sub-title mb-2" name="indicators[${titleIndex}][subTitle][]" placeholder="Sub-title" required>
            <span style="cursor:pointer" id="removeSubTitle" >&#10005;</span>
            </div>
        `);
    });

    $(document).on('submit', '#storeIndicatorForm', function(e) {
            e.preventDefault(); 

                let formData = new FormData(this);
     
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('store.indicator.form') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                              window.location.href= '{{ route('indicator.form') }}';

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


         $(document).on('click','.remove-title',function(){
            $(this).closest('#newTitle').remove()
         })

           $(document).on('click','#removeSubTitle',function(){
            $(this).closest('#newSubTitle').remove()
         })

      </script>

    @endsection 