@extends('layouts.master')
<link rel="stylesheet" href="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap4.css">
<style>
  .badge-success {
    background-color: #28a745;
    color: #fff;
  }

  .badge-danger {
    background-color: #dc3545;
    color: #fff;
  }

  .badge-secondary {
    background-color: #6c757d;
    color: #fff;
  }


  .history-card .card {
    background: #fff;
    color: #3b4452;
    border-radius: 4px;
    padding: 0;
  }

  .history-card .card .card-header {
    display: flex;
    justify-content: space-between;
    background-color: white;
    align-items: center;
  }

  .history-card .card .card-header h3 {
    font-size: 12px;
    font-weight: 600;
    color: #7f8fa4;
  }

  .history-card .card .card-header h4 {
    font-size: 14px;
    font-weight: 600;
    color: #666;
  }

  .history-card .card .card-body .span1 {
    font-weight: 600;
    color: #7f8fa4;
    font-size: 12px;
    width: 100px;
  }

  .history-card .card .card-body .span2 {
    color: #7f8fa4;
    font-size: 12px;
  }

  .history-card .card .card-body .span3 {
    color: #000000;
    font-size: 12px;
    font-weight: 600;
  }

  .history-card .card .card-body .span4 {
    color: #000000;
    font-size: 12px;
    font-weight: 600;
  }

  .history-card .card .card-body p {
    margin: 0px;
    padding: 0px;
  }

  .history-card .card .card-footer {
    display: flex;
    justify-content: space-between;
    background-color: white;
    align-items: center;
  }

  .history-card .card .card-footer h3 {
    font-size: 12px;
    font-weight: 600;
    color: #7f8fa4;
  }

  .history-card .card .card-footer h4 {
    font-size: 14px;
    font-weight: 600;
    color: #666;
  }

  .history-card .card .card-footer a {
    margin-right: 5px;
    font-weight: 600;
    font-size: 14px;
  }

  .history-card .card .card-footer .btn {
    font-weight: 600;
    font-size: 14px;
    background-color: #007bff !important;
    border-color: #007bff !important;
  }
</style>
@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<!-- Main content -->
<div class="page-wrapper">
  <div class="container-fluid mt-4">

    <form id="filterByDate" class="row">
      @csrf
      <div class="col-lg-3">
        <div class="form-group  searchInput">
          <label for="poc_name">From Date</label>
          <input class="form-control  search-input" id="from_date" type="date" name="from_date" />
        </div>
      </div>
      <div class="col-lg-3">
        <div class="form-group  searchInput">
          <label for="poc_name">To Date</label>
          <input class="form-control  search-input" id="to_date" type="date" name="to_date" />
        </div>
      </div>


      <div class="col-lg-3 d-flex" style="align-self:self-end; margin-bottom:0.3rem;">
        <div class="form-group  searchInput">
          <button class="btn btn-primary  addbtnall1" type="submit">Search
          </button>
        </div>
      </div>
    </form>

    <ul class="nav nav-tabs d-flex" id="myTab" role="tablist" style="justify-content:center;">
      <!-- <li class="nav-item" role="presentation">
        <a href="{{ route('leave.index') }}">
          <button class="nav-link Active" type="button">
            Pending
          </button>
        </a>
      </li> -->
      <li class="nav-item" role="presentation">

        <a href="{{ route('leave.history') }}">


          <button class="nav-link Active" type="button" id=leaveHistory>
            History
          </button>
        </a>
      </li>

    </ul>


    <div class="container-fluid history-card mt-5">
      @foreach ($leave_history as $history)

      <div class="card">
        <div class="card-header">
          <div>
            <h3>Category</h3>
            <h4>Leave</h4>
          </div>

          <div>
            <h3>Leave Type</h3>
            <h4>{{$history->leave_type}}</h4>
          </div>


          <div>
            @if ($history->approver1 && is_null($history->approve1 ) && $history->is_reject != 1 )
            <h3 class="text-danger">Pending (Awaiting Approver)</h3>
            @elseif ( $history->is_reject == 1)
              <h3 class="text-danger">Rejected</h3>
            @elseif ($history->approve1 == 1 )                  
            <h3 class="text-success">Approved</h3>
            @endif
          </div>

          
        </div>
        <div class="card-body">
          <p>
            <span class="span1">Date :</span>
            <span class="span2">
              <span class="span3">{{$history->from_date}}</span>
              @if($history->to_date != null)
              <span class="span3">-</span>
              <span class="span4">{{$history->to_date}}</span>
              @endif
          </p>
          <p>
            <span class="span1">Days :</span>
            <span class="span2">
              <span class="span3">{{$history->total_days}}</span>
          </p>
          <p>
            <span class="span1">Reason :</span>
            <span class="span2">
              {{$history->user_reason}}
            </span>
          </p>

          <p>
            <span class="span1">Leave Status :</span>
            <span class="span2">
              @if($history->leave_status ==  'pending')
              <span class="span4" style="color:rgb(255, 153, 51)">Pending</span>
              @elseif($history->leave_status ==  'inprogress')
              <span class="span4"  style="color:orange;">Inprogress</span>
              @elseif($history->leave_status ==  'complete')
              <span class="span4" style="color:green;">Completed</span>
              @elseif($history->leave_status ==  'reject')
              <span class="span4"  style="color:red;">Rejected</span>
              @endif
            </span>
          </p>
        </div>
        <div class="card-footer">
          <div>
            <h3>Applied on</h3>
            <h4>{{$history->created_at}}</h4>
          </div>
          <!-- <div>
            <a href="#"> View Details</a>
          </div> -->
        </div>
      </div>

      @endforeach

    </div>
  </div>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
  $(document).on('submit', '#filterByDate', function(event) {
    event.preventDefault();
    var from_date = $('#from_date').val();
    var to_date = $("#to_date").val();

    $.ajax({
      url: "{{ route('filtered.leave.history') }}",
      type: "GET",
      data: {
        from_date: from_date,
        to_date: to_date,
      },
      success: function(response) {

        if (response.status === true) {
          $('.history-card').empty();
          var leaveHistory = response.data.leave_history;
          console.log(leaveHistory);

          var cardHtml = '';

          var count = 1;
          leaveHistory.forEach((history) => {



            var leaveHistoryHtml = '<div class="card"> <div class="card-header">  <div> <h3>Category</h3>  <h4>Leave</h4>  </div> <div> <h3>Leave Type</h3>';

            leaveHistoryHtml += '<h4>' + history['leave_type'] + ' </h4> </div> <div>';

            if (history['approver1'] && history['approve1'] === null) {

              leaveHistoryHtml += '<h3 class="text-danger"> Pending (Awaiting Approver 1)</h3>  ';

            } else if (history['approver2'] && history['approve2'] === null) {

              leaveHistoryHtml += ' <h3 class="text-danger">Pending (Awaiting Approver 2)</h3> ';

            } else if (history['approver3'] && history['approve3'] === null) {

              leaveHistoryHtml += ' <h3 class="text-danger">Pending (Awaiting Approver 1)</h3>';

            } else if (history['approve1'] == 1 && history['approve2'] == 1 && history['approve3'] == 1) {

              leaveHistoryHtml += '<h3 class="text-success">Approved</h3>';

            } else {

              leaveHistoryHtml += '<h3 class="text-success">Approved</h3> ';
            }


            leaveHistoryHtml += '</div> </div> <div class="card-body"> <p>  <span class="span1">Date :</span> <span class="span2">';
            leaveHistoryHtml += ' <span class="span3"> ' + history['from_date'] + '</span>';

            if (history['to_date'] != null) {
              leaveHistoryHtml += ' <span class="span3">-</span>';
              leaveHistoryHtml += ' <span class="span4">' + history['to_date'] + '</span>';

            }

            leaveHistoryHtml += `</span></p> <p> <span class="span1">Days :</span>  <span class="span2"> <span class="span3">${history['total_days']}
                      </span> </span>  </p> <p> <span class="span1">Reason :</span>  <span class="span2"> ${history['user_reason']} </span>
                   </p></div>  <div class="card-footer">  <div>  <h3>Applied on</h3> <h4>${history['created_at']}</h4>  </div> </div> </div>`;


            var loopCount = count++;
            cardHtml += leaveHistoryHtml;
            console.log(cardHtml);
            console.log(loopCount);


          })

          $('.history-card').html(cardHtml);

        } else {
          alert(response.message);
        }
      },
      error: function() {
        alert('Failed to fetch data. Please try again.');
      }
    });
  });
</script>