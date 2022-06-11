<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Build_own_menu;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin_Setting;
use App\Models\Review;


class AdminDashBoardController extends Controller
{
    public function index()
    {
        $adminSetting = Admin_Setting::find(1);
        $user = User::count();
        $order = Order::count();
        $bomCount = Build_own_menu::count();
        $category = Category::count();
        $product = Product::count();
        $reviewCount = Review::count();
        return view('admin.index', compact('adminSetting', 'user', 'order', 'bomCount', 'category', 'product', 'reviewCount'));
    }

    public function setting(Request $request)
    {
        $editData = Admin_Setting::find(1);
        $adminSetting = Admin_Setting::find(1);
        return view('admin.setting', compact('editData', 'adminSetting'));
    }

    public function reviewDetail(Request $request)
    {
        $review = Review::all();
        $adminSetting = Admin_Setting::find(1);
        return view('admin.dashboard_layout.testimonial', compact('review', 'adminSetting'));
           
    }
}
