<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingFee;
use Illuminate\Http\Request;

class ShippingFeeController extends Controller
{
    public function index()
    {
        $shipping = ShippingFee::all();
        return  view('admin.shipping.index', compact('shipping'));
    }

    public function show()
    {
        return  view('admin.shipping.add-shipping-fee');
    }

    public function store(Request $request)
    {
        // validate data 
        $this->validate($request, ['shipping' => 'required']);

        $shipping = new ShippingFee();
        $shipping->shipping = $request->input('shipping');
        $shipping->save();
        return redirect('/admin/shipping-fee')->with('status', 'Added Successfully!');
    }

    public function edit($id)
    {
        $shipping_fee = ShippingFee::findorfail($id);
        return view('admin.shipping.edit-shipping-fee', compact('shipping_fee'));
    }

    public function update(Request $request, $id)
    {
        // validate data 
        $this->validate($request, ['shipping' => 'required']);

        $shipping =  ShippingFee::findorfail($id);
        $shipping->shipping = $request->input('shipping');
        $shipping->update();
        return redirect('/admin/shipping-fee')->with('status', 'Updated Successfully!');
    }

    public function destroy($id)
    {
        $shipping_fee = ShippingFee::findorfail($id);
        $shipping_fee->delete();
        return redirect('/admin/shipping-fee')->with('status', 'Deleted Successfully!');
    }
}
