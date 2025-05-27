<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeTraining;
use App\Models\Trainer;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TrainingListController extends Controller
{
    public function index(Request $request)
    {
        $trainings = Training::with(['trainer', 'multiple_employee'=>function($q){
            return $q->with(['employee'=>function($query){
                return $query->select('id', 'first_name', 'last_name');
            }]);
        }, 'department'])->latest()->get();
        $trainers = Trainer::all();
        $employees = Employee::all();
        $departments = Department::all();
        $employee_training = EmployeeTraining::all();
    
      
        if ($request->ajax()) {
            return DataTables::of($trainings)
               
                ->addColumn('first_name', function ($training) {
                    return e($training->trainer->first_name .' '. $training->trainer->last_name);
                })
                ->addColumn('department', function ($training) {
                    return optional($training->department)->department ?? 'N/A';
                })
               
                ->addColumn('training_type', function ($training) {
                    return e($training->training_type);
                })
                ->addColumn('employees', function ($training) {
                    $employees = $training->multiple_employee ?? [];
                
                    $names = [];
                    foreach ($employees as $emp) {
                        if (isset($emp['employee'])) {
                            $names[] = $emp['employee']['first_name'] . ' ' . $emp['employee']['last_name'];
                        }
                    }
                
                    return implode(', ', $names); // Combine names separated by commas
                })

                ->addColumn('status', function ($training) {
                    $status = $training->status;
                    $color = 'gray';
                    $class = 'bg-secondary';
 
                    if ($status == 'Pending') {
                        $color = 'orange';
                        $class = 'bg-inverse-warning';
                    } elseif ($status == 'Started') {
                        $color = 'green';
                        $class = 'bg-inverse-success';
                    } elseif ($status == 'Terminated') {
                        $color = 'red';
                        $class = 'bg-inverse-danger';
                    } elseif ($status == 'Completed') {
                        $color = 'blue';
                        $class = 'bg-inverse-primary';
                    }
 
                    return '<span class="badge ' . $class . '" style="color: ' . $color . ';">' . $status . '</span>';
                })
 
                ->addColumn('start_date', function ($training) {
                    return \Carbon\Carbon::parse($training->start_date)->format('d F Y') . '   -   ' . \Carbon\Carbon::parse($training->end_date)->format('d F Y');
                })
 
                ->addColumn('action', function ($training) {
                    $viewButton = '<a href="' . route('traininglist.view', $training->id) . '" class="btn btn-secondary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>';
                    $editButton = '<a href="' . route('traininglist.edit', $training->id) . '"
                                        class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>';
 
                    $deleteForm = '<form action="' . route('traininglist.destroy', $training->id) . '"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm(\'Are you sure?\')">
                                       ' . csrf_field() . method_field('DELETE') . '
                                       <button type="submit" class="btn btn-danger btn-sm">
                                           <i class="fa fa-trash"></i>
                                       </button>
                                   </form>';
 
                    return $viewButton . ' ' . $editButton . ' ' . $deleteForm;
                })
                ->rawColumns(['action', 'status', 'id'])
                ->make(true);
        }
 
 
 
        return view('admin.traininglist.index', compact('trainings', 'trainers', 'employees', 'departments'));
    }

    public function create()
    {
        $trainers = Trainer::all();
        $employees = Employee::all();
        return view('admin.traininglist.create', compact('trainers', 'employees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'training_type' => 'required|string|max:255',
            'trainer_id' => 'required|exists:trainers,id',
            'department_id' => 'required|exists:departments,id',
            'employee_id' => 'required|array',
            'employee_id.*' => 'exists:employees,id',
            // 'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Completed,Terminated,Started,Pending',
            'description' => 'nullable|string',
        ]);
 
 
 
        $training = new Training;
        $training->training_type =  $request->training_type;
        $training->trainer_id =  $request->trainer_id;
        $training->department_id =   $request->department_id;
        $training->start_date =  $request->start_date;
        $training->end_date =  $request->end_date;
        $training->status =  $request->status;
        $training->description = $request->description;
        if($training->save()){
            foreach ($request->employee_id as $employeeId) {
                $employeeTraining = new EmployeeTraining();
                $employeeTraining ->employee_id = $employeeId;
                $employeeTraining ->training_id = $training->id;
                $employeeTraining->save();
            }
        }
        return redirect()->route('traininglist.index')->with('success', 'Training successfully added.');
    }
 
    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        $training->delete();
        return redirect()->back()->with('success', 'Training deleted successfully.');
    }

    public function show($id)
{
    $training = Training::with(['trainer', 'employee'])->findOrFail($id);
 
    $employeeIds = EmployeeTraining::where('training_id', $id)->pluck('employee_id');
    $employee = Employee::whereIn('id', $employeeIds)->get();
  
 
    return view('admin.traininglist.view', compact('training', 'employee'));
}

    public function updateStatus(Request $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->performance = $request->performance;
        $training->status = $request->status;
        $training->remarks = $request->remarks;
        $training->save();
        return redirect()->back()->with('success', 'Training status updated successfully.');
    }

    public function edit($id)
    {
        $training = Training::findOrFail($id);
        $departments = Department::all();
        $trainers = Trainer::select('id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->pluck('full_name', 'id');
        $employees = Employee::select('id', DB::raw("CONCAT(first_name, ' ', last_name) as full_name"))->pluck('full_name', 'id');
        return view('admin.traininglist.edit', compact('training', 'trainers', 'employees', 'departments'));
    }

    public function update(Request $request, $id)
    {
 
        // dd($request->all());
 
        $training = Training::findOrFail($id);
 
        $training->training_type = $request->training_type;
        $training->trainer->first_name = $request->trainer;
        $training->status = $request->status;
        $training->department_id = $request->department_id;
 
        $training->employee_id = $request->employee_id;
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->description = $request->description;
        $training->save();
        return redirect()->route('traininglist.index')->with('success', 'Training updated successfully.');
    }


    public function getemployees(Request $request)
    {
        $employees = Employee::where('department', $request->department_id)->get();
        return response()->json(['status' => true, 'employees' => $employees]);
    }
 
    public function updateGetEmployees(Request $request){
 
        $employees = Employee::where('department',$request->department_id)->get();
        return response()->json(['status'=>true, 'employees'=>$employees]);
 
    }




    //For the employee Training For Employee dashboard

    public function empTraining(Request $request){
        $trainings = Training::select('trainings.*', 'departments.department as department_name', 'trainers.first_name as trainer_first_name','trainers.last_name as trainer_last_name')
          ->join('departments', 'trainings.department_id', '=', 'departments.id')
          ->join('trainers', 'trainings.trainer_id', '=', 'trainers.id')
          ->with(['multiple_employee' => function($q) {
              $q->with(['employee' => function($query) {
                  $query->select('id', 'first_name', 'last_name');
              }]);
          }])
          ->latest('trainings.created_at')
          ->get();
  
            $events = [];
                  $employeeId = Employee::join('users','employees.employee_id','=','users.id')->where('employees.employee_id','=',Auth::id())->select('employees.*')->first()->id;
                  $empTraining = Training::join('employees_training', 'trainings.id', '=', 'employees_training.training_id')
                      ->where('employees_training.employee_id',$employeeId)
                      ->select('trainings.*') 
                      ->take(5)
                      ->get();
                  foreach ($empTraining as $empTrainings) {
                  $events[] = [
                                      'title' => $empTrainings->training_type,
                                      'start' => $empTrainings->start_date,
                                      'end' => $empTrainings->end_date,
                                      'className' => 'fc-state-default',
                                      'icon' => "circle",
                                      'backgroundColor' => optional($empTrainings->event)->event_color ?? '#FF0000', // fallback to gray
                                      'borderColor' => optional($empTrainings->event)->event_color ?? '#FF0000',
                                      'event_description' => $empTrainings->description ?? 'No description',
                              ];
  
                  }
          if ($request->ajax()) {
              return DataTables::of($trainings)              
                  ->addColumn('trainer', function ($training) {
                      return e($training->trainer_first_name.' '.$training->trainer_last_name);
                  })
                   ->addColumn('department_name', function ($training) {
                      return e($training->department_name);
                  })
                   ->addColumn('description', function ($training) {
                      return e($training->description);
                  })
                  ->addColumn('status', function ($training) {
                      $status = $training->status;
                      $color = 'gray';
                      $class = 'bg-secondary';
   
                      if ($status == 'Pending') {
                          $color = 'orange';
                          $class = 'bg-inverse-warning';
                      } elseif ($status == 'Started') {
                          $color = 'green';
                          $class = 'bg-inverse-success';
                      } elseif ($status == 'Terminated') {
                          $color = 'red';
                          $class = 'bg-inverse-danger';
                      } elseif ($status == 'Completed') {
                          $color = 'blue';
                          $class = 'bg-inverse-primary';
                      }
                      return '<span class="badge ' . $class . '" style="color: ' . $color . ';">' . $status . '</span>';
                  })
                  ->rawColumns(['action', 'status', 'id'])
                  ->make(true);
          }
          return view('admin.employeeTraining.index', compact('events'));
      }
}
