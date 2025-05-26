<?php

namespace App\Http\Controllers;

use App\Models\AnnualLeave;
use App\Models\Countries;
use App\Models\Department;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\EmployeeAnnualLeave;
use App\Models\EmployeeSalaryComponents;
use App\Models\JobTitles;
use App\Models\User;
use App\Models\module_permission;
use App\Models\Nationalities;
use App\Models\roleTypeUser;
use App\Models\SalaryGroup;
use Carbon\Carbon;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class EmployeeController extends Controller
{
  

    public function save(Request $request){
        $year = Carbon::now()->year;

        $employee_number         = $request->input('employee_number');
        $workstation_id         = $request->input('workstation_id');
        $registration_no         = $request->input('registration_no');
        $cnps_no         = $request->input('cnps_no');
        $niu         = $request->input('niu');
        $first_name         = $request->input('first_name');
        $middle_name             = $request->input('middle_name');
        $last_name             = $request->input('last_name');
        $nationality_id            = $request->input('nationality_id');
        $date_of_birth       = $request->input('date_of_birth') == "null" ? null : $request->input('date_of_birth') ;
        $joined_date           = $request->input('joined_date');
        $confirmation_date        = $request->input('confirmation_date');
        $termination_date               = $request->input('termination_date') == "null" ? null : $request->input('termination_date');
        $contract_type  = $request->input('contract_type') == "null" ? null : $request->input('contract_type');
        $probation_period             = $request->input('probation_period') == "null" ? null : $request->input('probation_period');
        $salary_on_contract           = $request->input('salary_on_contract') == "null" ? null : $request->input('salary_on_contract');
        $gender       = $request->input('gender');
        $marital               = $request->input('marital');
        $immigration_id             = $request->input('immigration_id');
        $ssn_nric            = $request->file('ssn_nric');
        $nic        = $request->input('nic');
        $other_id  = $request->input( 'other_id' );
        $driving_license_no    = $request->input( 'driving_license_no' );
        $address_line_1    = $request->input( 'address_line_1' );
        $address_line_2    = $request->input( 'address_line_2' );
        $city       = $request->input( 'city' );
        $country_id           = $request->input('country_id');
        $postal_zip_code       = $request->input('postal_zip_code');
        $home_phone              = $request->input('home_phone') ;
        $mobile_phone     =  $request->input('mobile_phone');
        $work_email    =  $request->input('work_email');
        $work_phone    =  $request->input('work_phone');
        $private_email     =  $request->input('private_email');
        $employment_id  = $request->input('employment_id');
        $department_id  = $request->input('department_id');
        $jobtitle_id  = $request->input('jobtitle_id');
        $supervisor_id  =  null;
        $indirect_supervisor_id  =  null ;
        $first_level_approver_id  = $request->input('reporting_manager') == "null" ? null : $request->input('reporting_manager') ;
        $second_level_approver_id  =  null;
        $third_level_approver_id  =  null;
        $division_id  =null ;
        $category_id  =  null  ;
        $travel_category_allowance_id  =  null ;
        $basic_salary  = $request->input('basic_salary') == "null" ? null : (int)$request->input('basic_salary');
        $created_at         = date("Y-m-d H:i:s");
        $updated_at         = date("Y-m-d H:i:s");


       

        $role = FacadesDB::table('roles')->where('id', $request->role_id)->first('name');
        $userData = [
            'name'   => $first_name." ".$last_name,
            'email'  => $work_email,
            'join_date' => $created_at,
            'phone_number' => null,
            'status'           => 'Active',
            'role_name'      => $role->name,
            'avatar'          => null,
            'position'       => null,
            'department'  => null,
            'email_verified_at' => null,
            'password'      => Hash::make('12345678'),
            'created_at'        => $created_at,
            'updated_at'        => $updated_at
        ];

        // $insert = FacadesDB::table('users')->insertGetId($userData);
        $insert = User::create($userData);

        if ($insert) {
            $insert->roles()->attach($request->role_id);
            $employeeData = [
                'employee_id' => $insert->id,
                'olm_id' => $employee_number,
                'workstation_id' => $workstation_id,
                'registration_no' => $registration_no,
                'cnps_no' => $cnps_no,
                'niu' => $niu,
                'first_name'   => $first_name,
                'middle_name'  => $middle_name,
                'last_name' => $last_name,
                'nationality' => $nationality_id,
                'birthday'           =>$date_of_birth,
                'gender'      => $gender,
                'marital_status'   => $marital,
                'ssn_num'       => $ssn_nric,
                'nic_num'  => $nic,
                'other_id' => $other_id,
                'driving_license' => $driving_license_no,
                'driving_license_exp_date' => $updated_at,
                'employment_status'        => $employment_id,
                'job_title'        => $jobtitle_id,
                'work_station_id' => 'nil',
                'address1' => $address_line_1,
                'address2' => $address_line_2,
                'city' => $city,
                'country' => (int)$country_id,
                'postal_code' => $postal_zip_code,
                'home_phone' => $home_phone,
                'mobile_phone' => $mobile_phone,
                'work_phone' => $work_phone,
                'work_email' => $work_email,
                'private_email' => $private_email,
                'joined_date' => $joined_date,
                'confirmation_date' => $confirmation_date,
                'supervisor' => $supervisor_id ?? Null,
                'indirect_supervisors' => $indirect_supervisor_id,
                'department' => $department_id,
                'termination_date' => $termination_date,
                'contract_type' => $contract_type,
                'probation_period' => $probation_period,
                'salary_on_contract' => $salary_on_contract,
                'role_id' => (int)$request->role_id,
                'status' => 'Active',
                'immigration_status' => $immigration_id,
                'approver1' => $first_level_approver_id,
                'approver2' => $second_level_approver_id,
                'approver3' => $third_level_approver_id,


                'division_id' => $division_id,
                'category_id' => $category_id,
                'travel_category_allowance_id' => $travel_category_allowance_id,
                'basic_salary' => (int)$basic_salary,


                //Onboard Details
                'vendor_name' => null,
                'partner_type' => null,
                'registered_corporate_address' => null,
                'current_location' => null,
                'airtel_partner_code' => null,
                'circle_id' => null,
                'function_id' => null,
                'name_of_airtel_employee' => null,
                'airtel_employee_id' => null,
                'airtel_employee_email_id' => null,
                'airtel_employee_mobile_number' => null,
                'airtel_employee_circle' => null
            ];

            $employeeInsert = FacadesDB::table('employees')->insertGetId($employeeData);
            $annual_year = Carbon::now()->year;
            $total_leaves = AnnualLeave::where('year', $annual_year)->first();


            if($employeeInsert){
                $annual_employee_leaves = new EmployeeAnnualLeave();
                $annual_employee_leaves->year = $year;
                $annual_employee_leaves->user_id = $insert->id;
                $annual_employee_leaves->loss_of_pay = 0;
                $annual_employee_leaves->comp_off = 0;
                $annual_employee_leaves->annual_leave =  0;
                $annual_employee_leaves->work_from_home =  0;
                $annual_employee_leaves->sick_leave =  0;
                $annual_employee_leaves->restrict_leave =  $total_leaves->restrict_leave;
                $annual_employee_leaves->total_sick_leave =  $total_leaves->sick_leave;
                $annual_employee_leaves->total_annual_leave =  $total_leaves->annual_leave;
                $annual_employee_leaves->total_wfh =  $total_leaves->work_from_home;
                $annual_employee_leaves->total_wfh =  $total_leaves->work_from_home;

                $annual_employee_leaves->created_at = now();
                $annual_employee_leaves->updated_at = now();
                $annual_employee_leaves->save();
                $res['message'] = 'success';
            } else{
                $res['message'] = 'failed';
            }
            return response( $res );
        }


    }


    public function update(Request $request){

        $employee_id =  $request->employee_id;
        $employee_number         = $request->input('employee_number');
        $workstation_id         = $request->input('workstation_id');
        $registration_no         = $request->input('registration_no');
        $cnps_no         = $request->input('cnps_no');
        $niu         = $request->input('niu');
        $first_name         = $request->input('first_name');
        $middle_name             = $request->input('middle_name');
        $last_name             = $request->input('last_name');
        $nationality_id            = $request->input('nationality_id');
        $date_of_birth       = $request->input('date_of_birth') == "null" ? null : $request->input('date_of_birth') ;
        $joined_date           = $request->input('joined_date');
        $confirmation_date        = $request->input('confirmation_date');
        $termination_date               = $request->input('termination_date') == "null" ? null : $request->input('termination_date');
        $contract_type  = $request->input('contract_type') == "null" ? null : $request->input('contract_type');;
        $probation_period             = $request->input('probation_period') == "null" ? null : $request->input('probation_period');;
        $salary_on_contract           = $request->input('salary_on_contract') == "null" ? null : $request->input('salary_on_contract');;
        $gender       = $request->input('gender');
        $marital               = $request->input('marital');
        $immigration_id             = $request->input('immigration_id');
        $ssn_nric            = $request->file('ssn_nric');
        $nic        = $request->input('nic');
        $other_id  = $request->input( 'other_id' );
        $driving_license_no    = $request->input( 'driving_license_no' );
        $address_line_1    = $request->input( 'address_line_1' );
        $address_line_2    = $request->input( 'address_line_2' );
        $city       = $request->input( 'city' );
        $country_id           = $request->input('country_id');
        $postal_zip_code       = $request->input('postal_zip_code');
        $home_phone              = $request->input('home_phone') ;
        $mobile_phone     =  $request->input('mobile_phone');
        $work_email    =  $request->input('work_email');
        $work_phone    =  $request->input('work_phone');
        $private_email     =  $request->input('private_email');
        $employment_id  = $request->input('employment_id');
        $department_id  = $request->input('department_id');
        $jobtitle_id  = $request->input('jobtitle_id');
        $first_level_approver_id  = $request->input('reporting_manager') == "null" ? null : $request->input('reporting_manager') ;
        $second_level_approver_id  = $request->input('second_level_approver_id') == "null" ? null : $request->input('second_level_approver_id') ;
        $third_level_approver_id  = $request->input('third_level_approver_id') == "null" ? null : $request->input('third_level_approver_id');
        $division_id  = $request->input('division_id') == "null" ? null : $request->input('division_id') ;
        $category_id  = $request->input('category_id') == "null" ? null : $request->input('category_id') ;
        $travel_category_allowance_id  = $request->input('travel_payroll_category_id') == "null" ? null : $request->input('travel_payroll_category_id');
        $basic_salary  = $request->input('basic_salary') == "null" ? null : (int)$request->input('basic_salary');
       
        if (true) {
            $employeeData = [
                'olm_id' => $employee_number,
                'workstation_id' => $workstation_id,
                'registration_no' => $registration_no,
                'cnps_no' => $cnps_no,
                'niu' => $niu,
                'first_name'   => $first_name,
                'middle_name'  => $middle_name,
                'last_name' => $last_name,
                'nationality' => $nationality_id,
                'birthday'           =>$date_of_birth,
                'gender'      => $gender,
                'marital_status'   => $marital,
                'ssn_num'       => $ssn_nric,
                'nic_num'  => $nic,
                'other_id' => $other_id,
                'driving_license' => $driving_license_no,
                'employment_status'        => $employment_id,
                'job_title'        => $jobtitle_id,
                'work_station_id' => 'nil',
                'address1' => $address_line_1,
                'address2' => $address_line_2,
                'city' => $city,
                'country' => (int)$country_id,
                'postal_code' => $postal_zip_code,
                'home_phone' => $home_phone,
                'mobile_phone' => $mobile_phone,
                'work_phone' => $work_phone,
                'work_email' => $work_email,
                'private_email' => $private_email,
                'joined_date' => $joined_date,
                'confirmation_date' => $confirmation_date,
                'department' => $department_id,
                'termination_date' => $termination_date,
                'contract_type' => $contract_type,
                'probation_period' => $probation_period,
                'salary_on_contract' => $salary_on_contract,
                'status' => 'Active',
                'immigration_status' => $immigration_id,
                'approver1' => $first_level_approver_id,
                'approver2' => $second_level_approver_id,
                'approver3' => $third_level_approver_id,


                'division_id' => $division_id,
                'category_id' => $category_id,
                'travel_category_allowance_id' => $travel_category_allowance_id,
                'basic_salary' => (int)$basic_salary,

               
                //Onboard Details
                'vendor_name' => null,
                'partner_type' => null,
                'registered_corporate_address' => null,
                'current_location' => null,
                'airtel_partner_code' => null,
                'circle_id' => null,
                'function_id' => null,
                'name_of_airtel_employee' => null,
                'airtel_employee_id' => null,
                'airtel_employee_email_id' => null,
                'airtel_employee_mobile_number' => null,
                'airtel_employee_circle' => null
            ];

            $employeeInsert = FacadesDB::table('employees')->where('id', $employee_id)->update($employeeData);
            if($employeeInsert){
                $res['message'] = 'success';
            } else{
                $res['message'] = 'failed';
            }
            return response( $res );


        }
    }




    public function storeNewEmployee(Request $request){
 
        $validator = FacadesValidator::make($request->all(), [
            'work_email' => 'required|email|unique:users,email',
        ]);
   
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
   
        // dd($request->all());
 
        $year = Carbon::now()->year;
 
        $salary_group_id          = $request->input('salary_group_id');
        $employee_number         = $request->input('employee_number');
        $aadhaar_number         = $request->input('aadhaar_number');
        $first_name         = $request->input('first_name');
        $middle_name             = $request->input('middle_name');
        $last_name             = $request->input('last_name');
        $date_of_birth       = $request->input('date_of_birth') == "null" ? null : $request->input('date_of_birth') ;
        $gender       = $request->input('gender');
        $supervisor_id            = $request->input('supervisor_id');
        $joined_date           = $request->input('joined_date');
        $probation_period             = $request->input('probation_period') == "null" ? null : $request->input('probation_period');
        $confirmation_date        = $request->input('confirmation_date');
        $work_email    =  $request->input('work_email');
        $mobile_phone     =  $request->input('mobile_phone');
        $home_phone  = $request->input('home_phone');
        $fathers_name     =  $request->input('fathers_name');
        $mothers_name     =  $request->input('mothers_name');
        $spouse_name     =  $request->input('spouse_name');
        $emergency_contact_name     =  $request->input('emergency_contact_name');
        $emergency_contact_number    =  $request->input('emergency_contact_number');
        $employee_ctc     =  $request->input('employee_ctc');
        $department_id    =  $request->input('department');
        $job_title_id    =  $request->input('designation');
        $created_at         = date("Y-m-d H:i:s");
        $updated_at         = date("Y-m-d H:i:s");
 

 
 
        $role = FacadesDB::table('roles')->where('id', $request->role_id)->first('name');
        $userData = [
            'name'   => $first_name." ".$last_name,
            'email'  => $work_email,
            'join_date' => $created_at,
            'phone_number' => $mobile_phone,
            'status'           => 'Active',
            'role_name'      => $role->name,
            'email_verified_at' => null,
            'password'      => Hash::make('12345678'),
            'created_at'        => $created_at,
            'updated_at'        => $updated_at
        ];
 
        $insert = User::create($userData);
       
 
        if ($insert) {
          $insert->roles()->attach($request->role_id);
            $employeeData = [
               'employee_id' => $insert->id,
                'aadhaar_number' => $aadhaar_number,
                'employee_number'=>$employee_number,
                'salary_group_id'=>$salary_group_id,
                'first_name'   => $first_name,
                'middle_name'  => $middle_name,
                'last_name' => $last_name,
                'birthday'         =>$date_of_birth,
                'gender'      => $gender,
                'mobile_phone' => $mobile_phone,
                'work_email' => $work_email,
                'joined_date' => $joined_date,
                'confirmation_date' => $confirmation_date,
                'supervisor' => Null,
                'probation_period' => $probation_period,
                'role_id' => (int)$request->role_id,
                'status' => 'Active',
                'fathers_name'=>$fathers_name,
                'mothers_name'=>$mothers_name,
                'spouse_name'=>$spouse_name,
                'for_country' => 'in',
                'emergency_contact_name'=>$emergency_contact_name,
                'emergency_contact_number'=>$emergency_contact_number,
                'employee_ctc'=>$employee_ctc,
                'home_phone'=>$home_phone,
                'department'=>$department_id,
                'job_title'=>$job_title_id
               
            ];


           
 
           $employeeInsert = FacadesDB::table('employees')->insertGetId($employeeData);

          // dd($employeeData);
 
 
 
            $annual_year = Carbon::now()->year;
            $total_leaves = AnnualLeave::where('year', $annual_year)->first();
 
            if($employeeInsert){
                $annual_employee_leaves = new EmployeeAnnualLeave();
                $annual_employee_leaves->year = $year;
                $annual_employee_leaves->user_id = $insert->id;
                $annual_employee_leaves->loss_of_pay = 0;
                $annual_employee_leaves->comp_off = 0;
                $annual_employee_leaves->annual_leave =  0;
                $annual_employee_leaves->work_from_home =  0;
                $annual_employee_leaves->sick_leave =  0;
                $annual_employee_leaves->total_sick_leave =  $total_leaves->sick_leave;
                $annual_employee_leaves->total_annual_leave =  $total_leaves->annual_leave;
                $annual_employee_leaves->total_wfh =  $total_leaves->work_from_home;
                $annual_employee_leaves->created_at = now();
                $annual_employee_leaves->updated_at = now();
                $annual_employee_leaves->save();
                $res['message'] = 'employee successfully added';
            } else{
                $res['message'] = 'failed';
            }
            return response( $res );
        }
 
 
    }
 
    public function showCtcSplit(Request $request){
 
        $salary_group = SalaryGroup::with('components.component_details')->find($request->salaryGroupId);
 
                $earning_component=[];
                $deduction_component=[];
 
            foreach( $salary_group->components as $item)
 
            {
                if($item->component_details->component_type == 'earning'){
                    $earning_component[]  =  $item->component_details;
 
                }
              elseif($item->component_details->component_type == 'deduction'){
                    $deduction_component[]  =  $item->component_details;
 
                }
 
            }
 
            return response()->json(['status'=>true, 'earningComponent'=>$earning_component, 'deductionComponent'=>$deduction_component]);
 
    }
 
    public function getDesignation(Request $request){
        $designation = JobTitles::where('department_id',$request->department_id)->select('id','code','name')->get();
        return response()->json(['status'=>true, 'designation'=>$designation]);
    }

    public function information()
    {
        $user = Auth::user();
        $employee = Employee::where('employee_id', $user->id)->first();
        $department = Department::where('id', $employee->department)->first();
        $approver = user::where('id', $employee->approver2)->first();
        $job = JobTitles::where('id', $employee->job_title)->first();
        $nationality = Nationalities::where('id', $employee->nationality)->first();
        $country = Countries::where('id', $employee->country)->first();
        return view('information', compact('employee', 'department', 'approver', 'job', 'nationality', 'country'));
    }


}
