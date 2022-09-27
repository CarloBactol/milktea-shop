<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Size;
use App\Models\AddOn;
use App\Models\Product;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::where('popular', '1')->get();
        return view('frontend.index', compact('products'));
    }

    public function view_product($id)
    {
        $sinkers = AddOn::all();
        $sizes = Size::all();
        $products = Product::findorfail($id);
        return view('frontend.single-product', compact('products', 'sinkers', 'sizes'));
    }

    public function view_all_products()
    {
        $bottleSize = Size::all();
        $products = Product::where('status', '1')->get();
        return view('frontend.shop', compact('products', 'bottleSize'));
    }
}
