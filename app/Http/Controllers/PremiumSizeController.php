<?php

namespace App\Http\Controllers;

use App\Models\Premium;
use Illuminate\Http\Request;

class PremiumSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premiumSize = Premium::all();
        return view('admin.premiumSize.index', compact('premiumSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.premiumSize.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['size' => 'required', 'price' => 'filled']);

        $premiumSize = new Premium();
        $premiumSize->size = $request->input('size');
        $premiumSize->price = $request->input('price');
        $premiumSize->save();
        return redirect('/premium_sizes')->with('status', 'Created Successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $premiumSizeId = Premium::findorfail($id);
        return view('admin.premiumSize.edit', compact('premiumSizeId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'price' => 'required|integer',
        ]);
        $premiumSizeId = Premium::findorfail($id);
        $premiumSizeId->price = $request->input('price');
        $premiumSizeId->update();
        return redirect('/premium_sizes')->with('status', 'Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $premiumSizeId = Premium::findorfail($id);
        $premiumSizeId->delete();
        return redirect('/premium_sizes')->with('status', 'Deleted Successful!');
    }
}
