<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class FileUploadController extends Controller
{
    public function storeUploads($request_new)
    {
        if ($request_new['filename'] == "Banner") {
            Cloudder::upload($request_new['image'], null, array(
                "folder" => 'rjcaters/'.$request_new['filename'],  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, 
                "transformation" => array(
                        "quality" => "auto", 
                        "fetch_format" => "auto"
                    )
            ));
            $image = Cloudder::show(
                Cloudder::getPublicId(), [
                    "fetch_format" => "auto",
                    "quality" => "auto", 
                    "secure" => "true"
                ]);
        } else {
            Cloudder::upload($request_new['image'], null, array(
                "folder" => 'rjcaters/'.$request_new['filename'],  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, 
                "transformation" => array(
                        "quality" => "auto", 
                        "fetch_format" => "auto",
                        "width" => "500", 
                        "height" => "500"
                    )
            ));
            $image = Cloudder::show(
                Cloudder::getPublicId(), [
                    "fetch_format" => "auto",
                    "quality" => "auto", 
                    "width" => "500", 
                    "height" => "500",
                    "secure" => "true",
                ]);
        }
        
        $pbid = Cloudder::getPublicId();
        // $public_id = explode('/', $pbid);
        $image_detail = ['photo' => $image, 'public_id' => $pbid];

        return $image_detail;
    }

    public function UpdateUploads($request_new)
    {
        if (!empty($request_new['public_id'])) {
            Cloudder::delete($request_new['public_id']);
        }
        
        if ($request_new['filename'] == "Banner") {
            

            Cloudder::upload($request_new['image'], null, array(
                "folder" => 'rjcaters/'.$request_new['filename'],  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, 
                "transformation" => array(
                        "quality" => "auto", 
                        "fetch_format" => "auto",
                    )
            ));
            $image = Cloudder::show(
                Cloudder::getPublicId(), [
                    "fetch_format" => "auto",
                    "quality" => "auto",
                    "secure" => "true"
                ]);
        } else {
            
            Cloudder::upload($request_new['image'], null, array(
                "folder" => 'rjcaters/'.$request_new['filename'],  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, 
                "transformation" => array(
                        "quality" => "auto", 
                        "fetch_format" => "auto",
                        "width" => "500", 
                        "height" => "500"
                        
                    )
            ));
            $image = Cloudder::show(
                Cloudder::getPublicId(), [
                    "fetch_format" => "auto",
                    "quality" => "auto",
                    "width" => "500", 
                    "height" => "500",
                    "secure" => "true"
                ]);

        }
        
        $image_detail = ['photo' => $image, 'public_id' => Cloudder::getPublicId()];

        return $image_detail;
    }

    public function add_hypen($string)
    {
        for ($i = 0; $i < strlen($string); ++$i)
        {
        
            if ($string[$i] == ' ')
            {
                $string[$i] = '-';
            }
        }

        $new_string = $string. "\n";

        return $new_string;
    }

    public function deleteImage($publicId)
    {
        $imagedelete = Cloudder::delete($publicId);

        if($imagedelete) {
            return TRUE;
        }
    }
}
