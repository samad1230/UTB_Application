<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Admin_model\Department;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MainLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Userdashboard()
    {
        return view('User_View.User_dashboard');
    }


    public function UserDepartment()
    {
        $user = Auth::user()->id;
        $allservice = DB::table('department_user')
            ->select('department_user.department_id','departments.name')
            ->join('departments','departments.id','=','department_user.department_id')
            ->where('user_id',$user)
            ->get();

        return view('User_View.Access_Department',compact('allservice'));
    }


//    public function purchaseDepartment(){
//        $user = Auth::user();
//        $userDepartments = $user->departments();
//        $thisDepartment = Department::where('id',1)->first()->name;
//        if ($user->role->id == 1 || $user->role->id == 2){
//            return view('Department_Dashboard.Purchase_dashboard',compact('thisDepartment'));
//        }elseif($user->role->id == 3){
//            foreach($userDepartments as $userDepartment){
//                if($userDepartment->name == $thisDepartment){
//                    return view('Department_Dashboard.Purchase_dashboard',compact('thisDepartment'));
//                }
//            }
//            return back();
//        }
//        return back();
//    }

    public function purchaseDepartment(){
        setcookie("Department", "Purchase Department".",,"."Purchase-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',1)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Purchase_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Purchase_dashboard',compact('thisDepartment'));
        }
        return back();
    }

    public function HradminDepartment(){
        setcookie("Department", "Hradmin Department".",,"."Hradmin-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',2)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Hradmin_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Hradmin_dashboard',compact('thisDepartment'));
        }
        return back();
    }


    public function AccountsDepartment(){
        setcookie("Department", "Accounts Department".",,"."Accounts-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',3)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Accounts_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Accounts_dashboard',compact('thisDepartment'));
        }
        return back();
    }

    public function CommercialDepartment(){
        setcookie("Department", "Commercial Department".",,"."Commercial-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',4)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Commercial_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Commercial_dashboard',compact('thisDepartment'));
        }
        return back();
    }

    public function StoreDepartment(){
        setcookie("Department", "Store Department".",,"."Store-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',5)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Store_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Store_dashboard',compact('thisDepartment'));
        }
        return back();
    }

    public function SalesDepartment(){
        setcookie("Department", "Sales Department".",,"."Sales-Department", time() + (86400 * 1), "/");
        $user = Auth::user();
        $userDepartments = $user->departments();
        $thisDepartment = Department::where('id',6)->first()->name;
        if ($user->role->id == 1 || $user->role->id == 2){
            return view('Department_Dashboard.Sales_dashboard',compact('thisDepartment'));
        }elseif($user->role->id == 3){
            return view('Department_Dashboard.Sales_dashboard',compact('thisDepartment'));
        }
        return back();
    }



}
