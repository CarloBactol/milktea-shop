<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddOn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddOnsController extends Controller
{
    // display addOns all records 
    public function index()
    {
        $sinkers = AddOn::all();
        return view('admin.addOns.index', compact('sinkers'));
    }

    // show addons form
    public function show()
    {
        return view('admin.addOns.add-sinker');
    }

    // store addOns
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:200',
        ]);

        $add_on = new AddOn();
        $add_on->name = $request->input('name');
        $add_on->save();
        return response()->json('status', "New data Added");
    }

    // edit addOns
    public function edit($id)
    {
        $sinkers = AddOn::findorfail($id);
        return view('admin.addOns.edit-sinker', compact('sinkers'));
    }

    // update addOns
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:200',
            'price' => 'filled'
        ]);

        $add_on = Addon::findorfail($id);
        $add_on->name = $request->input('name');
        $add_on->price = $request->input('price');
        $add_on->update();
        return redirect('/admin/sinker-list')->with('status', 'Sinker Updated Successful!');
    }

    // delete single addOns 
    public function destroy($id)
    {
        $add_on = Addon::findorfail($id);
        $add_on->delete();
        return redirect('/admin/sinker-list')->with('status', 'Deleted Successful!');
    }
}
