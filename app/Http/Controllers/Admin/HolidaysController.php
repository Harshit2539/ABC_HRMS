<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HolidayExport;
use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\LeaveDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;


class HolidaysController extends Controller
{
    
    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year; // Get current year

        $data = Holiday::whereYear('date_holiday', $currentYear)->get(); // Filter by current year

        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('name_holiday', function ($data) {
                return $data->name_holiday;
            })
            ->addColumn('date_holiday', function ($data) {
                return $data->date_holiday;
            })
          
            ->addColumn("action", function ($data) {
                $button = '<div style="display:flex; justify-content:center">
                    <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Edit</a>
                </div>';
                return $button;
            })
                ->make(true);
        }
        return view('admin.holidays.index');
    }

    public function getHolidays($year)
    {
        $holidays = Holiday::whereYear('date_holiday', $year)->paginate(15); // Pagination added
        $weekends = $this->getWeekends($year);
        return response()->json(['holidays' => $holidays, 'weekends' => $weekends]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'holidayName' => 'required|string|max:255',
                'holidayDate' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            Holiday::create([
                'name_holiday'=> $request->holidayName,
                'date_holiday' => $request->holidayDate
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Skill created successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'holidayName' => 'required|string|max:255',
                'holidayDate' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $holiday = Holiday::findOrFail($id);
    
            $holiday->update([
                'name_holiday'=> $request->holidayName,
                'date_holiday' => $request->holidayDate
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Holiday updated successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }

    public function quickStore(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'import_from' => 'required|integer|min:2000|max:2100',
            'import_to' => 'required|integer|min:2000|max:2100',
            'holiday_name' => 'required|array',
            'holiday_name.*' => 'required|string',
            'holiday_date' => 'required|array',
            'holiday_date.*' => 'required|date',
        ]);

        // Loop through holidays and save them
        $holidays = [];
        foreach ($request->holiday_name as $key => $holidayName) {
            $holidays[] = [
                'name_holiday' => $holidayName,
                'date_holiday' => $request->holiday_date[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Save holidays in batch
        Holiday::insert($holidays); 

        // Example of redirecting back
        return redirect()->back()->with('message', 'Holidays added successfully!');
    }

    public function destroy($id)
    {
        Holiday::destroy($id);
        return response()->json(['message' => 'Holiday deleted successfully']);
    }

    public function edit($id)
    {
        $skill = Holiday::findOrFail($id);
        return response()->json($skill);
    }

    // Optional: If you want to implement weekends fetching logic
    private function getWeekends($year)
    {
        $startDate = Carbon::create($year, 1, 1);
        $endDate = Carbon::create($year, 12, 31);

        $weekends = [];

        // Iterate through the days of the year
        while ($startDate->lte($endDate)) {
            if ($startDate->isWeekend()) {
                $weekends[] = $startDate->format('Y-m-d');
            }
            $startDate->addDay();
        }

        return $weekends;
    }


    public function holidayCalender(Request $request){
        $currentYear = Carbon::now()->year; // Get current year

        $holidays = Holiday::select('id', 'name_holiday', 'is_restrict', 'date_holiday')
        ->whereYear('date_holiday', $currentYear)
        ->orderBy('date_holiday') // Order by date
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->date_holiday)->format('F'); // Group by month name
        });

        $employee_restrict_leave = LeaveDetail::select('id', 'restrict_leave_id')->where('leave_type', 'Restrict Leave')->whereYear('from_date', $currentYear)->get();

       
        return view('holidaycalender', compact('holidays', 'employee_restrict_leave'));
    }
}
