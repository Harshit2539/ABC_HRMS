<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\Countries;
use Illuminate\Http\Request;
use App\Models\RolesPermissions;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class SettingController extends Controller
{
  

    public function companySettings()
    {
        $company = CompanySetting::first();
        $countries = Countries::all();
        return view('settings.companysettings', compact('company', 'countries'));
    }
 
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'country' => 'nullable|integer|exists:countries,id',
            'city' => 'nullable|string|max:100',
            'state_province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:50',
            'mobile_number' => 'nullable|string|max:50',
            'fax' => 'nullable|string|max:50',
            'website_url' => 'nullable|url|max:255',
            'logo_image_url' => 'nullable|string|max:255',
            'dashboard_image_url' => 'nullable|string|max:255',
        ]);
 
        if ($request->hasFile('logo_image_url')) {
            $logoPath = $request->file('logo_image_url')->store('logos', 'public');
            $validated['logo_image_url'] = 'storage/' . $logoPath;
        }
 
        if ($request->hasFile('dashboard_image_url')) {
            $dashboardPath = $request->file('dashboard_image_url')->store('dashboards', 'public');
            $validated['dashboard_image_url'] = 'storage/' . $dashboardPath;
        }
 
 
        $company = CompanySetting::first();
        if ($company) {
            $company->update($validated);
        } else {
            CompanySetting::create($validated);
        }
 
        return redirect()->back()->with('success', 'Company information saved.');
    }
 



}
