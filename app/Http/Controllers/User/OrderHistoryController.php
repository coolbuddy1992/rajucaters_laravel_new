<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Build_own_menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin_Setting;

class OrderHistoryController extends Controller
{
    public function orderHistory()
    {
        $user = User::where('id', Auth::id())->first();
        $orders = Order::where('phone', $user->phone_number)->orderBy('id', 'DESC')->get();
        $bom = Build_own_menu::all();
        $userDetail = Admin_Setting::find(1);


        return view('frontend.order.order-history', compact('orders', 'bom', 'user', 'userDetail'));
    }
}
