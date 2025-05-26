<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/check-user', function (Request $request) {

    $user = User::where('email', $request->email)->first();
    if ($user) {
        return response()->json(['message' => 'User exists'], 200);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
});

Route::post('/register', function (Request $request) {

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
    ]);

  

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'join_date' => now(),
        'password' => $request->password, // Hash the password
    ]);
    if ($user) {
        $user->roles()->attach(3);
        $employeeData = [
            'employee_id' => $user->id,
            'olm_id' => null,
            'workstation_id' => null,
            'first_name'   => $user->name,
            'middle_name'  => 'null',
            'last_name' => 'null',
            'nationality' => null,
            'birthday'           => null,
            'gender'      => null,
            'marital_status'   => null,
            'ssn_num'       => null,
            'nic_num'  => null,
            'other_id' => null,
            'driving_license' => null,
            'driving_license_exp_date' => null,
            'employment_status'        => null,
            'job_title'        => null,
            'pay_grade' => null,
            'work_station_id' => 'nil',
            'role_id' => 3,
            'contract_type' => null,
            'probation_period' => null,
            'salary_on_contract' => null,
            'address1' => null,
            'address2' => null,
            'city' => null,
            'country' => null,
            'province' => 1,
            'postal_code' => null,
            'home_phone' => null,
            'mobile_phone' => null,
            'work_phone' => null,
            'work_email' => null,
            'private_email' => null,
            'joined_date' => null,
            'confirmation_date' => null,
            'supervisor' => $supervisor_id ?? Null,
            'indirect_supervisors' => null,
            'department' => null,
            'termination_date' => null,
            'status' => 'Active',
            'ethnicity' => null,
            'immigration_status' => null,
            'approver1' => null,
            'approver2' => null,
            'approver3' => null,

            //Onboard Details
            'vendor_name' => null,
            'partner_type' => null,
            'registered_corporate_address' => null,
            'current_location' => null,
            'airtel_partner_code' =>  null,
            'circle_id' => null,
            'function_id' => null,
            'name_of_airtel_employee' => null,
            'airtel_employee_id' => null,
            'airtel_employee_email_id' => null,
            'airtel_employee_mobile_number' => null,
            'airtel_employee_circle' => null
        ];

        $employeeInsert = DB::table('employees')->insertGetId($employeeData);
        if($employeeInsert){
            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } 
        // else{
        //     return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        // }
       
    }
});


Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    $user = User::where('email',$request->email)->first();

    if (Auth::attempt(['email'=> $user->email,'password'=>12345678,'status'=>null])) {
        return response()->json(['message' => 'Login successful', 'user' => 'current user'], 200);
    }else{
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
});
