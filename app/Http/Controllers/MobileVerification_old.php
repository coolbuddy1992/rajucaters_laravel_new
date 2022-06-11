<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOtpVerification;

class MobileVerification_old extends Controller
{

    public function generateOtp()
    {
        $otp = mt_rand(1000,9999);
        return $otp;
    }

    public function SendOtp($request)
    {
        dd($request);
        $getOtp = $this->generateOtp();

        $fields = array(
            "variables_values" => $getOtp,
            "route" => "otp",
            "numbers" => $request->phone,
        );

        $apiKey = env('FAST_TWO_SMS_API_KEY');

        dd($apiKey);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   // CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 30,
        //   CURLOPT_SSL_VERIFYHOST => 0,
        //   CURLOPT_SSL_VERIFYPEER => 0,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_POSTFIELDS => json_encode($fields),
        //   CURLOPT_HTTPHEADER => array(
        //     "authorization: ".$apiKey."",
        //     "accept: */*",
        //     "cache-control: no-cache",
        //     "content-type: application/json"
        //   ),
        // ));

        // dd($curl);

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     UserOtpVerification::create([
        //         'mobile'=> $request->phone,
        //         'sendOtp'=> $getOtp,
        //         'check_status' => 'unverified'
        //     ]);
        //     return $response;
        // }
    }

    public function verifyOtp($request)
    {
        $userOtp = UserOtpVerification::where('mobile', $request->phone)->first();

        $userReport = [
                'message' => 'Otp Not Verified',
                'success' => false
            ];

        if($userOtp == $request->Otp)
        {
            $userOtp->check_status = 'Verified';
            $userOtp->save();

            $userReport = [
                'message' => 'Otp Successfully Verified',
                'success' => true
            ];
        }

        return $userReport;
    }
}
