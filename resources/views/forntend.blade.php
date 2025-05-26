@extends('layouts.master')

<style>
    .content-fixed-wrapper {
        margin-left: 250px;
        margin-top: 70px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .content-fixed-wrapper {
            margin-left: 0;
            margin-top: 70px;
        }
    }
</style>

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
      .graph a{
        text-decoration: none;
        font-weight: 600;
      }
    </style>


@section('content')

       

<div class="content-fixed-wrapper">

<div class="row dashboard-card">
      <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
        <div class="card">
          <span>Review</span>
          <img
            src="gt_illustration_6.svg"
            alt=""
            style="width: 60px; height: auto; display: block; margin: auto"
          />
          <p class="p">Hurrah! You've nothing to review.</p>
        </div>
 
        <div class="card">
          <span>IT Declaration</span>
          <div style="margin-top: 10px; display: flex; align-items: start">
            <img
              src="gt_illustration_24.svg"
              alt=""
              style="width: 40px; margin-right: 10px"
            />
            <p>
              Uh oh! You have missed submitting your IT declaration. Please
              submit it once the window opens.
            </p>
          </div>
        </div>
      </div>
 
      <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
        <div class="card">
          <span>1 April 2025</span>
          <p style="font-size: 14px; margin-top: 5px; margin-bottom: 0px">
            Tuesday | General Shift
          </p>
          <p style="font-size: 14px; font-weight: bold; margin-top: 5px">
            11 : 56 : 09
          </p>
          <div style="display: flex; justify-content: end">
            <button class="btn btn-primary" style="width: 90px">Sign In</button>
          </div>
        </div>
        <div class="card">
          <span>Quick Access</span>
          <ul>
            <li>Reimbursement Payslip</li>
            <li>IT Statement</li>
            <li>YTD Reports</li>
            <li>Loan Statement</li>
          </ul>
        </div>
 
        <div class="card">
          <span>Track</span>
          <img
            src="gt_illustration_2.svg"
            alt=""
            style="width: 200px; display: block; margin: auto"
          />
          <p style="text-align: center; margin-top: 15px">
            All good! You've nothing new to track.
          </p>
        </div>
      </div>
 
      <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
        <div class="card">
          <a href="" class="Upcoming-holiday">
            <span>Upcoming Holidays</span>
            <span>&rarr;</span>
          </a>
 
          <section>
            <div>
              <p><span>06 April </span> Sunday</p>
              <p>Rama Navmi</p>
            </div>
 
            <div>
              <a href="">Apply</a>
            </div>
          </section>
 
          <section>
            <div>
              <p><span>10 April </span> Thursday</p>
              <p>Mahavir jayanti</p>
            </div>
 
            <div>
              <a href="">Apply</a>
            </div>
          </section>
 
          <section>
            <div>
              <p><span>14 April </span> Monday</p>
              <p>Rama Navmi</p>
            </div>
 
            <div>
              <a href="">Apply</a>
            </div>
          </section>
 
          <section>
            <div>
              <p><span>15 April </span> Tuesday</p>
              <p>Rama Navmi</p>
            </div>
 
            <div>
              <a href="">Apply</a>
            </div>
          </section>
        </div>
 
        <div class="card">
          <span>POI</span>
          <div style="margin-top: 10px; display: flex; align-items: start">
            <img
              src="gt_illustration_24.svg"
              alt=""
              style="width: 40px; margin-right: 10px"
            />
            <p>
              Hold on! You can submit your Proof of Investments (POI) once
              released.
            </p>
          </div>
        </div>
      </div>
 
      <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
        <div class="card">
          <a href="" class="Upcoming-holiday">
            <span>Payslip</span>
            <span>&rarr;</span>
          </a>
 
          <div>
            <figure class="highcharts-figure">
              <div id="container"></div>
            </figure>
 
            <div class="graph">
                <a href="">Download</a>
                <a href="">Show Salary</a>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>







    <!-- HightCharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
 

   

@endsection