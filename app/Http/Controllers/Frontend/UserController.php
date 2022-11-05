<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Size;
use App\Models\AddOn;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function my_order()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('frontend.my-orders', compact('orders'));
    }

    public function view_order($id)
    {
        $addOns = AddOn::all();
        $reg_size = Size::all();
        $orders = Order::findorfail($id);
        return view('frontend.view-order', compact('orders', 'addOns', 'reg_size'));
    }
}
