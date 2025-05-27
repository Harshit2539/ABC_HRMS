<?php

use App\Http\Controllers\Admin\AllRequestController;
use App\Http\Controllers\Admin\AnnualLeaveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\Localization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EngageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::get('home', function () {
        return view('home');
    });
});

Auth::routes();
Route::get('/localization/{locales}', [App\Http\Controllers\LocalizationController::class, 'index'])->name('localization');
// ----------------------------- main dashboard ------------------------------//

Route::middleware(Localization::class)->group(function () {
    Route::get('/chart/department-data', [AllRequestController::class, 'getDepartmentChartData']);
    Route::get('/birthdays', [AllRequestController::class, 'birthdays'])->name('birthdays.index');
    Route::get('/chart/gender-data', [AllRequestController::class, 'getGenderChartData']);
    Route::get('/chart/country-data', [AllRequestController::class, 'getCountryChartData']);
    Route::get('/chart/joining-data', [AllRequestController::class, 'getJoiningChartData']);
    Route::get('/chart/age-data', [AllRequestController::class, 'getAgeChartData']);
    Route::get('/chart/leave-data', [AllRequestController::class, 'getLeaveChartData']);
    Route::get('/work', [AllRequestController::class, 'work'])->name('work.index');
    Route::get('/chart/ctc-data', [AllRequestController::class, 'ctc'])->name('ctc');
    Route::get('/chart/service-data', [AllRequestController::class, 'getSeriviceChartData']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/loader', [App\Http\Controllers\HomeController::class, 'authenticateLoader'])->name('authenticate.loader');


    // -----------------------------settings----------------------------------------//
    Route::get('company/settings/page', [App\Http\Controllers\SettingController::class, 'companySettings'])->middleware('auth')->name('company/settings/page');
    Route::post('/company-settings/save', [App\Http\Controllers\SettingController::class, 'store'])->name('company.store');


    // -----------------------------login----------------------------------------//
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


    // ------------------------------ register ---------------------------------//
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'storeUser'])->name('register');

    // ----------------------------- forget password ----------------------------//
    Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'getEmail'])->name('forget-password');
    Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postEmail'])->name('forget-password');

    // ----------------------------- reset password -----------------------------//
    Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'getPassword']);
    Route::post('reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'updatePassword']);

    // ----------------------------- Admin Side -----------------------------//

    Route::group(['middleware' => 'auth'], function () {

        //------------------------------Company Structure-------------------------------------------//
        Route::get('admin/company-structure-setup', [App\Http\Controllers\Admin\CompanyStructure::class, 'index'])->name('company-structure.setup');
        Route::post('/admin/company-structure', [App\Http\Controllers\Admin\CompanyStructure::class, 'store'])->name('company-structure.setup.store');
        Route::get('admin/company-structure/{id}/edit', [App\Http\Controllers\Admin\CompanyStructure::class, 'edit']);
        Route::put('admin/company-structure/{id}', [App\Http\Controllers\Admin\CompanyStructure::class, 'update']);
        Route::post('admin/company-structure/{id}', [App\Http\Controllers\Admin\CompanyStructure::class, 'destroy']);

        // ----------------------------- JOB DETAILS SETUP -----------------------------//
        Route::get('admin/job-detail-setup', [App\Http\Controllers\Admin\JobDetailsSetupController::class, 'index'])->name('admin.job.details.setup');
        Route::post('/admin/job-details', [App\Http\Controllers\Admin\JobDetailsSetupController::class, 'store'])->name('job-details.store');
        Route::get('admin/job-details/{id}/edit', [App\Http\Controllers\Admin\JobDetailsSetupController::class, 'edit']);
        Route::put('admin/job-details/{id}', [App\Http\Controllers\Admin\JobDetailsSetupController::class, 'update']);
        Route::post('admin/job-details/{id}', [App\Http\Controllers\Admin\JobDetailsSetupController::class, 'destroy']);


        //--------------------------------payroll settings-------------------------------------//

        Route::get('salary_component', [App\Http\Controllers\Admin\PayRollSettings::class, 'salarycomponentlist'])->name('salary.component.list');
        Route::post('store_salary_component', [App\Http\Controllers\Admin\PayRollSettings::class, 'storeSalaryComponent'])->name('store.salary.component');
        Route::post('delete_salary_component/{id}', [App\Http\Controllers\Admin\PayRollSettings::class, 'deleteSalaryComponents'])->name('delete.salary.component');
        Route::get('edit_salary_component/{id}', [App\Http\Controllers\Admin\PayRollSettings::class, 'editSalaryComponents'])->name('edit.salary.component');
        Route::get('payrollsettings/salary_component', [App\Http\Controllers\Admin\PayRollSettings::class, 'salaryComponentList'])->name('admin.payrollsettings.salary_component');
        Route::post('update_salary_component/{id}', [App\Http\Controllers\Admin\PayRollSettings::class, 'updateSalaryComponents'])->name('update.salary.component');


        Route::get('salary_group', [App\Http\Controllers\Admin\PayRollSettings::class, 'salaryGroupList'])->name('salary.group.list');
        Route::post('store_salary_group', [App\Http\Controllers\Admin\PayRollSettings::class, 'storeSalaryGroup'])->name('store.salary.group');
        Route::post('delete_salary_group/{id}', [App\Http\Controllers\Admin\PayRollSettings::class, 'deleteSalaryGroup'])->name('delete.salary.group');
        Route::get('get_component_details', [App\Http\Controllers\Admin\PayRollSettings::class, 'getComponentDetails'])->name('get.component.details');
        Route::get('get_selected_components', [App\Http\Controllers\Admin\PayRollSettings::class, 'getSelectedComponents'])->name('get.selected.components');
        Route::get('edit_salary_group/{id}', [App\Http\Controllers\Admin\PayRollSettings::class, 'editSalaryGroup'])->name('edit.salary.group');
        Route::post('update_salary_group', [App\Http\Controllers\Admin\PayRollSettings::class, 'updateSalaryGroup'])->name('update.salary.group');


        // -----------------------------Employment Setup -----------------------------------------//

        Route::get('admin/employment-setup', [App\Http\Controllers\Admin\EmploymentController::class, 'index'])->name('admin.employment.setup');
        Route::post('/admin/employment-details', [App\Http\Controllers\Admin\EmploymentController::class, 'store']);
        Route::get('admin/paygrade-setup/{id}/edit', [App\Http\Controllers\Admin\EmploymentController::class, 'edit']);
        Route::put('admin/paygrade-setup/{id}', [App\Http\Controllers\Admin\EmploymentController::class, 'update']);
        Route::post('admin/employment-details/{id}', [App\Http\Controllers\Admin\EmploymentController::class, 'destroy']);


        //------------------------------Clients Route----------------------------------------------//
        Route::get('/clients', [App\Http\Controllers\Admin\ClientDetailsController::class, 'list'])->name('clients.list');
        Route::post('/clients_store', [App\Http\Controllers\Admin\ClientDetailsController::class, 'store'])->name('clients.store');
        Route::get('/clients_edit/{id}', [App\Http\Controllers\Admin\ClientDetailsController::class, 'edit'])->name('clients.edit');
        Route::post('/clients_update/{id}', [App\Http\Controllers\Admin\ClientDetailsController::class, 'update'])->name('clients.update');
        Route::get('/clients_delete/{id}', [App\Http\Controllers\Admin\ClientDetailsController::class, 'delete'])->name('clients.delete');

        // -------------------------------Projects Route--------------------------------------------//
        Route::get('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'list'])->name('projects.list');
        Route::post('/projects_store', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects_edit/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('projects.edit');
        Route::post('/projects_update/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('projects.update');
        Route::get('/projects_delete/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'delete'])->name('projects.delete');


        //------------------------------Skills Route-----------------------------------------------
        Route::get('/skills', [App\Http\Controllers\Admin\SkillController::class, 'list'])->name('skills.list');
        Route::post('/skills_store', [App\Http\Controllers\Admin\SkillController::class, 'store'])->name('skills.store');
        Route::get('/skills_edit/{id}', [App\Http\Controllers\Admin\SkillController::class, 'edit'])->name('skills.edit');
        Route::post('/skills_update/{id}', [App\Http\Controllers\Admin\SkillController::class, 'update'])->name('skills.update');
        Route::get('/skills_delete/{id}', [App\Http\Controllers\Admin\SkillController::class, 'delete'])->name('skills.delete');

        //--------------------------Languages Route----------------------------------------------------
        Route::get('/languages', [App\Http\Controllers\Admin\LanguageController::class, 'list'])->name('languages.list');
        Route::post('/languages_store', [App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('languages.store');
        Route::get('/languages_edit/{id}', [App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('languages.edit');
        Route::post('/languages_update/{id}', [App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('languages.update');
        Route::get('/languages_delete/{id}', [App\Http\Controllers\Admin\LanguageController::class, 'delete'])->name('languages.delete');


        //-------------------------------Certifications Route-------------------------------------------------
        Route::get('/certifications', [App\Http\Controllers\Admin\CertificationController::class, 'list'])->name('certifications.list');
        Route::post('/certifications_store', [App\Http\Controllers\Admin\CertificationController::class, 'store'])->name('certifications.store');
        Route::get('/certifications_edit/{id}', [App\Http\Controllers\Admin\CertificationController::class, 'edit'])->name('certifications.edit');
        Route::post('/certifications_update/{id}', [App\Http\Controllers\Admin\CertificationController::class, 'update'])->name('certifications.update');
        Route::get('/certifications_delete/{id}', [App\Http\Controllers\Admin\CertificationController::class, 'delete'])->name('certifications.delete');


        //----------------------------------------Education Route---------------------------------------------
        Route::get('/educations', [App\Http\Controllers\Admin\EducationController::class, 'list'])->name('educations.list');
        Route::post('/educations_store', [App\Http\Controllers\Admin\EducationController::class, 'store'])->name('educations.store');
        Route::get('/educations_edit/{id}', [App\Http\Controllers\Admin\EducationController::class, 'edit'])->name('educations.edit');
        Route::post('/educations_update/{id}', [App\Http\Controllers\Admin\EducationController::class, 'update'])->name('educations.update');
        Route::get('/educations_delete/{id}', [App\Http\Controllers\Admin\EducationController::class, 'delete'])->name('educations.delete');

        //-------------------------------Employee Projects Route-------------------------------------//
        Route::get('/emp_projects', [App\Http\Controllers\Admin\EmployeeController::class, 'project_list'])->name('emp_projects.list');
        Route::post('/emp_projects_store', [App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('emp_projects.store');
        Route::get('/emp_projects_edit/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'edit'])->name('emp_projects.edit');
        Route::post('/emp_projects_update/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'update'])->name('emp_projects.update');
        Route::get('/emp_projects_delete/{id}', [App\Http\Controllers\Admin\EmployeeController::class, 'delete'])->name('emp_projects.delete');

        //-------------------------------Country -------------------------------------------------//
        Route::get('/countries', [App\Http\Controllers\Admin\CountryController::class, 'list'])->name('countries.list');
        Route::post('/countries_store', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('countries.store');
        Route::get('/countries_edit/{id}', [App\Http\Controllers\Admin\CountryController::class, 'edit'])->name('countries.edit');
        Route::post('/countries_update/{id}', [App\Http\Controllers\Admin\CountryController::class, 'update'])->name('countries.update');
        Route::get('/countries_delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('countries.delete');



        //-------------------------------Employee -------------------------------------------------//
        Route::get('/employee', [App\Http\Controllers\Admin\EmployeesController::class, 'list'])->name('employees.list');
        Route::get('/employee-inactive', [App\Http\Controllers\Admin\EmployeesController::class, 'inactiveUsers'])->name('employees.list.inactive');
        Route::post('/save-exit-questions', [App\Http\Controllers\Admin\EmployeesController::class, 'saveExitQuestions'])->name('employees.saveExitQuestions');
        Route::get('/view-exit-questions/{id}', [App\Http\Controllers\Admin\EmployeesController::class, 'viewExitQuestions'])->name('employees.viewExitQuestions');

        // Route::post('/countries_store', [App\Http\Controllers\Admin\CountryController::class, 'store'])->name('countries.store');
// Route::get('/countries_edit/{id}', [App\Http\Controllers\Admin\CountryController::class, 'edit'])->name('countries.edit');
// Route::post('/countries_update/{id}', [App\Http\Controllers\Admin\CountryController::class, 'update'])->name('countries.update');
// Route::get('/countries_delete/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete'])->name('countries.delete');

        // --------------------------------System---------------------------------------------------//
//--------------------------------Provinces------------------------------------------------//
        Route::get('/provinces', [App\Http\Controllers\Admin\ProvinceController::class, 'list'])->name('provinces.list');
        Route::post('/provinces_store', [App\Http\Controllers\Admin\ProvinceController::class, 'store'])->name('provinces.store');
        Route::get('/provinces_edit/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'edit'])->name('provinces.edit');
        Route::post('/provinces_update/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'update'])->name('provinces.update');
        Route::get('/provinces_delete/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'delete'])->name('provinces.delete');

        //---------------------------------Currency Types ----------------------------------------//
        Route::get('/currency_types', [App\Http\Controllers\Admin\CurrencyTypeController::class, 'list'])->name('currency_types.list');
        Route::post('/currency_types_store', [App\Http\Controllers\Admin\CurrencyTypeController::class, 'store'])->name('currency_types.store');
        Route::get('/currency_types_edit/{id}', [App\Http\Controllers\Admin\CurrencyTypeController::class, 'edit'])->name('currency_types.edit');
        Route::post('/currency_types_update/{id}', [App\Http\Controllers\Admin\CurrencyTypeController::class, 'update'])->name('currency_types.update');
        Route::get('/currency_types_delete/{id}', [App\Http\Controllers\Admin\CurrencyTypeController::class, 'delete'])->name('currency_types.delete');

        //---------------------------------Nationality Route---------------------------------------//
        Route::get('/nationalities', [App\Http\Controllers\Admin\NationalityController::class, 'list'])->name('nationalities.list');
        Route::post('/nationalities_store', [App\Http\Controllers\Admin\NationalityController::class, 'store'])->name('nationalities.store');
        Route::get('/nationalities_edit/{id}', [App\Http\Controllers\Admin\NationalityController::class, 'edit'])->name('nationalities.edit');
        Route::post('/nationalities_update/{id}', [App\Http\Controllers\Admin\NationalityController::class, 'update'])->name('nationalities.update');
        Route::get('/nationalities_delete/{id}', [App\Http\Controllers\Admin\NationalityController::class, 'delete'])->name('nationalities.delete');


        //--------------------------------ImmigrationStatus Route-------------------------------------//
        Route::get('/immigration_status', [App\Http\Controllers\Admin\ImmigrationStatusController::class, 'list'])->name('immigration_status.list');
        Route::post('/immigration_status_store', [App\Http\Controllers\Admin\ImmigrationStatusController::class, 'store'])->name('immigration_status.store');
        Route::get('/immigration_status_edit/{id}', [App\Http\Controllers\Admin\ImmigrationStatusController::class, 'edit'])->name('immigration_status.edit');
        Route::post('/immigration_status_update/{id}', [App\Http\Controllers\Admin\ImmigrationStatusController::class, 'update'])->name('immigration_status.update');
        Route::get('/immigration_status_delete/{id}', [App\Http\Controllers\Admin\ImmigrationStatusController::class, 'delete'])->name('immigration_status.delete');



        //--------------------------------Travel Management Route-------------------------------------//
//--------------------------------Travel Requests-------------------------------------//
        Route::get('/travel_records', [App\Http\Controllers\Admin\TravelRecordController::class, 'list'])->name('travel_records.list');

        Route::post('/travel_records_store', [App\Http\Controllers\Admin\TravelRecordController::class, 'store'])->name('travel_records.store');
        Route::get('/travel_records_edit/{id}', [App\Http\Controllers\Admin\TravelRecordController::class, 'edit'])->name('travel_records.edit');
        Route::post('/travel_records_update', [App\Http\Controllers\Admin\TravelRecordController::class, 'update'])->name('travel_records.update');
        Route::get('/travel_records_delete/{id}', [App\Http\Controllers\Admin\TravelRecordController::class, 'delete'])->name('travel_records.delete');
        Route::get('form/travel-request-status', [App\Http\Controllers\Admin\TravelRecordController::class, 'travelRequestStatus'])->middleware('auth')->name('travel.status');


        //--------------------------------Subordinate Travel Requests -------------------------------------//
        Route::get('/subordinate_travel_requests', [App\Http\Controllers\Admin\TravelRecordController::class, 'subOrdinateList'])->name('subordinate_travel_requests.list');

        //--------------------------------User Reports -------------------------------------//
        Route::get('/userReports', [App\Http\Controllers\Admin\UserReportController::class, 'userReports_list'])->name('userReports.list');
        Route::get('/travel_request_report', [App\Http\Controllers\Admin\UserReportController::class, 'travel_request_report'])->name('travel_request.report');
        Route::get('/Employee_loan_report', [App\Http\Controllers\Admin\UserReportController::class, 'Employee_loan_report'])->name('employee_loan_report');
        Route::get('/attendance_request_report', [App\Http\Controllers\Admin\UserReportController::class, 'attendance_request_report'])->name('attendance_request.report');
        Route::get('/payslip_report', [App\Http\Controllers\Admin\UserReportController::class, 'payslip_report'])->name('payslip.report');
        Route::get('/export-payslip', [App\Http\Controllers\Admin\UserReportController::class, 'payslip_export'])->name('payslip.export');
        Route::get('/accumulated-export-payslip', [App\Http\Controllers\Admin\UserReportController::class, 'accumulatedPayslip_export'])->name('accumulated.payslip.export');


        Route::get('/employees-payslip_report', [App\Http\Controllers\Admin\UserReportController::class, 'employee_payslip_report'])->name('employees-payslip.report');
        Route::get('/employee-export-payslip', [App\Http\Controllers\Admin\UserReportController::class, 'employee_payslip_export'])->name('employees-payslip.export');
        Route::get('/employees-payslip/export-pdf', [App\Http\Controllers\Admin\UserReportController::class, 'employee_payslip_export_pdf'])->name('employees-payslip.export.pdf');



        Route::get('/active_help_request', [App\Http\Controllers\Admin\HelpDeskController::class, 'index'])->name('active.help_request');
        Route::post('/store_request_data', [App\Http\Controllers\Admin\HelpDeskController::class, 'storeRequestData'])->name('store-request.data');
        Route::get('/help_request_details/{id}', [App\Http\Controllers\Admin\HelpDeskController::class, 'helpRequestDetails'])->name('help-request.details');
        Route::get('/help_request_file', [App\Http\Controllers\Admin\HelpDeskController::class, 'downloadFile'])->name('download.file');
        Route::get('/closed_help_request', [App\Http\Controllers\Admin\HelpDeskController::class, 'closedHelpRequest'])->name('closed.help_request');
        Route::post('/close_request', [App\Http\Controllers\Admin\HelpDeskController::class, 'closeRequest'])->name('closed.request');
        Route::post('/search_employees', [App\Http\Controllers\Admin\HelpDeskController::class, 'searchEmployees'])->name('search.employees');

        //-------------------------------------People---------------------------------------------------------------------------------------------------//

        Route::get('/people_everyone', [App\Http\Controllers\Admin\PeopleController::class, 'index'])->name('people.everyone');
        Route::post('/search_employeeList', [App\Http\Controllers\Admin\PeopleController::class, 'searchEmployeeList'])->name('search.employee.list');
        Route::get('/get_employee_details', [App\Http\Controllers\Admin\PeopleController::class, 'getEmployeeDetails'])->name('get.employee.details');

        //---------------------------------- performance module routes ------------------------------------------------------------------//

        //----------------------------------performance goals--------------------------------------------------------------------//
        Route::get('/performance_goal_tracking', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'goalTrackingList'])->name('goal.tracking.list');
        Route::post('/store_new_goal', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'storeNewGoal'])->name('store.new.goal');
        Route::get('/get_designation', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'getDesignation'])->name('get.designation');
        Route::get('/update_get_designation', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'updateGetDesignation'])->name('update.get.designation');
        Route::get('/update_goal_details/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'updateGoalDetails'])->name('update.goal.details');
        Route::post('/store_updated_goal', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'storeUpdatedGoal'])->name('store.updated.goal');
        Route::post('/delete_goal/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'deleteGoal'])->name('delete.goal');

        //----------------------------------performance indicator---------------------------------------------------------------//

        Route::get('/performance_indicator', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'indicatorList'])->name('indicator.list');
        Route::post('/store_new_indicator', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'storeNewIndicator'])->name('store.new.indicator');
        Route::get('/update_indicator_details/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'updateIndicatorDetails'])->name('update.indicator.details');
        Route::post('/store_update_indicator', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'StoreUpdateIndicator'])->name('store.update.indicator');
        Route::post('/delete_indicator/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'deleteIndicator'])->name('delete.indicator');

        // -----------------------------------perofrmance appraisal-------------------------------------------------//
        Route::get('/performance_appraisal', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'appraisalList'])->name('appraisal.list');
        Route::get('/get_employee', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'getEmployee'])->name('get.employee');
        Route::get('/get_rating_data', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'getRatingData'])->name('get.rating.data');
        Route::post('/store_appraisal_rating', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'storeAppraisalRating'])->name('store.appraisal.rating');
        Route::get('/edit_appraisal_details/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'editAppraisalDetails'])->name('edit.appraisal.details');
        Route::post('/update_appraisal_details', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'updateAppraisalDetails'])->name('update.appraisal.details');
        Route::post('/delete_appraisal/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'deleteAppraisal'])->name('delete.appraisal');


        //------------------------------------indicator form--------------------------------------------------------//

        Route::get('/indicator_form', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'indicatorForm'])->name('indicator.form');
        Route::get('/create_indicator_form', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'createIndicatorForm'])->name('create.indicator.form');
        Route::post('/store_indicator_form', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'storeIndicatorForm'])->name('store.indicator.form');
        Route::get('/edit_indicator_form/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'editindicatorForm'])->name('edit.indicator.form');
        Route::post('/update_indicator_form', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'updateIndicatorForm'])->name('update.indicator.form');
        Route::post('/delete_indicator_form/{id}', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'deleteIndicatorForm'])->name('delete.indicator.form');
        Route::post('/edit_remove_title', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'editRemoveTitle'])->name('edit.remove.title');
        Route::post('/edit_remove_subtitle', [App\Http\Controllers\Admin\PerformanceManagementController::class, 'editRemoveSubtitle'])->name('edit.remove.subtitle');


        //--------------------------------Attendance ---------------------------------------------------------------------------------------------------//
        Route::get('/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'list'])->name('attendance.list');
        Route::post('/attendance_store', [App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance_edit/{id}', [App\Http\Controllers\Admin\AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::post('/attendance_update/{id}', [App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('attendance.update');
        Route::get('/attendance_delete/{id}', [App\Http\Controllers\Admin\AttendanceController::class, 'delete'])->name('attendance.delete');
        Route::get('/attendances', [App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/attendance-details', [App\Http\Controllers\Admin\AttendanceController::class, 'detail'])->name('attendances.details');
        Route::get('/attendance-summary', [App\Http\Controllers\Admin\AttendanceController::class, 'summary'])->name('attendances.summary');
        Route::get('/attendances/create', [App\Http\Controllers\Admin\AttendanceController::class, 'create'])->name('attendances.create');
        Route::post('/attendances', [App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendances.store');
        Route::delete('attendances/{attendance}', [App\Http\Controllers\Admin\AttendanceController::class, 'destroy'])->name('attendances.destroy');


        //--------------------------------OverTime Categories-------------------------------------//
        Route::get('/overtime_categories', [App\Http\Controllers\Admin\OverTimeCategoriesController::class, 'list'])->name('overtime_categories.list');
        Route::post('/overtime_categories_store', [App\Http\Controllers\Admin\OverTimeCategoriesController::class, 'store'])->name('overtime_categories.store');
        Route::get('/overtime_categories_edit/{id}', [App\Http\Controllers\Admin\OverTimeCategoriesController::class, 'edit'])->name('overtime_categories.edit');
        Route::post('/overtime_categories_update/{id}', [App\Http\Controllers\Admin\OverTimeCategoriesController::class, 'update'])->name('overtime_categories.update');
        Route::get('/overtime_categories_delete/{id}', [App\Http\Controllers\Admin\OverTimeCategoriesController::class, 'delete'])->name('overtime_categories.delete');

        //--------------------------------OverTime Requests-------------------------------------//
        Route::get('/overtime_requests', [App\Http\Controllers\Admin\OverTimeRequestsController::class, 'list'])->name('overtime_requests.list');
        Route::post('/overtime_requests_store', [App\Http\Controllers\Admin\OverTimeRequestsController::class, 'store'])->name('overtime_requests.store');
        Route::get('/overtime_requests_edit/{id}', [App\Http\Controllers\Admin\OverTimeRequestsController::class, 'edit'])->name('overtime_requests.edit');
        Route::post('/overtime_requests_update/{id}', [App\Http\Controllers\Admin\OverTimeRequestsController::class, 'update'])->name('overtime_requests.update');
        Route::get('/overtime_requests_delete/{id}', [App\Http\Controllers\Admin\OverTimeRequestsController::class, 'delete'])->name('overtime_requests.delete');

        //--------------------------------Loan Types-------------------------------------//
        Route::get('/loan_types', [App\Http\Controllers\Admin\LoanTypesController::class, 'list'])->name('loan_types.list');
        Route::post('/loan_types_store', [App\Http\Controllers\Admin\LoanTypesController::class, 'store'])->name('loan_types.store');
        Route::get('/loan_types_edit/{id}', [App\Http\Controllers\Admin\LoanTypesController::class, 'edit'])->name('loan_types.edit');
        Route::post('/loan_types_update/{id}', [App\Http\Controllers\Admin\LoanTypesController::class, 'update'])->name('loan_types.update');
        Route::get('/loan_types_delete/{id}', [App\Http\Controllers\Admin\LoanTypesController::class, 'delete'])->name('loan_types.delete');

        //--------------------------------Employee Loans-------------------------------------//
        Route::get('/employee_loans', [App\Http\Controllers\Admin\EmployeeLoansController::class, 'list'])->name('employee_loans.list');
        Route::post('/employee_loans_store', [App\Http\Controllers\Admin\EmployeeLoansController::class, 'store'])->name('employee_loans.store');
        Route::get('/employee_loans_edit/{id}', [App\Http\Controllers\Admin\EmployeeLoansController::class, 'edit'])->name('employee_loans.edit');
        Route::post('/employee_loans_update/{id}', [App\Http\Controllers\Admin\EmployeeLoansController::class, 'update'])->name('employee_loans.update');
        Route::get('/employee_loans_delete/{id}', [App\Http\Controllers\Admin\EmployeeLoansController::class, 'delete'])->name('employee_loans.delete');


        // ----------------------------- user profile ------------------------------//
        Route::get('profile_user', [App\Http\Controllers\UserManagementController::class, 'profile'])->middleware('auth')->name('profile_user');
        Route::post('profile/information/save', [App\Http\Controllers\UserManagementController::class, 'profileInformation'])->name('profile/information/save');

        // ----------------------------- user userManagement -----------------------//
        Route::get('userManagement', [App\Http\Controllers\UserManagementController::class, 'index'])->middleware('auth')->name('userManagement');
        Route::post('update', [App\Http\Controllers\UserManagementController::class, 'update'])->name('update');
        Route::get('activity/log', [App\Http\Controllers\UserManagementController::class, 'activityLog'])->middleware('auth')->name('activity/log');
        Route::get('activity/login/logout', [App\Http\Controllers\UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');


        // ----------------------------- form change password ------------------------------//
        Route::get('change/password', [App\Http\Controllers\UserManagementController::class, 'changePasswordView'])->middleware('auth')->name('change/password');
        Route::post('change/password/db', [App\Http\Controllers\UserManagementController::class, 'changePasswordDB'])->name('change/password/db');


        // ----------------------------- Holidays Controller------------------------------------------------------------------------------//
        Route::get('/holidays', [App\Http\Controllers\Admin\HolidaysController::class, 'index'])->name('holiday.index');
        Route::get('/holidays/data/{year}', [App\Http\Controllers\Admin\HolidaysController::class, 'getHolidays']);
        Route::post('/admin/holidays/store', [App\Http\Controllers\Admin\HolidaysController::class, 'store'])->name('holiday.store');
        Route::delete('/holidays/{id}', [App\Http\Controllers\Admin\HolidaysController::class, 'destroy'])->name('holiday.delete');
        Route::post('/holidays/quick-store', [App\Http\Controllers\Admin\HolidaysController::class, 'quickStore'])->name('holiday.quickStore');
        Route::post('/holidays/import-holidays', [App\Http\Controllers\Admin\HolidaysController::class, 'importHolidays'])->name('holiday.import');
        Route::get('/holiday_edit/{id}', [App\Http\Controllers\Admin\HolidaysController::class, 'edit'])->name('holidays.edit');
        Route::get('/holiday-calender', [App\Http\Controllers\Admin\HolidaysController::class, 'holidayCalender'])->name('holidays.calender');
        Route::post('/holidays_update/{id}', [App\Http\Controllers\Admin\HolidaysController::class, 'update'])->name('divisions.update');
        Route::get('/holidays/{month}', [App\Http\Controllers\Admin\HolidaysController::class, 'getHolidaysByMonth']);


        //-----------------------------document center ----------------------------------------------------------
        Route::get('/document', [App\Http\Controllers\Admin\DocumentController::class, 'index'])->name('Document.index');
        Route::get('/document/policies', [App\Http\Controllers\Admin\DocumentController::class, 'policies'])->name('document.policies');
        Route::get('/document/policies', [App\Http\Controllers\Admin\PoliciesController::class, 'index'])->name('document.policies');
        Route::get('/policies/create', [App\Http\Controllers\Admin\PolicyController::class, 'create'])->name('policies.create');
        Route::post('/policies/store', [App\Http\Controllers\Admin\PolicyController::class, 'store'])->name('policies.store');
        Route::get('/document/payslip', [App\Http\Controllers\Admin\DocumentController::class, 'payslip'])->name('document.payslip');

        //------------------------------policies------------------------------------------------------------------
        Route::get('/policies', [App\Http\Controllers\Admin\PolicyController::class, 'index'])->name('policies.index'); // List all policies
        Route::get('/policies/create', [App\Http\Controllers\Admin\PolicyController::class, 'create'])->name('policies.create'); // Show create form
        Route::post('/policies', [App\Http\Controllers\Admin\PolicyController::class, 'store'])->name('policies.store'); // Store new policy
        Route::get('/policies/{policy}', [App\Http\Controllers\Admin\PolicyController::class, 'show'])->name('policies.show'); // Show single policy
        Route::get('/policies/{policy}/edit', [App\Http\Controllers\Admin\PolicyController::class, 'edit'])->name('policies.edit'); // Show edit form
        Route::put('/policies/{policy}', [App\Http\Controllers\Admin\PolicyController::class, 'update'])->name('policies.update'); // Update policy
        Route::delete('/policies/{policy}', [App\Http\Controllers\Admin\PolicyController::class, 'destroy'])->name('policies.destroy'); // Delete policy
        Route::get('/policies/{policy}/download', [App\Http\Controllers\Admin\PolicyController::class, 'download'])->name('policies.download');
        Route::get('/policies', [App\Http\Controllers\Admin\PolicyController::class, 'index'])->name('policies.index');


        //--------------------------------Asset & Asset Types---------------------------------------------//
        Route::get('/assettypes', [App\Http\Controllers\Admin\AssetTypeController::class, 'index'])->name('assettypes.index');
        Route::post('/assettypes', [App\Http\Controllers\Admin\AssetTypeController::class, 'store'])->name('assettypes.store');
        Route::delete('/assettypes/{id}', [App\Http\Controllers\Admin\AssetTypeController::class, 'destroy'])->name('assettypes.destroy');
        Route::post('/assettypes/bulk-delete', [App\Http\Controllers\Admin\AssetTypeController::class, 'bulkDelete'])->name('assettypes.bulkDelete');
        Route::put('/assettypes/{id}', [App\Http\Controllers\Admin\AssetTypeController::class, 'update'])->name('assettypes.update');
        Route::post('/locations', [App\Http\Controllers\Admin\LocationController::class, 'store'])->name('locations.store');

        //------------------------------------------------Assets-------------------------------------------------------------
        Route::get('asset', [App\Http\Controllers\Admin\AssetController::class, 'index'])->name('asset.index');
        Route::get('/asset/create', [App\Http\Controllers\Admin\AssetController::class, 'create'])->name('asset.create');
        Route::post('/asset', [App\Http\Controllers\Admin\AssetController::class, 'store'])->name('asset.store');
        Route::get('/asset/{id}', [App\Http\Controllers\Admin\AssetController::class, 'show'])->name('asset.show');
        Route::delete('/asset/{id}', [App\Http\Controllers\Admin\AssetController::class, 'destroy'])->name('asset.destroy');
        Route::get('/asset/{id}/edit', [App\Http\Controllers\Admin\AssetController::class, 'edit'])->name('asset.edit');
        Route::put('/asset/{id}', [App\Http\Controllers\Admin\AssetController::class, 'update'])->name('asset.update');
        Route::get('/asset/{id}', [App\Http\Controllers\Admin\AssetController::class, 'show'])->name('asset.show');
        Route::post('/asset/bulk-delete', [App\Http\Controllers\Admin\AssetController::class, 'bulkDelete'])->name('asset.bulkDelete');
        Route::post('/asset/return', [App\Http\Controllers\Admin\AssetController::class, 'returnAsset'])->name('asset.return');
        Route::get('/get-asset-return/{id}', [App\Http\Controllers\Admin\AssetController::class, 'getAssetReturn']);
        Route::get('/get-asset-returns', [App\Http\Controllers\Admin\AssetController::class, 'getAssetReturns']);
        Route::delete('/asset-returns/{id}', [App\Http\Controllers\Admin\AssetController::class, 'deleteAssetReturn']);
        Route::post('/assets/return', [App\Http\Controllers\Admin\AssetController::class, 'return'])->name('asset.return');

        // lent asset
        Route::get('/lent-assets/users', [App\Http\Controllers\Admin\LentAssetController::class, 'index']);
        Route::post('/lent-assets/store', [App\Http\Controllers\Admin\LentAssetController::class, 'store']);

        // ----------------------------- form leaves ------------------------------//
        Route::get('form/leaves/new', [App\Http\Controllers\LeavesController::class, 'leaves'])->middleware('auth')->name('form/leaves/new');
        Route::get('form/leavesemployee/new', [App\Http\Controllers\LeavesController::class, 'leavesEmployee'])->middleware('auth')->name('form/leavesemployee/new');
        Route::post('form/leaves/save', [App\Http\Controllers\LeavesController::class, 'saveRecord'])->middleware('auth')->name('form/leaves/save');
        Route::post('form/leaves/edit', [App\Http\Controllers\LeavesController::class, 'editRecordLeave'])->middleware('auth')->name('form/leaves/edit');
        Route::post('form/leaves/edit/delete', [App\Http\Controllers\LeavesController::class, 'deleteLeave'])->middleware('auth')->name('form/leaves/edit/delete');

        // ----------------------------- form attendance  ------------------------------//
        Route::get('form/leavesettings/page', [App\Http\Controllers\LeavesController::class, 'leaveSettings'])->middleware('auth')->name('form/leavesettings/page');
        Route::get('attendance/page', [App\Http\Controllers\LeavesController::class, 'attendanceIndex'])->middleware('auth')->name('attendance/page');
        Route::get('attendance/employee/page', [App\Http\Controllers\LeavesController::class, 'AttendanceEmployee'])->middleware('auth')->name('attendance/employee/page');
        Route::get('form/shiftscheduling/page', [App\Http\Controllers\LeavesController::class, 'shiftScheduLing'])->middleware('auth')->name('form/shiftscheduling/page');
        Route::get('form/shiftlist/page', [App\Http\Controllers\LeavesController::class, 'shiftList'])->middleware('auth')->name('form/shiftlist/page');

        // ----------------------------- form payroll  ------------------------------//
        Route::get('form/salary/page', [App\Http\Controllers\PayrollController::class, 'salary'])->middleware('auth')->name('form/salary/page');
        Route::post('form/salary/save', [App\Http\Controllers\PayrollController::class, 'saveRecord'])->middleware('auth')->name('form/salary/save');
        Route::post('form/salary/update', [App\Http\Controllers\PayrollController::class, 'updateRecord'])->middleware('auth')->name('form/salary/update');
        Route::post('form/salary/delete', [App\Http\Controllers\PayrollController::class, 'deleteRecord'])->middleware('auth')->name('form/salary/delete');
        Route::get('form/salary/view/{rec_id}', [App\Http\Controllers\PayrollController::class, 'salaryView'])->middleware('auth');
        Route::get('form/payroll/items', [App\Http\Controllers\PayrollController::class, 'payrollItems'])->middleware('auth')->name('form/payroll/items');

        // ----------------------------- reports  ------------------------------//
        Route::get('form/expense/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'index'])->middleware('auth')->name('form/expense/reports/page');
        Route::get('form/invoice/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceReports'])->middleware('auth')->name('form/invoice/reports/page');
        Route::get('form/invoice/view/page', [App\Http\Controllers\ExpenseReportsController::class, 'invoiceView'])->middleware('auth')->name('form/invoice/view/page');
        Route::get('form/daily/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'dailyReport'])->middleware('auth')->name('form/daily/reports/page');
        Route::get('form/leave/reports/page', [App\Http\Controllers\ExpenseReportsController::class, 'leaveReport'])->middleware('auth')->name('form/leave/reports/page');

        // ----------------------------- performance  ------------------------------//
        Route::get('form/performance/indicator/page', [App\Http\Controllers\PerformanceController::class, 'index'])->middleware('auth')->name('form/performance/indicator/page');
        Route::get('form/performance/page', [App\Http\Controllers\PerformanceController::class, 'performance'])->middleware('auth')->name('form/performance/page');
        Route::get('form/performance/appraisal/page', [App\Http\Controllers\PerformanceController::class, 'performanceAppraisal'])->middleware('auth')->name('form/performance/appraisal/page');
        Route::post('form/performance/indicator/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordIndicator'])->middleware('auth')->name('form/performance/indicator/save');
        Route::post('form/performance/indicator/delete', [App\Http\Controllers\PerformanceController::class, 'deleteIndicator'])->middleware('auth')->name('form/performance/indicator/delete');
        Route::post('form/performance/indicator/update', [App\Http\Controllers\PerformanceController::class, 'updateIndicator'])->middleware('auth')->name('form/performance/indicator/update');

        Route::post('form/performance/appraisal/save', [App\Http\Controllers\PerformanceController::class, 'saveRecordAppraisal'])->middleware('auth')->name('form/performance/appraisal/save');
        Route::post('form/performance/appraisal/update', [App\Http\Controllers\PerformanceController::class, 'updateAppraisal'])->middleware('auth')->name('form/performance/appraisal/update');
        Route::post('form/performance/appraisal/delete', [App\Http\Controllers\PerformanceController::class, 'deleteAppraisal'])->middleware('auth')->name('form/performance/appraisal/delete');

        // ----------------------------- training  ------------------------------//
        Route::get('form/training/list/page', [App\Http\Controllers\TrainingController::class, 'index'])->middleware('auth')->name('form/training/list/page');
        Route::post('form/training/save', [App\Http\Controllers\TrainingController::class, 'addNewTraining'])->middleware('auth')->name('form/training/save');
        Route::post('form/training/delete', [App\Http\Controllers\TrainingController::class, 'deleteTraining'])->middleware('auth')->name('form/training/delete');
        Route::post('form/training/update', [App\Http\Controllers\TrainingController::class, 'updateTraining'])->middleware('auth')->name('form/training/update');

        // ----------------------------- trainers  ------------------------------//
        Route::get('form/trainers/list/page', [App\Http\Controllers\TrainersController::class, 'index'])->middleware('auth')->name('form/trainers/list/page');
        Route::post('form/trainers/save', [App\Http\Controllers\TrainersController::class, 'saveRecord'])->middleware('auth')->name('form/trainers/save');
        Route::post('form/trainers/update', [App\Http\Controllers\TrainersController::class, 'updateRecord'])->middleware('auth')->name('form/trainers/update');
        Route::post('form/trainers/delete', [App\Http\Controllers\TrainersController::class, 'deleteRecord'])->middleware('auth')->name('form/trainers/delete');
        // ----------------------------- training type  ------------------------------//
        Route::get('form/training/type/list/page', [App\Http\Controllers\TrainingTypeController::class, 'index'])->middleware('auth')->name('form/training/type/list/page');
        Route::post('form/training/type/save', [App\Http\Controllers\TrainingTypeController::class, 'saveRecord'])->middleware('auth')->name('form/training/type/save');
        Route::post('form//training/type/update', [App\Http\Controllers\TrainingTypeController::class, 'updateRecord'])->middleware('auth')->name('form//training/type/update');
        Route::post('form//training/type/delete', [App\Http\Controllers\TrainingTypeController::class, 'deleteTrainingType'])->middleware('auth')->name('form//training/type/delete');

        //--------------------------------------Payroll Management------------------------------------------------//
        Route::get('form/payroll', [App\Http\Controllers\Admin\PayrollManagementController::class, 'index'])->middleware('auth')->name('payroll.list');
        Route::get('form/employee/manage_payroll/{id?}', [App\Http\Controllers\Admin\PayrollManagementController::class, 'managePayroll'])->middleware('auth')->name('employee.manage_payroll');
        Route::post('submit/employeePayslip', [App\Http\Controllers\Admin\PayrollManagementController::class, 'monthlyPayslipSubmit'])->middleware('auth');
        Route::post('update/employeePayslip/{id}', [App\Http\Controllers\Admin\PayrollManagementController::class, 'monthlyPayslipUpdate'])->middleware('auth');
        Route::post('api/calculate-components', [App\Http\Controllers\Admin\PayrollManagementController::class, 'calculateComponents']);
        Route::post('/api/save-salary', [App\Http\Controllers\Admin\PayrollManagementController::class, 'saveSalary']);
        Route::post('/filter-salary/pay-period', [App\Http\Controllers\Admin\PayrollManagementController::class, 'getPayPeriodData']);
        Route::get('/employee-payslip-pdf', [App\Http\Controllers\Admin\PayrollManagementController::class, 'employee_payslip_pdf'])->name('employees.payslip.pdf');
        Route::get('/payslip-excl-export', [App\Http\Controllers\Admin\PayrollManagementController::class, 'payslip_excel_export'])->name('payslip-excel.export');






        Route::get('employeePayslip/detail/{employee_id?}', [App\Http\Controllers\Admin\PayrollManagementController::class, 'payslipDetail'])->name('view.payslip')->middleware('auth');
        Route::post('api/get-payslip', [App\Http\Controllers\Admin\PayrollManagementController::class, 'filterPayslip'])->middleware('auth');
        Route::get('individual-payroll-information', [App\Http\Controllers\Admin\PayrollManagementController::class, 'individualPayrollInformation'])->name('individual.payroll.information')->middleware('auth');
        Route::post('api/generate-pdf', [App\Http\Controllers\Admin\PayrollManagementController::class, 'generatePDF'])->name('generate.pdf');



        // ------------------------------------------Leave Management-------------------------------------------------//
        Route::get('form/leave', [App\Http\Controllers\Admin\LeaveManagement::class, 'index'])->middleware('auth')->name('leave.index');
        Route::get('form/leave/new', [App\Http\Controllers\Admin\LeaveManagement::class, 'indexnew'])->middleware('auth')->name('leave.index.new');
        Route::post('form/leave/save', [App\Http\Controllers\Admin\LeaveManagement::class, 'save'])->middleware('auth')->name('leave.store');
        Route::post('form/restrict-leave/save', [App\Http\Controllers\Admin\LeaveManagement::class, 'restrictLeave'])->middleware('auth')->name('restrictleave.store');
        Route::get('form/leave/history', [App\Http\Controllers\Admin\LeaveManagement::class, 'viewHistory'])->middleware('auth')->name('leave.history');
        Route::get('form/leave/filtered-history', [App\Http\Controllers\Admin\LeaveManagement::class, 'filteredLeaveHistory'])->middleware('auth')->name('filtered.leave.history');
        Route::get('employee-leave-balance', [App\Http\Controllers\Admin\LeaveManagement::class, 'leaveBalance'])->middleware('auth')->name('leave.balance');
        Route::get('form/leave-request-status', [App\Http\Controllers\Admin\LeaveManagement::class, 'leaveRequestStatus'])->middleware('auth')->name('leave.status');
        Route::get('form/leave-type-details', [App\Http\Controllers\Admin\LeaveManagement::class, 'leaveTypeDetails'])->middleware('auth')->name('leaves.type.details');

        // ----------------------------- employee  ------------------------------//
        Route::post('form/saveemployee', [App\Http\Controllers\EmployeeController::class, 'save'])->middleware('auth');
        Route::post('form/updateemployee', [App\Http\Controllers\EmployeeController::class, 'update'])->middleware('auth');
        Route::get('/user-information', [EmployeeController::class, 'information'])->name('user.information');




        Route::post('form/store_new_employee', [App\Http\Controllers\EmployeeController::class, 'storeNewEmployee'])->middleware('auth')->name('store.new.employee');
        Route::get('form/show_ctc_split', [App\Http\Controllers\EmployeeController::class, 'showCtcSplit'])->middleware('auth')->name('show.ctc.split');
        Route::get('form/get_designation', [App\Http\Controllers\EmployeeController::class, 'getDesignation'])->middleware('auth');


        // Route::post('form/training/type/save', [App\Http\Controllers\TrainingTypeController::class, 'saveRecord'])->middleware('auth')->name('form/training/type/save');
// Route::post('form//training/type/update', [App\Http\Controllers\TrainingTypeController::class, 'updateRecord'])->middleware('auth')->name('form//training/type/update');
// Route::post('form//training/type/delete', [App\Http\Controllers\TrainingTypeController::class, 'deleteTrainingType'])->middleware('auth')->name('form//training/type/delete');


        //-------------------------------------AJAX CAllS-----------------------------//
        Route::get('listnationality', [App\Http\Controllers\Api\AjaxController::class, 'getRows'])->middleware('auth');
        Route::get('listcurrency', [App\Http\Controllers\Api\AjaxController::class, 'getCurrencyRows'])->middleware('auth');
        Route::get('listimmigration', [App\Http\Controllers\Api\AjaxController::class, 'getImmigrationRows'])->middleware('auth');
        Route::get('listemployment', [App\Http\Controllers\Api\AjaxController::class, 'getEmploymentRows'])->middleware('auth');
        Route::get('listdepartment', [App\Http\Controllers\Api\AjaxController::class, 'getDepartmentRows'])->middleware('auth');
        Route::get('listjobtitle', [App\Http\Controllers\Api\AjaxController::class, 'getJobTitleRows'])->middleware('auth');
        Route::get('listpaygrade', [App\Http\Controllers\Api\AjaxController::class, 'getPaygradeRows'])->middleware('auth');
        Route::get('listcountry', [App\Http\Controllers\Api\AjaxController::class, 'getCountryRows'])->middleware('auth');
        Route::get('listemployees', [App\Http\Controllers\Api\AjaxController::class, 'getEmployeesRows'])->middleware('auth');
        Route::get('listroles', [App\Http\Controllers\Api\AjaxController::class, 'getRolesRows'])->middleware('auth');
        Route::get('listdivisions', [App\Http\Controllers\Api\AjaxController::class, 'getDivisionRows'])->middleware('auth');
        Route::get('listcategories', [App\Http\Controllers\Api\AjaxController::class, 'getCategoryRows'])->middleware('auth');
        Route::get('listsalarypayrollcategories', [App\Http\Controllers\Api\AjaxController::class, 'getSalaryPayrollCategoryRows'])->middleware('auth');
        Route::get('getSearchEmployee/{search_employee}', [App\Http\Controllers\Api\AjaxController::class, 'getEmployeesBySearch'])->middleware('auth');
        Route::get('getEmployeeDataByDepartmentId/{id}', [App\Http\Controllers\Api\AjaxController::class, 'getEmployeesByDepartmentId'])->middleware('auth');
        Route::get('getEmployeeTravelAllowance/{id}', [App\Http\Controllers\Api\AjaxController::class, 'getEmployeeTravelAllowance'])->middleware('auth');
        Route::get('getEmployee/{id}', [App\Http\Controllers\Api\AjaxController::class, 'getEmployee'])->middleware('auth');

        //-------------------------------User Role & Permission-------------------------------------//

        Route::get('/roles', [RoleController::class, 'index'])->name('role.listing');
        Route::get('/createRole', [RoleController::class, 'create'])->name('create.role');
        Route::post('/storeRole', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/role/{id}', [RoleController::class, 'edit']);
        Route::post('update/role/{id}', [RoleController::class, 'update']);
        Route::post('/roles/{role}/permission', [RoleController::class, 'givePermission'])->name('admin.roles.permissions');
        Route::post('/admin/roles/{role}/{permission}', [RoleController::class, 'revokePermission']);


        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.listing');
        Route::get('/createPermission', [PermissionController::class, 'create'])->name('create.permission');
        Route::post('/storePermission', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/edit/permission/{id}', [PermissionController::class, 'edit']);
        Route::post('/update/permission/{id}', [PermissionController::class, 'update']);
        Route::post('/permissions/{permission}/role', [PermissionController::class, 'giveRole'])->name('admin.permissions.roles');
        Route::post('/admin/permissions/{permission}/{role}', [PermissionController::class, 'revokeRole']);

        //--------------------------------------All Request----------------------------------------------------//

        //--------------------------------------Travel Request-------------------------------------------------//
        Route::get('/travel-request', [AllRequestController::class, 'travel_request'])->name('travel.request.listing');
        Route::post('/travel-request/approve', [AllRequestController::class, 'approveTravelRequest'])->name('travel-request.approve');
        Route::post('/travel-request/reject', [AllRequestController::class, 'rejectTravelRequest'])->name('travel-request.reject');
        Route::get('/travel-request/details/{id}', [AllRequestController::class, 'getTravelRequestDetails']);


        //--------------------------------------Leave Request-------------------------------------------------//
        Route::get('/leave-request', [AllRequestController::class, 'leave_request'])->name('leave.request.listing');
        Route::post('/leave-request/approve', [AllRequestController::class, 'approveLeaveRequest'])->name('leave-request.approve');
        Route::post('/leave-request/reject', [AllRequestController::class, 'rejectLeaveRequest'])->name('leave-request.reject');
        Route::get('/leave-request/details/{id}', [AllRequestController::class, 'getLeaveRequestDetails']);


        //---------------------------------------Annual Leave-------------------------------------------------//
        Route::get('/annual-leaves', [AnnualLeaveController::class, 'annualLeaves'])->name('annualleave.list');
        Route::post('/save-leave-details', [AnnualLeaveController::class, 'store'])->name('save.annualleaves');


        //--------------------------------------Loan Request-------------------------------------------------//
        Route::get('/loan-request', [AllRequestController::class, 'loan_request'])->name('loan.request.listing');
        Route::post('/loan-request/approve', [AllRequestController::class, 'approveLoanRequest'])->name('loan-request.approve');
        Route::post('/loan-request/reject', [AllRequestController::class, 'rejectLoanRequest'])->name('loan-request.reject');
        Route::get('/loan-request/details/{id}', [AllRequestController::class, 'getLoanRequestDetails']);

        //------------------------------Category Route-----------------------------------------------
        Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'list'])->name('categories.list');
        Route::post('/categories_store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories_edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/categories_update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories_delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('categories.delete');


        //------------------------------Division Route-----------------------------------------------
        Route::get('/divisions', [App\Http\Controllers\Admin\DivisionController::class, 'list'])->name('divisions.list');
        Route::post('/divisions_store', [App\Http\Controllers\Admin\DivisionController::class, 'store'])->name('divisions.store');
        Route::get('/divisions_edit/{id}', [App\Http\Controllers\Admin\DivisionController::class, 'edit'])->name('divisions.edit');
        Route::post('/divisions_update/{id}', [App\Http\Controllers\Admin\DivisionController::class, 'update'])->name('divisions.update');
        Route::get('/divisions_delete/{id}', [App\Http\Controllers\Admin\DivisionController::class, 'delete'])->name('divisions.delete');



        //------------------------------Travel Category Route-----------------------------------------------
        Route::get('/travel-categories', [App\Http\Controllers\Admin\TravelCategoryController::class, 'list'])->name('travelcategories.list');
        Route::get('/add-travel-categories', [App\Http\Controllers\Admin\TravelCategoryController::class, 'create'])->name('travelcategories.create');

        Route::post('/travel-categories-allowances-store', [App\Http\Controllers\Admin\TravelCategoryAllowanceController::class, 'store'])->name('travel.category.allowance.store');
        Route::post('/api/check-travel-category-allowance', [App\Http\Controllers\Admin\TravelCategoryAllowanceController::class, 'checkCombination']);
        Route::get('/travel-categories-data/{id?}', [App\Http\Controllers\Admin\TravelCategoryAllowanceController::class, 'travelCategoryData'])->name('travel.category.data');
        Route::get('/travel_allowance_category_amount_edit/{id}', [App\Http\Controllers\Admin\TravelCategoryAllowanceController::class, 'edit'])->name('travel.category.edit');
        Route::post('/travel_allowance_category_amount_update/{id}', [App\Http\Controllers\Admin\TravelCategoryAllowanceController::class, 'update'])->name('travel.category.update');


        //------------------------------------------------Event-----------------------------------------------------------//
        Route::get('/manage-event', [App\Http\Controllers\Admin\EventController::class, 'manageEvent'])->name('manage.event');
        Route::post('form/saveevent', [App\Http\Controllers\Admin\EventController::class, 'save'])->middleware('auth');


        //------------------------------------------------Timesheet-----------------------------------------------------------//
        Route::get('/manage-timesheet', [App\Http\Controllers\Admin\TimesheetController::class, 'manageTimesheet'])->name('manage.timesheet');
        Route::post('/upload-timesheet', [App\Http\Controllers\Admin\TimesheetController::class, 'uploadTimesheet'])->name('upload.timesheet');



        //-----------------------------------------------Attachments---------------------------------------------------------------------------//
        Route::post('/attachments/upload', [App\Http\Controllers\Admin\AttachmentController::class, 'store'])->name('attachments.upload');
        Route::delete('/attachments/delete/{id}', [App\Http\Controllers\Admin\AttachmentController::class, 'destroy'])->name('attachments.delete');


        //------------------------------------------------Trainer------------------------------------------------------------------------------//
        Route::get('/trainers', [App\Http\Controllers\Admin\TrainerController::class, 'index'])->name('trainer.index');
        Route::get('/trainer/list', [App\Http\Controllers\Admin\TrainerController::class, 'list'])->name('trainer.list');
        Route::post('/trainer/store', [App\Http\Controllers\Admin\TrainerController::class, 'store'])->name('trainer.store');
        Route::get('/trainer/{id}', [App\Http\Controllers\Admin\TrainerController::class, 'show'])->name('trainer.show');
        Route::get('/trainer/{id}/edit', [App\Http\Controllers\Admin\TrainerController::class, 'edit'])->name('trainer.edit');
        Route::post('/trainer/{id}/update', [App\Http\Controllers\Admin\TrainerController::class, 'update'])->name('trainer.update');
        Route::delete('/trainer/{id}', [App\Http\Controllers\Admin\TrainerController::class, 'destroy'])->name('trainer.destroy');
        Route::get('/trainer/view/{id}', [App\Http\Controllers\Admin\TrainerController::class, 'view'])->name('trainer.view');


        //-----------------------------------------------Traninglist-----------------------------------------------------------------------------//
        Route::post('/training', [App\Http\Controllers\Admin\TrainingListController::class, 'store'])->name('traininglist.store');
        Route::get('/traininglist', [App\Http\Controllers\Admin\TrainingListController::class, 'index'])->name('traininglist.index');
        Route::delete('/traininglist/{id}', [App\Http\Controllers\Admin\TrainingListController::class, 'destroy'])->name('traininglist.destroy');
        Route::get('/traininglist/view/{id}', [App\Http\Controllers\Admin\TrainingListController::class, 'show'])->name('traininglist.view');
        Route::put('/traininglist/update-status/{id}', [App\Http\Controllers\Admin\TrainingListController::class, 'updateStatus'])->name('traininglist.updateStatus');
        Route::get('/traininglist/{id}/edit', [App\Http\Controllers\Admin\TrainingListController::class, 'edit'])->name('traininglist.edit');
        Route::put('/traininglist/{id}/update', [App\Http\Controllers\Admin\TrainingListController::class, 'update'])->name('traininglist.update');
        Route::get('/get-employees', [App\Http\Controllers\Admin\TrainingListController::class, 'getEmployees'])->name('get.employees');
        Route::get('get-employees-by-department/{id}', [App\Http\Controllers\Admin\TrainingListController::class, 'updateGetEmployees'])->name('update.get.employees');


        //-----------------------------------------------Employee Training-----------------------------------------------------------------------------//
        Route::get('get-employee-training', [App\Http\Controllers\Admin\TrainingListController::class, 'empTraining'])->name('employee-training');


        //--------------------------------------------------Contracts-------------------------------------------------------------------------------//
        Route::get('/contracts', [App\Http\Controllers\Admin\ContractController::class, 'index'])->name('contracts.index');
        Route::post('/contracts/store', [App\Http\Controllers\Admin\ContractController::class, 'store'])->name('contracts.store');
        Route::get('/contracts/{id}/edit', [App\Http\Controllers\Admin\ContractController::class, 'edit'])->name('contracts.edit');
        Route::put('/contracts/{id}', [App\Http\Controllers\Admin\ContractController::class, 'update'])->name('contracts.update');
        Route::delete('/contracts/{id}', [App\Http\Controllers\Admin\ContractController::class, 'destroy'])->name('contracts.destroy');
        Route::get('/contracts/{id}', [App\Http\Controllers\Admin\ContractController::class, 'show'])->name('contracts.show');

        //--------------------------------------------------Reimbursement-------------------------------------------------------------------------------//
        Route::get('reimbursement', [App\Http\Controllers\Admin\ReimbursementController::class, 'index'])->name('reimburs.index');
        Route::post('/reimbursement', [App\Http\Controllers\Admin\ReimbursementController::class, 'store'])->name('reimburs.store');
        Route::get('reimbursement/details', [App\Http\Controllers\Admin\ReimbursementController::class, 'details'])->name('reimburs.details');
        Route::get('/reimburs/{id}/edit', [App\Http\Controllers\Admin\ReimbursementController::class, 'edit'])->name('reimburs.edit');
        Route::put('/reimburs/{id}/update', [App\Http\Controllers\Admin\ReimbursementController::class, 'update'])->name('reimburs.update');
        //------------------------------------------------Engage-----------------------------------------------------------//
        Route::get('/engage', [EngageController::class, 'index'])->name('engage.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/posts/{post}/comments', [PostController::class, 'fetchComments']);
        Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


        Route::post('export-payslip-report/export', [App\Http\Controllers\Admin\ExportController::class, 'exportPayslipExport'])->name('payslip.report.export');
        Route::post('export-payslip-report/export-pdf', [App\Http\Controllers\Admin\ExportController::class, 'exportPayslipExportPdf'])->name('payslip.report.exportpdf');
    });
    // Route::post('/categories_store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categories_edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('categories.edit');
// Route::post('/categories_update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
// Route::get('/categories_delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('categories.delete');

});



Route::get('/common/anniversary', [App\Http\Controllers\Admin\CommonController::class, 'work'])->name('anniversary');
Route::get('/common/birthday', [App\Http\Controllers\Admin\CommonController::class, 'birthday'])->name('birthday');
Route::get('/common/appraisal', [App\Http\Controllers\Admin\CommonController::class, 'appraisal'])->name('appraisal');


// -----------------------------Departments Setup-----------------------------------------//

Route::get('admin/departments-setup', [App\Http\Controllers\Admin\DepartmentsController::class, 'index'])->name('admin.departments.setup');
Route::post('admin/departments-details', [App\Http\Controllers\Admin\DepartmentsController::class, 'store'])->name('admin.departments.store');
Route::get('admin/departments-setup/{id}/edit', [App\Http\Controllers\Admin\DepartmentsController::class, 'edit'])->name('admin.departments.edit');
Route::put('admin/departments-setup/{id}', [App\Http\Controllers\Admin\DepartmentsController::class, 'update'])->name('admin.departments.update');
Route::put('admin/departments-details/{id}', [App\Http\Controllers\Admin\DepartmentsController::class, 'destroy'])->name('admin.departments.destroy');