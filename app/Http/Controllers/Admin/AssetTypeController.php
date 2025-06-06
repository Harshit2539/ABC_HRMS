<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AssetTypeController extends Controller
{

    public function index(Request $request)
    {
        $assetTypes = AssetType::all();

        if ($request->ajax()) {
            return DataTables::of($assetTypes)
                ->addColumn('name', function ($assetTypes) {
                    return e($assetTypes->name);
                })
                ->addColumn('action', function ($assetTypes) {
                    $editButton = '<button class="btn btn-success btn-sm editAssetTypeBtn"
                          data-bs-toggle="modal"
                          data-bs-target="#editAssetTypeModal"
                          data-id="' . $assetTypes->id . '"
                          data-name="' . $assetTypes->name . '">
                          <i class="fa fa-edit"></i>
                      </button>';

                    $deleteForm = '<form action="' . route('assettypes.destroy', $assetTypes->id) . '"
                          method="POST" class="d-inline-block"
                          onsubmit="return confirm(\'Are you sure?\')">
                          ' . csrf_field() . method_field('DELETE') . '
                          <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fa fa-trash"></i>
                          </button>
                      </form>';

                    return $editButton . ' ' . $deleteForm;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.assetTypes.index', compact('assetTypes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AssetType::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Asset Type added successfully!');
    }
    public function destroy($id)
    {
        $assetTypes = AssetType::findOrFail($id);
        $assetTypes->delete();
        return redirect()->route('assettypes.index')->with('success', 'Asset Type deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids); // Convert string to array

        if (!empty($ids)) {
            AssetType::whereIn('id', $ids)->delete();
            return redirect()->route('assettypes.index')->with('success', 'Asset Type deleted successfully.');
        } else {
            return response()->json(['error' => 'No assets selected'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $assetType = AssetType::findOrFail($id);
        $assetType->name = $request->name;
        $assetType->save();

        return redirect()->back()->with('success', 'Asset Type updated successfully.');
    }

}
