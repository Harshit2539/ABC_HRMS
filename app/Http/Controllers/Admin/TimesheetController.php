<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimesheetController extends Controller
{
    public function manageTimesheet(Request $request){
        return view('admin.timesheet.manage_timesheet');
    }

    public function uploadTimesheet(Request $request){
        $request->validate([
            'month' => 'required|string',
            'year' => 'required|numeric',
            'timesheet' => 'required|mimes:xlsx,xls',
        ]);
    
        // Handle file upload
        if ($request->hasFile('timesheet')) {
            $file = $request->file('timesheet');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('timesheets', $fileName, 'public'); // store in public/timesheets
    
            // Save to database
            Timesheet::create([
                'month' => $request->month,
                'year' => $request->year,
                'file_name' => $fileName,
                'file_path' => 'storage/' . $filePath, // for public access
                'uploaded_by' => Auth::id() // default user or auth user
            ]);
    
            return response()->json(['success' => true, 'message' => 'Timesheet uploaded successfully.']);
        }
    
        return response()->json(['success' => false, 'message' => 'No file uploaded.'], 400);
    }

}
