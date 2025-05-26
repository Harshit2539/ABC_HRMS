<?php
 
namespace App\Http\Controllers\admin;
 
use App\Http\Controllers\Controller;
use App\Models\ccEmployees;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HelpDeskRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
 
 
 
 
class HelpDeskController extends Controller
{
 
 
    public function index(Request $request)
    {
 
        $user = Auth::user();
 
        $employees = User::where([['id', '!=', Auth::id()], ['role_name', '!=', 'Admin']])->select('id', 'name')->get();
 
        if ($user->role_name == 'Admin') {
 
            $employee_requests = HelpDeskRequest::where('req_resolved_status', 0)->select('id', 'request_category', 'request_subject', 'request_description', 'request_priority', 'req_resolved_status')->orderBy('id', 'DESC')->get();
        } else {
 
            $cc_requests = ccEmployees::where('cc_employee_id', Auth::id())->get();
            $help_request_id = [];
 
            foreach ($cc_requests as $item) {
 
                $help_request_id[] = $item->help_request_id;
            }
 
            $employee_requests = HelpDeskRequest::where([['req_resolved_status', 0], ['employee_id', $user->id]])->orWhereIn('id', $help_request_id)->select('id', 'request_category', 'request_subject', 'request_description', 'request_priority', 'req_resolved_status')->orderBy('id', 'DESC')->get();
        }
 
 
        if ($request->ajax()) {
 
            return DataTables::of($employee_requests)
                ->addIndexColumn()
                ->addColumn('request_category', function ($employee_requests) {
                    return $employee_requests->request_category;
                })
                ->addColumn('request_subject', function ($employee_requests) {
                    return $employee_requests->request_subject;
                })->addColumn('request_priority', function ($employee_requests) {
 
                    if ($employee_requests->request_priority === 'Medium') {
                        return '<span class="badge bg-warning text-dark ">Medium</span>';
                    } else if ($employee_requests->request_priority === 'High') {
                        return '<span class="badge bg-inverse-danger">High</span>';
                    } else if ($employee_requests->request_priority === 'Low') {
                        return '<span class="badge bg-inverse-success">Low</span>';
                    }
                })->addColumn('request_status', function ($employee_requests) {
 
                    if ($employee_requests->req_resolved_status === 0) {
                        return '<span class="badge bg-info text-white">Active</span>';
                    } else if ($employee_requests->req_resolved_status === 1) {
                        return '<span class="badge bg-inverse-success">Closed</span>';
                    }
                })->addColumn('action', function ($employee_requests) {
 
                    return ' <button type="button" data-id="' . $employee_requests->id . '"  data-target="#requestDetailsModal" title="View Request Details" data-bs-toggle="modal"  id="requestDetailsButton" class="btn btn-primary btn-view"> <i class="fa fa-eye"></i></button>';
                })->rawColumns(['action', 'request_priority', 'request_status'])->make(true);
        }
 
        return view('admin.helpDesk.helpDesk_active', compact('employees'));
    }
 
 
 
    public function storeRequestData(Request $request)
    {
        $employee_id = Auth::id();
 
        $request->validate([
            'request_category' => 'required|string',
            'request_subject' => 'required|string',
            'request_description' => 'required|string',
            'request_priority' => 'required|string',
            'attach_file' => 'nullable|file',
        ]);
 
        $help_request = new HelpDeskRequest();
        $help_request->request_category = $request->request_category;
        $help_request->request_subject = $request->request_subject;
        $help_request->request_description = $request->request_description;
        $help_request->request_priority = $request->request_priority;
        $help_request->employee_id = $employee_id;
 
        if ($request->hasFile('attach_file')) {
            $file = $request->file('attach_file');
            $filePath = $file->store('helpdesk_files');
 
            $help_request->file_path = $filePath;
            $help_request->file_name = $file->getClientOriginalName();
            $help_request->file_mime = $file->getClientMimeType();
        }
 
        $help_request->save();
 
        if (isset($request->CC_to)) {
            foreach ($request->CC_to as $item) {
                $cc_employees = new ccEmployees;
                $cc_employees->cc_employee_id = $item;
                $cc_employees->help_request_id = $help_request->id;
                $cc_employees->user_id = $employee_id;
                $cc_employees->save();
            }
 
        }
 
 
        return response()->json(['status' => true, 'message' => 'Request sent successfully']);
    }
 
 
    public function helpRequestDetails(Request $request)
    {
 
 
        $help_request_details = HelpDeskRequest::with('cc')->find($request->id);
        $employee = User::find($help_request_details->employee_id);
 
        $user = Auth::user();
 
        if ($help_request_details) {
 
            $id = $help_request_details->id;
            $request_category = $help_request_details->request_category;
            $request_description = $help_request_details->request_description;
            $request_priority = $help_request_details->request_priority;
            $request_subject = $help_request_details->request_subject;
            $created_at = Carbon::parse($help_request_details->created_at)->format('d-m-Y');
            $employee_name = $employee->name;
            $role_name = $user->role_name;
 
            if (isset($help_request_details->cc)) {
 
                $emp_id = [];
                foreach ($help_request_details->cc as $employee) {
                    $emp_id[] = $employee->cc_employee_id;
                }
 
                $cc_employees_details = User::whereIn('id', $emp_id)->get();
                $cc_names = collect($cc_employees_details)->pluck('name');
            }
 
 
            return response()->json([
                'id' => $id,
                'requestCategory' => $request_category,
                'cc_names' => $cc_names,
                'requestDescription' => $request_description,
                'requestPriority' => $request_priority,
                'requestSubject' => $request_subject,
                'createdAt' => $created_at,
                'employeeName' => $employee_name,
                'roleName' => $role_name
            ]);
        } else {
            return response()->json(['message' => 'Help Request not found'], 404);
        }
    }
 
 
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);
 
        $filePath = $request->file('file')->store('helpdesk_files');
 
        $helpRequest = new HelpDeskRequest();
        $helpRequest->file_path = $filePath;
        $helpRequest->file_name = $request->file('file')->getClientOriginalName();
        $helpRequest->file_mime = $request->file('file')->getClientMimeType();
        $helpRequest->save();
 
        return response()->json(['success' => true]);
    }
    public function downloadFile(Request $request)
    {
        $help_request_details = HelpDeskRequest::find($request->id);
 
        if (!$help_request_details || !$help_request_details->file_path || !Storage::exists($help_request_details->file_path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
 
        $filePath = $help_request_details->file_path;
        $fileName = $help_request_details->file_name ?? 'file_' . time();
        $mime = $help_request_details->file_mime ?? Storage::mimeType($filePath);
 
        return response()->download(storage_path("app/{$filePath}"), $fileName, [
            'Content-Type' => $mime
        ]);
    }
 
 
 
 
    public function closedHelpRequest(Request $request)
    {
 
 
        $user = Auth::user();
        if ($user->role_name == 'Admin') {
            $active_requests = HelpDeskRequest::where('req_resolved_status', 1)->select('id', 'request_category', 'request_subject', 'request_description', 'request_priority', 'req_resolved_status')->orderBy('id', 'DESC')->get();
        } else {
 
            $active_requests = HelpDeskRequest::where([['req_resolved_status', 1], ['employee_id', $user->id]])->select('id', 'request_category', 'request_subject', 'request_description', 'request_priority', 'req_resolved_status')->orderBy('id', 'DESC')->get();
        }
 
 
        if ($request->ajax()) {
 
            return DataTables::of($active_requests)
                ->addIndexColumn()
                ->addColumn('request_category', function ($active_requests) {
                    return $active_requests->request_category;
                })
                ->addColumn('request_subject', function ($active_requests) {
                    return $active_requests->request_subject;
                })->addColumn('request_priority', function ($active_requests) {
 
 
                    if ($active_requests->request_priority === 'Medium') {
                        return '<span class="badge bg-warning text-dark ">Medium</span>';
                    } else if ($active_requests->request_priority === 'High') {
                        return '<span class="badge bg-inverse-danger">High</span>';
                    } else if ($active_requests->request_priority === 'Low') {
                        return '<span class="badge bg-inverse-success">Low</span>';
                    }
                })->addColumn('request_status', function ($active_requests) {
 
                    if ($active_requests->req_resolved_status === 0) {
                        return '<span class=class="badge bg-secondary text-white">Active</span>';
                    } else if ($active_requests->req_resolved_status === 1) {
                        return '<span class="badge bg-inverse-success">Closed</span>';
                    }
                })->addColumn('action', function ($active_requests) {
 
                    return ' <button type="button" data-id="' . $active_requests->id . '"  data-target="#requestDetailsModal" title="View Request Details" data-bs-toggle="modal"  id="requestDetailsButton" class="btn btn-primary btn-view"> <i class="fa fa-eye"></i></button>';
                })->rawColumns(['action', 'request_priority', 'request_status'])->make(true);
        }
 
 
        return view('admin.helpDesk.helpDesk_closed');
    }
 
 
    public function closeRequest(Request $request)
    {
        $request_details = HelpDeskRequest::find($request->id);
 
        if ($request_details) {
 
            $request_details->req_resolved_status = 1;
            $request_details->save();
 
            return response()->json(['status' => true, 'message' => 'Request Closed Successfully']);
        } else {
            return response()->json(['status' => false, 'message' => ' Help Request does not exist']);
        }
    }
 
 
 
    public function searchEmployees(Request $request)
    {
 
        if ($request->filled('employee_name')) {
 
            $search = $request->input('employee_name');
            $employees = User::where('name', 'like', "%$search%")->get();
 
            if (count($employees) == 0) {
 
                return response()->json(['status' => false, 'message' => 'No Data Found']);
            } else if (!empty($employees)) {
 
                $employeeArr = [];
 
                foreach ($employees as $employee) {
                    $employeeArr[] = [
                        'name' => $employee->name,
                        'id' => $employee->id
                    ];
                }
 
                return response()->json(['status' => true, 'employees' => $employeeArr]);
            }
        }
    }
}
 
 