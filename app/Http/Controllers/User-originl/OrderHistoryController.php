<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function orderHistory()
    {
        $userDetail = User::where('id', Auth::id())->first();
        $orders = Order::where('phone', $userDetail->phone_number)->orderBy('id', 'DESC')->get();
        return view('frontend.order.order-history', compact('orders'));
    }
}
