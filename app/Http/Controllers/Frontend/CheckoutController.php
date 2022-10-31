<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Size;
use App\Models\User;
use App\Models\AddOn;
use App\Models\Order;
use App\Models\Product;
use App\Models\Distance;
use App\Models\OrderItem;
use App\Models\ShippingFee;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // IP ADDRESS 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $ip = $ipaddress;
        $getIp = GeoIP::getLocation($ip);

        $distances = Distance::all();
        $addons = AddOn::all();
        $bottle_size = Size::all();
        $shipping_fees = ShippingFee::all();
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('carts', 'shipping_fees', 'getIp', 'addons', 'bottle_size', 'distances'));
    }

    public function place_order(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required|integer',
        ]);


        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total_price = $request->input('total_price');
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('lastname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->postal_code = $request->input('postal_code');
        $order->tracking_no = time() . rand(1000, 9999);

        $order->distance = $request->input('distance');

        $order->shipping = $request->input('shipping');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');
        $order->save();

        $cart_items = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cart_items);

        foreach ($cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'sugar_level' => $item->sugar_level,
                'add_ons' => $item->add_ons_id,
                'qty' => $item->product_qty,
            ]);

            // remove cart
            $prod = Product::where('id', $item->product_id)->first();
            $prod->qty = $prod->qty - $item->product_qty;
            $prod->update();
        }


        if (Auth::user()->address == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->postal_code = $request->input('postal_code');
            $user->update();
        }

        if ($request->input('payment_mode') == "Paid by Paypal") {
            return response()->json(['status' => 'Order placement successfully!']);
        }
        return redirect('/my-order')->with('status', 'Place Order Successfully Added!');
    }

    public function load_ship(Request $request)
    {
        $check_if_exist = ShippingFee::where('user_id', Auth::id())->exists();
        $total = 0;
        if ($check_if_exist) {
            $distance = Distance::where('user_id', Auth::id())->first();
            $sanitize = $distance->name;
            $only_number = filter_var($sanitize, FILTER_SANITIZE_NUMBER_INT);
            // less than 1km 
            if ($only_number >= -1) {
                $total = 100;
                $driving_fee = ShippingFee::where('user_id', Auth::id())->first();
                $driving_fee->shipping = $total;
                $driving_fee->update();
            }
            // 12km above
            if ($only_number >= 120) {
                $total = 150;
                $driving_fee = ShippingFee::where('user_id', Auth::id())->first();
                $driving_fee->shipping = $total;
                $driving_fee->update();
            }
            // check if data is exists
            $cheeck_user_ship = ShippingFee::where('user_id', Auth::id())->exists();
            if ($cheeck_user_ship == true) {
                $update_ship = ShippingFee::where('user_id', Auth::id())->first();
                $update_ship->shipping = $total;
                $update_ship->update();
            }
        } else {
            $new_ship  = new ShippingFee();
            $new_ship->user_id = Auth::id();
            $new_ship->shipping = $total;
            $new_ship->save();
        }

        return response()->json(['count' => $total]);
    }

    public function load_total()
    {

        $grand_total = 0;
        $total = 0;
        $get_shipping_fee = ShippingFee::where('user_id', Auth::id())->get();
        foreach ($get_shipping_fee as $fee) {
            $total = $fee->shipping;
        }
        // cart 
        $cart = Cart::where('user_id',  Auth::id())->get();
        foreach ($cart as $item) {
            $qty =  $item->product_qty;
            if ($item->bottle_size_id == $item->bottle->id) {
                $btl_size = $item->bottle->price;
            }
            $add_ons = json_decode($item->add_ons_id);
            $total_add_ons = count($add_ons) * 10;

            $sum_of_addons_bottle = $total_add_ons + $btl_size;
            $sum_of_qty_addons_bottle = $qty * $sum_of_addons_bottle;
            $grand_total = $sum_of_qty_addons_bottle + $total;
        }
        return response()->json(['count' => $grand_total]);
    }
}
