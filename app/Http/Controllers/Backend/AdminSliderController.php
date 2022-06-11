<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderStoreRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use App\Models\Admin_Setting;
use App\Http\Controllers\FileUploadController;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Slider.index', compact('sliders', 'adminSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Slider.create', compact('adminSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderStoreRequest $request)
    {

        if($request->file('slider_image')){
            $images = $request->file('slider_image');
            $request_new = ["filename" => "Slider", "image" => $images->getRealPath()];
            $imageDetail = (new FileUploadController)->storeUploads($request_new);
            
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];

            Slider::create([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
                'slider_image' => $save_url,
                'public_id' => $public_id,
            ]);
        }else{
            Slider::create([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
            ]);
        }

        $notification = [
            'message' => 'Slider Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
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
        $slider = Slider::findOrFail($id);
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Slider.edit', compact('slider', 'adminSetting'));
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
        $slider = Slider::findOrFail($id);

        // $sliderImage = (new FileUploadController)->deleteImage($slider->public_id);
        
        if($request->file('slider_image')){
            $images = $request->file('slider_image');
            $request_new = ["filename" => "Slider", "image" => $images->getRealPath(),"public_id"=>$slider->public_id];
            $imageDetail = (new FileUploadController)->UpdateUploads($request_new);
            
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];


            $slider->update([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
                'slider_image' => $save_url,
                'public_id' => $public_id,
            ]);
        }else{
            $slider->update([
                'slider_status' => $request->input('slider_status'),
                'slider_name' => $request->input('slider_name'),
                'slider_title' => $request->input('slider_title'),
                'slider_description' => $request->input('slider_description'),
            ]);
        }

        $notification = [
            'message' => 'Slider Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $sliderImage = (new FileUploadController)->deleteImage($slider->public_id);
        if($sliderImage){
            $slider->delete();
        }

        $notification = [
            'message' => 'Slider Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.index')->with($notification);
    }

    public function changeSliderStatus(Request $request)
    {
        $slider = Slider::findOrFail($request->slider_id);
        $slider->slider_status = $request->status;
        $slider->save();

         $notification = [
            'message' => 'Slider Status Updated Successfully!!!',
            'alert-type' => 'success'
        ];
        return response()->json($notification, 200);
    }
}
