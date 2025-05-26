<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        corePlugins: {
            preflight: false
        }
    }
</script>
@extends('layouts.master')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />

    <style>
        .dash-widget-info {
            color: black;
        }

        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }


        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }

        .graph-icons {
            text-align: center;
        }

        .graph-icons i {
            font-size: 15px;
            margin-left: 10px;
            color: gray;
            margin-right: 3px;
        }
    </style>


    <style>
        .container-first {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 10px;
        }

        .container-first h3 {
            font-size: 24px;
            color: #394657;
        }

        .container-first .p1 {
            font-size: 17px;
            color: #beb2b2;
        }

        .container-first .p2 {
            font-size: 17px;
            color: #000000;
        }

        .main-container {
            width: 80%;
            margin: auto;
        }

        .main-container .container-img {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50%;
            margin-right: 30px;
        }

        .main-container {
            display: flex;
            align-items: center;
            padding: 5px;
            border: 1px solid lightgray;
            border-radius: 10px;
            background-color: #f7f7f7;
            justify-content: space-evenly;
            flex-wrap: wrap;
        }

        .main-container .main-container-content {
            display: flex;
            align-items: center;
            border: 1px solid lightgray;
            border-radius: 5px;
            background-color: #ffffff;
            padding: 15px;
        }

        .main-container .main-container-content h4 {
            font-size: 17px;
            margin-bottom: 0px;
        }

        .main-container .main-container-content p {
            font-size: 14px;
            margin-bottom: 0px;
        }

        .main-container .main-container-content a {
            text-decoration: none;
            font-weight: 600;
        }

        .main-container span {
            font-weight: 600;
            color: gray;
        }

        /* Leave Balance Card */
        .leave-balance .buttons {
            display: flex;
            justify-content: end;
            gap: 10px;
        }

        .leave-balance .buttons .btn {
            border-radius: 4px;
            font-size: 14px;
        }

        .leave-balance .card {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 12px 15px 0;
            background-color: #fff;
            min-height: 243px;
        }

        .leave-balance .card .card-header {
            background-color: inherit;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
        }

        .leave-balance .card .card-header h4 {
            color: #7f8fa4;
            font-size: 14px;
            font-weight: 600;
        }

        .leave-balance .card .card-header p {
            color: #7f8fa4;
            font-size: 14px;
            font-weight: 400;
        }

        .leave-balance .card .card-header p span {
            font-weight: 500;
        }

        .leave-balance .card .card-body h1 {
            font-size: 24px;
            text-align: center;
            font-weight: 400;
        }

        .leave-balance .card .card-body p {
            font-size: 12px;
            text-align: center;
            font-weight: 400;
            color: #7f8fa4;
        }

        .leave-balance .card .card-body a {
            color: #24a7f8;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .leave-balance .card .card-footer {
            background-color: inherit;
            border: none;
            padding: 5px;
        }

        .leave-balance .card .card-footer label {
            color: #7f8fa4;
            font-size: 10px;
        }

        .leave-balance .card .card-footer progress {
            width: 100%;
        }
    </style>

    <style>
        .circle1-container {
            position: relative;
            width: 320px;
            height: 320px;
            margin-bottom: 20px;
        }

        .circle1 {
            box-shadow: 0 0 15px rgb(0, 17, 31);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(#ff3d3d 0deg 51.43deg,
                    #ffaf4d 51.43deg 102.86deg,
                    #006b3e 102.86deg 154.29deg,
                    #6cff4f 154.29deg 205.71deg,
                    #4df0ff 205.71deg 257.14deg,
                    #836dff 257.14deg 308.57deg,
                    #ff5eff 308.57deg 360deg);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .circle1:hover {
            animation: changeParts 6s ease-in-out forwards infinite;
            transition: 6s;
            background: linear-gradient();
            cursor: pointer;
        }

        .showing1 {
            position: absolute !important;
            font-size: 20px;
            width: 10%;
            height: 40%;
            right: 220px;
            text-align: center;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transform-origin: 80px 65px;
        }

        .showing1:nth-child(1) {
            transform: rotate(-1.5deg) translateX(85%) translateY(-76%);
        }

        .showing1:nth-child(2) {
            transform: rotate(0deg) translateX(390%) translateY(-80%);
        }

        .showing1:nth-child(3) {
            transform: rotate(0deg) translateX(600%) translateY(-20%);
        }

        .showing1:nth-child(4) {
            transform: rotate(0deg) translateX(530%) translateY(55%);
        }

        .showing1:nth-child(5) {
            transform: rotate(0deg) translateX(250%) translateY(90%);
        }

        .showing1:nth-child(6) {
            transform: rotate(0deg) translateX(-20%) translateY(60%);
        }

        .showing1:nth-child(7) {
            transform: rotate(0deg) translateX(-120%) translateY(-20%);
        }

        .showing1:nth-child(8) {
            transform: rotate(0deg) translateX(80%) translateY(-80%);
        }

        .showing1:hover {
            color: rgb(0, 0, 0);
            transition: 0.5s;
            font-size: 22px;
        }

        .content-info-boxs {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dept {
            display: inline-flex;
            padding: 3px 10px;
            font-size: 12px;
            border-radius: 5px;
            color: #fff;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .color-2 {
            background-color: #39d450;
        }

        .color-4 {
            background-color: #e67f19;
        }

        .color-3 {
            background-color: #bf391b;
        }

        .color-1 {
            background-color: #f2a7c9;
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

        .graph a {
            text-decoration: none;
            font-weight: 600;
        }
    </style>

    <style>
        .dashboard-tile {
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: white;
            overflow: hidden;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .dashboard-tile:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .dashboard-icon {
            font-size: 2rem;
            opacity: 0.8;
        }

        .dashboard-count {
            font-size: 2rem;
            font-weight: bold;
        }

        /* .bg-c-blue {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
        }

        .bg-c-green {
            background: linear-gradient(135deg, #28a745, #218838);
        }

        .bg-c-yellow {
            background: linear-gradient(135deg, #ffc107, #e0a800);
        }

        .bg-c-pink {
            background: linear-gradient(135deg, #e83e8c, #c82362);
        } */

        .bg-c-orange {
            background: linear-gradient(135deg, #fd7e14, #e8590c);
        }
    </style>

    <div class="page-wrapper">

        @if (auth()->user()->role_name == 'Employee')
            <div class="content container-fluid">

                <div class="container container-first">
                    <div>
                        @php
                            $hour = date('H');
                            if ($hour > 12) {
                                $greeting = 'Good Morning';
                            } elseif ($hour >= 12 && $hour < 18) {
                                $greeting = 'Good Afternoon';
                            } else {
                                $greeting = 'Good Evening';
                            }
                        @endphp

                        <p class="p1">
                            The quickest way to double your money is to fold it <br />
                            over and put it back in your pocket.
                        </p>
                        <p class="p2">- Will Rogers</p>
                    </div>

                    <div>
                        <img src="assets/images/home-morning.svg" alt="Logo">
                    </div>
                </div>

                <div class="container">
                    <div class="main-container">
                        <div>
                            <h5 style="margin-bottom: 0px"><?php
                            // Get the current date in the format: Month Name Day, Year
                            echo date('F j, Y');
                            ?></h5>
                            <p class="day"><?php
                            // Get the current day of the week (e.g., Monday)
                            echo date('l');
                            ?> | General Shift</p>
                        </div>

                        <div class="main-container-content">
                            <img src="assets/img/redianlogo.jpeg" class="container-img" alt="Logo">
                            <div>
                                <h4>Your Gateway to Possibilities</h4>
                                <p>
                                    Taxes, Salary Advances, <a href="">All within HRMS!</a>
                                </p>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="row dashboard-card pt-3">


                    <!-- <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
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
                                                                                                    </div> -->

                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-1">
                        <div class="card">
                            <span><?php echo date('F j, Y'); ?></span>
                            <p style="font-size: 14px; margin-top: 5px; margin-bottom: 0px">
                                <?php echo date('l'); ?> | General Shift
                            </p>
                            <p id="live-time"></p>
                            <!-- <div style="display: flex; justify-content: end">
                                                                                                                    <button class="btn btn-primary" style="width: 90px">Sign In</button>
                                                                                                                </div> -->
                        </div>


                        <div class="card">
                            <span>Track</span>
                            <img src="gt_illustration_2.svg" alt=""
                                style="width: 200px; display: block; margin: auto" />
                            <p style="text-align: center; margin-top: 15px">
                                All good! You've nothing new to track.
                            </p>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5 col-md-6 col-12 mb-1">
                        <div class="card">
                            <a href="{{ route('holidays.calender') }}" class="Upcoming-holiday">
                                <span>Upcoming Holidays</span>
                                <span>&rarr;</span>
                            </a>

                            @foreach ($current_month_holiday as $holiday)
                                <section>
                                    <div>
                                        <p><span>06 April </span> Sunday</p>
                                        <p>{{ $holiday->name_holiday }}</p>
                                    </div>
                                    <div>
                                        @if ($holiday->is_restrict == 1)
                                            <a href="{{ route('holidays.calender') }}">Apply</a>
                                        @endif
                                    </div>
                                </section>
                            @endforeach


                        </div>

                        <!-- <div class="card">
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
                                                                                                        </div> -->

                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-1">
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
                                    <a href="{{ route('individual.payroll.information') }}">Show Salary</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif



        @if (auth()->user()->role_name == 'Admin')
            <x-dashboard />


            <div class="container mt-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">
                    <div class="col">
                        <a href="{{ route('employees.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-blue">
                                <div class="dashboard-icon"><i class="fa fa-unlock-alt"></i></div>
                                <div>
                                    <h6>This month joining</h6>
                                    <div class="dashboard-count" id="this-month-joining-count">{{ $currentMonthJoinCount }}
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('employees.list.inactive') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-green">
                                <div class="dashboard-icon"><i class="fa fa-sign-out"></i></div>
                                <div>
                                    <h6>This month exit</h6>
                                    <div class="dashboard-count">0</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('anniversary') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-yellow">
                                <div class="dashboard-icon"><i class="fa fa-gift"></i></div>
                                <div>
                                    <h6>This month Work Anniversary</h6>
                                    <div class="dashboard-count">{{ $workAnniversaryCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('birthday') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-pink">
                                <div class="dashboard-icon"><i class="fa fa-birthday-cake"></i></div>
                                <div>
                                    <h6>This month Birthdays</h6>
                                    <div class="dashboard-count">{{ $birthdayCount }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-orange">
                                <div class="dashboard-icon"><i class="fa fa-check-circle"></i></div>
                                <div>
                                    <h6>This month Appraisal</h6>
                                    <div class="dashboard-count">0</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            {{-- new card --}}
            <div class="container mt-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 g-3">

                    <div class="col">
                        <a href="{{ route('employees.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-blue">
                                <div class="dashboard-icon"><i class="fa fa-users"></i></div>
                                <div>
                                    <h6>Employees</h6>
                                    <div class="dashboard-count">{{ $totalCount }}</div>
                                    <div style="font-size:13px;">Active:
                                        @foreach ($usersByStatus as $user)
                                            @if ($user->status == 'Active')
                                                {{ $user->count }}
                                            @endif
                                        @endforeach
                                        {{-- &nbsp;&nbsp;Inactive:
                                        @foreach ($usersByStatus as $user)
                                            @if ($user->status == 'Inactive')
                                                {{ $user->count ?? 0 }}
                                            @endif
                                        @endforeach --}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('company-structure.setup') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-green">
                                <div class="dashboard-icon"><i class="fa fa-building"></i></div>
                                <div>
                                    <h6>Companies</h6>
                                    <div class="dashboard-count">{{ $dataCounts['companies'] }}</div>
                                    <div style="font-size:13px;">Total Companies: {{ $dataCounts['companies'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('projects.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-yellow">
                                <div class="dashboard-icon"><i class="fa fa-refresh"></i></div>
                                <div>
                                    <h6>Projects</h6>
                                    <div class="dashboard-count">{{ $dataCounts['projects'] }}</div>
                                    <div style="font-size:13px;">Total Projects: {{ $dataCounts['projects'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('divisions.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-pink">
                                <div class="dashboard-icon"><i class="fa fa-refresh"></i></div>
                                <div>
                                    <h6>Divisions</h6>
                                    <div class="dashboard-count">{{ $dataCounts['divisions'] }}</div>
                                    <div style="font-size:13px;">Total Division: {{ $dataCounts['divisions'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="#" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-orange">
                                <div class="dashboard-icon"><i class="fa fa-sitemap"></i></div>
                                <div>
                                    <h6>Departments</h6>
                                    <div class="dashboard-count">{{ $department ?? 0 }}</div>
                                    <div style="font-size:13px;">Total Departments: {{ $department ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('userReports.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-blue">
                                <div class="dashboard-icon"><i class="fa fa-building"></i></div>
                                <div>
                                    <h6>Reports</h6>
                                    <div class="dashboard-count">4</div>
                                    <div style="font-size:13px;">Total Reports: 4</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('travel_records.list') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-green">
                                <div class="dashboard-icon"><i class="fa fa-plane"></i></div>
                                <div>
                                    <h6>Travel</h6>
                                    <div class="dashboard-count">{{ $dataCounts['travels'] }}</div>
                                    <div style="font-size:13px;">Total Travel: {{ $dataCounts['travels'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('role.listing') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-yellow">
                                <div class="dashboard-icon"><i class="fa fa-key"></i></div>
                                <div>
                                    <h6>Roles & Permissions</h6>
                                    <div class="dashboard-count">{{ $dataCounts['roles'] }}</div>
                                    <div style="font-size:13px;">Total Roles: {{ $dataCounts['roles'] }}</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <div class="dashboard-tile bg-c-pink">
                            <div class="dashboard-icon"><i class="fa fa-tags"></i></div>
                            <div>
                                <h6>Travel Cat. by Division</h6>
                                @foreach ($divisionss as $div)
                                    <div class="d-flex justify-content-between" style="font-size:12px;">
                                        <span>{{ $div->name }}</span>
                                        <a href="{{ route('travel.category.data', ['id' => $div->id]) }}"
                                            class="text-white">
                                            <i class="fa fa-arrow-right small"></i>
                                        </a>
                                    </div>
                                @endforeach
                                <div><a class="text-white" href="{{ route('travelcategories.list') }}">View more...</a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col">
                        <a href="{{ route('employees.list.inactive') }}" class="text-decoration-none">
                            <div class="dashboard-tile bg-c-orange">
                                <div class="dashboard-icon"><i class="fa fa-sign-out"></i></div>
                                <div>
                                    <h6>Exit Employees</h6>
                                    <div class="dashboard-count">0</div>
                                    <div style="font-size:13px;">This month exit: 0</div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>









            {{-- <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <a href="{{ route('employees.list') }}" class="text-white">

                                <div class="card-block">
                                    <h6 class="m-b-20">Employees</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa fa-users f-left"></i><span>{{ $totalCount }}</span></h2>
                                    <div class="row">
                                        <div class="col-6">
                                            Active : &nbsp; @foreach ($usersByStatus as $user)
                                                @if ($user->status == 'Active')
                                                    {{ $user->count }}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-6" style="font-size:13px !important; margin : 0 !important">
                                            Inactive : &nbsp; @foreach ($usersByStatus as $user)
                                                @if ($user->status == 'Inactive')
                                                    {{ $user->count ?? 0 }}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <a href="{{ route('company-structure.setup') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Companies</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-building f-left"></i><span>{{ $dataCounts['companies'] }}</span>
                                    </h2>

                                    <div class="row">
                                        <div class="col-9">
                                            Total Companies :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            {{ $dataCounts['companies'] }}
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <a href="{{ route('projects.list') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Projects</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-refresh f-left"></i><span>{{ $dataCounts['projects'] }}</span>
                                    </h2>
                                    <div class="row">
                                        <div class="col-9">
                                            Total Projects :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            {{ $dataCounts['projects'] }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <a href="{{ route('divisions.list') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Division</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-refresh f-left"></i><span>{{ $dataCounts['divisions'] }}</span>
                                    </h2>
                                    <div class="row">
                                        <div class="col-9">
                                            Total Division :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            {{ $dataCounts['divisions'] }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <a href="{{ route('userReports.list') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Reports</h6>
                                    <h2 class="text-right"><i class="fa fa-building f-left"></i><span>4</span></h2>

                                    <div class="row">
                                        <div class="col-9">
                                            Total Reports :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            4
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>



                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-green order-card">
                            <a href="{{ route('travel_records.list') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Travel</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-plane f-left"></i><span>{{ $dataCounts['travels'] }}</span></h2>

                                    <div class="row">
                                        <div class="col-9">
                                            Total Travel :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            {{ $dataCounts['travels'] }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-yellow order-card">
                            <a href="{{ route('role.listing') }}" class="text-white">
                                <div class="card-block">
                                    <h6 class="m-b-20">Roles & Permissions</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-key f-left"></i><span>{{ $dataCounts['roles'] }}</span></h2>

                                    <div class="row">
                                        <div class="col-9">
                                            Total Roles :
                                        </div>
                                        <div class="col-3" style="text-align-last:end;">
                                            {{ $dataCounts['roles'] }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>



                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-c-pink order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Travel Cat. Based On Division</h6>
                                <div class="row" style="font-size:11px !important;">
                                    @foreach ($divisionss as $div)
                                        <div class="col-10">
                                            {{ $div->name }}
                                        </div>
                                        <div class="col-2" style="text-align-last:end;">
                                            <a href="{{ route('travel.category.data', ['id' => $div->id]) }}"
                                                style="color:white">
                                                <i class="fa fa-arrow-right" style="font-size:small"
                                                    aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row" style="font-size:12px !important;">
                                    <div class="col-12">
                                        <a class="text-white" href="{{ route('travelcategories.list') }}">View
                                            more...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
        @endif



        @if (auth()->user()->hasAnyRole(['Admin', 'HR', 'Direct superior', 'DGA']))
            <div class="container dashboardSection hidden">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                        <figure class="highcharts-figure">
                            <div id="container-1"></div>
                        </figure>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                        <figure class="highcharts-figure">
                            <div id="container-2"></div>
                        </figure>
                    </div>


                    <div class="col-xl-6 col-lg-6 col-md-12 mb-2 graph-icons">
                        <span><a href= "{{ route('leave.status', ['status' => 'complete', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"> <span class="dept color-2"> Leave Request
                                        Approved</span></span></a></span>
                        <span><a href= "{{ route('leave.status', ['status' => 'pending', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"><span class="dept color-4"> Leave Request
                                        Pending</span></span></a></span>
                        <span><a href= "{{ route('leave.status', ['status' => 'reject', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"><span class="dept color-3"> Leave Request
                                        Rejected</span></span></a></span>
                        <!-- <span><a  href= "{{ route('leave.status', ['status' => 'inprogress']) }}"><span class="leave-status-link"><span class="dept color-1 text-dark"> Leave Request Inprogress</span></span></a></span> -->


                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-12 mb-2  graph-icons">
                        <span><a href= "{{ route('travel.status', ['status' => 'complete', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"><span class="dept color-2"> Travel Request
                                        Approved</span></span></a></span>
                        <span><a href= "{{ route('travel.status', ['status' => 'pending', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"><span class="dept color-4"> Travel Request
                                        Pending</span></span></a></span>
                        <span><a href= "{{ route('travel.status', ['status' => 'reject', 'from' => 'dashboard']) }}"><span
                                    class="leave-status-link"><span class="dept color-3"> Travel Request
                                        Rejected</span></span></a></span>
                        <!-- <span><a   href= "{{ route('travel.status', ['status' => 'inprogress']) }}"><span class="leave-status-link "><span class="dept color-1 text-dark">Travel Request Inprogress</span></span></a></span> -->

                    </div>



                </div>




                <!-- <div class="container d-flex mt-5">
                                                                                                        <div class="row justify-content-center">
                                                                                                            <div class="col-lg-6 d-flex justify-content-center">
                                                                                                            <div class="circle1-container">
                                                                                                                <div class="circle1">

                                                                                                                <div class="showing1" data-titles="Pay-Per-Click (PPC) Service" data-texts='PPC is a popular advertising strategy, in which an advertiser will pay the markers every time a user clicks on their published ad. So, as a trusted &lt;a href=&quot;https://www.batterseawebexpert.com/best-ppc-company-in-delhi/&quot;&gt;PPC company in Delhi&lt;/a&gt;, we will prepare better ads that not only promise extra leads but will improve the overall ROI of your marketing strategy.'>
                                                                                                                    1</div>

                                                                                                                <div class="showing1" data-titles="Content Marketing Service" data-texts='Do you know that a content marketing strategy can generate about 3 times more leads, compared to outbound marketing? And, as a content marketing company in Delhi, we will help you craft some really engaging blogs, customer articles, videos, and other forms of digital content to help you drive more traffic and conversion to your platform.'>
                                                                                                                    2</div>

                                                                                                                <div class="showing1" data-titles="Email marketing service" data-texts='Emails are a direct way of communicating with your customers, as they directly target the user’s inbox. And, as an email marketing company in Delhi, we will help you craft some personalized messages to inform the users about all the new products, promotions, or updates. This will help you build strong customer relationships while encouraging a repeat purchase.'>
                                                                                                                    3</div>

                                                                                                                <div class="showing1" data-titles="Social Media Marketing Service" data-texts='Social media marketing as the name suggests refers to the process of promoting your content on social media content. So, as a &lt;a href=&quot;https://www.batterseawebexpert.com/best-social-media-marketing-agency-delhi/&quot;&gt;Social media marketing agency in Delhi&lt;/a&gt;, we will market your content on all the major social media handles like Facebook, Instagram, Twitter, and LinkedIn to direct the audience to your website.'>
                                                                                                                    what is hrms</div>

                                                                                                                <div class="showing1" data-titles="Social Media Optimization (SMO) Service" data-texts='SMO includes improving the brand’s social media presence by following a variety of marketing tactics such as content curation, strategic posting, and interaction with followers. So as an expert &lt;a href=&quot;https://www.batterseawebexpert.com/best-social-media-agency-in-delhi/&quot;&gt;SMO company in Delhi&lt;/a&gt;, we will help you build a strong online presence so that you can stand out among the crowd and then prepare a strategy accordingly.'>
                                                                                                                    5</div>

                                                                                                                <div class="showing1" data-titles="Web development service" data-texts='Having a responsive website is perhaps the most important thing for a business to have, as it is going to be the first thing that a user is going to notice about your brand. And, since we are a reliable &lt;a href=&quot;https://www.batterseawebexpert.com/website-development-company-in-delhi/&quot;&gt;web development company in Delhi&lt;/a&gt;, we will help you create a user-friendly and responsive website that better aligns with all of your marketing efforts.'>
                                                                                                                    6</div>

                                                                                                                <div class="showing1" data-titles="Web Design Service" data-texts='A website should always have a great visual appeal in it. In fact, according to the CXL, a whopping 94% of first impressions of a website are based on its design. And, this is why as a &lt;a href=&quot;https://www.batterseawebexpert.com/website-designing-company-in-delhi/&quot;&gt;Website Designing Company in Delhi&lt;/a&gt; we focus on all the layout, color schemes, and typography of a website to build its aesthetic appeal and improve the conversion rate.'>
                                                                                                                    7</div>

                                                                                                                <a href="#">
                                                                                                                    <div class="d-flex justify-content-center align-items-center" style="width: 150px; Height: 150px; background-color: white; border-radius:80px; box-shadow: 0 0 15px rgb(0, 17, 31);">
                                                                                                                    <img src="https://www.batterseawebexpert.com/wp-content/uploads/2023/07/logo.webp" alt="" width="80%">
                                                                                                                    </div>
                                                                                                                </a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            </div>
                                                                                                            <div class="col-lg-6">
                                                                                                            <div class="content-info-boxs">
                                                                                                                <h2 id="content-titless">Heading</h2>
                                                                                                                <p id="text">Click On Numbers on circle to preview different Card's</p>
                                                                                                            </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div> -->

            </div>
        @endif



        <div class="container dashboardSection hidden">
            <div class="row" style="padding-top: 20px">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="department-chart" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 mb-2" id="birthday">
                    <div class="card">
                        <h4 style="text-align: center; padding-top: 15px;">Employee's Birthday Months</h4>
                        <form class="mb-3 d-flex gap-3 align-items-center">
                            <select id="birthdayDropdown" name="month"
                                class="form-select w-auto border-primary text-primary fw-semibold shadow-sm rounded-pill px-3"
                                style="padding:8px; margin: 5px; color: #b76066 !important;">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-muted ">🎉 Showing Birthdays In
                                {{-- <strong id="selectedMonth" style="color: black">
                                </strong> --}}
                                Month 🎂
                            </span>
                        </form>
                        <div class="list-group birthdayList">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container dashboardSection hidden">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="gender-chart"></div>
                                <p class="highcharts-description">
                                    Gender Chart
                                </p>
                            </figure>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="country-chart"></div>
                                <p class="highcharts-description">
                                    Countries
                                </p>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container dashboardSection hidden" id="joining">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="joining-chart"></div>
                            </figure>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="age-chart"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container dashboardSection hidden">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="leave-chart" class="table-title" style="text-align: center; padding: 8px;">
                                <strong>Top 5 Leave Taker Employee's</strong>
                            </div>
                            <table class="table custom-table border">
                                <thead>
                                    <tr
                                        style="background: linear-gradient(90deg, rgb(255, 81, 81) 0%, rgb(220, 185, 255) 35%, rgb(255, 133, 133) 100%);">
                                        <th>Emp No.</th>
                                        <th>Name</th>
                                        <th>Day</th>
                                    </tr>
                                </thead>
                                <tbody id="leave-chart-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2" id="work">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center; padding-top: 15px;">Employee's Work Anniversary</h4>
                            <form class="mb-3 d-flex gap-3 align-items-center">
                                <select id="workDropdown" name="month"
                                    class="form-select w-auto border-primary text-primary fw-semibold shadow-sm rounded-pill px-3"
                                    style="padding:8px; margin: 5px; color: #b76066 !important;">
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-muted ">🎉Showing Work Anniversaries In
                                    {{-- <strong id="selectedMonth" style="color: black">
                                    </strong> --}}
                                    Month 🎂
                                </span>
                            </form>
                            <div class="list-group workList">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container dashboardSection hidden">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="ctc-chart"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>






    </div>
    <!-- /Page Content -->



    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script>
        axios.get('/chart/joining-data')
            .then(response => {
                document.getElementById('this-month-joining-count').innerText = response.data.this_month_joining;
            })
            .catch(error => {
                console.error('Error fetching joining data:', error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/chart/department-data')
                .then(response => response.json())
                .then(data => {
                    const categories = data.map(item => item.name ?? 'Unknown');
                    const seriesData = data.map(item => parseInt(item.total));

                    Highcharts.chart('department-chart', {
                        chart: {
                            type: 'column',
                            backgroundColor: '#f8f9fa', // Light background for a clean look
                            style: {
                                fontFamily: 'Poppins, sans-serif' // Nice font
                            },
                            animation: {
                                duration: 1500, // Smooth chart animation
                                easing: 'easeOutBounce'
                            }
                        },
                        title: {
                            text: 'Employees by Department',
                            style: {
                                fontSize: '20px',
                                fontWeight: 'bold',
                                color: '#343a40'
                            }
                        },
                        xAxis: {
                            categories: categories,
                            title: {
                                text: 'Departments',
                                style: {
                                    fontSize: '16px',
                                    fontWeight: 'bold'
                                }
                            },
                            labels: {
                                style: {
                                    color: '#495057',
                                    fontSize: '13px'
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Number of Employees',
                                style: {
                                    fontSize: '16px',
                                    fontWeight: 'bold'
                                }
                            },
                            labels: {
                                style: {
                                    color: '#495057'
                                }
                            },
                            gridLineColor: '#e9ecef'
                        },
                        tooltip: {
                            backgroundColor: '#ffffff',
                            borderColor: '#ced4da',
                            style: {
                                color: '#212529',
                                fontSize: '13px'
                            },
                            pointFormat: '<b>{point.y} Employees</b>'
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            column: {
                                colorByPoint: true,
                                colors: ['#0d6efd', '#6610f2', '#6f42c1', '#d63384', '#dc3545',
                                    '#fd7e14', '#ffc107', '#198754'
                                ],
                                borderRadius: 5,
                                dataLabels: {
                                    enabled: true,
                                    style: {
                                        fontSize: '12px',
                                        color: '#495057'
                                    }
                                }
                            },
                            series: {
                                animation: {
                                    duration: 1500,
                                    easing: 'easeOutBounce'
                                }
                            }
                        },
                        series: [{
                            name: 'Employees',
                            data: seriesData
                        }],
                        credits: {
                            enabled: false
                        }
                    });
                });
        });




        function getMonthName(monthNumber) {
            const date = new Date();
            date.setMonth(monthNumber - 1);
            return date.toLocaleString('en-US', {
                month: 'long'
            });
        }

        function fetchBirthdays(month) {
            $.ajax({
                url: "{{ route('birthdays.index') }}",
                type: 'GET',
                data: {
                    month: month
                },
                success: function(response) {
                    if (response.status === true) {
                        let unitHtml = '';

                        if (response.birthdays.length > 0) {
                            response.birthdays.forEach((el) => {
                                unitHtml += `
                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="https://plus.unsplash.com/premium_vector-1682269287900-d96e9a6c188b?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            alt="Profile" class="rounded-circle me-3" width="70" height="70">
                                        <strong>${el.first_name} ${el.last_name}</strong>
                                    </div>
                                    <div>
                                        ${new Date(el.birthday).toLocaleDateString('en-GB', {
                                            day: '2-digit',
                                            month: 'long',
                                            year: 'numeric'
                                        })}
                                    </div>
                                </div>`;
                            });
                            $('#selectedMonth').text(getMonthName(response.month));
                        } else {
                            unitHtml = `
                            <div class="list-group-item text-center text-muted">
                                No birthdays in this month.
                            </div>`;
                        }

                        $('.birthdayList').html(unitHtml);
                    }
                },
                error: function(error) {
                    console.error("Error fetching birthday data", error);
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#birthdayDropdown').on('change', function(e) {
                e.preventDefault();
                const selectedMonth = $(this).val();
                fetchBirthdays(selectedMonth);
            });

          
            const defaultMonth = $('#birthdayDropdown').val();
            fetchBirthdays(defaultMonth);
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/chart/gender-data')
                .then(response => response.json())
                .then(data => {
                    const seriesData = data.map(item => [item.name ?? 'Unknown', parseInt(item.total)]);

                    Highcharts.chart('gender-chart', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Employees<br>By<br>Gender',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 60,
                            style: {
                                fontSize: '1.1em'
                            }
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: true,
                                    distance: -50,
                                    style: {
                                        fontWeight: 'bold',
                                        color: 'white'
                                    }
                                },
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                size: '110%'
                            }
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            name: 'Employees',
                            data: seriesData
                        }]
                    });
                });
        });




        document.addEventListener('DOMContentLoaded', function() {
            fetch('/chart/country-data')
                .then(response => response.json())
                .then(data => {
                    const seriesData = data.map(item => [item.name ?? 'Unknown', parseInt(item.total)]);

                    Highcharts.chart('country-chart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Employee\'s By Country'
                        },
                        xAxis: {
                            type: 'category',
                            title: {
                                text: 'Countries'
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Number of Employees'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Employees: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Employees',
                            colors: [
                                '#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9',
                                '#691af3',
                                '#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5',
                                '#3e5ccf',
                                '#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1',
                                '#0a9eaa',
                                '#03c69b', '#00f194'
                            ],
                            colorByPoint: true,
                            groupPadding: 0,
                            data: seriesData,
                            dataLabels: {
                                enabled: true,
                                rotation: -90,
                                color: '#FFFFFF',
                                inside: true,
                                verticalAlign: 'top',
                                y: 10,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });

                });
        });




        fetch('/chart/joining-data')
            .then(response => response.json())
            .then(data => {
                Highcharts.chart('joining-chart', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Additions & Attrition'
                    },
                    subtitle: {
                        text: 'Jan-2024 To Dec-2025'
                    },
                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                        ]
                    },
                    yAxis: {
                        title: {
                            text: 'Number of Employees'
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: '#666666',
                                lineWidth: 1
                            }
                        }
                    },
                    series: [{
                            name: 'Joined',
                            marker: {
                                symbol: 'diamond'
                            },
                            data: data.joined
                        },
                        {
                            name: 'Resigned',
                            marker: {
                                symbol: 'circle'
                            },
                            data: data.resigned
                        }
                    ]
                });
            });


        fetch('/chart/age-data')
            .then(response => response.json())
            .then(data => {
                const seriesData = data.map(item => [item.name ?? 'Unknown', parseInt(item.total)]);

                Highcharts.chart('age-chart', {
                    chart: {
                        type: 'cylinder',
                        options3d: {
                            enabled: true,
                            alpha: 15,
                            beta: 15,
                            depth: 50,
                            viewDistance: 25
                        }
                    },
                    title: {
                        text: 'Age Distribution'
                    },
                    xAxis: {
                        categories: [
                            '10-19', '20-29', '30-39', '40-49', '50-59', '60-69',
                            '70-79', '80-89', '90+'
                        ],
                        title: {
                            text: 'Age groups'
                        },
                        labels: {
                            skew3d: true
                        }
                    },
                    yAxis: {
                        title: {
                            margin: 20,
                            text: 'Number of Employees'
                        },
                        labels: {
                            skew3d: true
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>Age: {category}</b><br>'
                    },
                    plotOptions: {
                        series: {
                            depth: 25,
                            colorByPoint: true
                        }
                    },
                    series: [{
                        data: seriesData,
                        name: 'Employees',
                        showInLegend: false
                    }]
                });
            });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/chart/leave-data')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('leave-chart-body');
                    tbody.innerHTML = ''; 
                    if (data.length === 0) {
                        const row =
                            `<tr><td colspan="3" style="text-align:center;">No data available</td></tr>`;
                        tbody.innerHTML = row;
                        return;
                    }

                    data.forEach(emp => {
                        const row = `
                                <tr>
                                    <td>${emp.Emp_id ?? '-'}</td>
                                    <td>${emp.name ?? '-'}</td>
                                    <td>${emp.total ?? 0}</td>
                                </tr>
                            `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error("Error fetching leave chart data:", error);
                    document.getElementById('leave-chart-body').innerHTML =
                        `<tr><td colspan="3" style="text-align:center; color:red;">Failed to load data</td></tr>`;
                });
        });
    </script>
    <script>
        function getOrdinalSuffix(i) {
            let j = i % 10,
                k = i % 100;
            if (j == 1 && k != 11) return "st";
            if (j == 2 && k != 12) return "nd";
            if (j == 3 && k != 13) return "rd";
            return "th";
        }

        function getMonthName(m) {
            return new Date(2000, m - 1).toLocaleString('default', {
                month: 'long'
            });
        }

        function fetchWorkAnniversaries(month) {
            $.ajax({
                url: "{{ route('work.index') }}",
                type: 'GET',
                data: {
                    month: month
                },
                success: function(response) {
                    if (response.status === true) {
                        let unitHtml = '';

                        if (response.work.length > 0) {
                            response.work.forEach((el) => {
                                unitHtml += `
                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="https://plus.unsplash.com/premium_vector-1682269287900-d96e9a6c188b?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            alt="Profile" class="rounded-circle me-3" width="70" height="70">
                                        <div>
                                            <strong>${el.first_name} ${el.last_name}</strong><br>
                                            <small>on ${new Date(el.work).toLocaleDateString('en-GB', {
                                                day: '2-digit',
                                                month: 'long'
                                            })}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-success">${el.anniversary_count}${getOrdinalSuffix(el.anniversary_count)}</span>
                                    </div>
                                </div>`;
                            });
                            $('#selectedMonth').text(getMonthName(response.month));
                        } else {
                            unitHtml = `<div class="list-group-item text-center text-muted">
                            No Work Anniversary in this month.
                        </div>`;
                        }

                        $('.workList').html(unitHtml);
                    }
                },
                error: function(error) {
                    console.error("Error fetching work anniversaries", error);
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

           
            $('#workDropdown').on('change', function() {
                const selectedMonth = $(this).val();
                fetchWorkAnniversaries(selectedMonth);
            });

            
            const defaultMonth = $('#workDropdown').val();
            fetchWorkAnniversaries(defaultMonth);
        });






        document.addEventListener("DOMContentLoaded", function() {
            fetch("/chart/ctc-data")
                .then(response => response.json())
                .then(seriesdata => {
                    Highcharts.chart('ctc-chart', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Last 6 Months Monthly CTC'
                        },
                        xAxis: {
                            type: 'category'
                        },
                        legend: {
                            enabled: true
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}; font-weight:bold;">{point.name}</span>: ' +
                                '<b>{point.y}</b><br/>'
                        },
                        series: [{
                            name: 'Monthly CTC',
                            colorByPoint: true,
                            data: seriesdata
                        }]
                    });
                });
        });
    </script>






    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/cylinder.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

    <script>
        Highcharts.chart('container-1', {
            chart: {
                type: 'pie',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;
                        const result = {{ $statusCounts['complete'] }} + {{ $statusCounts['pending'] }} +
                            {{ $statusCounts['reject'] }};

                        if (!customLabel) {
                            customLabel = chart.options.chart.custom.label =
                                chart.renderer.label(
                                    'Total<br/>' +
                                    `<strong>${result}</strong>`
                                )
                                .css({
                                    color: '#000',
                                    textAnchor: 'middle'
                                })
                                .add();
                        }

                        const x = series.center[0] + chart.plotLeft,
                            y = series.center[1] + chart.plotTop -
                            (customLabel.attr('height') / 2);

                        customLabel.attr({
                            x,
                            y
                        });
                        // Set font size based on chart diameter
                        customLabel.css({
                            fontSize: `${series.center[2] / 12}px`
                        });
                    }
                }
            },
            accessibility: {
                point: {
                    valueSuffix: ''
                }
            },
            title: {
                text: 'Today Leave Requests'
            },
            tooltip: {
                // pointFormat: '{series.name}: <b>{point.y}</b>'
                pointFormat: '{series.name}: <b>{point.y}</b>'

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.y}', // Show actual value
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: 'Requests',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                        name: 'Approved',
                        y: {{ $statusCounts['complete'] }},
                        color: 'green' // Green color for Completed Ride
                    },
                    {
                        name: 'Rejected',
                        y: {{ $statusCounts['reject'] }},
                        color: 'red' // Red color for Rejected Ride

                    },
                    {
                        name: 'Pending',
                        y: {{ $statusCounts['pending'] }},
                        color: '#ff9933' // Blue color for Upcoming Ride

                    },
                    // {
                    //     name: 'Inprogress',
                    //     y: {{ $statusCounts['inprogress'] }},
                    //     color: 'pink' // Red color for Rejected Ride

                    // }
                ]
            }]
        });
    </script>


    <script>
        Highcharts.chart('container-2', {
            chart: {
                type: 'pie',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;
                        const result = {{ $travelStatusCounts['complete'] }} +
                            {{ $travelStatusCounts['pending'] }} + {{ $travelStatusCounts['reject'] }};


                        if (!customLabel) {
                            customLabel = chart.options.chart.custom.label =
                                chart.renderer.label(
                                    'Total<br/>' +
                                    `<strong>${result}</strong>`
                                )
                                .css({
                                    color: '#000',
                                    textAnchor: 'middle'
                                })
                                .add();
                        }

                        const x = series.center[0] + chart.plotLeft,
                            y = series.center[1] + chart.plotTop -
                            (customLabel.attr('height') / 2);

                        customLabel.attr({
                            x,
                            y
                        });
                        // Set font size based on chart diameter
                        customLabel.css({
                            fontSize: `${series.center[2] / 12}px`
                        });
                    }
                }
            },
            accessibility: {
                point: {
                    valueSuffix: ''
                }
            },
            title: {
                text: 'Today Travel Requests'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.y}', // Show actual value
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: 'Requests',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                        name: 'Approved',
                        y: {{ $travelStatusCounts['complete'] }},
                        color: 'green' // Green color for Completed Ride
                    },
                    {
                        name: 'Rejected',
                        y: {{ $travelStatusCounts['reject'] }},
                        color: 'red' // Red color for Rejected Ride

                    },
                    {
                        name: 'Pending',
                        y: {{ $travelStatusCounts['pending'] }},
                        color: '#ff9933' // Blue color for Upcoming Ride

                    },
                    // {
                    //     name: 'Inprogress',
                    //     y: {{ $travelStatusCounts['inprogress'] }},
                    //     color: 'pink' // Red color for Rejected Ride

                    // }
                ]
            }]
        });
    </script>


    <script>
        function updateGreeting() {
            let hour = new Date().getHours();
            let greeting = "Good Evening";
            if (hour < 12) greeting = "Good Morning";
            else if (hour < 18) greeting = "Good Afternoon";
            document.getElementById("greeting").innerText = greeting;
        }
        setInterval(updateGreeting, 100 * 60);

        function updateTime() {
            // Get the current time
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Add leading zeros if needed (e.g., 09:05:09 instead of 9:5:9)
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            // Format time as HH:MM:SS
            var timeString = hours + ":" + minutes + ":" + seconds;

            // Update the content of the live-time paragraph
            document.getElementById("live-time").textContent = timeString;
        }

        // Update the time every 1000ms (1 second)
        setInterval(updateTime, 1000);

        // Initialize the time immediately on page load
        updateTime();
    </script>



    <script>
        document.querySelectorAll(".showing1").forEach((showing1) => {
            showing1.addEventListener("click", function() {
                const title = this.getAttribute("data-titles");
                const text = this.getAttribute("data-texts");
                document.getElementById("content-titless").textContent = title;
                document.getElementById("text").innerHTML = text;
            });
        });
    </script>





    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                events: @json($events),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                eventContent: function(arg) {
                    // Custom event rendering with thumb-tack icon
                    return {
                        html: `<i class="fa fa-thumb-tack text-primary me-1"></i> ${arg.event.title}`
                    }
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    document.getElementById('modalEventTitle').textContent = info.event.title;
                    document.getElementById('modalEventStart').textContent = info.event.start
                        .toLocaleString();
                    document.getElementById('modalEventEnd').textContent = info.event.end ? info.event
                        .end.toLocaleString() : 'Ended...';
                    document.getElementById('modalEventDescription').textContent = info.event
                        .extendedProps.event_description;
                    var eventModal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                    eventModal.show();
                },
                eventDidMount: function(info) {
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: info.event.title,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                dayMaxEventRows: true,
                eventDisplay: 'block',
                eventColor: '#0d6efd',
                eventTextColor: '#ffffff',
                selectable: true,
                nowIndicator: true,
                aspectRatio: 1.5,
            });
            calendar.render();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#welcomeBtn').on('click', function() {
                $('.welcomeSection').removeClass('hidden');
                $('.dashboardSection').addClass('hidden');
            });

            $('#dashboardBtn').on('click', function() {
                $('.dashboardSection').removeClass('hidden');
                $('.welcomeSection').addClass('hidden');
            });
        });
    </script>

@endsection
