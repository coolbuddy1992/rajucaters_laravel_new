<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\Models\User;
use App\Http\Controllers\MobileVerification;
use App\Models\Admin_Setting;


class LoginController extends Controller
{
    // use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User;
    }

    public function login(Request $request)
    {
        $userDetail = Admin_Setting::find(1);
        // Check validation
        $this->validate($request, [
            'mobileNum' => 'required|regex:/[0-9]{10}/|digits:10',            
        ]);

        // Get user record
        $user = User::where('phone_number', $request->get('mobileNum'))->first();

        if(!empty($user)){
            $content = new Request();
            $content->phone = $request->get('mobileNum');
            $content->otp_type = 'login';

            $userMobile = $request->get('mobileNum');
            $loginType = 'login';

            $otpSend = (new MobileVerification)->SendOtp($content);

            $otpRequestId = $otpSend['request_id']; 

            return view('auth.otpVerify', compact('userMobile', 'loginType', 'otpRequestId', 'userDetail'));
        }else{
            $notification = [
                'message' => 'Mobile number not verify',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }
        

       
    }

    public function otpVerification(Request $request)
    {
        // $this->validate($request, [
        //     'mobileNum' => 'required|regex:/[0-9]{10}/|digits:4',            
        // ]);
        
        $content = new Request();
        $content->phone = $request->get('mobileNum');
        $content->Otp = $request->get('otpNum');
        $content->otpRequestId = $request->get('otpRequestId');

        $otpVerify = (new MobileVerification)->verifyOtp($content); 


        if($otpVerify['success']){

            $user = User::where('phone_number', $request->get('mobileNum'))->first();        
        
            // Set Auth Details
            \Auth::login($user);
            
            // Redirect home page
            $notification = [
                'message' => 'Otp Verify',
                'alert-type' => 'error'
            ];

            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = [
                'message' => 'Otp not verify',
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }
    }
}
