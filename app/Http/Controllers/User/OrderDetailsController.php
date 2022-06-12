<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Build_own_menu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\Admin_Setting;

class OrderDetailsController extends Controller
{
    public function userOrderDetails($order_id)
    {
        // $order = Order::whereId($order_id)->where('phone', Auth::user()->phone_number)
        //     ->with(['user'])
        //     ->first();
        
        // $orderItems = OrderItem::where('order_id', $order->id)
        //     ->with('product')
        //     ->orderBy('id', 'DESC')->get();

        $order = Order::where('id', $order_id)->first();

        $user = User::where(['phone_number' => $order->phone, 'id' => Auth::user()->id])->first();

        $orderItems = OrderItem::where('order_id', $order->order_number)->first();

        $bom = Build_own_menu::all();

        $bom_menu = Build_own_menu::where('id', $orderItems->build_menu_id)->first();

        $userDetail = Admin_Setting::find(1);

        //return $orderItems;
        return view('frontend.order.order-details', compact(
            'order',
            'orderItems',
            'bom',
            'bom_menu',
            'user',
            'userDetail'
        ));
    }

    public function userInvoiceDownload($order_id)
    {
        $order = Order::where('order_number', $order_id)->first();

        $user = User::where(['phone_number' => $order->phone, 'id' => Auth::user()->id])->first();
        
        $orderItems = OrderItem::where('order_id', $order->order_number)->first();

        $pdf = PDF::loadView('frontend.order.invoice-download', compact('order','orderItems', 'user'))
            ->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download('invoice.pdf');
    }

    public function returnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'status' => 'cancel',
            'cancel_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function returnOrderList()
    {
        $orders = Order::where('user_id',Auth::id())
        ->where('return_reason','!=',NULL)
        ->where('status','=', 'return')
        ->orderBy('id','DESC')->get();
        return view('frontend.order.order-history',compact('orders'));
    }
    public function cancelOrderList()
    {
        $orders = Order::where('user_id',Auth::id())
        ->where('return_reason','!=',NULL)
        ->where('status','cancel')
        ->orderBy('id','DESC')->get();
        return view('frontend.order.order-history',compact('orders'));
    }
}
