<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClientDetailsController extends Controller
{
    public function list(Request $request)
    {
        $data = ClientDetails::with('user')->get();

        if ($request->ajax()) {
            return DataTables::of($data)
            ->addColumn('userName', function ($data) {
                return $data->user->name;
            })
            ->addColumn('details', function ($data) {
                if(!empty($data->details)){
                    return $data->details;
                   }
            })
            ->addColumn('address', function ($data) {
                if(!empty($data->address)){
                    return $data->address;
                   }
            })
            ->addColumn('userMbl', function ($data) {
                if(!empty($data->user->phone_number)){
                    return $data->user->phone_number;
                   }
                
            })
 
            ->addColumn("action", function ($data) {
                $button = '<div style="display:flex;">
                    <a href="javascript:void(0)"
                       class="btn btn-info mr-1 btn-edit"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Edit</a>
                    <a href="javascript:void(0)"
                       class="btn btn-primary btn-delete"
                       style="font-size:smaller; font-weight:bold;"
                       data-id="' . $data->id . '">Delete</a>
                </div>';
                return $button;
            })
                ->make(true);
        }
        return view('admin.client.list');
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
                'email' => 'required',
            ], [
                'name.required' => 'Name is required.',
                'status.required' => 'Status is required.',
                'email.required' => 'Email is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $user = User::create($request->only(['name', 'phone_number', 'email', 'status']) + [
                'password' => 'Nill',
                'join_date' => now(),
                'rec_id' => 'Nill',
                'role_name' => 'Client'
            ]);
            
            if ($user) {
                ClientDetails::create([
                    'client_id' => $user->id,
                    'details' => $request->input('details'),
                    'address' => $request->input('address'),
                    'url' => $request->input('url'),
                    'first_contact_date' => $request->input('first_contact_date'),
                ]);
            }
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Client created successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }
    public function edit($id)
    {
        $details = ClientDetails::findOrFail($id);
        $user = User::where('id',$details->client_id)->first();
        return response()->json([
            'details' => $details,
            'user' => $user,
        ]);
    }
    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
                'email' => 'required',
            ], [
                'name.required' => 'Name is required.',
                'status.required' => 'Status is required.',
                'email.required' => 'Email is required.',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'result' => 'error',
                    'msg' => $validator->errors(),
                ]);
            }
    
            $details = ClientDetails::findOrFail($id);
            $user = User::where('id',$details->client_id)->update($request->only(['name', 'phone_number', 'email', 'status']) + [
                'password' => 'Nill',
                'join_date' => now(),
                'rec_id' => 'Nill',
                'role_name' => 'Client',
            ]);
    
            $details->update([
                'details' => $request->input('details'),
                'address' => $request->input('address'),
                'url' => $request->input('url'),
                'first_contact_date' => $request->input('first_contact_date'),
            ]);
    
            return response()->json([
                'result' => 'success',
                'msg' => 'Client updated successfully.',
            ]);
        } catch (\Exception $e) {
            app(\App\Exceptions\Handler::class)->report($e);
    
            return response()->json([
                'result' => 'failure',
                'msg' => 'An error occurred. Please try again.',
            ]);
        }
    }
    public function delete($id)
    {
        try {
            $details = ClientDetails::findOrFail($id);
            $user = User::where('id',$details->client_id)->delete();
            $details->delete();

            return response()->json([
                'result' => 'success',
                'msg' => 'Client deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'result' => 'error',
                'msg' => 'Failed to delete Client.',
            ]);
        }
    } 
}
