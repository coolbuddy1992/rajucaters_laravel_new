<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubSubCategoryStoreRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\FileUploadController;
use App\Models\Admin_Setting;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsubCategories = SubSubCategory::with(['category','subcategory'])->latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.SubSubCategory.index', compact('subsubCategories', 'adminSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('subcategory')->latest()->get();
        $adminSetting = Admin_Setting::find(1);
        //dd($categories);
        return view('admin.SubSubCategory.create', compact('categories', 'adminSetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubSubCategoryStoreRequest $request)
    {
        if($request->file('subsubcategory_image')) {
            $request_new = ["filename" => "Subsubcategory", "image" => $request->file('subsubcategory_image')->getRealPath()];
            $imageDetail = (new FileUploadController)->storeUploads($request_new);
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];
            SubSubCategory::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
                'subsubcategory_name_hi' => $request->input('subsubcategory_name_hi'),
                'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
                'subsubcategory_slug_hi' => (new FileUploadController)->add_hypen($request->input('subsubcategory_name_hi')),
                'subsubcategory_image' => $save_url,
                'public_id' => $public_id
            ]);
        } else {
            SubSubCategory::create([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
                'subsubcategory_name_hi' => $request->input('subsubcategory_name_hi'),
                'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
                'subsubcategory_slug_hi' => (new FileUploadController)->add_hypen($request->input('subsubcategory_name_hi')),
            ]);
        }

        $notification = [
            'message' => 'Sub Sub Category Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subsubcategories.index')->with($notification);
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
        $subsubCategory = SubSubCategory::findOrFail($id);
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.SubSubCategory.edit', compact('categories','subcategories','subsubCategory', 'adminSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubSubCategoryStoreRequest $request, $id)
    {
        $subsubCategory = SubSubCategory::findOrFail($id);
        if($request->file('subsubcategory_image')) {
            $request_new = ["filename" => "Subsubcategory", "image" => $request->file('subsubcategory_image')->getRealPath(), "public_id"=>$subsubCategory->public_id];
            $imageDetail = (new FileUploadController)->UpdateUploads($request_new);
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];
            $subsubCategory->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
                'subsubcategory_name_hi' => $request->input('subsubcategory_name_hi'),
                'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
                'subsubcategory_slug_hi' => (new FileUploadController)->add_hypen($request->input('subsubcategory_name_hi')),
                'subsubcategory_image' => $save_url,
                'public_id' => $public_id
            ]);
        } else {
            $subsubCategory->update([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_name_en' => $request->input('subsubcategory_name_en'),
                'subsubcategory_name_hi' => $request->input('subsubcategory_name_hi'),
                'subsubcategory_slug_en' => Str::slug($request->input('subsubcategory_name_en')),
                'subsubcategory_slug_hi' => (new FileUploadController)->add_hypen($request->input('subsubcategory_name_hi')),
            ]);
        }

        $notification = [
            'message' => 'Sub Sub Category Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('subsubcategories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsubCategory = SubSubCategory::findOrFail($id);
        $subsubCategoryImageRemove = (new FileUploadController)->deleteImage($subsubCategory->public_id);

        if($subsubCategoryImageRemove){
            $subsubCategory->delete();

            $notification = [
                'message' => 'Sub Sub Category Deleted Successfully!!!',
                'alert-type' => 'success'
            ];
        }

        return redirect()->route('subsubcategories.index')->with($notification);
    }

    public function getSubCategory($category_id)
    {
        $subCategory = SubCategory::where('category_id','=', $category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subCategory);
    }

    public function getSubSubCategory($subcategory_id)
    {
        $subsubCategory = SubSubCategory::where('subcategory_id', '=', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubCategory);
    }
}
