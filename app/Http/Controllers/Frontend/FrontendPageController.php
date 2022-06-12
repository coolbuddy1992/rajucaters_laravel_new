<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Build_own_menu;
use App\Models\Build_own_menu_list;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Review;
use App\Http\Controllers\FileUploadController;
use App\Models\Admin_Setting;
use Session;

class FrontendPageController extends Controller
{
    public function home()
    {
        $bom = Build_own_menu::all();
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('slider_name', '=', 'Main-Slider')->where('slider_status', '=', 1)->limit(3)->get();
        $new_products = Product::with(['images'])->where('status', 1)->limit(20)->get();
        $gallery = Gallery::where('gallery_status','1')->inRandomOrder()->limit(5)->get();
        // $skip_category_0 = Category::skip(0)->first();
        // $skip_category_0 = Category::inRandomOrder()->first();
        $skip_category_0 = Category::first();
        
        if (!empty($skip_category_0)) {
            $skip_category_products_0 = Product::where('category_id', '6')
                            ->where('status', 1)
                            ->latest()->limit(20)->get();
        } else {
            $skip_category_products_0 = "";
        }

        $userDetail = Admin_Setting::find(1);
        $review = Review::all();

        return view('frontend.index', compact(
            'bom',
            'categories',
            'sliders',
            'new_products',
            'skip_category_0',
            'skip_category_products_0',
            'gallery',
            'userDetail',
            'review'
        ));
    }

    public function category()
    {
        $userDetail = Admin_Setting::find(1);
        return view('frontend.frontend_layout.category_page.category-page');
    }

    public function gallery()
    {
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $bom = Build_own_menu::all();
        $userDetail = Admin_Setting::find(1);
        
        return view('frontend.frontend_layout.home_page.gallery', compact('categories', 'bom'));
    }

    public function productDeatil($slug)
    {
        $bom = Build_own_menu::all();
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        if ((session()->get('language') == 'hindi')) {
            $product = Product::where('product_slug_hi',$slug)->first();
        } else {
            $product = Product::where('product_slug_en',$slug)->first();
        }
        
        $product_gallery = Product::with(['images'])->findOrFail($product->id);
        $related_products = Product::where('category_id',$product->category_id)
        ->where('id', '!=', $product->id)->orderBy('id','DESC')->get();

        $review = Review::all();
        $userDetail = Admin_Setting::find(1);
        $reviewCount = Review::where('product_id', $product->id)->count();
        $reviewRating = Review::where('product_id', $product->id)->get();
        // dd($reviewRating);

        return view('frontend.frontend_layout.product_page.product-page', compact(
            'categories',
            'product',
            'product_gallery',
            'related_products',
            'bom',
            'review',
            'userDetail',
            'reviewCount',
            'reviewRating'
        ));
    }

    public function tagwiseProduct($tag)
    {
        $bom = Build_own_menu::all();
        $tag_products = Product::where('status',1)->where('product_tags_en', $tag)
        ->where('product_tags_hi',$tag)->orderBy('id', 'DESC')->paginate(3);
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $userDetail = Admin_Setting::find(1);
        return view('frontend.tags.tags_view', compact('tag_products', 'categories', 'bom', 'userDetail'));
    }

    public function subcategoryProducts($id, $slug)
    {
        $bom = Build_own_menu::all();
        $subcategory_products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $userDetail = Admin_Setting::find(1);
        return view('frontend.frontend_layout.subcategory_page.subcategory_product_page', compact('subcategory_products', 'categories', 'bom', 'userDetail'));
    }

    public function subsubcategoryProducts($id, $slug)
    {
        $bom = Build_own_menu::all();
        $subsubcategory_products = Product::where('status', 1)->where('sub_subcategory_id', $id)->orderBy('id','DESC')->paginate(3);
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $userDetail = Admin_Setting::find(1);
        return view('frontend.frontend_layout.subcategory_page.subsubcategory_product_page', compact('subsubcategory_products', 'categories', 'bom', 'userDetail'));
    }

    public function productviewAjax($id)
    {
        $product = Product::with(['brand','category'])->findOrFail($id);
        $colors_en = explode(',', $product->product_color_en);
        $size_en = explode(',', $product->product_size_en);
        return response()->json([
            'product' => $product,
            'colors_en' => $colors_en,
            'size_en' => $size_en,
        ],200);
    }

    public function Build_own_menu(Request $request, $slug)
    {
        Session::forget('menuDetailCustomer');

        $bom = Build_own_menu::all();
        $bom_detail = Build_own_menu::with(['build_own_menu_list'])->where('slug_en',$slug)->latest()->get();
        $categories = Category::with(['subcategory'])->orderBy('category_name_en', 'ASC')->get();
        $categorieslist = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $getMenu = Build_own_menu::where('slug_en', $slug)->first();
        $menuSlug = $slug;
        $userDetail = Admin_Setting::find(1);

        return view('frontend.frontend_layout.bom.build_menu', compact('bom', 'bom_detail', 'categories', 'menuSlug', 'categorieslist', 'getMenu','userDetail')); 
    }

    public function getMenu(Request $request)
    {
        $category = $request->category;
        $categoryProduct = $request->categoryProduct;
        $subcategory = $request->subcatwithpro;
        $subsubcategory = $request->subsubcatwithpro;
        $catpro = [];
        $subcatData = [];
        $subsubcatData = [];

        // category product
        if (!empty($categoryProduct)) {
            foreach ($categoryProduct as $product) {
                if (!empty($product)) {
                    foreach ($product as $catproduct) {
                        $catpro[] = $catproduct;
                    }
                }
            }
        }

        //subcategory and subcategory product
        if (!empty($subcategory)) {
            foreach ($subcategory as $subcat) {
                $subcatNm = $subcat['subcatName'];
                $subcatProduct = [];
                if (!empty($subcat['product'])) {
                    foreach ($subcat['product'] as $subcatpro) {
                        $subcatProduct[$subcatNm]['subcategoryPro'][] = $subcatpro;
                    }
                }
                $subcatData[] = ['subcategoryName' => $subcat['subcatName'], 'subcatPro' => $subcatProduct ];
            }
        }

        //subsubcategory and subsubcategory product
        if (!empty($subsubcategory)) {
            foreach ($subsubcategory as $subsubcat) {
                $subsubcatName = $subsubcat['subsubcatName'];
                $subsubcatProduct = [];
                if (!empty($subsubcat['product'])) {
                    foreach($subsubcat['product'] as $subsubcatpro){
                        $subsubcatProduct[$subsubcatName]['subsubcatprod'][] = $subsubcatpro;
                    }
                }
                $subsubcatData[] = ['subsubcategoryName' => $subsubcat['subsubcatName'], 'subsubcatProducts' => $subsubcatProduct ];
            }
        }
        
        $menuData = ["data" => ["categoryDetail" => ["categoryName" => $category, "categoryProduct" => $catpro,"subcategoryDetail"=> $subcatData, "subsubcategoryDetail"=> $subsubcatData]]];
        
        // print_r($menuData);
        
        Session::push('menuDetailCustomer', $menuData);

        $menuSession = array_map("unserialize", array_unique(array_map("serialize", Session::get('menuDetailCustomer'))));

        $html = '<table border="1" class="menuTable">';

        foreach($menuSession as $menuDatas){
            $html .= '<tr>';
            foreach($menuDatas['data'] as $menucat){
                $html .= '<td>'.$menucat['categoryName'] .'</td>';
                $html .= '<td><table>';
                // For category Product
                if(!empty($menucat['categoryProduct'])){
                    $html .= '<tr><td><table><thead><th>Product</th></thead><tbody>';
                    foreach($menucat['categoryProduct'] as $catProDetail){
                        $html .= '<tr><td>' .$catProDetail. '</td></tr>';
                    }
                    $html .= '</tbody></table></td></tr>';
                }
                // For subcategory
                if(!empty($menucat['subcategoryDetail'])){
                    $html .= '<tr><td><table>';
                    foreach($menucat['subcategoryDetail'] as $subcatDetail){
                        $html .= '<thead><th>' .$subcatDetail['subcategoryName']. '</th></thead>';
                        // For subcategory Product
                        foreach($subcatDetail['subcatPro'] as $subcatProDetail){
                            $html .= '<tbody>';
                            foreach($subcatProDetail['subcategoryPro'] as $subcategoryPro){
                                $html .= '<tr><td>' .$subcategoryPro. '</td></tr>';
                            }
                            $html .= '</tbody>';
                        }
                    }
                    $html .= '</table></td></tr>';
                }

                // For subsubcategory
                if(!empty($menucat['subsubcategoryDetail'])){
                    $html .= '<tr>';
                    $html .= '<td>';
                    $html .= '<table>';
                    foreach($menucat['subsubcategoryDetail'] as $subsubcatDetail){
                        $html .= '<thead><th>' .$subsubcatDetail['subsubcategoryName']. '</th></thead>';
                        // For subsubcategory Product
                        foreach($subsubcatDetail['subsubcatProducts'] as $subsubcatProDetail){
                            $html .= '<tbody>';
                            foreach($subsubcatProDetail['subsubcatprod'] as $subsubcategoryPro){
                                $html .= '<tr><td>' .$subsubcategoryPro. '</td></tr>';
                            }
                            $html .= '</tbody>';
                        }
                    }
                    $html .= '</table></td></tr>';
                }
            
                $html .= '</table></td>';
            }
            $html .= '</tr>';

        }

        $html .= '</table>';

        
        
        // Session::push('menuDetailHtml', $html);

        $menuresponse = ['menuDataCustomer'=> $html ,'success' => 'Menu added Successfully, Please click next button to add more menu'];
        
        return $menuresponse;
    }

    public function userReviewImg(Request $request)
    {
        if($request->file('file')){

            $images = $request->file('file');
            $request_new = ["filename" => "Review", "image" => $images->getRealPath()];
            
            $imageDetail = (new FileUploadController)->storeUploads($request_new);
            $save_url = $imageDetail['photo'];
            $public_id = $imageDetail['public_id'];

            Session::put('reviewImg',['userImg'=>$save_url,'public_id'=>$public_id]);
        }
    }

    public function customerReview(Request $request)
    {

        $getImageSession = Session::get('reviewImg');
        
        Review::create([
            'name' => $request->name,
            'review_comments' => $request->comments,
            'rating' => $request->rating,
            'review_image' => $getImageSession['userImg'],
            'public_id' => $getImageSession['public_id'],
            'review_type' => $request->review_type,
            'product_detail'=> $request->product_detail,
            'product_id' => $request->product_id
        ]);

        $notification = [
            'message' => 'Review Add Successfully!!!',
            'alert-type' => 'success',
            'success' => TRUE
        ];

        return $notification;
    }

}
