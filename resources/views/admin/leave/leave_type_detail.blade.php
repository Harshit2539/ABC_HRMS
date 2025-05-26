@extends('layouts.master')
 
 

@section('content')

 
 
<!-- Main content -->
<div class="page-wrapper">
    <div class="container-fluid mt-4">
     
 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                             <h3 class="card-label">Leave Type Details ({{$leave_type}}) {{$year}}</h3>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                                <figure class="highcharts-figure">
                                    <div id="leave-details-chart"></div>
                                </figure>
            </div>
                       
                       
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                       
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->


           
        </div>
 
 
 
     
 

    </div>
   
 
   
 
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>
 
 
 
 
    <script>
                let leaveData = @json(array_values($formattedData)); // Convert PHP array to JSON array
                let LeaveType = @json($leave_type); // Convert PHP array to JSON array
                let Year = @json($year); // Convert PHP array to JSON array


        Highcharts.chart('leave-details-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Leave '
                },
                subtitle: {
                    text:
                        // 'Source: <a target="_blank" ' +
                        // 'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>'
                        ''
                },
                xAxis: {
                    categories: ['Jan'+" "+Year, 'Feb'+" "+Year, 'Mar'+" "+Year, 'Apr'+" "+Year, 'May'+" "+Year, 'Jun'+" "+Year, 'Jul'+" "+Year, 'Aug'+" "+Year, 'Sep'+" "+Year, 'Oct'+" "+Year, 'Nov'+" "+Year, 'Dec'+" "+Year],
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Days'
                    }
                },
                tooltip: {
                    valueSuffix: '(In Days)'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [
                    {
                        name: LeaveType,
                        data: leaveData
                    },
                    
                ]
        });












    
        
    
    
        
    </script>
 
  @endsection