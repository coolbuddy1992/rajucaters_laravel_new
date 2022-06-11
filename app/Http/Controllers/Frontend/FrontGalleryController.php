<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Category;
use App\Models\Admin_Setting;

class FrontGalleryController extends Controller
{
    public function gallery()
    {
        $gallery = Gallery::where('gallery_status','1')->get();
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        $userDetail = Admin_Setting::find(1);
        return view('frontend.frontend_layout.home_page.gallery', compact('gallery', 'categories', 'userDetail'));
    }
}
