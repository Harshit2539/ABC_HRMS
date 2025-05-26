
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    
   
   
   <style>
   
   * {
        box-sizing: border-box;
      margin: 0;
      padding: 0;
         
   }
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
       
         .page-wrapper{
               
                   margin-top: 15%;
           
         }
   
         .loader-container{
                
                display:flex;
                justify-content:center;
                align-items:center;
                   
         }
   
       .loader {
       width: 60px;
       aspect-ratio: 1;
       --c:no-repeat linear-gradient(orange 0 0);
       background:
           var(--c) left   20px top    0,
           var(--c) top    20px right  0,
           var(--c) right  20px bottom 0,
           var(--c) bottom 20px left   0;
       background-size:calc(100%/3) calc(100%/3);
       animation: 
           l29-1 .75s infinite alternate linear,
           l29-2 1.5s infinite;
       }
       @keyframes l29-1 {
       90%,100% {background-size:calc(2*100%/3) calc(100%/3),calc(100%/3) calc(2*100%/3)}
       }
       @keyframes l29-2 {
       0%,49.99% {transform:scaleX(1)}
       50%,100%  {transform:scaleX(-1)}
       }
   
      
   
   </style>
   
   <!-- Main content -->
           <div class="page-wrapper main " >
          
      
               <div class="container-fluid mt-4 loader-container " >
                <div>
              <img src="assets/img/redianlogo.jpeg" alt="">
   
           </div>
               <span class="loader"></span>
           </div>
   
               
   </div>
   
   <!-- Script Code -->
   @section('scripts')
       <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    @endsection
   
               <script>
      window.onload = function(){
                 setTimeout(()=>{
                window.location.href= '{{ route('home') }}';
           },1000)
      }
               </script>
           
         
               
   