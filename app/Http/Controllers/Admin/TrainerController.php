<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class TrainerController extends Controller
{

        public function index(Request $request)
        {
            $trainers = Trainer::all();
            if ($request->ajax()) {
                return DataTables::of($trainers)
                    // ->addColumn('id', function ($trainer) {
                    //     return '<span class="badge bg-inverse-danger p-3">#CON000' . $trainer->id . '</span>';
                    // })
                    ->addColumn('first_name', function ($trainer) {
                        return e($trainer->first_name .' '. $trainer->last_name);
                    })
                    ->addColumn('contact_number', function ($trainer) {
                        return e($trainer->contact_number);
                    })
                    ->addColumn('email', function ($trainer) {
                        return e($trainer->email);
                    })
                    ->addColumn('expertise', function ($trainer) {
                        return e($trainer->expertise);
                    })
     
                    ->addColumn('address', function ($trainer) {
                        return e($trainer->address);
                    })
                    ->addColumn('action', function ($trainer) {
                        $viewButton = '<a href="' . route('trainer.view', $trainer->id) . '" class="btn btn-secondary btn-sm">
                          <i class="fa fa-eye"></i>
                               </a>';
     
                        $editButton = '<a href="'. route('trainer.edit', $trainer->id) .'" class="btn btn-success btn-sm">
                          <i class="fa fa-edit"></i></a>';
     
                        $deleteForm = '<form action="' . route('trainer.destroy', $trainer->id) . '"
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
     
     
            return view('admin.trainer.index', compact('trainers'));
        }
     
        public function store(Request $request)
        {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:trainers,email',
                'expertise' => 'nullable|string',
                'address' => 'nullable|string',
            ]);
     
            Trainer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'expertise' => $request->expertise,
                'address' => $request->address,
            ]);
     
            return redirect()->back()->with('success', 'Trainer created successfully.');
        }
        public function destroy($id)
        {
            Log::info("Delete request received for trainer ID: " . $id);
     
            $trainer = Trainer::find($id);
     
            if (!$trainer) {
                Log::error("Trainer not found: " . $id);
                return redirect()->back()->with('error', 'Trainer not found.');
            }
     
            $trainer->delete();
            Log::info("Trainer deleted successfully: " . $id);
     
            return redirect()->back()->with('success', 'Trainer deleted successfully.');
        }
     
        public function view($id)
        {
            $trainer = Trainer::findOrFail($id);
            return view('admin.trainer.show', compact('trainer'));
        }
     
        public function edit($id)
    {
        $trainer = Trainer::findOrFail($id);
        return view('admin.trainer.edit', compact('trainer'));
    }
     
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'expertise' => 'nullable|string',
            'address' => 'nullable|string',
        ]);
     
        $trainer = Trainer::findOrFail($id);
        $trainer->update($request->only([
            'first_name', 'last_name', 'contact_number', 'email', 'expertise', 'address'
        ]));
     
        return redirect()->route('trainer.index')->with('success', 'Trainer updated successfully.');
    }
     
     
    }
     
     
