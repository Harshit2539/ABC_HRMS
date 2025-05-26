<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryComponent;
use App\Models\Employee;
use App\Models\SalaryGroup;
use App\Models\SalaryGroupComponents;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
 
 
class PayRollSettings extends Controller
{
    public function salaryComponentlist(Request $request){
 
        $salary_component_list= SalaryComponent::orderBy('id', 'DESC')->get();
 
 
        if ($request->ajax()) {
 
            return DataTables::of($salary_component_list)
            ->addIndexColumn()
            ->addColumn('name', function ($salary_component_list) {
                     
                return $salary_component_list->component_name;
 
            }) ->addColumn('type', function ($salary_component_list) {
               
                 return $salary_component_list->component_type;
 
            }) ->addColumn('value_type', function ($salary_component_list) {
 
                return $salary_component_list->component_value_type_label;
               
                     
            })->addColumn('monthly_percentage', function ($salary_component_list) {
 
                if(   $salary_component_list->component_value_type == 3  || $salary_component_list->component_value_type == 4){
                    return $salary_component_list->monthly_percentage . '%' ;
                }
                   
                else if($salary_component_list->component_value_type == 1 || $salary_component_list->component_value_type == 2){
                    return  'Rs ' . $salary_component_list->monthly_amount ;
                }
             
 
          }) ->addColumn('action', function ($salary_component_list) {
           
            return '<a href="' . url('edit_salary_component/' . $salary_component_list->id) . '" class="btn btn-primary btn-view" title="Edit Salary Component"><i class="fa-solid fa-pencil"></i></a>
            <button type="button" data-id="' . $salary_component_list->id . '"  title="Delete component""  id="deleteComponentBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
            })  ->rawColumns(['action'])->make(true);
       
        }
 
        return  view('admin.payrollsettings.salary_component');
    }
 
 
    public function storeSalaryComponent(Request $request){
         
        $salary_component = new SalaryComponent;
        $salary_component->component_name =$request->component_name ;
        $salary_component->component_type=$request->component_type;
        $salary_component->component_value_type=$request->component_value_type;
 
        if( $request->component_value_type == 3 || $request->component_value_type == 4){
            $salary_component->monthly_percentage=$request->monthly_percentage;
        }
        else if($request->component_value_type == 1 || $request->component_value_type == 2){
            $salary_component->monthly_amount=$request->monthly_amount;
        }
 
        $salary_component->save();
       
        return response()->json(['status'=>true, 'message'=>'Salary component added successfully']);
    }
 
    public function salaryGroupList(Request $request){
                           
        $salaryComponentList= SalaryComponent::get();
       $employees= Employee::select('id','first_name','last_name')->get();
       $salary_groups = SalaryGroup::get();
 
        if ($request->ajax()) {
 
            return DataTables::of($salary_groups)
            ->addIndexColumn()
            ->addColumn('group_name', function ($salary_groups) {
                     
                return $salary_groups->salary_group_name;
 
            })
 
            ->addColumn('action', function ($salary_groups) {                  
               
        $editGroupUrl = route('edit.salary.group', $salary_groups->id);
           
        return ' <a  href="'.$editGroupUrl.'" title="Edit salary Group"  id="salaryGroupDetails" class="btn btn-primary btn-view"> <i class="fa-solid fa-pencil"></i></a>
   
                <button type="button" data-id="'.$salary_groups->id.'"  title="Delete Group""  id="deleteGroupBtn" class="btn btn-danger btn-view"> <i class="fa-solid fa-trash-can"></i></button>';
   
            })  ->rawColumns(['action'])->make(true);
       
        }
 
        return  view('admin.payrollsettings.salary_group', compact('salaryComponentList','employees'));
 
    }
 
    public function storeSalaryGroup(Request $request){
 
            $salary_group = new  SalaryGroup;
            $salary_group->salary_group_name= $request->group_name;
            $salary_group->save();
       
                  foreach($request->salaryComponents as $component){
 
                                 $salary_group_component = new SalaryGroupComponents;
                                 $salary_group_component->salary_component_id = $component;
                                 $salary_group_component->salary_group_id = $salary_group->id;
                                 $salary_group_component->save();
                  }
 
                   return response()->json(['status'=>true,'message'=>'Salary Group Saved Successfully']);
 
    }
 
    public function getComponentDetails(Request $request){
                   $salary_component= SalaryComponent::find($request->id);
                   return response()->json(['status'=>true, 'salaryComponent'=>  $salary_component]);
   
    }
 
    public function getSelectedComponents(Request $request){
 
        $selected_component= SalaryComponent::whereIn('id',$request->ids)->get();
        return response()->json(['status'=>true, 'selectedComponents'=> $selected_component]);
 
  }
 
   public function deleteSalaryGroup(Request $request){
 
                 $salary_group= SalaryGroup::find($request->id);
                $salary_group->delete();
                return response()->json(['status'=>true, 'message'=>'Group Deleted Successfully']);
   }
 
 
   public function editSalaryGroup(Request $request){
 
    $salaryComponentList= SalaryComponent::select('id','component_name')->get();      
    $salaryGroupDetails= SalaryGroup::with('components')->find($request->id);
    return view('admin.payrollsettings.edit_salary_group',compact('salaryComponentList','salaryGroupDetails'));
 
   }
 
   public function updateSalaryGroup(Request $request){
 
                      $salaryGroupDetails = SalaryGroup::find($request->group_id);
                      $salaryGroupDetails->salary_group_name = $request->group_name;
                      $salaryGroupDetails->save();
 
                   $salary_group_components =  SalaryGroupComponents::where('salary_group_id',$request->group_id)->get();
 
                  foreach( $salary_group_components as $existingComponent){
 
                    $existingComponent->delete();
                  }
                   
                  foreach( $request->salaryComponents as $newComponent){
                             
                    $salary_group_component = new SalaryGroupComponents;
                    $salary_group_component->salary_component_id = $newComponent;
                    $salary_group_component->salary_group_id = $salaryGroupDetails->id;
                    $salary_group_component->save();
 
                  }
 
                return response()->json(['status'=>true, 'message'=> 'salary group successfully updated']);
 
   }
 
   public function deleteSalaryComponents(Request $request)
    {
        $salary_component_list = SalaryComponent::find($request->id);
        $salary_component_list->delete();
        return response()->json(['status' => true, 'message' => 'Component Deleted Successfully']);
    }
    public function editSalaryComponents($id)
    {
        $salary_component_list = SalaryComponent::findOrFail($id);
        return view('admin.payrollsettings.edit_salary_component', compact('salary_component_list'));
    }
 
    public function updateSalaryComponents(Request $request, $id)
    {
        $request->validate([
            'component_name' => 'required|string|max:255',
            'component_type' => 'required|in:earning,deduction',
            'component_value_type' => 'required|in:1,2,3,4', // matching the values in the enum
            'monthly_percentage' => 'nullable|numeric|min:0|max:100',
            'monthly_amount' => 'nullable|numeric'
        ]);
 
        $salary_component_list = SalaryComponent::findOrFail($id);
        $updateData = [
            'component_name' => $request->component_name,
            'component_type' => $request->component_type,
            'component_value_type' => $request->component_value_type,
        ];
        // Conditionally add value based on type
        if ($request->component_value_type == 3 || $request->component_value_type == 4) {
            $updateData['monthly_percentage'] = $request->monthly_percentage;
            $updateData['monthly_amount'] = null;
        } elseif ($request->component_value_type == 1 || $request->component_value_type == 2) {
            $updateData['monthly_amount'] = $request->monthly_amount;
            $updateData['monthly_percentage'] = null;
        }
        $salary_component_list->update($updateData);
        return redirect()->route('admin.payrollsettings.salary_component')->with('success', 'Salary Component updated successfully.');
    }
 
}