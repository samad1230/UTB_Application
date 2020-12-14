<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Userdashboard()
    {
        $roleid = Auth::user()->role_id;
        return view('User_View.User_dashboard');
    }

    public function purchaseDepartment(){
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',1)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department.Purchase_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            foreach($userDepartments as $userDepartment){
                if($userDepartment->name == $thisDepartment){
                    return view('Department.Purchase_dashboard',compact('thisDepartment'));
                }
            }
            return back();
        }
        return back();
    }


    public function DepartmentAccess($id)
    {
        $department = Department::where('id',$id)->first();

        if ($department->id==1){
            return view('Department.Purchase_dashboard',compact('department'));
        }else if($department->id==2){
            return view('Department.Hradmin_dashboard',compact('department'));
        }else if($department->id==3){
            return view('Department.Accounts_dashboard',compact('department'));
        }else if($department->id==4){
            return view('Department.Commercial_dashboard',compact('department'));
        }else if($department->id==5){
            return view('Department.Store_dashboard',compact('department'));
        }else{
            return view('Department.Sales_dashboard',compact('department'));
        }

    }
}
