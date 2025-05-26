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
        color: #868686;
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

   
</style>

@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<!-- Main content -->
        <div class="page-wrapper">
            <div class="container-fluid mt-4">
            <form id='updateIndicatorForm'>   
                <div class="row justify-content-center">

                    <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10 col-12">
                      <div class="row mb-2 mt-2">
                              <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-1">
                               <label>  Department</label>

                                <input type="text" class="form-control" value="{{ $department->department }}" readonly>
                               
                              </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-1">
                               <label> Select Designation</label>
                            <input type="text" class="form-control" value="{{ $designation->name }}" readonly>
                              </div>
                            </div>
                                     
                                     <?php  
                                     $titleCount = 0;
                                     $subTitleCount =0;
                                      ?>

                                        @foreach ( $titles as $index => $title )
                       <div class="card p-3" style="background-color:rgb(255, 255, 255); border-left: 4px solid cornflowerblue;">
                    <div class="card-body">
                          <div class="title-box">
                        
                            <input type="text"  type="hidden" class="title mb-2"  name="indicators[{{ $index }}][title]" value="{{ $title['title'] }}"      id="indicatorTitle"   placeholder="Title" required>    {{-- name="indicators[{{ $titleCount }}][title]"      id="indicatorTitle" value="{{ $title['title'] }}"  --}}
                            <input type="hidden" class="title mb-2" name="indicators[{{ $index }}][id]" value="{{ $title['id'] }}">{{-- name="indicators[{{ $titleCount }}][title_id]" value="{{ $title['id'] }}"  --}}
                                <br>                             
                                                         
                             <div id="subtitle_entries_{{ $index }}">
                             @foreach ( $subTitles as $subTitle )
                             @if ($subTitle->title_id == $title['id'])
                          <div>
                <input type="text"  name="indicators[{{ $index }}][subtitles][{{ $loop->index }}][sub_title]" value="{{ $subTitle['sub_title'] }}"               class="sub-title mb-2"    id="indicatorSubTitle"   placeholder="Sub-title" required>{{-- name="indicators[ {{  $subTitleCount }} ] [subTitle][]"     value="{{$subTitle->sub_title  }}" --}}
                <input type="hidden"  name="indicators[{{ $index }}][subtitles][{{ $loop->index }}][id]" value="{{ $subTitle['id'] }}"   />
                              </div> 
                              @endif
                                
                             @endforeach

                             {{-- dynamic entries --}}
                             </div>
                 <p type="text" class="add-sub-title mb-2" style=" color: lightskyblue;"   id="addSubTitle"  name=""  data-title-index="{{ $index }}"   >Add new Sub Title</p> 
                             
                    </div>
                    </div>
                                </div>
                                  <?php  
                                     $titleCount++ ;
                                      $subTitleCount++;
                                      ?>
                                  @endforeach
                                <div class="newIndicator_entries">
                            {{-- dynamcially appended here --}}
                            
                                </div>
                                
                  <div class="card-text text-center graph-icon">
                  {{-- <div><a href="javascript:void(0)" id="addTitleBox"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> </div> --}}
                  <div style="margin-top: 8px; padding-bottom: 10px;">   <button id='updateFormBtn' data-id="{{ $id }}"  class="btn btn-primary">submit</button>  </div>            
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


           let titleCount = {{ count($titles) }};

     $(document).on('click','#addTitleBox', function(){
    

    $('.newIndicator_entries').append(`
                       <div class="card shadow-lg p-3" style="background-color:rgb(248, 249, 250);;">
                    <div class="card-body">
                          <div class="title-box">
                            <input type="text" class="title mb-2" name="indicators[${titleCount}][title]"  id="indicatorTitle" value=""  placeholder="Title" required> <br>
                            <input type="text" class="sub-title mb-2" name="indicators[${titleCount}][subTitle][]"  id="indicatorSubTitle" value=""  placeholder="Sub-title" required>

                               <div  id="subtitle_entries_${titleCount}">
                             {{-- dynamic entries --}}

                             </div>
                 <p type="text" style=" color: lightskyblue;" class="add-sub-title mb-2" name="" data-title-index="${titleCount}"   >Add new Sub Title</p>

                    </div>
                    </div>
                   </div>`);


                   titleCount++;

                           

})


     $(document).on('click', '.add-sub-title', function () { 
    let titleIndex = $(this).data('title-index'); 

     let subtitleWrapper = $(`#subtitle_entries_${titleIndex}`);
    let count = subtitleWrapper.children().length;
    
     // let subtitleWrapper = $(this).siblings('#subtitle_entries');

    subtitleWrapper.append(`<div>
        <input type="text" class="sub-title mb-2"   name="indicators[${titleIndex}][subtitles][${count}][sub_title]" placeholder="Sub-title" required> 
        </div>
    `);

    //name="indicators[${titleIndex}][subTitle][]"
});


    $(document).on('submit', '#updateIndicatorForm', function(e) {
            e.preventDefault(); 

                let formData = new FormData(this);

                  let  id = $('#updateFormBtn').data('id');

                    formData.append('id', id);


                  for(var pair of formData.entries()) {
                   console.log(pair[0]+ ':'+ pair[1]); 
                    }
                   //debugger;
     
                      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                    $.ajax({
                    url: "{{ route('update.indicator.form') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                       
                    if(response.status == true){
                                toastr.success(response.message);
                             // window.location.href= '{{ route('indicator.form') }}';

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

      </script>

    @endsection 





