<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use DB;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function getcities($id){
        $cities = DB::table('city')->where('districtid',$id)->get();
        return $cities;
    }
    public function getdistict($id){
        $getdistict = DB::table('district')->where('state_id',$id)->get();
        return $getdistict;
    }
    public function index()
    {
        if(\Auth::user()->can('Manage Branch'))
        {
            $branches = Branch::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('branch.index', compact('branches'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Branch'))
        {
            $state = DB::table('state')->get();
            return view('branch.create',compact('state'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Branch'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $state = DB::table('state')->where('state_id',$request->state_name)->first();
            $district_name = DB::table('district')->where('districtid',$request->district_name)->first();


            $branch             = new Branch();
            $branch->name       = $request->name;
            //country
            $branch->country_name  = $request->country_name;
            $branch->state_name    = $state->state_title;
            $branch->district_name = $district_name->district_title;
            $branch->city_name    = $request->city_name;
            $branch->zip_code    = $request->zip_code;
            $branch->address    = $request->address;

            $branch->created_by = \Auth::user()->creatorId();
            $branch->save();

            return redirect()->route('branch.index')->with('success', __('Branch  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Branch $branch)
    {
        return redirect()->route('branch.index');
    }

    public function edit(Branch $branch)
    {
        if(\Auth::user()->can('Edit Branch'))
        {
            if($branch->created_by == \Auth::user()->creatorId())
            {
                $state = DB::table('state')->get();
                return view('branch.edit', compact('branch','state'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Branch $branch)
    {
        if(\Auth::user()->can('Edit Branch'))
        {
            if($branch->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $state = DB::table('state')->where('state_id',$request->state_name)->first();
                $district_name = DB::table('district')->where('districtid',$request->district_name)->first();

                $branch->name = $request->name;
                $branch->country_name  = $request->country_name;
                $branch->state_name    = $state->state_title;
                $branch->district_name = $district_name->district_title;
                $branch->city_name    = $request->city_name;
                $branch->zip_code    = $request->zip_code;
                $branch->address    = $request->address;
                $branch->save();

                return redirect()->route('branch.index')->with('success', __('Branch successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Branch $branch)
    {
        if(\Auth::user()->can('Delete Branch'))
        {
            if($branch->created_by == \Auth::user()->creatorId())
            {
                $employee     = Employee::where('branch_id',$branch->id)->get();
                if(count($employee) == 0)
                {
                    $department = Department::where('branch_id',$branch->id)->first();
                    if(!empty($department)){
                        Designation::where('department_id',$department->branch_id)->delete();
                        $department->delete();
                    }
                    $branch->delete();
                }
                else
                {
                    return redirect()->route('branch.index')->with('error', __('This branch has employees. Please remove the employee from this branch.'));
                }

                return redirect()->route('branch.index')->with('success', __('Branch successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getdepartment(Request $request)
    {

        if($request->branch_id == 0)
        {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if(in_array('0', $request->department_id))
        {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
