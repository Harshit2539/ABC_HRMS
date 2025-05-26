<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerformanceGoals;
use App\Models\department;
use App\Models\JobTitles;
use App\Models\IndicatorTitle;
use App\Models\IndicatorForm;
use App\Models\IndicatorSubTitle;
use App\Models\PerformaceIndicator;
use App\Models\PerformanceIndicatorRating;
use App\Models\Employee;
use App\Models\PerformanceAppraisal;
use App\Models\PerformanceAppraisalRating;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PerformanceManagementController extends Controller
{

    // ----------  Goal Tracker Page------------------------

    public function goalTrackingList(Request $request)
    {

        $goals_list = PerformanceGoals::select('id', 'goal_type', 'start_date', 'end_date', 'subject', 'target_achievement', 'rating', 'progress')->orderBy('id', 'DESC')->get();

        $departments = Department::select('id', 'department')->get();


        if ($request->ajax()) {

            return DataTables::of($goals_list)
                ->addIndexColumn()
                ->addColumn('goal_type', function ($goals_list) {

                    switch ($goals_list->goal_type) {
                        case '0':
                            $goalType = '<span>Long Term Goal</span>';
                            break;
                        case '1':
                            $goalType = '<span>Invoice Goal</span>';
                            break;
                        case '2':
                            $goalType = '<span>Short Term Goal</span>';
                            break;
                    }

                    return $goalType;
                })
                ->addColumn('start_date', function ($goals_list) {
                    return Carbon::parse($goals_list->start_date)->format('d-m-Y');
                })->addColumn('end_date', function ($goals_list) {

                    return Carbon::parse($goals_list->end_date)->format('d-m-Y');
                })->addColumn('subject', function ($goals_list) {

                    return $goals_list->subject;
                })->addColumn('rating', function ($goals_list) {

                    $ratedStar =  $goals_list->rating;
                    $unratedStar = 5 - $ratedStar;

                    $renderHtml = '<div>';

                    for ($i = 0; $i < $ratedStar; $i++) {
                        $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                    }

                    for ($i = 0; $i < $unratedStar; $i++) {
                        $renderHtml .= '<i class="fas fa-star"></i>';
                    }

                    $renderHtml .= '</div>';


                    return  $renderHtml;
                })->addColumn('progress', function ($goals_list) {

                    switch (true) {
                        case $goals_list->progress <= 29:
                            $colour = 'bg-danger';
                            $shadow = '0 8px 8px -1px rgba(255, 58, 110, 0.3);';
                            break;
                        case $goals_list->progress <= 59:
                            $colour = 'bg-warning';
                            $shadow = '0 8px 8px -1px rgba(255, 162, 29, 0.3);';

                            break;
                        case $goals_list->progress <= 79:
                            $colour = 'bg-info';
                            $shadow = '0 8px 8px -1px rgba(62, 201, 214, 0.3)';
                            break;
                        default:
                            $colour = 'bg-success';
                            $shadow = '0 8px 8px -1px rgba(111, 217, 67, 0.3);';
                    }

                    $renderHtml =
                        '<div>
                        <span>' . $goals_list->progress . '%</span>
                        </div>
                        <div class="progress progress-xs mt-2 w-100 " style="height:8px;">
                        <div  class="progress-bar ' . $colour . '" role="progressbar" aria-valuenow="' . $goals_list->progress . '" aria-valuenow="' . $goals_list->progress . '" aria-valuemin="0" 
                        aria-valuemax="100" style="width: ' . $goals_list->progress . '%; height:100%; box-shadow:' . $shadow . '" >
                        </div>
                        </div>';

                    return $renderHtml;
                })->addColumn('target_achievement', function ($goals_list) {

                    return $goals_list->target_achievement;
                })->addColumn('action', function ($goals_list) {

                    return ' <button type="button" data-id="' . $goals_list->id . '"  data-target="#goalDetailsModal" title="View Goal Details" data-bs-toggle="modal"  id="goalDetailsButton" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></button>
                <button type="button" data-id="' . $goals_list->id . '"  title="Delete Goal""  id="deleteGoalBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
                })->rawColumns(['rating', 'progress', 'goal_type', 'action'])->make(true);
        }

        return view('admin.performanceManagement.performance_goal_tracking', compact('departments'));
    }

    public function storeNewGoal(Request $request)
    {

        $employee_id = Employee::where('employee_id', Auth::id())->select('id')->first();
        $new_goal = new PerformanceGoals;
        $new_goal->goal_type = $request['goal_type'];
        $new_goal->department_id = $request['department'];
        $new_goal->job_title_id = $request['designation'];
        $new_goal->employee_id = $employee_id->id;;
        $new_goal->start_date = $request['start_date'];
        $new_goal->end_date = $request['end_date'];
        $new_goal->subject = $request['subject'];
        $new_goal->target_achievement = $request['target_achievement'];
        $new_goal->description = $request['description'];
        $new_goal->save();

        return response()->json(['status' => true, 'message' => 'Goal Added Successfully']);
    }


    public function updateGoalDetails(Request $request)
    {

        $departments = Department::select('id', 'department')->get();

        $goal_details = PerformanceGoals::with(['department:id,department', 'job_title:id,name'])->find($request->id);
        $goal_details->end_date = Carbon::parse($goal_details->end_date)->format('Y-m-d');
        $goal_details->start_date = Carbon::parse($goal_details->start_date)->format('Y-m-d');
        unset($goal_details->created_at);
        unset($goal_details->updated_at);

        return response()->json(['status' => true, 'goalDetails' => $goal_details, 'departments' => $departments]);
    }

    public function storeUpdatedGoal(Request $request)
    {


        $goal_details = PerformanceGoals::find($request['id']);
        $goal_details->goal_type = $request['goal_type'];
        $goal_details->department_id = $request['department'];
        $goal_details->job_title_id = $request['designation'];
        $goal_details->start_date = $request['start_date'];
        $goal_details->end_date = $request['end_date'];
        $goal_details->subject = $request['subject'];
        $goal_details->target_achievement = $request['target_achievement'];
        $goal_details->description = $request['description'];
        $goal_details->status = $request['status'];
        $goal_details->rating = $request['rating'];
        $goal_details->progress = $request['progress'];
        $goal_details->save();

        return response()->json(['status' => true, 'message' => 'Goal Updated Successfully']);
    }

    public function deleteGoal(Request $request)
    {
        $goal_details = PerformanceGoals::find($request->id);
        $goal_details->delete();

        return response()->json(['status' => true, 'message' => 'Goal Deleted Successfully']);
    }

    public function getDesignation(Request $request)
    {

        $designation = JobTitles::where('department_id', $request->department_id)->select('id', 'code', 'name')->get();
        return response()->json(['status' => true, 'designation' => $designation]);
    }

    public function updateGetDesignation(Request $request)
    {
        $designation = JobTitles::where('department_id', $request->department_id)->select('id', 'code', 'name')->get();
        return response()->json(['status' => true, 'designation' => $designation]);
    }


    //   ------------Indicator Page------------------------------

    public function indicatorList(Request $request)
    {

        $auth_employee = Employee::where('employee_id', Auth::id())->first();

        $indicator_form =  IndicatorForm::where([['department_id', $auth_employee->department], ['job_title_id', $auth_employee->job_title]])->first();

        $message = '';

        if (is_null($indicator_form)) {
            $message = 'KPI Form for your  Designation  not found';

            return view('admin.performanceManagement.performance_indicator', compact('message'));
        }

        $indicator_title_data = IndicatorTitle::with('sub_title')->where('indicator_form_id', $indicator_form->id)->get();
        $indicator_subTitle_data = [];

        foreach ($indicator_title_data as $item) {
            $indicator_subTitle_data[] = $item->sub_title;
        }

        $subTitles = collect($indicator_subTitle_data)->flatten(1);
        $titles = collect($indicator_title_data)->map(function ($item) {
            unset($item->sub_title);
            return $item;
        });

        $department = department::find($auth_employee->department);
        $designation = JobTitles::find($auth_employee->job_title);

        if ($auth_employee->role_id == 1) {
            $indicator_data = PerformaceIndicator::with([
                'department:id,department',
                'employee:id,first_name,last_name',
                'job_title:id,name',
                'indicator_rating:id,performance_indicator_id,rating'
            ])->orderBy('id', 'DESC')->get();
        } else {
            $indicator_data = PerformaceIndicator::with([
                'department:id,department',
                'employee:id,first_name,last_name',
                'job_title:id,name',
                'indicator_rating:id,performance_indicator_id,rating'
            ])->orderBy('id', 'DESC')->where('employee_id', $auth_employee->id)->get();
        }

        if ($request->ajax()) {

            return DataTables::of($indicator_data)
                ->addIndexColumn()
                ->addColumn('department', function ($indicator_data) {

                    return $indicator_data->department->department;
                })
                ->addColumn('designation', function ($indicator_data) {

                    return $indicator_data->job_title->name;
                })->addColumn('overall_rating', function ($indicator_data) {

                    $total_rating = 0;

                    foreach ($indicator_data->indicator_rating as $item) {

                        $total_rating =  $total_rating + $item->rating;
                    }

                    $overall_rating = $total_rating / count($indicator_data->indicator_rating);



                    if (is_numeric($overall_rating) && floor($overall_rating) != $overall_rating) {    //checking if number is decimal 

                        $fullRatedStar = intval($overall_rating);
                        $unratedStar = 5 - $fullRatedStar - 1;

                        $renderHtml = '<div>';
                        for ($i = 0; $i < $fullRatedStar; $i++) {
                            $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                        }

                        $renderHtml .= '<i class=" text-warning fas fa-star-half-alt"></i>';
                        for ($i = 0; $i < $unratedStar; $i++) {
                            $renderHtml .= '<i class="fas fa-star"></i>';
                        }
                        $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                        $renderHtml .= '</div>';
                        return  $renderHtml;
                    } else {
                        $fullRatedStar = $overall_rating;
                        $unratedStar = 5 - $fullRatedStar;

                        $renderHtml = '<div>';
                        for ($i = 0; $i < $fullRatedStar; $i++) {
                            $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                        }
                        for ($i = 0; $i < $unratedStar; $i++) {
                            $renderHtml .= '<i class="fas fa-star"></i>';
                        }
                        $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                        $renderHtml .= '</div>';
                        return  $renderHtml;
                    }
                })->addColumn('added_by', function ($indicator_data) {

                    $firstName = $indicator_data->employee->first_name;
                    $last_Name = $indicator_data->employee->last_name;

                    return  $firstName . ' ' . $last_Name;
                })->addColumn('created_at', function ($indicator_data) {

                    return Carbon::parse($indicator_data->created_at)->format('d-m-Y');
                })->addColumn('action', function ($indicator_data) use ($auth_employee) {

                    $renderHtml = ' <button type="button" data-id="' . $indicator_data->id . '"  data-target="#indicatorDetailsModal" title="View Indicator Details" data-bs-toggle="modal"  id="indicatorDetailsBtn" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></button>';

                    if ($indicator_data->employee_id == $auth_employee->id) {
                        $renderHtml .= ' <button type="button" data-id="' . $indicator_data->id . '"  title="Delete Indicator""  id="deleteIndicatorBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
                    }
                    return  $renderHtml;
                })->rawColumns(['overall_rating', 'action'])->make(true);
        }

        return view('admin.performanceManagement.performance_indicator', compact('titles', 'subTitles', 'department', 'designation', 'message'));
    }

    public function storeNewIndicator(Request $request)
    {

        //    $appraisal_year =  explode('-', $request->appraisal_year);
        $appraisal_year = $request['appraisal_year'];
        $employee_id = Employee::where('employee_id', Auth::id())->select('id')->first();
        $indicator_rating_exists = PerformaceIndicator::where([['appraisal_year', $appraisal_year], ['employee_id', $employee_id->id]])->first();

        if (isset($indicator_rating_exists)) {

            return response()->json(['status' => false, 'message' => "Indicator Rating Already Exists"]);
        }


        $performance_indicator  = new PerformaceIndicator;
        $performance_indicator->employee_id = $employee_id->id;
        $performance_indicator->department_id = $request['department'];
        $performance_indicator->job_title_id = $request['designation'];
        $performance_indicator->appraisal_year = $appraisal_year;
        $performance_indicator->save();

        $dataArr = $request['data'];
        unset($dataArr['department']);
        unset($dataArr['designation']);

        foreach ($dataArr as $key => $item) {
            $performance_indicator_rating  = new  PerformanceIndicatorRating;
            $performance_indicator_rating->performance_indicator_id =  $performance_indicator->id;
            $performance_indicator_rating->title_id  = $item['titleId'];
            $performance_indicator_rating->sub_title_id  = $item['subTitleId'];
            $performance_indicator_rating->rating  = $item['rating'];
            $performance_indicator_rating->save();
        }

        $appraisal_rating_exists = PerformanceAppraisal::where([['appraisal_year', $appraisal_year], ['rated_employee_id', $employee_id->id]])->first();

        if (isset($appraisal_rating_exists)) {

            $appraisal_rating_exists->performance_indicator_id = $performance_indicator->id;
            $appraisal_rating_exists->save();

            return response()->json(['status' => true, 'message' => 'Indicator rating re-added suceesfully']);
        }

        return response()->json(['status' => true, 'message' => 'New Indicator added successfully']);
    }

    public function deleteIndicator(Request $request)
    {

        $indicator_details = PerformaceIndicator::find($request->id);
        $indicator_details->delete();

        return response()->json(['status' => true, 'message' => 'Indicator deleted successfuly']);
    }

    public function updateIndicatorDetails(Request $request)
    {

        $indicator_details = PerformaceIndicator::with([
            'department:id,department',
            'indicator_rating:id,performance_indicator_id,rating,title_id,sub_title_id',
            'indicator_rating.sub_title',
            'job_title:id,name'
        ])->find($request->id);

        $LoggedIn_employee = Employee::where('employee_id', Auth::id())->first();
        $change_rating_allowed =  ($LoggedIn_employee->id == $indicator_details->employee_id) ? 1 : 0;

        $dataArr = $indicator_details->indicator_rating;
        foreach ($dataArr as $item) {
            unset($item->title);
        }

        $titles = $dataArr->groupBy('title_id')->map(function ($items, $key) {

            return [
                'title_id' => $items->first()['title'],
                'title' => $items->first()['title'],
            ];
        })->flatten(1)->unique(function ($item) {
            return $item->id . '-' . $item->title;
        })->values();


        unset($indicator_details->created_at);
        unset($indicator_details->updated_at);
        unset($indicator_details->indicator_rating);

        return response()->json(['status' => true, 'indicatorDetails' => $indicator_details, 'titles' => $titles, 'data' => $dataArr, 'change_rating_allowed' => $change_rating_allowed]);
    }

    public function  StoreUpdateIndicator(Request $request)
    {
        $performanceRatingArr = PerformanceIndicatorRating::where('performance_indicator_id', $request->id)->get();
        $reqArr = $request['data'];

        foreach ($reqArr as $reqItem) {
            $titleId = $reqItem['titleId'];
            $subTitleId = $reqItem['subTitleId'];
            $rating = $reqItem['rating'];

            // Find the matching record in DB
            $record = $performanceRatingArr->first(function ($item) use ($titleId, $subTitleId) {
                return $item->title_id == $titleId && $item->sub_title_id == $subTitleId;
            });

            if ($record) {
                $record->rating = $rating;
                $record->save();
            }
        }

        return response()->json(['status' => true, 'message' => 'Indicator Updated successfully']);
    }


    // ----------------appraisal page----------------------//

    public function appraisalList(Request $request)
    {

        $departments = department::select('id', 'department')->get();
        $auth_employee = Employee::where('employee_id', Auth::id())->first();

        if ($auth_employee->role_id == 1) {

            $appraisal_data = PerformanceAppraisal::with([
                'department:id,department',
                'job_title:id,name',
                'appraisal_rating:id,performance_appraisal_id,rating',
                'indicator.indicator_rating',
                'rated_employee:id,first_name,last_name'
            ])->orderBy('id', 'DESC')->get();
        } else {

            $appraisal_data = PerformanceAppraisal::with([
                'department:id,department',
                'job_title:id,name',
                'appraisal_rating:id,performance_appraisal_id,rating',
                'indicator.indicator_rating',
                'rated_employee:id,first_name,last_name'
            ])->orderBy('id', 'DESC')->where('rated_employee_id', $auth_employee->id)->get();
        }


        if ($request->ajax()) {
            return DataTables::of($appraisal_data)
                ->addIndexColumn()
                ->addColumn('department', function ($appraisal_data) {

                    return $appraisal_data->department->department;
                })
                ->addColumn('designation', function ($appraisal_data) {

                    return $appraisal_data->job_title->name;
                })->addColumn('employee', function ($appraisal_data) {

                    $firstName =  $appraisal_data->rated_employee->first_name;
                    $last_Name =  $appraisal_data->rated_employee->last_name;

                    return  $firstName . ' ' . $last_Name;
                })->addColumn('target_rating', function ($appraisal_data) {


                    if (is_null($appraisal_data->indicator)) {

                        return '<span class="text-danger" >Employee Rating Deleted </span>';
                    } else {
                        $total_rating = 0;

                        foreach ($appraisal_data->indicator->indicator_rating as $item) {
                            $total_rating =  $total_rating + $item->rating;
                        }

                        $overall_rating = $total_rating / count($appraisal_data->indicator->indicator_rating);


                        if (is_numeric($overall_rating) && floor($overall_rating) != $overall_rating) {

                            $fullRatedStar = intval($overall_rating);
                            $unratedStar = 5 - $fullRatedStar - 1;

                            $renderHtml = '<div>';
                            for ($i = 0; $i < $fullRatedStar; $i++) {
                                $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                            }

                            $renderHtml .= '<i class=" text-warning fas fa-star-half-alt"></i>';
                            for ($i = 0; $i < $unratedStar; $i++) {
                                $renderHtml .= '<i class="fas fa-star"></i>';
                            }
                            $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                            $renderHtml .= '</div>';
                            return  $renderHtml;
                        } else {
                            $fullRatedStar = $overall_rating;
                            $unratedStar = 5 - $fullRatedStar;

                            $renderHtml = '<div>';
                            for ($i = 0; $i < $fullRatedStar; $i++) {
                                $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                            }
                            for ($i = 0; $i < $unratedStar; $i++) {
                                $renderHtml .= '<i class="fas fa-star"></i>';
                            }
                            $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                            $renderHtml .= '</div>';
                            return  $renderHtml;
                        }


                        return $renderHtml;
                    }
                })
                ->addColumn('overall_rating', function ($appraisal_data) {

                    $total_rating = 0;

                    foreach ($appraisal_data->appraisal_rating as $item) {

                        $total_rating =  $total_rating + $item->rating;
                    }

                    $overall_rating = $total_rating / count($appraisal_data->appraisal_rating);


                    if (is_numeric($overall_rating) && floor($overall_rating) != $overall_rating) {

                        $fullRatedStar = intval($overall_rating);
                        $unratedStar = 5 - $fullRatedStar - 1;

                        $renderHtml = '<div>';
                        for ($i = 0; $i < $fullRatedStar; $i++) {
                            $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                        }

                        $renderHtml .= '<i class=" text-warning fas fa-star-half-alt"></i>';
                        for ($i = 0; $i < $unratedStar; $i++) {
                            $renderHtml .= '<i class="fas fa-star"></i>';
                        }
                        $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                        $renderHtml .= '</div>';
                        return  $renderHtml;
                    } else {
                        $fullRatedStar = $overall_rating;
                        $unratedStar = 5 - $fullRatedStar;

                        $renderHtml = '<div>';
                        for ($i = 0; $i < $fullRatedStar; $i++) {
                            $renderHtml .= '<i class="text-warning fas fa-star"></i>';
                        }
                        for ($i = 0; $i < $unratedStar; $i++) {
                            $renderHtml .= '<i class="fas fa-star"></i>';
                        }
                        $renderHtml .= '<span>  (' . $overall_rating . ')</span>';
                        $renderHtml .= '</div>';
                        return  $renderHtml;
                    }
                })->addColumn('appraisal_year', function ($appraisal_data) {


                    return $appraisal_data->appraisal_year;
                })->addColumn('action', function ($appraisal_data) use ($auth_employee) {

                    $renderHtml = '<button type="button" data-id="' . $appraisal_data->id . '"  style="background-color:grey"  data-bs-target="#appraisalDetailsModal" title="View Indicator Details" data-bs-toggle="modal"  id="appraisalDetailsBtn" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></button>';

                    if ($appraisal_data->supervisor_emp_id  == $auth_employee->id) {
                        $renderHtml .= ' <button type="button" data-id="' . $appraisal_data->id . '"  title="Delete Appraisal""  id="deleteAppraisalBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
                    }

                    return $renderHtml;

                    //  return ' <button type="button" data-id="'.$appraisal_data->id.'"  data-bs-target="#appraisalDetailsModal" title="View Indicator Details" data-bs-toggle="modal"  id="appraisalDetailsBtn" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></button>
                    //  <button type="button" data-id="'.$appraisal_data->id.'"  title="Delete Appraisal""  id="deleteAppraisalBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';

                })->rawColumns(['overall_rating', 'target_rating', 'action'])->make(true);
        }

        $loggedIn_employee = Employee::where('employee_id', Auth::id())->first();

        return view('admin.performanceManagement.performance_appraisal', compact('departments', 'loggedIn_employee'));
    }


    public function getEmployee(Request $request)
    {

        $employees = Employee::where('job_title', $request->designationt_id)->select('id', 'first_name', 'last_name')->get();
        return response()->json(['status' => true, 'employees' => $employees]);
    }


    public function getRatingData(Request $request)
    {

        //  list($year, $monthNumber) = explode('-', $request->appraisal_year);
        $year = $request->appraisal_year;

        $indicator_details = PerformaceIndicator::with([
            'indicator_rating:id,performance_indicator_id,rating,title_id,sub_title_id',
            'indicator_rating.sub_title',
            'indicator_rating.title'
        ])
            ->where('employee_id', $request->employee_id)
            ->whereYear('appraisal_year', $year)->first();

        if (is_null($indicator_details)) {

            return response(['status' => false, 'message' => 'Employee hasnt given rating yet']);
        }

        $indicatorId = $indicator_details->id;
        $rating_details = $indicator_details->indicator_rating;

        $dataArr = [];

        foreach ($rating_details as  $item) {

            $dataArr[] = [

                'sub_title_id' => $item->sub_title_id,
                'sub_title' => $item->sub_title,
                'rating' => $item->rating,
                'title_id' => $item->title,
            ];
        }

        $titleArr = $rating_details->groupBy('title_id')->map(function ($items, $key) {

            return [
                'title_id' => $items->first()['title'],
                'title' => $items->first()['title'],
            ];
        })->flatten(1)->unique(function ($item) {
            return $item->id . '-' . $item->title;
        })->values();

        return response()->json(['status' => true, 'data' => $dataArr, 'titles' => $titleArr, 'indicatorId' => $indicatorId]);
    }


    public function storeAppraisalRating(Request $request)
    {

        // list($year, $monthNumber) = explode('-', $request->appraisal_year);
        $year = $request->appraisal_year;

        $supervisor_details = Employee::where('employee_id', Auth::id())->first();
        $appraisal_rating_exists = PerformanceAppraisal::where([['appraisal_year', $year], ['rated_employee_id', $request['employee_id']]])->first();

        if (isset($appraisal_rating_exists)) {
            return response()->json(['status' => false, 'message' => "Appraisal Rating Already Exists"]);
        }

        $performance_appraisal  = new PerformanceAppraisal;
        $performance_appraisal->rated_employee_id = $request['employee_id'];
        $performance_appraisal->performance_indicator_id = $request['indicatorId'];
        $performance_appraisal->supervisor_emp_id = $supervisor_details->id;
        $performance_appraisal->supervisor_job_title = $supervisor_details->job_title;
        $performance_appraisal->supervisor_dept_id = $supervisor_details->department;
        $performance_appraisal->department_id = $request['department_id'];
        $performance_appraisal->job_title_id = $request['designation_id'];
        $performance_appraisal->appraisal_year = $year;
        $performance_appraisal->remarks = $request['remarks'];
        $performance_appraisal->save();

        $dataArr = $request['data'];

        foreach ($dataArr as $key => $item) {
            $performance_appraisal_rating  = new  PerformanceAppraisalRating;
            $performance_appraisal_rating->performance_appraisal_id =  $performance_appraisal->id;
            $performance_appraisal_rating->title_id  = $item['titleId'];
            $performance_appraisal_rating->sub_title_id  = $item['subTitleId'];
            $performance_appraisal_rating->rating  = $item['rating'];
            $performance_appraisal_rating->save();
        }

        return response()->json(['status' => true, 'message' => 'Appraisal Rating added successfully']);
    }

    public function editAppraisalDetails(Request $request)
    {

        $LoggedIn_employee = Employee::where('employee_id', Auth::id())->first();
        $giveApprisalstatus =  ($LoggedIn_employee->role_id == 1) ? 1 : 0;

        $appraisal_details = PerformanceAppraisal::with([
            'department:id,department',
            'job_title:id,name',
            'appraisal_rating:id,performance_appraisal_id,rating,title_id,sub_title_id',
            'appraisal_rating.title',
            'appraisal_rating.sub_title',
            'employee:id,first_name,last_name',
            'indicator.indicator_rating'
        ])->find($request->id);


        $rated_emp = Employee::find($appraisal_details->rated_employee_id);
        $dataArr = $appraisal_details->appraisal_rating;

        $titleArr = $dataArr->groupBy('title_id')->map(function ($items, $key) {

            return [
                'title_id' => $items->first()['title'],
                'title' => $items->first()['title'],
            ];
        })->flatten(1)->unique(function ($item) {
            return $item->id . '-' . $item->title;
        })->values();


        foreach ($dataArr as $item) {
            unset($item->title);
        }

        unset($appraisal_details->created_at);
        unset($appraisal_details->updated_at);
        unset($appraisal_details->appraisal_rating);

        if (is_null($appraisal_details->indicator)) {

            $indicator_rating_deleted =  true;
            return response()->json(['status' => true, 'titles' => $titleArr, 'appraisalDetails' => $appraisal_details, 'data' => $dataArr, 'giveAppraisalStatus' => $giveApprisalstatus, 'rated_emp' => $rated_emp,  'indicatorRatingDeleted' => $indicator_rating_deleted]);
        }

        foreach ($dataArr as  $item) {
            $item->indicator_rating = $appraisal_details->indicator->indicator_rating;
        }

        foreach ($dataArr as $item) {  //&$item
            $subTitleId = $item['sub_title_id'];

            $matchedIndicator = collect($item['indicator_rating'])->firstWhere('sub_title_id', $subTitleId);
            $item['emp_indicator_rating'] = $matchedIndicator ? $matchedIndicator['rating'] : null;
            unset($item['indicator_rating']);
        }
        //   unset($item); 


        $indicator_rating_deleted =  false;

        return  response()->json(['status' => true, 'titles' => $titleArr, 'appraisalDetails' => $appraisal_details, 'data' => $dataArr, 'giveAppraisalStatus' => $giveApprisalstatus, 'rated_emp' => $rated_emp, 'indicatorRatingDeleted' => $indicator_rating_deleted]);
    }

    public function updateAppraisalDetails(Request $request)
    {

        $permanceAppraisalDetails = PerformanceAppraisal::find($request->id);
        $permanceAppraisalDetails->remarks = $request->remarks;
        $permanceAppraisalDetails->save();

        $appraisalRatingArr = PerformanceAppraisalRating::where('performance_appraisal_id', $request->id)->get();


        $reqArr = $request['data'];
        foreach ($reqArr as $reqItem) {
            $titleId = $reqItem['titleId'];
            $subTitleId = $reqItem['subTitleId'];
            $rating = $reqItem['rating'];

            // Finding  the matching record in DB through first() 
            $record = $appraisalRatingArr->first(function ($item) use ($titleId, $subTitleId) {
                return $item->title_id == $titleId && $item->sub_title_id == $subTitleId;
            });

            if ($record) {
                $record->rating = $rating;
                $record->save();
            }
        }

        return response()->json(['status' => true, 'message' => 'Rating updated successfully']);
    }

    public function deleteAppraisal(Request $request)
    {
        $performance_appraisal_details = PerformanceAppraisal::find($request->id);
        $performance_appraisal_details->delete();

        return response()->json(['status' => true, 'message' => 'Appraisal Rating  deleted successfuly']);
    }

    //-------------- indicator form--------------------------------------------//

    public function indicatorForm(Request $request)
    {

        $indicator_forms =  DB::table('indicator_form')->join('departments', 'indicator_form.department_id', '=', 'departments.id')
            ->join('job_titles', 'job_titles.id', '=', 'indicator_form.job_title_id')
            ->select('indicator_form.id', 'indicator_form.department_id', 'indicator_form.job_title_id', 'departments.department', 'job_titles.name')
            ->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {

            return DataTables::of($indicator_forms)
                ->addIndexColumn()
                ->addColumn('department', function ($indicator_forms) {

                    return $indicator_forms->department;
                })
                ->addColumn('designation', function ($indicator_forms) {

                    return $indicator_forms->name;
                })->addColumn('action', function ($indicator_forms) {


                    $editFormUrl = route('edit.indicator.form', $indicator_forms->id);

                    return ' <a  href="' . $editFormUrl . '" title="Edit Indicator Form"  id="editFormsBtn" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></a>
         <button type="button" data-id="' . $indicator_forms->id . '"  title="Delete Indicator Form""  id="deleteIndicatorForm" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
                })->rawColumns(['action'])->make(true);
        }

        return view('admin.performanceManagement.indicator_forms');
    }

    public function createIndicatorForm()
    {

        $departments = Department::select('id', 'department')->get();

        return view('admin.performanceManagement.create_indicator_form', compact('departments'));
    }

    public function storeIndicatorForm(Request $request)
    {


        $form_exists  = IndicatorForm::where([['department_id', $request->department], ['job_title_id', $request->designation]])->first();
        if ($form_exists) {

            return response()->json(['status' => false, 'message' => 'KPI Form already exists']);
        }

        $indicators = $request->indicators;
        $flat = collect($indicators)->flatMap(function ($item) {
            return collect($item['subTitle'])->map(function ($sub) use ($item) {
                return [
                    'title' => $item['title'],
                    'subTitle' => $sub,
                ];
            });
        });

        $indicator_form =  new IndicatorForm;
        $indicator_form->department_id = $request->department;
        $indicator_form->job_title_id = $request->designation;
        $indicator_form->save();

        $titleMap = [];

        foreach ($flat as $item) {
            $title = $item['title'];
            $subTitle = $item['subTitle'];

            if (!isset($titleMap[$title])) {
                $indicator_title = new IndicatorTitle;
                $indicator_title->title = $title;
                $indicator_title->indicator_form_id = $indicator_form->id;
                $indicator_title->save();

                $titleMap[$title] = $indicator_title->id;
            }

            $indicator_sub_title = new IndicatorSubTitle;
            $indicator_sub_title->sub_title = $subTitle;
            $indicator_sub_title->title_id = $titleMap[$title];
            $indicator_sub_title->save();
        }

        return response()->json(['status' => true, 'message' => 'indicator form saved succesfully']);
    }

    public function editindicatorForm(Request $request)
    {

        $indicator_form_details = IndicatorForm::with('department', 'job_title', 'title', 'title.sub_title')
            ->select('id', 'department_id', 'job_title_id')->where('indicator_form.id', $request->id)->first();

        $form_id = $indicator_form_details->id;

        $department = $indicator_form_details->department;
        $designation =  $indicator_form_details->job_title;

        $titleArr = [];
        foreach ($indicator_form_details->title as $item) {
            $titleArr[]   = ['id' => $item->id, 'title' => $item->title];
        }

        $subtitles = [];
        foreach ($indicator_form_details->title as $item) {

            $subtitles[]   = $item->sub_title;
        }

        $subTitleArr = collect($subtitles)->flatten();

        return view('admin.performanceManagement.edit_indicator_form', [
            'department' => $department,
            'designation' => $designation,
            'titles' => $titleArr,
            'subTitles' => $subTitleArr,
            'id' => $form_id
        ]);
    }

    public function updateIndicatorForm(Request $request)
    {


        foreach ($request->indicators as $titleData) {
            if (isset($titleData['id'])) {
                $title = IndicatorTitle::find($titleData['id']);
                $title->title = $titleData['title'];
                $title->save();
            } else {
                $title = new IndicatorTitle;
                $title->title = $titleData['title'];
                $title->indicator_form_id = $request->id;
                $title->save();
            }

            if (isset($titleData['subTitles'])) {
                foreach ($titleData['subTitles'] as $subtitleData) {
                    if (isset($subtitleData['id'])) {
                        $subtitle = IndicatorSubTitle::find($subtitleData['id']);
                        $subtitle->sub_title = $subtitleData['sub_title'];
                        $subtitle->save();
                    } else {
                        $subtitle =  new IndicatorSubtitle;
                        $subtitle->sub_title = $subtitleData;
                        $subtitle->title_id = $title->id;
                        $subtitle->save();
                    }
                }
            }
        }


        return response()->json(['status' => true, 'message' => 'KPI Form updated Succesfully']);
    }

    public function editRemoveTitle(Request $request)
    {

        $indicator_details = IndicatorTitle::with('sub_title')->find($request->id);
        $indicator_details->delete();
        //  return response()->json(['status'=> true]);

    }

    public function editRemoveSubtitle(Request $request)
    {

        $subtitle = IndicatorSubtitle::find($request->id);
        $subtitle->delete();
        // return response()

    }

    public function deleteIndicatorForm(Request $request)
    {

        $indicator_details = IndicatorForm::find($request->id);
        $indicator_details->delete();
        return response()->json(['status' => true, 'message' => 'Indicator deleted successfuly']);
    }
}






// update without nestedforeach end


// $flatArray = collect( $request->indicators)->flatMap(function ($item) {
//     return collect($item['subTitles'])->map(function ($sub) use ($item) {
//         $entry = [
//             'title' => $item['title'],
//         ];

//         if (isset($item['id'])) {
//             $entry['id'] = $item['id'];
//         }

//         if (is_array($sub)) {
//             $entry['sub_title'] = $sub['sub_title'];
//             if (isset($sub['id'])) {
//                 $entry['sub_title_id'] = $sub['id'];
//             }
//         } else {
//             $entry['sub_title'] = $sub;
//         }

//         return $entry;
//     });
//     })->values()->all();


// //   return  ($flatArray);
// //   die;

// dump($flatArray);

// foreach ($flatArray as $item) {

// if (isset($item['id'])) {

// $title = IndicatorTitle::find($item['id']);
// if ($title) {
//     $title->title = $item['title'];
//     // $title->save();
//     dump('old_title:'. $title->title);
// }
// } else {

// $title= new IndicatorTitle;
// $title->title = $item['title'];
// $title->indicator_form_id = $request->id;
// // $title->save();
// dump('new_title:'. $title->title);
// }


// if (isset($item['sub_title_id'])) {
// $subtitle = IndicatorSubTitle::find($item['sub_title_id']);
// if ($subtitle) {
//     $subtitle->sub_title = $item['sub_title'];
//     // $subtitle->save();
//     dump('old_subtitle:'. $subtitle->sub_title);
// }
// } else {


// $subtitle =  new IndicatorSubtitle;
// $subtitle->sub_title =$item['sub_title'];
// $subtitle->title_id = $title->id;
// // $subtitle->save();
// dump('title_id:'. $subtitle->title_id);
// dump('new_subtitle:'. $subtitle->sub_title);
// }
// }


// dd('stop');



// update without nestedforeach end