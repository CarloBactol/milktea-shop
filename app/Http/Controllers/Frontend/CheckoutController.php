<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ShippingFee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $shipping_fees = ShippingFee::all();
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('carts', 'shipping_fees'));
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
                'price' => $item->bottle_size,
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
}
