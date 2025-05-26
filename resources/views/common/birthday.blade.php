@extends('layouts.master') <!-- Use your base layout -->

@section('content')
    <div class="page-wrapper">
        <div class="container container-fluid mt-4 ">
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
    <script>
        

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

            // ✅ Fetch for default month on load
            const defaultMonth = $('#birthdayDropdown').val();
            fetchBirthdays(defaultMonth);
        });
    </script>

@endsection