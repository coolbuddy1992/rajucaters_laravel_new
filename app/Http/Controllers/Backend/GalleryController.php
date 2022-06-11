<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Requests\GalleyStoreRequest;
use App\Http\Requests\GalleyUpdateRequest;
use Image;
use App\Http\Controllers\FileUploadController;
use App\Models\Admin_Setting;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Gallery.index', compact('gallery', 'adminSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Gallery.create', compact('adminSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleyStoreRequest $request)
    {
        if($request->file('gallery_image')){
            // $upload_location = 'upload/sliders/';
            // $file = $request->file('slider_image');
            // $name_gen = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            // Image::make($file)->resize(870,370)->save($upload_location.$name_gen);
            // $save_url = $upload_location.$name_gen;

            $images = $request->file('gallery_image');
            $request_new = ["filename" => "Gallery", "image" => $images->getRealPath()];
            $imageDetail = (new FileUploadController)->storeUploads($request_new);
            
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];
            // dd($public_id);

            Gallery::create([
                'gallery_status' => $request->input('gallery_status'),
                'photo_name' => $request->input('gallery_name'),
                'photo_location' => $save_url,
                'public_id' => $public_id
            ]);
        }
        $notification = [
            'message' => 'Gallery Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('gallery.index')->with($notification);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Gallery.edit', compact('gallery', 'adminSetting'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $galleryImage = (new FileUploadController)->deleteImage($gallery->public_id);

        if($galleryImage) {

            if($request->file('gallery_image')){

                $images = $request->file('gallery_image');
                $request_new = ["filename" => "Gallery", "image" => $images->getRealPath()];
                $imageDetail = (new FileUploadController)->storeUploads($request_new);
                
                $save_url = $imageDetail['photo'];
                $public_id = $imageDetail['public_id'];
                
                $gallery->update([
                    'gallery_status' => $request->input('gallery_status'),
                    'photo_name' => $request->input('gallery_name'),
                    'photo_location' => $save_url,
                    'public_id' => $public_id
                ]);
            }

            $notification = [
                'message' => 'Gallery Updated Successfully!!!',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Gallery Not Updated Successfully!!!',
                'alert-type' => 'success'
            ];
        }

        return redirect()->route('gallery.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $galleryImage = (new FileUploadController)->deleteImage($gallery->public_id);

        if($galleryImage){

            $gallery->delete();

            $notification = [
                'message' => 'Gallery Image Delete Successfully!!!',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Gallery Image Not Delete Successfully!!!',
                'alert-type' => 'success'
            ];
        }

        return redirect()->route('gallery.index')->with($notification);   
    }

    public function changegallerystatus(Request $request)
    {
     
        $gallery = Gallery::findOrFail($request->gallery_id);
        $gallery->gallery_status = $request->status;
        $gallery->save();

         $notification = [
            'message' => 'Gallery Status Updated Successfully!!!',
            'alert-type' => 'success'
        ];
        return response()->json($notification, 200);

    }
}
