<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_Setting;
use App\Http\Controllers\FileUploadController;

class SettingController extends Controller
{
    public function settingUpdate(Request $request)
    {
        $adminSetting = Admin_Setting::find(1);

        $save_url_logo = Null;
        $public_id_logo = Null;

        $save_url_favicon = Null;
        $public_id_favicon = Null;

        if(empty($adminSetting))
        {   

            if($request->file('website_logo')){
                $images = $request->file('website_logo');
                $request_new = ["filename" => "WebsiteProfile", "image" => $images->getRealPath()];
                $imageDetail = (new FileUploadController)->storeUploads($request_new);
                
                $save_url_logo = $imageDetail['photo'];
                $public_id_logo = $imageDetail['public_id'];
            }

            if($request->file('website_favicon')){
                $images = $request->file('website_favicon');
                $request_new = ["filename" => "WebsiteProfile", "image" => $images->getRealPath()];
                $imageDetail = (new FileUploadController)->storeUploads($request_new);
                
                $save_url_favicon = $imageDetail['photo'];
                $public_id_favicon = $imageDetail['public_id'];
            }
            Admin_Setting::create([
               'website_title' => $request->website_title,
               'website_favicon' => $save_url_favicon,
               'website_logo' => $save_url_logo,
               'website_logo_pubic_id' => $public_id_logo,
               'website_favicon_public_id' => $public_id_favicon,
               'website_address' => $request->website_address,
               'website_address_city' => $request->website_address_city,
               'website_address_state' => $request->website_address_state,
               'website_address_pin' => $request->website_address_pin,
               'website_email' => $request->website_email,
               'website_phone_1' => $request->website_phone_1,
               'website_phone_2' => $request->website_phone_2,
               'website_phone_3' => $request->website_phone_3,
               'website_phone_4' => $request->website_phone_4
            ]);
        } else {

            if(!empty($request->website_title)){
                $adminSetting->website_title = $request->website_title;
            }

            if(!empty($request->website_favicon)){

                $deleteWebProfilefavIcon = (new FileUploadController)->deleteImage($adminSetting->website_favicon_public_id);

                if($deleteWebProfilefavIcon){
                
                    if($request->file('website_favicon')){
                        $images = $request->file('website_favicon');
                        $request_new = ["filename" => "WebsiteProfile", "image" => $images->getRealPath()];
                        $imageDetail = (new FileUploadController)->storeUploads($request_new);
                        
                        $save_url_favicon = $imageDetail['photo'];
                        $public_id_favicon = $imageDetail['public_id'];

                        $adminSetting->website_favicon = $save_url_favicon;
                        $adminSetting->website_favicon_public_id = $public_id_favicon;
                    }
                }

            }
            if(!empty($request->website_logo)){

                $deleteWebProfilelogo = (new FileUploadController)->deleteImage($adminSetting->website_logo_pubic_id);

                if($deleteWebProfilelogo){
                    if($request->file('website_logo')){
                        $images = $request->file('website_logo');
                        $request_new = ["filename" => "WebsiteProfile", "image" => $images->getRealPath()];
                        $imageDetail = (new FileUploadController)->storeUploads($request_new);
                        
                        $save_url_logo = $imageDetail['photo'];
                        $public_id_logo = $imageDetail['public_id'];
                    
                        $adminSetting->website_logo = $save_url_logo;
                
                        $adminSetting->website_logo_pubic_id = $public_id_logo;
                    }
                }
            }
            if(!empty($request->website_address)){
                $adminSetting->website_address = $request->website_address;
            }
            if(!empty($request->website_address_city)){
                $adminSetting->website_address_city = $request->website_address_city;
            }
            if(!empty($request->website_address_state)){
                $adminSetting->website_address_state = $request->website_address_state;
            }
            if(!empty($request->website_address_pin)){
                $adminSetting->website_address_pin = $request->website_address_pin;
            }
            if(!empty($request->website_email)){
                $adminSetting->website_email = $request->website_email;
            }
            if(!empty($request->website_phone_1)){
                $adminSetting->website_phone_1 = $request->website_phone_1;
            }
            if(!empty($request->website_phone_2)){
                $adminSetting->website_phone_2 = $request->website_phone_2;
            }
            if(!empty($request->website_phone_3)){
                $adminSetting->website_phone_3 = $request->website_phone_3;
            }
            if(!empty($request->website_phone_4)){
                $adminSetting->website_phone_4 = $request->website_phone_4;
            }
            
            $adminSetting->save();
        }

        $notification = [
            'message' => 'Web Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.dashboard')->with($notification);
    }
}
