<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOtpVerification;
use App\Models\Admin_Setting;


class MobileVerification extends Controller
{
    public function generateOtp()
    {
        $otp = mt_rand(1000,9999);
        return $otp;
    }

    public function SendOtp(Request $request)
    {
        $userDetail = Admin_Setting::find(1);
        $getOtp = $this->generateOtp();

        $fields = array(
            "variables_values" => $getOtp,
            "route" => "otp",
            "numbers" => $request->phone,
        );

        $otpType = $request->otp_type;
        
        // if($request->otp_type == 'login')
        // {
        //     $otpType = 'login';
        // }

        $apiKey = $userDetail->sms_api_key;

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($fields),
          CURLOPT_HTTPHEADER => array(
            "authorization: ".$apiKey."",
            "accept: */*",
            "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $data = [
            "return" => false, 
            "message" => "Message not send Successfully"
        ]; 
            return $data;
        } else {
            
            $responseData = json_decode($response, TRUE);
            
            if($responseData['return']){
                UserOtpVerification::create([
                    'mobile'=> $request->phone,
                    'sendOtp'=> $getOtp,
                    'check_status' => 'unverified',
                    'request_id' => $responseData['request_id'],
                    'otpType' => $otpType
                ]);
                
                $userReport = [
                    'message' => 'Otp Successfully Verified',
                    'success' => TRUE,
                    'request_id' => $responseData['request_id']
                ];
            }

            return $userReport;
        }
    }

    public function verifyOtp(Request $request)
    {
        $userOtp = UserOtpVerification::where(['mobile' =>$request->phone, 'request_id' =>$request->otpRequestId])->first();
        
        $userReport = [
                'message' => 'Otp Not Verified',
                'success' => FALSE
            ];

        if($userOtp->sendOtp == $request->Otp)
        {
            $userOtp->check_status = 'Verified';
            $userOtp->save();

            $userReport = [
                'message' => 'Otp Successfully Verified',
                'success' => TRUE,
                'request_id' => $userOtp->request_id
            ];
        }

        return $userReport;
    }

}
