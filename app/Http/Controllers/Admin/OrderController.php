<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddOn;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', '0')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function view_order($id)
    {
        $addOns = AddOn::all();
        $orders = Order::findorfail($id);
        return view('admin.order.view-order', compact('orders', 'addOns'));
    }

    public function update_order(Request $request, $id)
    {
        $this->validate($request, ['status' => 'filled']);

        $orders = Order::findorfail($id);
        $orders->status = $request->input('status');
        $orders->update();
        return redirect('/admin/orders-list')->with('status', 'Orders Updated!');
    }

    public function order_history()
    {
        $orders = Order::where('status', '1')->get();
        return view('admin.order.order-history', compact('orders'));
    }

    public function delete_order($id)
    {
        $orders = Order::findorfail($id);
        $orders->delete();
        return redirect('/admin/order-history')->with('status', 'Orders Deleted!');
    }
}
