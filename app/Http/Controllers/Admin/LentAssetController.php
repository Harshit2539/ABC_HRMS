<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\LentAsset;
use App\Models\User;
use Illuminate\Http\Request;

class LentAssetController extends Controller
{
    public function index() {
        $users = User::select('id', 'name')->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'asset_id' => 'required|exists:assets,id',
            'lend_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:lend_date',
        ]);
        try {
            LentAsset::create([
                'user_id' => $request->user_id,
                'asset_id' => $request->asset_id,
                'lend_date' => $request->lend_date,
                'return_date' => $request->return_date,
                'notes' => $request->notes,
            ]);
            Asset::where('id', $request->asset_id)->update(['lent_status'=>'returned']);
            return response()->json(['message' => 'Asset lent successfully']);
        } catch (\Throwable $th) {
            //throw $th;
        }
 
    }

}
