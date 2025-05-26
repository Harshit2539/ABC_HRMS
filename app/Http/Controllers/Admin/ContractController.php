<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\Log;
use App\Models\Attachment;
use App\Models\Note;
use Carbon\Carbon;
use App\Models\Comment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{
    

    public function index(Request $request)
    {
        $contracts = Contract::all();
        if ($request->ajax()) {
            return DataTables::of($contracts)
                ->addColumn('id', function ($contract) {
                    return '<span class="badge bg-inverse-danger p-3">#VEN000' . $contract->id . '</span>';
                })
                ->addColumn('Vendor_name', function ($contract) {
                    return e($contract->Vendor_name);
                })
                ->addColumn('subject', function ($contract) {
                    return e($contract->subject);
                })
                ->addColumn('type', function ($contract) {
                    return e($contract->type);
                })
                ->addColumn('start_date', function ($contract) {
                    return e($contract->start_date);
                })

                ->addColumn('due_date', function ($contract) {
                    return e($contract->due_date);
                })
                ->addColumn('description', function ($contract) {
                    return e($contract->description);
                })
                ->addColumn('action', function ($contract) {
                    $viewButton = '<a href="' . route('contracts.show', $contract->id) . '" class="btn btn-secondary btn-sm">
                                <i class="fa fa-eye"></i></a>';
                    $editButton = '<a href="javascript:void(0)" class="btn btn-success btn-sm editContractBtn"
                                        data-id="{{ $contract->id }}"><i class="fa fa-edit"></i></a>';

                    $deleteForm = '<form action="' . route('contracts.destroy', $contract->id) . '"
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
                ->rawColumns(['action', 'id'])
                ->make(true);
        }

        return view('admin.contracts.index', compact('contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Vendor_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Contract::create($request->all());

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    public function destroy($id)
    {
        $contract = Contract::find($id);
        if (!$contract) {
            Log::error("Contract not found: " . $id);
            return redirect()->back()->with('error', 'Contract not found.');
        }
        $contract->delete();
        return redirect()->back()->with('success', 'Contract deleted successfully.');
    }

    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        return response()->json($contract);
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->update([
            'Vendor_name' => $request->Vendor_name,
            'subject' => $request->subject,
            'value' => $request->value,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'description' => $request->description,
        ]);

        return response()->json(['success' => 'Contract updated successfully.']);
    }

    public function show($id)
    {
        $contract = Contract::findOrFail($id);
        $attachments = Attachment::all(); // Or filter based on contract ID if necessary
        $notes = Note::latest()->get(); // Fetch all notes (you can filter by contract ID if needed)


        return view('admin.contracts.show', compact('contract', 'attachments', 'notes'));
    }
    
    public function download($id)
    {
        $attachment = Attachment::findOrFail($id);

        $filePath = $attachment->file_path; // Assuming DB has full path relative to storage/app
        $fileName = $attachment->file_name ?? basename($filePath); // fallback to filename from path

        if (!Storage::exists($filePath)) {
            abort(404, 'File not found.');
        }

        return Storage::download($filePath, $fileName);
    }


}
