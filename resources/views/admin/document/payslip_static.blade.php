@extends('layouts.master')

@section('content')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            font-weight: bold;
            font-size: 17.5px;
            padding: 15px;
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 600;
            font-size: 13px;
        }

        .nav-tabs .nav-link.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }

        .list-group-item {
            border: none;
            padding: 11px 14px;
            border-radius: 5px;
            background: #ffffff;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
        }

        .list-group-item:hover {
            background-color: #f1f5f9;
        }

        .list-group-item span {
            font-size: 12.5px;
            color: #6c757d;
        }

        .btn-light {
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 13px;
            margin-right: 5px;
        }

        .btn-light:hover {
            background: #e9ecef;
        }

        .jump-to {
            font-weight: 600;
            font-size: 13px;
            color: #343a40;
            margin-bottom: 10px;
        }

        .nav.flex-column .nav-link {
            color: #007bff;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.3s;
        }

        .nav.flex-column .nav-link:hover {
            text-decoration: underline;
        }

        h4 {
            color: #007bff;
        }
    </style>

    <div class="page-wrapper">
        <div class="container-fluid mt-4">
            <div class="card card-header d-flex justify-content-between text-sm mb-3">
                <div class="card-title mb-0">
                    <h4 id="all" class="main-heading">Document Center / Documents</h4>
                </div>
                <div class="d-flex align-items-center"></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="payslipTabs">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#2025">Payslips</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="jump-to">JUMP TO</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item"><a class="nav-link" href="#2025">2025</a></li>
                                <li class="nav-item"><a class="nav-link" href="#2024">2024</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                <div id="2025" class="tab-pane fade show active">
                                    <div class="card">
                                        <div class="card-header">2025</div>
                                        <div class="accordion" id="policyAccordion">
                                            <div class="card">
                                                <div class="card-header" id="heading0">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse"
                                                            data-target="#collapse0" aria-expanded="true"
                                                            aria-controls="collapse0">
                                                            Payslip May 2025
                                                            <span class="ml-3 text-muted small">Last updated on: 24 May,
                                                                2025</span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse0" class="collapse show" aria-labelledby="heading0"
                                                    data-parent="#policyAccordion">
                                                    <div class="card-body">
                                                        <a href="#" download
                                                            class="btn btn-sm btn-primary">
                                                            <i class="la la-download"></i> Download File
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="2024" class="tab-pane fade show active">
                                    <div class="card">
                                        <div class="card-header">2024</div>
                                        <div class="accordion" id="accordion2024">
                                            <div class="card">
                                                <div class="card-header" id="heading1">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                            data-target="#collapse1" aria-expanded="false"
                                                            aria-controls="collapse1">
                                                            Payslip Jan 2024
                                                            <span class="ml-3 text-muted small">Last updated on: 24 Jan,
                                                                2024</span>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div id="collapse1" class="collapse" aria-labelledby="heading1"
                                                    data-parent="#accordion2024">
                                                    <div class="card-body">
                                                        <a href="#" download
                                                            class="btn btn-sm btn-primary">
                                                            <i class="la la-download"></i> Download File
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
@endsection
