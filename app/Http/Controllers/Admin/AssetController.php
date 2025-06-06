<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssetType;
use App\Models\Asset;
use App\Models\AssetReturn;
use App\Models\User;
use App\Models\Location;
use App\Models\LentAsset;

class AssetController extends Controller
{


    public function index(Request $request)
    {
        $query = Asset::query();

        // Filter by Status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Location
        if ($request->has('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Filter by User (Lent To)
        if ($request->filled('user_id')) {
            $assetIds = LentAsset::where('user_id', $request->user_id)->pluck('asset_id');
            $query->whereIn('id', $assetIds);
        }


        // Search by Asset Name or Serial Number
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('serial_number', 'LIKE', "%$search%");
            });
        }
        $query->with(['lentTo.user']);
        $assets = $query->get();
        $locations = Location::all();
        $users = User::all();
        $asset_types = AssetType::all(); // Fetch asset types
        $assetTypes = AssetType::all();

   

        return view('admin.asset.index', compact('assets', 'locations', 'users', 'asset_types', 'assetTypes'));

    }

    public function create()
    {
        $assetTypes = AssetType::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();

        return view('asset.create', compact('assetTypes', 'users'));
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();

        return redirect()->route('asset.index')->with('success', 'Asset deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type_id' => 'required|exists:asset_types,id',
            'location_id' => 'required|exists:locations,id',
            'serial_number' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Working,Not Working',
            'lent_status' => 'nullable|in:lent,returned',
            'image' => 'nullable|image|max:2048',
        ]);
 
        $asset = new Asset();
        $asset->name = $request->name;
        $asset->asset_type_id = $request->asset_type_id;
        $asset->location_id = $request->location_id;
        $asset->serial_number = $request->serial_number;
        $asset->description = $request->description;
        $asset->status = $request->status ?? 'Working';
        $asset->lent_status = 'lent';
 
        // Handle image upload if provided
 
        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('assets', $filename, 'public');
            $asset->image = $filename;
        }
        $asset->save();
 
        return redirect()->route('asset.index')->with('success', 'Asset added successfully.');
    }

    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $assetTypes = AssetType::all();
        $locations = Location::all();
 
        return view('admin.asset.edit', compact('asset', 'assetTypes', 'locations'));
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'asset_type_id' => 'required|exists:asset_types,id',
            'location_id' => 'nullable|exists:locations,id',
            'serial_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Working,Not Working',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
 
        $asset = Asset::findOrFail($id);
        $asset->fill($request->except('image'));
 
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/assets'), $filename);
            $asset->image = $filename;
        }
 
        $asset->save();
 
        return redirect()->route('asset.index', $asset->id)->with('success', 'Asset updated successfully.');
    }
   


    public function show($id)
    {
        $asset = Asset::with(['assetType', 'location'])->findOrFail($id);
        return response()->json($asset);
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->ids); // Convert string to array

        if (!empty($ids)) {
            Asset::whereIn('id', $ids)->delete();
            return redirect()->route('asset.index')->with('success', 'Asset deleted successfully.');
        } else {
            return response()->json(['error' => 'No assets selected'], 400);
        }
    }

    public function returnAsset(Request $request)
    {
        $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'notes' => 'nullable|string'
        ]);
 
        AssetReturn::create([
            'id'=> $request->asset_id,
            'asset_id' => $request->asset_id,
            'user_id' => auth()->id(),
            'lend_date' => now(),
            'return_date' => now(),
            'notes' => $request->notes
        ]);
 
        Asset::where('id', $request->asset_id)->update(['lent_to' => null]);
 
        return redirect()->back()->with('success', 'Asset returned successfully');
    }
    public function fetchAssetReturns()
    {
        $assetReturns = AssetReturn::with(['user', 'asset'])
            ->orderBy('lend_date', 'desc')
            ->get()
            ->map(function ($return) {
                return [
                    'name' => $return->asset->name ?? 'Unknown',
                    'lend_date' => $return->lend_date,
                    'lend_by' => $return->user->name ?? 'Admin',
                    'return_date' => $return->return_date ?? 'Not Returned',
                    'return_by' => $return->return_user_id ? User::find($return->return_user_id)->name : 'Admin',
                    'actual_return_date' => $return->updated_at->format('Y-m-d'),
                    'notes' => $return->notes ?? '',
                ];
            });
 
        return response()->json($assetReturns);
    }
    public function getAssetReturns(Request $request)
    {
        $assetReturns = AssetReturn::with(['user', 'returnBy', 'asset'])
            ->where('asset_id', $request->asset_id)
            ->orderBy('lend_date', 'desc')
            ->paginate(2);
 
        return response()->json([
            'data' => $assetReturns->map(function ($return) {
                return [
                    'id' => $return->id,
                    'name' => $return->asset->name ?? 'Unknown',
                    'lend_to' => $return->user->name ?? 'Admin',
                    'lend_date' => $return->lend_date ?? '-',
                    'lend_by' => $return->user->name ?? 'Admin',
                    'return_date' => $return->return_date ?? 'Not Returned',
                    'return_by' => $return->returnBy->name ?? 'Admin',
                    'actual_return_date' => $return->updated_at ? $return->updated_at->format('d F Y') : '-',
                    'notes' => $return->notes ?? '-',
                ];
            }),
            'pagination' => [
                'current_page' => $assetReturns->currentPage(),
                'last_page' => $assetReturns->lastPage(),
                'next_page_url' => $assetReturns->nextPageUrl(),
                'prev_page_url' => $assetReturns->previousPageUrl(),
            ],
        ]);
    }

    public function deleteAssetReturn($id)
    {
        $assetReturn = AssetReturn::findOrFail($id);
        $assetReturn->delete();
 
        return response()->json(['message' => 'Asset return record deleted successfully.']);
    }


    public function return(Request $request)
    {
        $asset = LentAsset::where('asset_id',$request->asset_id)->first();
 
      try {
        AssetReturn::create([
            'asset_id'    => $asset->asset_id,
            'user_id'     => $asset->user_id,
            'return_by'   => auth()->id(),
            'lend_date'   => $asset->lend_date ?? now(),
            'return_date' => $request->actual_return_date,
            'notes'       => $request->notes,
        ]);
        Asset::where('id', $request->asset_id)->update(['lent_status'=>'lent']);
 
        return response()->json(['status'=>true]);
      } catch (\Throwable $th) {
      }
 
    }
}
