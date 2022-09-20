<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    // show form products 
    public function show()
    {
        $sizes = Size::all();
        return view('admin.product.add-product', compact('sizes'));
    }

    // store products 
    public function store(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required',
            'image' => 'required|image|min:0| max:1024', // image only 1mb required
            'name' => 'required|string|max:200',
            'description' => 'required',
            'size_id' => 'required',
        ]);

        $product = new Product();
        //check image files
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/products/',  $filename);
            $product->image = $filename;
        }

        $product->qty = $request->input('qty');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->size_id = $request->input('size_id');
        $product->status = $request->input('status') == True ? '1' : '0'; // if checkbox is checked 
        $product->popular = $request->input('popular') == True ? '1' : '0';  // if checkbox is checked 
        $product->save();
        return redirect('/admin/product-list')->with('status', 'New Product Created!');
    }


    // edit product form
    public function edit($id)
    {
        $products = Product::findorfail($id);
        return view('admin.product.edit-product', compact('products'));
    }

    // update product form
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'qty' => 'required',
            'image' => 'image|min:0| max:1024', // image only 1mb required
            'name' => 'required|string|max:200',
            'description' => 'required',
            'size_id' => 'required',
        ]);

        $product = Product::findorfail($id);
        if ($request->hasFile('image')) {
            $path = "assets/products/" . $product->image;

            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('assets/products/',  $filename);
            $product->image = $filename;
        }

        $product->qty = $request->input('qty');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->size_id = $request->input('size_id');
        $product->status = $request->input('status') == True ? '1' : '0'; // if checkbox is checked 
        $product->popular = $request->input('popular') == True ? '1' : '0';  // if checkbox is checked 
        $product->update();
        return redirect('/admin/product-list')->with('status', 'Update Successfully!');
    }

    // delete single products
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        if ($product->image) {
            $path = '/assets/products/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('/admin/product-list')->with('status', 'Deleted Successfully!');
    }
}
