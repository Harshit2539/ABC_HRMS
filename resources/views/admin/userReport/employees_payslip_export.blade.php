@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
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
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="main-heading">Employees<span>Payslip</span></h3>
                        </div>
                    </div>

                    <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <div class="row">
                        <div class="col-sm-4">
                            <input class="form-control" type="month" id="start" name="start" min="2018-03" value="{{ now()->format('Y-m') }}">
                        </div>
                        <div class="col-sm-4">
                            <a href="javascript:void(0)" id="exportBtn"><button type="button" class="btn btn-primary"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            Excel</button></a>
                            <a href="javascript:void(0)" id="exportPdfBtn"><button type="button" class="btn btn-danger" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            PDF</button></a>
                        </div>
                        </div>
                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
   
    $('#exportBtn').on('click', function () {
        let selectedMonth = $('#start').val();

        if (!selectedMonth) {
            let currentDate = new Date();
            selectedMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }

        $.ajax({
            url: "{{ route('employees-payslip.export') }}",
            type: "GET",
            data: { month: selectedMonth },
            xhrFields: {
                responseType: 'blob' // Ensures proper handling of file downloads
            },
            success: function (response) {
                let blob = new Blob([response], { type: 'application/vnd.ms-excel' });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "payslip_" + selectedMonth + ".xlsx";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function (xhr, status, error) {
                console.error("Error exporting payslip:", error);
                alert("Failed to export payslip. Please try again OR May be data not found");
            }
        });
    });


    $('#exportPdfBtn').on('click', function () {
        let selectedMonth = $('#start').val();

        if (!selectedMonth) {
            let currentDate = new Date();
            selectedMonth = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2);
        }

        window.location.href = "{{ route('employees-payslip.export.pdf') }}?month=" + selectedMonth;
    });



</script>


@endsection 