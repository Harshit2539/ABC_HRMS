@extends('layouts.master')
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<style>
  * {
    margin: 0px;
    padding: 0px;
  }

  .dashboard-card .card {
    padding: 15px;
    border: 1px solid #c8d3de;
    border-radius: 0.625rem;
    background-color: white;
    min-height: 100px;
    margin-bottom: 20px;
  }

  .dashboard-card .card:hover {
    box-shadow: 0 4px 8px -0px rgba(57, 67, 87, 0.3);
  }

  .dashboard-card .card span {
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 600;
    color: #5a6a7c;
  }

  .p {
    color: #5a6a7c;
    margin-top: 25px;
    text-align: center;
  }

  .card ul li {
    list-style: none;
    font-size: 14px;
    margin: 5px 0px;
  }

  .Upcoming-holiday {
    text-decoration: none;
    display: flex;
    justify-content: space-between;
  }

  .Upcoming-holiday span {
    display: block;
  }

  .card section {
    display: flex;
    justify-content: space-between;
    margin-top: 1px;
    margin-bottom: 5px;
    align-items: center;
    padding: 5px;
  }

  .card section:hover {
    background-color: #edf3ff;
    border-radius: 5px;
    padding: 5px;
  }

  .card section p {
    margin: 0px;
  }

  .card section a {
    text-decoration: none;
  }

  .graph {
    display: flex;
    justify-content: space-between;
  }

  .graph a {
    text-decoration: none;
    font-weight: 600;
  }
</style>





<div class="page-wrapper">


  <div class="content container-fluid">


  <div class="row dashboard-card pt-3">
    @foreach($holidays as $month => $monthHolidays) 
        <div class="col-12" >
            <h3>{{ $month }}</h3> <!-- Month name -->
        </div>

        @foreach($monthHolidays as $holiday)
            <div class="col-xl-4 col-lg-5 col-md-6 col-12 mb-1">
                <div class="card">
                    <section>
                        <div >
                            <p><span>{{ \Carbon\Carbon::parse($holiday->date_holiday)->format('d F') }}</span> 
                                {{ \Carbon\Carbon::parse($holiday->date_holiday)->format('l') }} <!-- Day Name -->
                            </p>
                            <p>{{ $holiday->name_holiday }}</p>
                        </div>
                        @if ($holiday->is_restrict == 1)
                          <div>
                              @php
                                  // Check if the holiday ID exists in the restrict_leave_id column
                                  $alreadyApplied = collect($employee_restrict_leave)->contains('restrict_leave_id', $holiday->id);
                              @endphp

                              @if ($alreadyApplied)
                                  <a href="javascript:void(0);" class="text-success">Already applied</a>
                              @else
                                  <a href="javascript:void(0);" class="apply-leave" 
                                    data-holiday-id="{{ $holiday->id }}" 
                                    data-holiday-name="{{ $holiday->name_holiday }}" 
                                    data-holiday-date="{{ $holiday->date_holiday }}">
                                    Apply
                                  </a>
                              @endif
                          </div>
                      @endif
                       
                    </section>
                </div>
            </div>
        @endforeach

    @endforeach
  </div>

  </div>





  <div class="modal fade" id="applyLeaveModal" tabindex="-1" aria-labelledby="applyLeaveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apply for Leave</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="leaveApplyForm">
          <input type="hidden" id="holiday_id" name="holiday_id">
          <div class="form-group">
            <label>Holiday Name</label>
            <input type="text" id="holiday_name" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Holiday Date</label>
            <input type="text" id="holiday_date" class="form-control" >
          </div>
          <div class="form-group">
            <label>Leave Reason</label>
            <textarea id="leave_reason" class="form-control" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>









</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>


$(document).ready(function() {
    // Open modal when "Apply" is clicked
    $(document).on('click', '.apply-leave', function() {
        var holidayId = $(this).data('holiday-id');
        var holidayName = $(this).data('holiday-name');
        var holidayDate = $(this).data('holiday-date');

        $('#holiday_id').val(holidayId);
        $('#holiday_name').val(holidayName);
        $('#holiday_date').val(holidayDate);

        $('#applyLeaveModal').modal('show');
    });

    // Handle leave form submission
    $('#leaveApplyForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('restrictleave.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                holiday_id: $('#holiday_id').val(),
                user_reason: $('#leave_reason').val(),
                from_date : $('#holiday_date').val(),
                to_date : $('#holiday_date').val(),
                leave_type : 'Restrict Leave'
            },
            success: function(response) {

             if (response.message == false) {
                    // Show Toastr notification if validation fails
                    toastr.error(response.msg, {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Duration the toast will be visible (in milliseconds)
                        extendedTimeOut: 1000  // Duration it will stay open after hover
                    });
                    return;
                }


                $('#applyLeaveModal').modal('hide');
                location.reload(); // Refresh the page
            },
            error: function(xhr) {
                alert('Error applying for leave.');
            }
        });
    });
});




</script>

@endsection