<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Size;
use App\Models\AddOn;
use App\Models\Premium;
use App\Models\Product;
use App\Models\Category;
use App\Models\PremiumAddon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::where('category_id', '3')->get();
        return view('frontend.index', compact('products'));
    }

    public function view_product($id)
    {
        $premiumBottle = Premium::all();
        $premiumAddOn = PremiumAddon::All();
        $sinkers = AddOn::all();
        $sizes = Size::all();
        $products = Product::findorfail($id);
        return view('frontend.single-product', compact('products', 'sinkers', 'sizes', 'premiumBottle', 'premiumAddOn'));
    }

    public function view_all_products(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();
        // ajax
        if ($request->ajax()) {
            if (empty($request->category)) {
                $products = $query->get();
            } else {
                $products = $query->where(['category_id' => $request->category])->get();
            }
            return response()->json(['products' => $products]);
        }

        $products = Product::where('status', '1')->get();
        return view('frontend.shop', compact('products', 'categories'));
    }
}
