<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;


class PeopleController extends Controller
{
    public function index()
    {
        return view('admin.people.people_everyone');
    }


    public function searchEmployeeList(Request $request)
    {
        if ($request->filled('employee_name')) {
          
            $search = $request->input('employee_name');
      
            $employees = User::with('employee')->where('name', 'like', "%$search%")->get();

          

            if (count($employees) == 0) {

                return response()->json(['status' => false, 'message' => 'No Data Found']);
            } else if (!empty($employees)) {

                $employeeArr = [];

                foreach ($employees as $employee) {
                    $employeeArr[] = [
                        'name' => $employee->name,
                        'id' => $employee->id,
                        'olm_id' => $employee->employee->olm_id
                    ];
                }

                return response()->json(['status' => true, 'employees' => $employeeArr]);
            }
        }
    }

    public function getEmployeeDetails(Request $request)
    {

        $employee_details = Employee::where('employee_id', $request->id)->select('first_name', 'middle_name', 'last_name', 'olm_id', 'birthday', 'marital_status', 'city', 'country', 'work_email', 'work_phone','joined_date')->first();
        return  response()->json(['status' => true, 'employeeDetails' => $employee_details]);
    }
}
