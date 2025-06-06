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
    @php
        $groupedData = $data->groupBy('year');
    @endphp

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
                        @php $first = true; @endphp
                        @foreach ($groupedData as $year => $items)
                            <li class="nav-item">
                                <a class="nav-link {{ $first ? 'active' : '' }}" data-toggle="tab"
                                    href="#tab{{ $year }}">{{ $year }}</a>
                            </li>
                            @php $first = false; @endphp
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6 class="jump-to">JUMP TO</h6>
                            <ul class="nav flex-column">
                                @foreach ($groupedData as $year => $items)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab{{ $year }}">{{ $year }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content">
                                @if ($data->isEmpty())
                                    <p>No payslip data found for your profile.</p>
                                @endif

                                @php $first = true; @endphp
                                @foreach ($groupedData as $year => $items)
                                    <div id="{{ $year }}" class="tab-pane fade {{ $first ? 'show active' : '' }}">
                                        <div class="card">
                                            <div class="card-header">{{ $year }}</div>
                                            <div class="accordion" id="accordion{{ $year }}">
                                                @foreach ($items as $index => $item)
                                                    @php
                                                        $monthName = \Carbon\Carbon::create()
                                                            ->month($item->current_month)
                                                            ->format('M');
                                                        $collapseId = 'collapse' . $year . '_' . $index;
                                                        $headingId = 'heading' . $year . '_' . $index;
                                                    @endphp
                                                    <div class="card">
                                                        <div class="card-header" id="{{ $headingId }}">
                                                            <h5 class="mb-0">
                                                                <button
                                                                    class="btn btn-link {{ !$first && $index !== 0 ? 'collapsed' : '' }}"
                                                                    data-toggle="collapse"
                                                                    data-target="#{{ $collapseId }}"
                                                                    aria-expanded="{{ $first && $index === 0 ? 'true' : 'false' }}"
                                                                    aria-controls="{{ $collapseId }}">
                                                                    Payslip {{ $monthName }} {{ $item->year }}
                                                                    <span class="ml-3 text-muted small">
                                                                        Last updated on:
                                                                        {{ \Carbon\Carbon::parse($item->released_date)->format('d M, Y') }}
                                                                    </span>
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="{{ $collapseId }}"
                                                            class="collapse {{ $first && $index === 0 ? 'show' : '' }}"
                                                            aria-labelledby="{{ $headingId }}"
                                                            data-parent="#accordion{{ $year }}">
                                                            <div class="card-body">
                                                                <a href="#" download class="btn btn-sm btn-primary">
                                                                    <i class="la la-download"></i> Download File
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @php $first = false; @endphp
                                @endforeach
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
