<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Size;
use App\Models\AddOn;
use App\Models\Premium;
use App\Models\Product;
use App\Models\Category;
use App\Models\PremiumAddon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $this->validate($request, [
            'addons' => 'required'
        ]);

        $product_id = $request->input('product_id');
        $category_id = $request->input('category_id');
        $bottle_size_id = $request->input('bottle_size');;
        $sugar_level = $request->input('sugar_level');
        $addons = $request->input('addons');
        $product_qty = $request->input('product_qty');

        $cartItem = new Cart();
        $cartItem->product_id = $product_id;
        $cartItem->category_id = $category_id;
        $cartItem->user_id = Auth::id();
        $cartItem->bottle_size_id = $bottle_size_id;
        $cartItem->sugar_level = $sugar_level;
        $cartItem->add_ons_id = json_encode($addons);
        $cartItem->product_qty = $product_qty;
        $cartItem->save();
        return response()->json(['status' => " Added to cart"]);
    }

    public function cart()
    {
        $addons = AddOn::all();
        $premAddons = PremiumAddon::all();
        $premiumAddons = Premium::all();
        $categories = Category::all();
        // remove out of stock items
        $old_cart_items = Cart::where('user_id', Auth::id())->get();
        foreach ($old_cart_items as $item) {
            // if (!Product::where('id', $item->product_id)->where('qty', '>=', $item->product_qty)->exists()) {
            //     $removeItem = Cart::where('product_id', $item->product_id)->where('user_id', Auth::id())->first();
            //     $removeItem->delete();
            // }
        }

        $cart_items = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cart_items', 'addons', 'premiumAddons', 'categories', 'premAddons'));
    }

    public function delete_cart(Request $request)
    {

        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart_item = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart_item->delete();
                return response()->json(['status' => 'Cart item deleted']);
            }
        } else {
            return response()->json(['status' => 'Login to continue']);
        }
    }

    // cart-count
    public function cart_count()
    {
        $cart_counts = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cart_counts]);
    }
}
