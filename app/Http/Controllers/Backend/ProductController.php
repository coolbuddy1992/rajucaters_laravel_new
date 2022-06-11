<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image as ModelsImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Http\Controllers\FileUploadController;
use App\Models\Admin_Setting;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'subsubcategory', 'images'])->latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Product.index',compact('products', 'adminSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.Product.create', compact(
            'brands',
            'categories',
            'subcategories',
            'subsubcategories',
            'adminSetting'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $save_url = '';
        $public_id = '';
        if($request->file('product_thumbnail'))
        {
            $images = $request->file('product_thumbnail');
            $request_new = ["filename" => "Product/Thumbnail", "image" => $images->getRealPath()];
            $imageDetail = (new FileUploadController)->storeUploads($request_new);
            
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];
        }
        if($request->input('subcategory_id') == 'Select SubCategory'){
            $subcatid  = Null;
        } else {
            $subcatid  = $request->input('subcategory_id');
        }
        if($request->input('sub_subcategory_id') == 'Select Sub-SubCategory'){
            $subsubcatid  = Null;
        } else {
            $subsubcatid  = $request->input('sub_subcategory_id');
        }
        $product = Product::create([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $subcatid,
            'sub_subcategory_id' => $subsubcatid,
            'product_name_en' => $request->input('product_name_en'),
            'product_name_hi' => $request->input('product_name_hi'),
            'product_slug_en' => Str::slug($request->input('product_name_en')),
            'product_slug_hi' => (new FileUploadController)->add_hypen($request->input('product_name_hi')),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'product_tags_en' => $request->input('product_tags_en'),
            'product_tags_hi' => $request->input('product_tags_hi'),
            'short_description_en' => $request->input('short_description_en'),
            'short_description_hi' => $request->input('short_description_hi'),
            'long_description_en' => $request->input('long_description_en'),
            'long_description_hi' => $request->input('long_description_hi'),
            'status' => $request->input('status')|false,
            'product_thumbnail' => $save_url,
            'public_id' => $public_id,
            ]);


            if($request->file('product_images'))
            {
                $images = $request->file('product_images');
                foreach ($images as $single_image) {
                    $request_new = ["filename" => "Product/Multi_images", "image" => $single_image->getRealPath()];
                    $imageDetail = (new FileUploadController)->storeUploads($request_new);
                    
                    $save_url = $imageDetail['photo'];
                    $public_id = $imageDetail['public_id'];
                    ModelsImage::create([
                        'product_id' => $product->id,
                        'photo_name' => $save_url,
                        'public_id' => $public_id
                    ]);
                }
            }

        $notification = [
            'message' => 'Product Created Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

        // 'product_thumbnail' => 'required|mimes:png,jpg',
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['category', 'subcategory', 'subsubcategory', 'images'])->findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $product = Product::with(['category', 'subcategory', 'subsubcategory', 'images'])->findOrFail($id);
        $productImage = Image::where('product_id', $product->id)->get();
        $adminSetting = Admin_Setting::find(1);
        
        return view('admin.Product.edit', compact('product', 'categories', 'subcategories', 'subsubcategories', 'adminSetting'));
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
        $product = Product::findOrFail($id);
        
        $product->update([
            'category_id' => $request->input('category_id'),
            'subcategory_id' => $request->input('subcategory_id'),
            'sub_subcategory_id' => $request->input('sub_subcategory_id'),
            'product_name_en' => $request->input('product_name_en'),
            'product_name_hi' => $request->input('product_name_hi'),
            'product_slug_en' => Str::slug($request->input('product_name_en')),
            'product_slug_hi' => (new FileUploadController)->add_hypen($request->input('product_name_hi')),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'product_tags_en' => $request->input('product_tags_en'),
            'product_tags_hi' => $request->input('product_tags_hi'),
            'short_description_en' => $request->input('short_description_en'),
            'short_description_hi' => $request->input('short_description_hi'),
            'long_description_en' => $request->input('long_description_en'),
            'long_description_hi' => $request->input('long_description_hi'),
            'status' => $request->input('status')|false
            ]);

        if($request->file('product_thumbnail')){
            
            $request_new = ["filename" => "Product/Thumbnail", "image" => $request->file('product_thumbnail')->getRealPath(), "public_id"=> $product->public_id];
            $imageDetail = (new FileUploadController)->UpdateUploads($request_new);
            
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];

            $product->update([
                'product_thumbnail' => $save_url,
                'public_id' => $public_id
            ]);
        }

        $notification = [
            'message' => 'Product Updated Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $productImageRemove = (new FileUploadController)->deleteImage($product->public_id);
        
        if($productImageRemove){
            $product_images = ModelsImage::where('product_id', '=',$product->id)->get();
                foreach ($product_images as $value) {
                    $multiImageRemove = (new FileUploadController)->deleteImage($value->public_id);
                    $value->delete();
                }
                $product->delete();
        }

        $notification = [
            'message' => 'Product Deleted Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('products.index')->with($notification);
    }


    public function MultiImageUpdateNew(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if($request->file('product_images'))
        {
            $images = $request->file('product_images');
            foreach ($images as $single_image) {
                $request_new = ["filename" => "Product/Multi_images", "image" => $single_image->getRealPath()];
                $imageDetail = (new FileUploadController)->storeUploads($request_new);
                
                $save_url = $imageDetail['photo'];
                $public_id = $imageDetail['public_id'];
                ModelsImage::create([
                    'product_id' => $product->id,
                    'photo_name' => $save_url,
                    'public_id' => $public_id
                ]);
            }
        }

        $notification = array(
                'message' => 'Product Image Updated Successfully',
                'alert-type' => 'info'
            );

        return redirect()->back()->with($notification);
       
    }
    public function MultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	       $imgDel = ModelsImage::findOrFail($id);
	    
     //    unlink($imgDel->photo_name);

    	// $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
     //    $upload_location = 'upload/products/multi_images/';
    	// Image::make($img)->resize(600,600)->save($upload_location.$make_name);
    	// $uploadPath = $upload_location.$make_name;

            $request_new = ["filename" => "Product/Multi_images", "image" => $img->getRealPath(), "public_id"=> $product->public_id];
            $imageDetail = (new FileUploadController)->UpdateUploads($request_new);
                
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];
            
            ModelsImage::where('id',$id)->update([
        		'photo_name' => $save_url,
                'public_id' => $public_id,
        		'updated_at' => Carbon::now(),

        	]);
        }

        $notification = array(
    			'message' => 'Product Image Updated Successfully',
    			'alert-type' => 'info'
    		);

    		return redirect()->back()->with($notification);
        }

    public function changeStatus(Request $request)
    {
        //dd($request->all());
        $product = Product::findOrFail($request->product_id);
        $product->status = $request->status;
        $product->save();

        return response()->json(['success'=>'Product status change successfully.']);
    }
}
