@extends('layouts.master') <!-- Use your base layout -->

@section('content')
    <div class="page-wrapper">
        <div class="container container-fluid mt-4 ">
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

            // Handle dropdown change
            $('#workDropdown').on('change', function() {
                const selectedMonth = $(this).val();
                fetchWorkAnniversaries(selectedMonth);
            });

            // On page load, fetch for default selected month
            const defaultMonth = $('#workDropdown').val();
            fetchWorkAnniversaries(defaultMonth);
        });
    </script>
@endsection
