<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'address' => 'nullable|string'
        ]);

        $location = Location::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->route('asset.index')->with('success', 'Asset added successfully.');

    }
}
