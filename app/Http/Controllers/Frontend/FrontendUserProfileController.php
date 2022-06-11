<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FileUploadController;
use App\Models\Build_own_menu;
use App\Models\Admin_Setting;


class FrontendUserProfileController extends Controller
{
    public function userdashboard()
    {
        $user = Auth::user();
        $bom = Build_own_menu::all();
        $userDetail = Admin_Setting::find(1);
        return view('dashboard', compact('user', 'bom', 'userDetail'));
    }
    public function userlogout()
    {
        Auth::logout();
        $notification = [
            'message' => 'Logout Successfull',
            'alert-type' => 'success',
        ];
        return redirect()->route('login')->with($notification);
    }

    public function userprofile()
    {
        $user = Auth::user();
        $bom = Build_own_menu::all();
        $userDetail = Admin_Setting::find(1);
        return view('frontend.profile.index', compact('user', 'bom', 'userDetail'));
    }

    public function userprofileupdate(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone_number' => 'required',
        //     'image' => 'image|mimes:jpg,png,jpeg'
        // ]);
        //dd($user, $request->all());
        $data = User::findOrFail(Auth::user()->id);

        if(!empty($data->public_id)) { 
            
            $userImageRemove = (new FileUploadController)->deleteImage($data->public_id);

            if($userImageRemove)
            {
                if(!empty($request->name)) {
                    $data->name = $request->name;
                }
                if(!empty($request->email)) {
                    $data->email = $request->email;
                }
                if(!empty($request->phone_number)) {
                    $data->phone_number = $request->phone_number;
                }
                if(!empty($request->file('image')))
                {
                    $image_file = $request->file('image');
                    $request_new = ["filename" => "UserProfile", "image" => $image_file->getRealPath()];
                    $imageDetail = (new FileUploadController)->storeUploads($request_new);
                    $data['profile_photo_path'] = $imageDetail['photo'];
                    $data['public_id'] = $imageDetail['public_id'];
                    // if($data->profile_photo_path){
                    //     @unlink(public_path('storage/profile-photos/'.$data->profile_photo_path));
                    // }
                    // $filename = date('YmdHi').'.'.$image_file->getClientOriginalExtension();
                    // $image_file->move(public_path('storage/profile-photos'),$filename);
                    // $data['profile_photo_path']= $filename;
                }
                $data->save();

                $notification = [
                    'message' => 'Profile Updated Successfully',
                    'alert-type' => 'success'
                ];

                return redirect()->route('user.profile')->with($notification);
            
            } else {
                $notification = [
                    'message' => 'Sorry Profile Not Update',
                    'alert-type' => 'error'
                ];
            }
        } else {

            if(!empty($request->name)) {
                $data->name = $request->name;
            }
            if(!empty($request->email)) {
                $data->email = $request->email;
            }
            if(!empty($request->phone_number)) {
                $data->phone_number = $request->phone_number;
            }
            if(!empty($request->file('image')))
            {
                $image_file = $request->file('image');
                $request_new = ["filename" => "UserProfile", "image" => $image_file->getRealPath()];
                $imageDetail = (new FileUploadController)->storeUploads($request_new);
                $data['profile_photo_path'] = $imageDetail['photo'];
                $data['public_id'] = $imageDetail['public_id'];
            }
            $data->save();

            $notification = [
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('user.profile')->with($notification);

        }

            return back()->with($notification);
    }

    
    public function userpasswordchange()
    {
        $user = Auth::user();
        $bom = Build_own_menu::all();
        return view('frontend.profile.changepassword', compact('user', 'bom'));
    }

    public function userpasswordupdate(Request $request)
    {
        $current_password = $request->input('current_password');
        $new_password = $request->input('password');

        $user = User::findOrFail(Auth::user()->id);
        if(Hash::check($current_password,$user->password)){
            $user->password = Hash::make($new_password);
            $user->update([
                'password' => $user->password,
            ]);

            Auth::logout();

            $notification = [
                'message' => 'Password Updated Successfully!!!',
                'alert-type' => 'success'
            ];
            return redirect()->route('user.logout')->with($notification);
        }else{
            $notification = [
                'message' => 'Please provide valid password',
                'alert-type' => 'error'
            ];
            return redirect()->route('user.change.password')->with($notification);
    }
  }
}