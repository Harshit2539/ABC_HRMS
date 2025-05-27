<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class CommonController extends Controller
{
    public function appraisal(Request $request)
    {
        $month = $request->input('month') ?? now()->month;
        $currentYear = now()->year;
        $today = now();

        $employees = Employee::select('id', 'first_name', 'last_name', 'joined_date')
            ->get()
            ->filter(function ($employee) use ($month, $currentYear, $today) {
                $joinedDate = Carbon::parse($employee->joined_date);
                if ($joinedDate->diffInYears($today) < 1) {
                    return false;
                }
                $appraisalDate = $joinedDate->copy()->year($currentYear);
                if ($appraisalDate->lt($today)) {
                    $appraisalDate->addYear();
                }
                return $appraisalDate->month == (int) $month;
            })
            ->map(function ($employee) use ($currentYear, $today) {
                $joinedDate = Carbon::parse($employee->joined_date);
                $appraisalYear = $joinedDate->copy()->addYears($joinedDate->diffInYears($today))->year;
                $appraisalDate = $joinedDate->copy()->year($appraisalYear);
                if ($appraisalDate->lt($today)) {
                    $appraisalDate->addYear();
                }
                return [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'appraisal_date' => $appraisalDate->toDateString(),
                ];
            })
            ->sortBy('appraisal_date')
            ->values();
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'month' => (int) $month,
                'work' => $employees
            ]);
        }
        return view('common.appraisal', [
            'employees' => $employees,
            'month' => $month
        ]);
    }

    public function birthday(Request $request)
    {
        $month = $request->input('month') ?? now()->month;

        $birthdays = Employee::whereMonth('birthday', $month)
            ->select('id', 'first_name', 'last_name', 'birthday')
            ->get();

        return view('common.birthday', [
            'birthdays' => $birthdays,
            'month' => $month
        ]);
    }
    public function work(Request $request)
    {
        $month = $request->input('month') ?? now()->month;
        $today = now();

        $employees = Employee::whereMonth('joined_date', $month)
            ->select('id', 'first_name', 'last_name', 'joined_date')
            ->get()
            ->map(function ($employee) use ($today) {
                $years = $today->year - Carbon::parse($employee->joined_date)->year;
                return [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'work' => $employee->joined_date,
                    'anniversary_count' => $years
                ];
            });

        return view('common.anniversary', [
            'employees' => $employees,
            'month' => $month
        ]);
    }
}
