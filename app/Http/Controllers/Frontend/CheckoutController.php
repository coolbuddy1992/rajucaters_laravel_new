<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\Shipping;
use App\Models\ShipState;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use Session;
use App\Models\Build_own_menu;
use App\Models\Build_own_menu_list;
use App\Models\User;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkoutStore(CheckoutStoreRequest $request)
    {
        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_postCode'] = $request->shipping_postCode;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe', compact(
                'data',
                'cart_total',
            ));
        }elseif($request->payment_method == 'card'){
            return "card";
        }else{
            return view('frontend.payment.cod', compact(
                'data',
                'cart_total',
            ));
        }
    }

    public function getDistrict($division_id)
    {
        $districts = ShipDistrict::where('division_id','=', $division_id)->orderBy('district_name','ASC')->get();
        return json_encode($districts);
    }
    public function getState($district_id)
    {
        $states = ShipState::where('district_id','=', $district_id)->orderBy('state_name','ASC')->get();
        return json_encode($states);
    }

    public function checkoutPage_old()
    {
        if(Auth::check()){
            
            if (sizeof(Cart::content()) > 0) {
                $carts = Cart::content();
                $cart_qty = Cart::count();
                // $cart_total = Cart::total();
                $cart_total = '10';

                $divisions = ShipDivision::with(['districts', 'states'])->latest()->get();
                //return $divisions;
                return view('frontend.checkout_page.checkout_page', compact(
                    'carts',
                    'cart_qty',
                    'cart_total',
                    'divisions'
                ));
            }else{
                $notification = [
                    'message' => 'Your shopping cart is empty!!',
                    'alert-type' => 'error'
                ];
                return redirect()->route('home')->with($notification);
            }
        }else{
            $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('login')->with($notification);
        }
    }

    // checkoutpage
    public function checkoutPage()
    {
        if (sizeof(Cart::content()) > 0) {
            $carts = Cart::content();
            $cart_qty = Cart::count();
            // $cart_total = Cart::total();
            $cart_total = '10';

            $divisions = ShipDivision::with(['districts', 'states'])->latest()->get();
            //return $divisions;
            return view('frontend.checkout_page.checkout_page', compact(
                'carts',
                'cart_qty',
                'cart_total',
                'divisions'
            ));
        }else{
            $notification = [
                'message' => 'Your shopping cart is empty!!',
                'alert-type' => 'error'
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    // Save Menu Detail
    public function storeMenu(Request $request)
    {
        $menuDetail = Session::get('menuDetailCustomer');
        if(!empty($menuDetail)) {
            // $json = json_encode($menuDetail);
            $json_menu = json_encode($menuDetail);
            $bomId = $request->input('bom_id');
        } else {
        
            $bomId = $request->input('bom_id');
            $bom_detail = Build_own_menu::with(['build_own_menu_list'])->where('id',$bomId)->first();
            $bom_menu_list = $bom_detail->build_own_menu_list;
            $bom_Menu_list = $bom_menu_list[0]->build_menu_list_name;
            $json = json_encode($bom_Menu_list);
            $json_menu = json_decode($json, TRUE);
        }

        $dt = Carbon::now();

        $order = new Order();
        $order->phone = $request->input('phone');
        $order->order_number = mt_rand() . $dt->second;
        $order->invoice_number = mt_rand() . $dt->year. $dt->second;
        $order->order_date = $dt;
        $order->order_month = $dt->month;
        $order->order_year = $dt->year;
        
        $order->save();

        $order_item = new OrderItem();
        $order_item->order_id = $order->order_number;
        $order_item->build_menu_id = $bomId;
        $order_item->menu_list = $json_menu;
        $order_item->save();

        $phoneNumber = $request->input('phone');

        $checkUser = User::where('phone_number', $phoneNumber)->first();

        if(empty($checkUser)) {
            User::create([
                'phone_number'=> $phoneNumber
            ]);
        }      

        // $notification = [
        //     'message' => 'Order Created Successfully!!!',
        //     'alert-type' => 'success',
        //     'success' => True
        // ];

        $menuresponse = ['success'=> TRUE ,'message' => 'Order Created Successfully!!!'];
        
        return $menuresponse;

        // return redirect()->route('home')->with($notification);
    }
}
