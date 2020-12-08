<?php

namespace App\Http\Controllers\OwnerController;

use App\Admin_model\Role;
use App\Admin_model\User_Profile;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class AdminManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Ownerindex(){

        $roledata = Role::whereNotIn('id', [1,4])
            ->get();

        $userdata = DB::table('users')
            ->where('role_id', 2)
            ->get();

        return view('Admin_view.Main.Owner_Main_Dashborad',compact('roledata','userdata'));
    }


    public function adminregistration(Request $request)
    {
        $loginid = Auth::user()->id;

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
        ]);

        $data = new User();
        $data ['name']=$request->user_name;
        $data ['role_id']=$request->usertype;
        $data ['staf_id']=$request->stafid;
        $data ['email']=$request->email;
        $data ['password']=Hash::make($request->password);
        $data ['creat_by']=$loginid;
        $data->save();

        $notification=array(
            'messege'=>'User Registration Success!',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    public function OwnerprofileUpdate(Request $request)
    {
        //dd($request);

        $name_new = $request->user_name;
        $name_old = $request->nameold;

        if ($name_old != $name_new){
            $user = Auth::user();  ///
            $user->name=$name_new;
            $user->save();
        }

        $profileCount = Auth::user()->profile != null?Auth::user()->profile->count():0;
        $profile = Auth::user()->profile != null?Auth::user()->profile:0;
        $userid = Auth::user()->id;
        if($profileCount > 0){
            $data = $profile;
        }else{
            $data= new User_Profile();
        }
        $data['user_id']=$userid;
        $data['national_id']=$request->nationalid;
        $data['address']=$request->address;
        $data['phone']=$request->mobile;

        $profileimage=$request->profileimage;
        $nidimage=$request->nidimage;

        if($request->hasFile('profileimage')){
            $profileUserImage = $profileCount > 0 ? $profile->user_image: null;
            if($profileUserImage != null){
                $image = $profile->user_image;
                $path = 'Media/user_profile/' . $image;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $profileImageFilename = time() . $x . $profileimage->getClientOriginalExtension();
            Image::make($profileimage->getRealPath())->resize(250, 200)->save(public_path('/Media/user_profile/' . $profileImageFilename));
            $data['user_image']=$profileImageFilename;

        }

        if($request->hasFile('nidimage')){
            $profileUserImage = $profileCount > 0 ? $profile->national_id_image: null;
            if($profileUserImage != null){
                $image = $profile->national_id_image;
                $path = 'Media/user_profile/' . $image;
                unlink($path);
            }
            $x = 'abcdefghijklmnopqrstuvwxyz0123456789';
            $x = str_shuffle($x);
            $x = substr($x, 0, 6) . '.DAC_ZS.';
            $nidimageFilename = time() . $x . $nidimage->getClientOriginalExtension();
            Image::make($nidimage->getRealPath())->resize(450, 350)->save(public_path('/Media/user_profile/' . $nidimageFilename));
            $data['national_id_image']=$nidimageFilename;
        }
        $data->save();

        $notification=array(
            'messege'=>'Successfully Profile Updated!',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }
}
