<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    public function show()
    {
        return view('admin.size.add-bottle-size');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['size' => 'required', 'price' => 'filled']);

        $size = new Size();
        $size->size = $request->input('size');
        $size->price = $request->input('price');
        $size->save();
        return redirect('/admin/bottle-size')->with('status', 'New Added!');
    }

    public function edit($id)
    {
        $sizes = Size::findorfail($id);
        return view('admin.size.edit-bottle-size', compact('sizes'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['size' => 'required', 'price' => 'filled']);
        $size = Size::findorfail($id);
        $size->size = $request->input('size');
        $size->price = $request->input('price');
        $size->update();
        return redirect('/admin/bottle-size')->with('status', 'Upadate Successfully!');
    }

    public function destroy($id)
    {
        $sizes = Size::findorfail($id);
        $sizes->delete();
        return redirect('/admin/bottle-size')->with('status', 'Deleted Successfully!');
    }
}
