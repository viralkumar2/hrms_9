<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Mail\WarningSend;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ShiftController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Warning'))
        {
            if(Auth::user()->type == 'employee')
            {
                return redirect()->back();
            }
            else
            {
                $shift = Shift::where('status',1)->where('created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('shift.index', compact('shift'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Warning'))
        {
            if(Auth::user()->type == 'employee')
            {
                return redirect()->back();
            }
            else
            {
                $user             = \Auth::user();
                $current_employee = Employee::where('user_id', $user->id)->get()->pluck('name', 'id');
                $employees        = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            }

            return view('shift.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }
    public function store(request $request){
        return $request->all();
    }

}
