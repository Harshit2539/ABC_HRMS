<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::where('status', 'active')->get();
        return view('admin.policies.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policies.create' );
    }

    public function store(Request $request)
   {
    $request->validate([
        'policy_name' => 'required|string|max:255',
        'description' => 'required|string',
        'serial_no' => 'required|integer',
        'policy_category' => 'required|string',
        'upload_file' => 'nullable|mimes:pdf,doc,docx|max:2048', // File validation
    ]);

    $filePath = null;

    if ($request->hasFile('upload_file')) {
        $file = $request->file('upload_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/policies', $fileName, 'public'); // Stored in storage/app/public/uploads/policies
    }

    

    // Create new Policy data with mapped fields
    $policy = new Policy();
    // $policy->id = $request->input('serial_no');
    $policy->name = $request->input('policy_name');
    $policy->description = $request->input('description');
    $policy->policy_category = $request->input('policy_category');
    $policy->upload_file = $filePath;
    $policy->save();

    // ✅ Save to DocumentLog after saving the policy
    if ($filePath) {
        \App\Models\DocumentLog::create([
            'policy_id' => $policy->id,
            'policy_name' => $policy->name,
            'uploaded_file_path' => $filePath,
        ]);
    }

    return redirect()->route('policies.index')->with('success', 'Policy created successfully.');
}


    public function edit(Policy $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

        public function update(Request $request, Policy $policy)
    {
        $request->validate(['name' => 'required']);
        $policy->update($request->all());
        return redirect()->route('policies.index')->with('success', 'Policy updated successfully.');
    }


    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->status = 'inactive';
        $policy->save();

        return redirect()->route('policies.index')->with('success', 'Policy marked as inactive.');
    }

    public function download($id)
    {
        $policy = Policy::findOrFail($id);

     

        // if (!$policy->upload_file || !file_exists(storage_path('app/public/' . $policy->upload_file))) {
        //     return redirect()->route('policies.index')->with('error', 'File not found.');
        // }

        return response()->download('public/' . $policy->upload_file);




        $filePath = public_path($policy->upload_file); // Correct path
        return $filePath;
        die;

    if (!file_exists($filePath)) {
        return redirect()->route('policies.index')->with('error', 'File not found.');
    }

    return response()->download($filePath);
    }
}
