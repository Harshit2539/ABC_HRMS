<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\TravelCategoryAllowance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function getrows(){
        $data = DB::table('nationalities')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }


    public function getImmigrationRows(){
        $data = DB::table('immigration_status')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getEmploymentRows(){
        $data = DB::table('employment_status')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getDepartmentRows(){
        $data = DB::table('departments')->get(['department', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getJobTitleRows(){
        $data = DB::table('job_titles')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }
    
    public function getPaygradeRows(){
        $data = DB::table('pay_grades')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getCountryRows(){
        $data = DB::table('countries')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getEmployeesRows(){
        $data = DB::table('users')
        ->get(['name', 'id', 'role_name']);
    
            // Group users by role_name directly
            $grouped = $data->groupBy('role_name');

            
            $dgaUsers = $grouped->get('DGA', collect());
            $HrUsers = $grouped->get('HR', collect());
            $DirectSuperiorUsers = $grouped->get('Direct superior', collect());



            $adminUsers = $grouped->get('Admin', collect());

        
           
            $dgaMerged = $dgaUsers->merge($adminUsers);
            
            $HrMerged = $HrUsers->merge($adminUsers)->merge($dgaUsers)->merge($DirectSuperiorUsers);
            $DirectSuperiorMerged = $DirectSuperiorUsers->merge($adminUsers);


         
            // Prepare the response, defaulting to empty arrays if a role group is missing
            $res['success'] = true;
            $res['message'] = [
                'dga' => $dgaMerged,
                'hr' => $HrMerged ,
                'direct_superior' => $DirectSuperiorMerged,
            ];


            
            
            return response($res);
    }

    public function getRolesRows(){
        $data = DB::table('roles')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getDivisionRows(){
        $data = DB::table('divisions')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getCategoryRows(){
        $data = DB::table('categories')->get(['name', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getSalaryPayrollCategoryRows(){
        $data = DB::table('employee_payslip_categories')->get(['category_name', 'id', 'basic_salary']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getCurrencyRows(){
        $data = DB::table('currency_types')->get(['code', 'id']);
        if ( $data ) {
			$res['success'] = true;
			$res['message']= $data;
        }
        return response( $res );
    }

    public function getEmployeesBySearch($search){
        $users = User::where('name', 'like', '%' . $search . '%')->get(['id', 'name']);

        if (!$users->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $users]);
        } else {
            return response()->json(['status' => 400, 'data' => []]);
        }
    }



    public function getEmployeesByDepartmentId(Request $request){
        $users = Employee::where('department', $request->id)->get(['id', 'first_name', 'last_name', 'employee_id']);

        if (!$users->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $users]);
        } else {
            return response()->json(['status' => 400, 'data' => []]);
        }
    }

    public function getEmployeeTravelAllowance(Request $request, $id){
        $employeeDetails = Employee::where('employee_id', $request->id)->first(['id', 'division_id', 'category_id']);
        $travel_allowance = TravelCategoryAllowance::with('travel_allowance')->where('division_id', $employeeDetails['division_id'])
        ->where('category_id', $employeeDetails['category_id'])->get();
        if (!$travel_allowance->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $travel_allowance]);
        } else {
            return response()->json(['status' => 400, 'data' => []]);
        }
    }

    public function getEmployee($id){
       $user = User::find($id,['id', 'name']);
    return response()->json(['status' => 200, 'data' => $user]);
       
    }
    
    

}
